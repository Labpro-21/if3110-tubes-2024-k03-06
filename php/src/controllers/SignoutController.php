<?php

include("core/Controller.php");

class SignoutController extends Controller
{
    public function index()
    {
        session_unset();
        session_destroy();
        header("Location: /login");
        exit();
    }
}
