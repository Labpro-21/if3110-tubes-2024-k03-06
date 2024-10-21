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

    public function lamarlowongan()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $targetDirCV = "public/data_lamaran/cv/";
            $targetDirVideo = "public/data_lamaran/video/";

            // Buat direktori jika belum ada
            if (!is_dir($targetDirCV)) {
                mkdir($targetDirCV, 0777, true);
            }

            if (!is_dir($targetDirVideo)) {
                mkdir($targetDirVideo, 0777, true);
            }

            // Cek apakah user terdaftar di session
            if (!isset($_SESSION['user'])) {
                echo json_encode(['success' => false, 'message' => 'User tidak ditemukan di session.']);
                exit();
            }

            // Cek apakah file CV diunggah
            if (!isset($_FILES['cv']) || $_FILES['cv']['error'] == UPLOAD_ERR_NO_FILE) {
                echo json_encode(['success' => false, 'message' => 'CV wajib diunggah.']);
                exit();
            }

            $user_id = $_SESSION['user']->id;
            $timestamp = time();
            $cv_filename = $user_id . "_" . $timestamp . "_" . basename($_FILES["cv"]["name"]);
            $targetFileCV = $targetDirCV . $cv_filename;

            // Cek apakah ada error pada file CV
            if ($_FILES["cv"]["error"] !== UPLOAD_ERR_OK) {
                echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat mengunggah file CV.']);
                exit();
            }

            // Pindahkan file CV
            if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFileCV)) {
                echo json_encode(['success' => false, 'message' => 'Maaf, terjadi kesalahan saat mengunggah file CV.']);
                exit();
            }

            // Cek apakah video diunggah (opsional)
            if (isset($_FILES['video']) && $_FILES['video']['error'] !== UPLOAD_ERR_NO_FILE) {
                $video_filename = $user_id . "_" . $timestamp . "_" . basename($_FILES["video"]["name"]);
                $targetFileVideo = $targetDirVideo . $video_filename;

                if ($_FILES["video"]["error"] !== UPLOAD_ERR_OK) {
                    echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat mengunggah file Video.']);
                    exit();
                }

                if (!move_uploaded_file($_FILES["video"]["tmp_name"], $targetFileVideo)) {
                    echo json_encode(['success' => false, 'message' => 'Maaf, terjadi kesalahan saat mengunggah file Video.']);
                    exit();
                }
            }

            // Insert data lamaran ke database
            $video_path = isset($targetFileVideo) ? $targetFileVideo : null;

            if (!isset($_SESSION['lowongan_id'])) {
                echo json_encode(['success' => false, 'message' => 'Lowongan ID tidak ditemukan dalam session.']);
                exit();
            }

            $company = new Company();
            $company->lemarLowongan($user_id, $targetFileCV, $video_path);
            echo json_encode(['success' => true, 'message' => 'Lamaran berhasil diunggah', 'id' => $_SESSION['lowongan_id']]);
            exit();
        }
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
