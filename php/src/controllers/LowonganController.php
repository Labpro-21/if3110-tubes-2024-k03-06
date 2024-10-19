<?php

include("core/Controller.php");

class LowonganController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_GET['id'])) {
            $_SESSION['lowongan_id'] = $_GET['id'];
            $this->load("detailpage/lowonganjs/lowonganjs");
        }
    }
}
?>