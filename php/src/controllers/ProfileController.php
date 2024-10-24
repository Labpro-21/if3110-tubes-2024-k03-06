<?php

include("core/Controller.php");
include_once("config/Database.php");

class ProfileController extends Controller {
    public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"])) {
            $this->load("profile/profilecomp");
        } else {
            header("Location: /home");
        }
    }

    public function update () {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"])) {
            $this->load("profile/updateprofile");
        } else {
            header("Location: /home");
        }
    }

    public function updateCompany () {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user']) && $_SESSION['user']->role == 'company') {
                $newName = $_POST['company-title'];
                $newLoc = $_POST['company-loc'];
                $newDesc = $_POST['company-desc'];

                try {
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    $db = Database::getInstance();
                    $conn = $db->getConnection();

                    $stmt = $conn->prepare('UPDATE _user SET nama = :newName WHERE user_id = :user_id');
                    $stmt->bindParam(':user_id', $_SESSION['user']->id, PDO::PARAM_INT);
                    $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);
                    $stmt->execute();

                    $stmt = $conn->prepare('UPDATE _company_detail SET lokasi = :newLokasi, about = :newDesc WHERE user_id = :user_id');
                    $stmt->bindParam(':user_id', $_SESSION['user']->id, PDO::PARAM_INT);
                    $stmt->bindParam(':newLokasi', $newLoc, PDO::PARAM_STR);
                    $stmt->bindParam(':newDesc', $newDesc, PDO::PARAM_STR);
                    $stmt->execute();

                    $_SESSION['user']->nama = $newName;

                    header('Location: /profile');
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
                }
            }
        }
    }
}