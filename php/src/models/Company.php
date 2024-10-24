<?php
require_once __DIR__ . '/../config/Database.php';

class Company
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Create company details
    public function create($userId, $location, $about)
    {
        $stmt = $this->db->prepare("INSERT INTO _company_detail (user_id, lokasi, about) VALUES (:user_id, :lokasi, :about)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':lokasi', $location);
        $stmt->bindParam(':about', $about);

        return $stmt->execute();
    }

    // Update company details
    public function update($userId, $location, $about)
    {
        $stmt = $this->db->prepare("UPDATE _company_detail SET lokasi = :lokasi, about = :about WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':lokasi', $location);
        $stmt->bindParam(':about', $about);

        return $stmt->execute();
    }

    // Get company details by user ID
    public function getByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM _company_detail WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function reviewLamaran($status, $message, $lamaran_id)
    {
        $stmt = $this->db->prepare("UPDATE _lamaran 
                    SET status = :status, status_reason = :reason
                    WHERE lamaran_id = :lamaran_id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':reason', $message);
        $stmt->bindParam(':lamaran_id', $lamaran_id);
        return ($stmt->execute());
    }

    public function lemarLowongan($user_id, $targetFileCV, $video_path)
    {
        $stmt = $this->db->prepare("INSERT INTO _lamaran (lowongan_id, user_id, cv_path, video_path, status, created_at) VALUES (:low_id, :user_id, :cv, :video, 'waiting', NOW())");
        $stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':cv', $targetFileCV);
        $stmt->bindParam(':video', $video_path);
        $stmt->execute();
    }

    public function addLowongan($title, $description, $type, $location, $imagePaths)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt1 = $conn->prepare("
        INSERT INTO _lowongan (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open, created_at) 
        VALUES (:company_id, :posisi, :deskripsi, :jenis_pekerjaan, :jenis_lokasi, true, NOW())
    ");
        $stmt1->bindParam(':company_id', $_SESSION['user']->id);
        $stmt1->bindParam(':posisi', $title);
        $stmt1->bindParam(':deskripsi', $description);
        $stmt1->bindParam(':jenis_pekerjaan', $type);
        $stmt1->bindParam(':jenis_lokasi', $location);

        if ($stmt1->execute()) {
            $lowongan_id = $conn->lastInsertId();

            if (count($imagePaths) > 0) {
                foreach ($imagePaths as $targetFile) {
                    $stmt2 = $conn->prepare("INSERT INTO _attachment_lowongan (lowongan_id, file_path) VALUES (:lowongan_id, :file_path)");
                    $stmt2->bindParam(':lowongan_id', $lowongan_id);
                    $stmt2->bindParam(':file_path', $targetFile);
                    $stmt2->execute();
                }
            }

            return true;
        } else {
            return false;
        }
    }

    public function editLowongan($title, $description, $type, $location, $imagePaths)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt1 = $conn->prepare("UPDATE _lowongan SET posisi = :title, deskripsi = :description, jenis_pekerjaan = :type, jenis_lokasi = :location, updated_at = NOW() WHERE lowongan_id = :lowongan_id");
        $stmt1->bindParam(':title', $title);
        $stmt1->bindParam(':description', $description);
        $stmt1->bindParam(':type', $type);
        $stmt1->bindParam(':location', $location);
        $stmt1->bindParam(':lowongan_id', $_SESSION['lowongan_id']);
        $stmt1->execute();

        if ($stmt1->execute()) {
            if (count($imagePaths) > 0) {
                foreach ($imagePaths as $targetFile) {
                    $stmt2 = $conn->prepare("INSERT INTO _attachment_lowongan (lowongan_id, file_path) VALUES (:lowongan_id, :file_path)");
                    $stmt2->bindParam(':lowongan_id', $_SESSION['lowongan_id']);
                    $stmt2->bindParam(':file_path', $targetFile);
                    $stmt2->execute();
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function exportToCSV($pelamar)
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="daftar_pelamar.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Nama', 'Pekerjaan yang Dilamar', 'Tanggal Melamar', 'CV URL','Video URL', 'Status']);

        foreach ($pelamar as $row) {
            fputcsv($output, [
                $row['nama'],
                $row['posisi'],
                $row['created_at'],
                $row['cv_path'],
                $row['video_path'],
                $row['status'],
            ]);
        }

        fclose($output);
        exit();
    }
    public function exportDataPelamar()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $lowongan_id = $_SESSION['lowongan_id'];

        $stmt = $this->db->prepare("
        SELECT u.nama, l.posisi, la.created_at, la.cv_path,la.video_path, la.status
        FROM _lamaran la
        JOIN _user u ON la.user_id = u.user_id
        JOIN _lowongan l ON la.lowongan_id = l.lowongan_id
        WHERE la.lowongan_id = :low_id
    ");
        $stmt->bindParam(':low_id', $lowongan_id);
        $stmt->execute();

        $pelamar = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->exportToCSV($pelamar);
    }
}
