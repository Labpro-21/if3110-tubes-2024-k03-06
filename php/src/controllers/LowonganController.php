<?php

include("core/Controller.php");
include_once("config/Database.php");
require_once __DIR__ . '/../models/Company.php';

class LowonganController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"])) {
            if (isset($_GET['id'])) {
                $_SESSION['lowongan_id'] = $_GET['id'];
                if ($_SESSION['user']->role == 'company') {
                    $this->load("detailpage/lowongancomp/lowongancomp");
                } else {
                    $this->load("detailpage/lowonganjs/lowonganjs");
                }
            }
        } else {
            header("Location: /index");
        }
    }

    public function fetchJobs()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 3;
            $offset = ($page - 1) * $limit;

            $sort = isset($_GET['job-sort']) ? $_GET['job-sort'] : '';
            $jobType = isset($_GET['job-type']) ? $_GET['job-type'] : '';
            $jobLocation = isset($_GET['job-location']) ? $_GET['job-location'] : '';
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            // Where 1 = 1 is used to enable appending filters
            $baseQuery = " FROM _lowongan lo JOIN (SELECT user_id, nama FROM _user WHERE role = 'company') us ON lo.company_id = us.user_id WHERE 1=1";

            // Filters
            if ($jobType) {
                $baseQuery .= " AND jenis_pekerjaan = :jobType";
            }
            if ($jobLocation) {
                $baseQuery .= " AND jenis_lokasi = :jobLocation";
            }

            // Search
            if ($search) {
                $baseQuery .= " AND posisi ILIKE :search";
            }

            // Query to fetch jobs with LIMIT and OFFSET
            $jobQuery = "SELECT lo.lowongan_id, us.nama, lo.posisi, lo.jenis_pekerjaan, lo.jenis_lokasi, lo.updated_at" . $baseQuery;
            if ($sort) {
                $jobQuery .= " ORDER BY updated_at " . $sort;
            }
            $jobQuery .= " LIMIT :limit OFFSET :offset";

            // Query to count total results (no LIMIT, no OFFSET, no ORDER BY)
            $countQuery = "SELECT COUNT(*) as total " . $baseQuery;

            $db = Database::getInstance();
            $conn = $db->getConnection();

            // Prepare the job fetching query
            $stmtJob = $conn->prepare($jobQuery);
            $stmtJob->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmtJob->bindParam(':offset', $offset, PDO::PARAM_INT);

            // Prepare the count query
            $stmtCount = $conn->prepare($countQuery);

            // Bind parameters to both queries
            if ($jobType) {
                $stmtJob->bindParam(':jobType', $jobType);
                $stmtCount->bindParam(':jobType', $jobType);
            }
            if ($jobLocation) {
                $stmtJob->bindParam(':jobLocation', $jobLocation);
                $stmtCount->bindParam(':jobLocation', $jobLocation);
            }
            if ($search) {
                $searchParam = '%' . $search . '%';
                $stmtJob->bindParam(':search', $searchParam);
                $stmtCount->bindParam(':search', $searchParam);
            }

            // Execute both queries
            $stmtJob->execute();
            $lowonganList = $stmtJob->fetchAll(PDO::FETCH_ASSOC);

            $stmtCount->execute();
            $totalResults = $stmtCount->fetch()['total'];
            $totalPages = ceil($totalResults / $limit);

            // Return the results
            header('Content-Type: application/json');
            echo json_encode([
                'lowonganList' => $lowonganList,
                'totalPages' => $totalPages
            ]);
            exit();
        }
    }

    public function toAddJob()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"])) {
            $this->load("action/add-job");
        } else {
            $this->load("login/login");
        }
    }

    public function addJob()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $type = $_POST['type'];
            $location = $_POST['location'];

            $targetDir = "public/uploads/job_images/";

            // Buat direktori jika belum ada
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $imagePaths = [];
            if (isset($_FILES['image']) && $_FILES['image']['error'][0] == UPLOAD_ERR_OK) {

                foreach ($_FILES['image']['name'] as $key => $imageNameOriginal) {
                    $imageFileType = strtolower(pathinfo($imageNameOriginal, PATHINFO_EXTENSION));

                    // Buat nama file unik
                    $imageName = uniqid(md5(time() . '_' . bin2hex(random_bytes(5))), true) . '.' . $imageFileType;
                    $targetFile = $targetDir . $imageName;

                    // Validasi jenis file gambar
                    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo json_encode(['success' => false, 'message' => 'Format gambar tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.']);
                        exit();
                    }

                    // Pindahkan file gambar ke direktori tujuan
                    if (!move_uploaded_file($_FILES['image']['tmp_name'][$key], $targetFile)) {
                        echo json_encode(['success' => false, 'message' => 'Gagal mengunggah gambar pekerjaan.']);
                        exit();
                    }

                    $imagePaths[] = $targetFile;
                }
            }
            try {
                $company = new Company();
                if ($company->addLowongan($title, $description, $type, $location, $imagePaths)) {
                    echo json_encode(['success' => true, 'message' => 'Lowongan berhasil ditambahkan.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal menambahkan lowongan.']);
                }
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
            }
            exit();
        }
    }

    public function toEditJob()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"])) {
            if (isset($_GET["id"])) {
                $_SESSION["lowongan_id"] = $_GET["id"];
            }
            $this->load("action/update-job");
        } else {
            $this->load("login/login");
        }
    }

    public function editJob()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Ambil data dari form
            $lowongan_id = $_SESSION['lowongan_id'];
            $title = $_POST['job-title'];
            $description = $_POST['job-description'];
            $type = $_POST['job-type'];
            $location = $_POST['job-location'];
            $delete_images = isset($_POST['delete_images']) ? $_POST['delete_images'] : [];

            $targetDir = "public/uploads/job_images/";
            // Buat direktori jika belum ada
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            try {
                $db = Database::getInstance();
                $conn = $db->getConnection();

                $stmt = $conn->prepare("UPDATE _lowongan SET posisi = :title, deskripsi = :description, jenis_pekerjaan = :type, jenis_lokasi = :location, updated_at = NOW() WHERE lowongan_id = :lowongan_id");
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':type', $type);
                $stmt->bindParam(':location', $location);
                $stmt->bindParam(':lowongan_id', $lowongan_id);
                $stmt->execute();

                // Handle delete attachments
                if (!empty($delete_images)) {
                    foreach ($delete_images as $attachment_id) {
                        $stmt = $conn->prepare("SELECT file_path FROM _attachment_lowongan WHERE attachment_id = :attachment_id");
                        $stmt->bindParam(':attachment_id', $attachment_id);
                        $stmt->execute();
                        $attachment = $stmt->fetch(PDO::FETCH_ASSOC);
                        if (file_exists($attachment['file_path'])) {
                            unlink($attachment['file_path']);
                        }

                        $stmt = $conn->prepare("DELETE FROM _attachment_lowongan WHERE attachment_id = :attachment_id");
                        $stmt->bindParam(':attachment_id', $attachment_id, PDO::PARAM_INT);
                        $stmt->execute();
                    }
                }

                // Handle upload gambar baru
                if (isset($_FILES['job-image']) && $_FILES['job-image']['error'][0] == UPLOAD_ERR_OK) {
                    $imagePaths = [];
                    foreach ($_FILES['job-image']['name'] as $key => $imageNameOriginal) {
                        $imageFileType = strtolower(pathinfo($imageNameOriginal, PATHINFO_EXTENSION));

                        $imageName = uniqid(md5(time() . '_' . bin2hex(random_bytes(5))), true) . '.' . $imageFileType;
                        $targetFile = $targetDir . $imageName;

                        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo json_encode(['success' => false, 'message' => 'Format gambar tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.']);
                            exit();
                        }

                        if (!move_uploaded_file($_FILES['job-image']['tmp_name'][$key], $targetFile)) {
                            echo json_encode(['success' => false, 'message' => 'Gagal mengunggah gambar pekerjaan.']);
                            exit();
                        }

                        $imagePaths[] = $targetFile;
                    }

                    try {
                        $company = new Company();
                        if ($company->editLowongan($title, $description, $type, $location, $imagePaths)) {
                            header("Location: /home");
                        } else {
                            echo json_encode(['success' => false, 'message' => 'Gagal menambahkan lowongan.']);
                        }
                    } catch (PDOException $e) {
                        echo json_encode(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
                    }
                    exit();
                }
                header("Location: /home");
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
            }
        }
    }


    public function openJob()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['low_id'])) {
                $low_id = $input['low_id'];

                try {
                    $db = Database::getInstance();
                    $conn = $db->getConnection();

                    $stmt = $conn->prepare("UPDATE _lowongan SET is_open = true WHERE lowongan_id = :low_id");
                    $stmt->bindParam(':low_id', $low_id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        echo json_encode(['success' => true, 'message' => 'Pekerjaan berhasil dibuka.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Gagal membuka pekerjaan.']);
                    }
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID pekerjaan tidak ditemukan.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Metode request tidak valid.']);
        }
    }

    public function closeJob()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['low_id'])) {
                $low_id = $input['low_id'];

                try {
                    $db = Database::getInstance();
                    $conn = $db->getConnection();

                    $stmt = $conn->prepare("UPDATE _lowongan SET is_open = false WHERE lowongan_id = :low_id");
                    $stmt->bindParam(':low_id', $low_id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        echo json_encode(['success' => true, 'message' => 'Pekerjaan berhasil ditutup.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Gagal menutup pekerjaan.']);
                    }
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID pekerjaan tidak ditemukan.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Metode request tidak valid.']);
        }
    }


    public function deleteJob()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['low_id'])) {
                $low_id = $input['low_id'];

                try {
                    $db = Database::getInstance();
                    $conn = $db->getConnection();
                    
                    $stmt = $conn->prepare("SELECT file_path FROM _attachment_lowongan WHERE lowongan_id = :low_id");
                    $stmt->bindParam(':low_id', $low_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $attachments = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($attachments as $attachment) {
                        if (file_exists($attachment['file_path'])) {
                            unlink($attachment['file_path']);
                        }
                    }

                    $stmt = $conn->prepare("DELETE FROM _attachment_lowongan WHERE lowongan_id = :low_id");
                    $stmt->bindParam(':low_id', $low_id, PDO::PARAM_INT);
                    $stmt->execute();

                    $stmt = $conn->prepare("DELETE FROM _lowongan WHERE lowongan_id = :low_id");
                    $stmt->bindParam(':low_id', $low_id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        echo json_encode(['success' => true, 'message' => 'Pekerjaan berhasil dihapus.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Gagal menghapus pekerjaan.']);
                    }
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID pekerjaan tidak ditemukan.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Metode request tidak valid.']);
        }
    }
}
