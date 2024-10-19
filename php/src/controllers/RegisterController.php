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
}

// include_once '../config/Database.php'; // Your DB connection

// header('Content-Type: application/json'); // Return JSON response

// $response = ['success' => false, 'message' => ''];
// $db = new Database();
// $conn = $db->getConnection();

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $role = $_POST['role'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Check if email is unique
//     $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
//     $stmt->bindParam(':email', $email);
//     $stmt->execute();

//     if ($stmt->rowCount() > 0) {
//         $response['message'] = 'Email is already in use!';
//         echo json_encode($response);
//         exit;
//     }

//     // Hash the password
//     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//     // Insert data based on role
//     if ($role === 'job_seeker') {
//         $name = $_POST['name'];
//         $sql = "INSERT INTO users (email, password, name, role) VALUES (:email, :password, :name, 'job_seeker')";
//         $stmt = $conn->prepare($sql);
//         $stmt->bindParam(':email', $email);
//         $stmt->bindParam(':password', $hashed_password);
//         $stmt->bindParam(':name', $name);
//     } elseif ($role === 'company') {
//         $company_name = $_POST['company_name'];
//         $location = $_POST['location'];
//         $about = $_POST['about'];
//         $sql = "INSERT INTO users (email, password, company_name, location, about, role) VALUES (:email, :password, :company_name, :location, :about, 'company')";
//         $stmt = $conn->prepare($sql);
//         $stmt->bindParam(':email', $email);
//         $stmt->bindParam(':password', $hashed_password);
//         $stmt->bindParam(':company_name', $company_name);
//         $stmt->bindParam(':location', $location);
//         $stmt->bindParam(':about', $about);
//     }

//     if ($stmt->execute()) {
//         $response['success'] = true;
//     } else {
//         $response['message'] = 'Registration failed. Try again!';
//     }
// }

// echo json_encode($response);