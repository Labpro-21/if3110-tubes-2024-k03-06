<?php
require_once __DIR__ . '/../models/User.php';

class LoginController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

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
                echo json_encode(['success' => true, 'message' => 'Login successful']);
                header("Location: /home");
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            }
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
        }
    }
}
