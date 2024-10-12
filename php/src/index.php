<?php
session_start();
require_once __DIR__ . '/controllers/LoginController.php';

$action = $_GET['action'] ?? '';

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loginController = new LoginController();
    if ($loginController->login($email, $password)) {
        echo '<script src="/public/index.js"></script>';
    } else {
        header("Location: /?error=Invalid credentials");
    }
} else {
    require __DIR__ . '/views/login.php';
}
?>
