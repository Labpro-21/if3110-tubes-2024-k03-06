<?php
require_once __DIR__ . '/../models/User.php';

class LoginController {
    public function login($email, $password) {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM _user WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();
        if ($user) {
            $_SESSION['user'] = new User($user['user_id'], $user['role'], $user['nama']);
            header("Location: index.php?page=home");
        } else {
            header("Location: index.php?page=login&error=Email atau password salah");
        }
        exit();
    }
}
?>