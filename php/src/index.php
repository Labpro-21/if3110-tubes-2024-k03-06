<?php
spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/models/' . $class_name . '.php';
});

session_start();
require_once __DIR__ . '/controllers/LoginController.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'detail-lamaran';

switch ($page) {
    case 'login':
        require_once __DIR__ . '/public/views/login/login.php';
        break;

    case 'login-process':
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $loginController = new LoginController();
            $loginController->login($email, $password);
        } else {
            header("Location: index.php?page=login&error=Invalid request");
            exit();
        }
        break;

    case 'register':
        # code...
        break;

    case 'home':
        require_once __DIR__ . '/public/views/homepage/homecomp.php';
        break;

    case 'detail-lowcomp':
        require_once __DIR__ . '/public/views/detailpage/lowongancomp/lowongancomp.php';
        break;

    case 'detail-lowjs':
        require_once __DIR__ . '/public/views/detailpage/lowonganjs/lowonganjs.php';
        break;

    case 'lamar':
        require_once __DIR__ . '/public/views/lamaran/halaman_lamaran/halaman_lamaran.php';
        break;

    case 'lamar-process':
        require_once __DIR__ . '/controllers/UploadController.php';
        break;

    case 'detail-lamaran':
        require_once __DIR__ . '/public/views/lamaran/detail_lamaran/detail_lamaran.php';
        break;
    case 'review-process':
        require_once __DIR__ . '/controllers/ReviewController.php';
        break;

    default:
        header("Location: index.php?page=home");
        exit();
}
