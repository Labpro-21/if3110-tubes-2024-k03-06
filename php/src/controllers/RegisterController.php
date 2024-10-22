<?php
include("core/Controller.php");

class RegisterController extends Controller {
    public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            header("Location: /home");
        } else {
            $this->load("register/register");
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Assuming you validate and sanitize inputs here
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role'];
            $name = $_POST['name'];
            $location = $_POST['location'] ?? null;
            $about = $_POST['about'] ?? null;

            if (User::findByEmail($email)) {
                echo json_encode(['success' => false, 'message' => 'Email is already used!']);
                exit();
            }

            // Insert new user
            if (USER::create($email, $password, $role, $name)) {
                $userId = Database::getInstance()->getConnection()->lastInsertId();; // Get the new user ID
                $companyModel = new Company();

                if ($role === 'company') {
                    if ($companyModel->create($userId, $location, $about)) {
                        $_SESSION['user'] = User::findByEmail($email);
                        echo json_encode(['success' => true, 'message' => 'User registered successfully with company details']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'User registered, but failed to create company details']);
                    }
                } else {
                    $_SESSION['user'] = User::findByEmail($email);
                    echo json_encode(['success' => true, 'message' => 'User registered successfully']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to register user']);
            }
            exit();
        }
    }
}