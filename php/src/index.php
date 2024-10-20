<?php

include("models/User.php");

spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/models/' . $class_name . '.php';
});

$uri_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uri_path = filter_var($uri_path, FILTER_SANITIZE_URL);
$path = explode('/', $uri_path);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    // echo "Controller $controller not found";
    header("Location: /home"); // Sending user back to default
}