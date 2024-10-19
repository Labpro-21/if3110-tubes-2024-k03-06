<?php

include("core/Controller.php");

class LamarController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->load("lamaran/halaman_lamaran/halaman_lamaran");
    }
}
?>