<?php

$targetDirCV = "public/data_lamaran/cv/";
$targetDirVideo = "public/data_lamaran/video/";

if (!is_dir($targetDirCV)) {
    mkdir($targetDirCV, 0777, true);
}

if (!is_dir($targetDirVideo)) {
    mkdir($targetDirVideo, 0777, true);
}

if (!isset($_FILES['cv']) || $_FILES['cv']['error'] == UPLOAD_ERR_NO_FILE) {
    header("Location: index.php?page=lamar&cv_error=CV wajib diunggah.");
    exit();
}

$user_id = $_SESSION['user'] -> id;
$timestamp = time();
$cv_filename = $user_id . "_" . $timestamp . "_" . basename($_FILES["cv"]["name"]);
$targetFileCV = $targetDirCV . $cv_filename;
$fileTypeCV = strtolower(pathinfo($targetFileCV, PATHINFO_EXTENSION));

// check file
if ($fileTypeCV != "pdf") {
    header("Location: index.php?page=lamar&cv_error=Maaf, hanya file PDF yang diperbolehkan untuk CV.");
    exit();
}

if ($_FILES["cv"]["error"] > 0) {
    header("Location: index.php?page=lamar&cv_error=Error CV: " . $_FILES["cv"]["error"]);
    exit();
}

if (isset($_FILES['video']) && $_FILES['video']['error'] != UPLOAD_ERR_NO_FILE) {
    $video_filename = $user_id . "_" . $timestamp . "_" . basename($_FILES["video"]["name"]);
    $targetFileVideo = $targetDirVideo . $video_filename;
    $fileTypeVideo = strtolower(pathinfo($targetFileVideo, PATHINFO_EXTENSION));

    if ($fileTypeVideo != "mp4") {
        header("Location: index.php?page=lamar&video_error=Maaf, hanya file MP4 yang diperbolehkan untuk video.");
        exit();
    }

    if ($_FILES["video"]["error"] > 0) {
        header("Location: index.php?page=lamar&video_error=Error Video: " . $_FILES["video"]["error"]);
        exit();
    }

    if (!move_uploaded_file($_FILES["video"]["tmp_name"], $targetFileVideo)) {
        header("Location: index.php?page=lamar&video_error=Maaf, terjadi kesalahan saat mengunggah file Video.");
        exit();
    }
}

if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFileCV)) {
    header("Location: index.php?page=lamar&cv_error=Maaf, terjadi kesalahan saat mengunggah file CV.");
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

header("Location: index.php?page=detail-low");
exit();
