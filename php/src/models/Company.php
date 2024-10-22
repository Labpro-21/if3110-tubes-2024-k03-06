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
}
