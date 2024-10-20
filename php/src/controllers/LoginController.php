<?php
include("core/Controller.php");
require_once __DIR__ . '/../models/User.php';

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

            $user = User::findByEmail($email);

            if ($user && $user->validatePassword($password)) {
                $_SESSION['user'] = $user;
                echo json_encode(['success' => true, 'message' => 'Login successful']);
            } else {
                echo json_encode(['success' => false, 'message' => $user->password]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
        }
        exit();
    }
}
