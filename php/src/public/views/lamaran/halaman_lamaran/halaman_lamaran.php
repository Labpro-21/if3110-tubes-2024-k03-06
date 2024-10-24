<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan l join _user u on l.company_id = u.user_id WHERE lowongan_id = :low_id");
$stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lowongan = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/views/lamaran/halaman_lamaran/halaman_lamaran.css">
</head>

<body>
    <!-- Desktop Navbar -->
    <?php
    echo '<div id="desktop-navbar">';
    include_once __DIR__ . '/../../navbar/navbarjs.php';
    echo '</div>';
    ?>

    <!-- Mobile Navbar -->
    <nav id="mobile-navbar">
        <img src="public/assets/img/back.png" alt="Back" class="back-button" onclick="history.back()">
    </nav>

    <div class="main-container">
        <div class="container">
            <div class="nama-pt">
                <i class="fas fa-building"></i>
                <h2>
                    <?php
                    echo $lowongan['nama'];
                    ?>
                </h2>
            </div>
            <h2>
                <?php
                echo $lowongan['posisi'];
                ?>
            </h2>
            <div class="tipe-low">
                <img class="suitcase" src="public/assets/img/suitcase.png" alt="Suitcase">
                <h3>
                    <?php 
                    echo $lowongan['jenis_lokasi'] . " • " . $lowongan['jenis_pekerjaan'];
                    ?>
                </h3>
            </div>
            <hr>

            <form id="lamar-process" method="POST" enctype="multipart/form-data">
                <div class="upload-container">
                    <h3>Upload Your Curriculum Vitae (.pdf)<span class="wajib">*</span></h3>
                    <label for="cv-upload" class="custom-file-upload <?php if (isset($_GET['cv_error'])) echo 'error-border'; ?>">
                        <img src="public/assets/img/attach.png" alt="Attachment Icon" class="attachment-icon">
                        ATTACH CV
                    </label>
                    <input id="cv-upload" type="file" name="cv" accept=".pdf" />

                    <br><br>

                    <h3>Upload Video Your Introduction (.mp4)</h3>
                    <label for="video-upload" class="custom-file-upload <?php if (isset($_GET['video_error'])) echo 'error-border'; ?>">
                        <img src="public/assets/img/attach.png" alt="Attachment Icon" class="attachment-icon">
                        ATTACH VIDEO
                    </label>
                    <input id="video-upload" type="file" name="video" accept=".mp4" />
                </div>
                <small id="lamarError" class="error"></small>
                <br>
                <div class="submit-button">
                    <button type="submit" class="submit-application">SUBMIT APPLICATION</button>
                </div>
            </form>
        </div>
    </div>
    <script src="/public/views/lamaran/halaman_lamaran/halaman_lamaran.js"></script>
</body>

</html>