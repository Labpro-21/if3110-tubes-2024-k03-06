<?php

// var_dump($_SERVER);
// var_dump($_POST);

$uri_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$path = explode('/', $uri_path);

$controller = !empty($path[0]) ? ucfirst($path[0]) . 'Controller' : 'HomeController';
$action = !empty($path[1]) ? $path[1] : 'index';
$params = array_slice($path,2);

$controller_path = "controllers/" . $controller . ".php";

if (file_exists($controller_path)) {
    require_once $controller_path;

    $controllerInstance = new $controller();

    if (method_exists($controllerInstance, $action)) {
        call_user_func_array([$controllerInstance, $action], $params);
    } else {
        echo "Method $method not found in controller $controller";
    }
} else {
    echo "Controller $controller not found";
}

// spl_autoload_register(function ($class_name) {
//     require_once __DIR__ . '/models/' . $class_name . '.php';
// });

// session_start();
// require_once __DIR__ . '/controllers/LoginController.php';

// $page = isset($_GET['page'])? $_GET['page'] : 'home';

// switch ($page) {
//     case 'login':
//         require_once __DIR__ . '/public/views/login/login.php';
//         break;

//     case 'login-process':
//         if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
//             $email = $_POST['email'];
//             $password = $_POST['password'];
//             $loginController = new LoginController();
//             $loginController->login($email, $password);
//         } else {
//             header("Location: index .php?page=login&error=Invalid request");
//             exit();
//         }
//         break;

//     case 'register':
//         # code...
//         break;
