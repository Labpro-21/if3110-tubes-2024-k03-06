<?php

include("core/Controller.php");
include_once("config/Database.php");

class LowonganController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_GET['id'])) {
            $_SESSION['lowongan_id'] = $_GET['id'];
            if ($_SESSION['user']->role == 'company') {
                $this->load("detailpage/lowongancomp/lowongancomp");
            } else {
                $this->load("detailpage/lowonganjs/lowonganjs");
            }
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

            // Where 1 = 1 is used to enable appending filters
            $baseQuery = " FROM _lowongan WHERE 1=1";

            // Filters
            if ($jobType) {
                $baseQuery .= " AND jenis_pekerjaan = :jobType";
            }
            if ($jobLocation) {
                $baseQuery .= " AND jenis_lokasi = :jobLocation";
            }

            // Query to fetch jobs with LIMIT and OFFSET
            $jobQuery = "SELECT * " . $baseQuery;
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

            // Bind filter parameters to both queries
            if ($jobType) {
                $stmtJob->bindParam(':jobType', $jobType);
                $stmtCount->bindParam(':jobType', $jobType);
            }
            if ($jobLocation) {
                $stmtJob->bindParam(':jobLocation', $jobLocation);
                $stmtCount->bindParam(':jobLocation', $jobLocation);
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
