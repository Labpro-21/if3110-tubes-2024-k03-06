<?php
require_once __DIR__ . '/../config/Database.php';

class Company {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Create company details
    public function create($userId, $location, $about) {
        $stmt = $this->db->prepare("INSERT INTO _company_detail (user_id, lokasi, about) VALUES (:user_id, :lokasi, :about)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':lokasi', $location);
        $stmt->bindParam(':about', $about);

        return $stmt->execute();
    }

    // Update company details
    public function update($userId, $location, $about) {
        $stmt = $this->db->prepare("UPDATE _company_detail SET lokasi = :lokasi, about = :about WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':lokasi', $location);
        $stmt->bindParam(':about', $about);

        return $stmt->execute();
    }

    // Get company details by user ID
    public function getByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM _company_detail WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
