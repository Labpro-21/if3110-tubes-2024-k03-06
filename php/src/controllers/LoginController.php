<?php
require_once __DIR__ . '/../models/User.php';
include("core/Controller.php");

class LoginController extends Controller
{
    public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            header("Location: /home");
        } else {
            $this->load("login/login");
        }
    }

    public function login()
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
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            }
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
        }
    }
}
