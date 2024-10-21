<?php

include("core/Controller.php");
require_once __DIR__ . '/../models/Company.php';

class LamarController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->load("lamaran/halaman_lamaran/halaman_lamaran");
    }
    public function review()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status']) && isset($_POST['message'])) {
            $status = $_POST['status'];
            $message = $_POST['message'];
            $lamaran_id = $_SESSION['lamaran_id'];
            $company = new Company();
            if ($company->reviewLamaran($status, $message, $lamaran_id)) {
                echo json_encode(['success' => true, 'id' => $_SESSION['user']->id]);
            } else {
                echo json_encode(['success' => false, 'id' => $_SESSION['user']->id]);
            }
            exit();
        }
    }
}
