<?php
class SignoutController
{
    public function index()
    {
        session_unset();
        session_destroy();
        header("Location: /login");
        exit();
    }
}
