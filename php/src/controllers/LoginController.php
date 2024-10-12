<?php
require_once __DIR__ . '/../models/User.php';

class LoginController {
    public function login($email, $password) {
        $user = new User();
        $result = $user->login($email, $password);
        
        if ($result) {
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['role'] = $result['role'];
            return true;
        } else {
            header("Location: /?error=Invalid credentials");
            return false;
        }
    }
}
?>
