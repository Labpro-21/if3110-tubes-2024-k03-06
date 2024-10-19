<?php

include("core/Controller.php");

class UploadController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $targetDirCV = "public/data_lamaran/cv/";
            $targetDirVideo = "public/data_lamaran/video/";

            if (!is_dir($targetDirCV)) {
                mkdir($targetDirCV, 0777, true);
            }

            if (!is_dir($targetDirVideo)) {
                mkdir($targetDirVideo, 0777, true);
            }

            $user_id = $_SESSION['user']->id;
            $timestamp = time();
            $cv_filename = $user_id . "_" . $timestamp . "_" . basename($_FILES["cv"]["name"]);
            $targetFileCV = $targetDirCV . $cv_filename;
            
            if ($_FILES["cv"]["error"] > 0) {
                $error = $_FILES["cv"]["error"];
                echo json_encode(['success' => false, 'message' => 'Error CV: ' . $error]);
                exit();
            }

            if (isset($_FILES['video']) && $_FILES['video']['error'] != UPLOAD_ERR_NO_FILE) {
                $video_filename = $user_id . "_" . $timestamp . "_" . basename($_FILES["video"]["name"]);
                $targetFileVideo = $targetDirVideo . $video_filename;

                if ($_FILES["video"]["error"] > 0) {
                    echo json_encode(['success' => false, 'message' => 'Error Video: ' . $_FILES["video"]["error"]]);
                    exit();
                }

                if (!move_uploaded_file($_FILES["video"]["tmp_name"], $targetFileVideo)) {
                    echo json_encode(['success' => false, 'message' => 'Maaf, terjadi kesalahan saat mengunggah file Video.']);
                    exit();
                }
            }

            if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFileCV)) {
                echo json_encode(['success' => false, 'message' => 'Maaf, terjadi kesalahan saat mengunggah file CV.']);
                exit();
            }

            // Insert to database
            $video_path = isset($targetFileVideo) ? $targetFileVideo : null;
            $db = Database::getInstance();
            $conn = $db->getConnection();
            $stmt = $conn->prepare("INSERT INTO _lamaran (lowongan_id, user_id, cv_path, video_path, status, created_at) VALUES (:low_id, :user_id, :cv, :video, 'waiting', NOW())");
            $stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':cv', $targetFileCV);
            $stmt->bindParam(':video', $video_path);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Lamaran berhasil diunggah', 'id' => $_SESSION['lowongan_id']]);
            exit();
        }
    }
}
