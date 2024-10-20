<?php

include("core/Controller.php");

class DetaillamaranController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_GET['lamaran_id'])) {
            $_SESSION['lamaran_id'] = $_GET['lamaran_id'];
            $this->load("lamaran/detail_lamaran/detail_lamaran");
        }
    }
}