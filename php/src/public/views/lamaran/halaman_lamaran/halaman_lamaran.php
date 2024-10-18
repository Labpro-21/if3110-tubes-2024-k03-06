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

    <div class="container">
        <div class="nama-pt">
            <img src="public/assets/img/home.png" alt="PT Logo">
            <h2>
                PT Ordivo Teknologi Indonesia
            </h2>
        </div>
        <h2> Senior Full Stack Developer </h2>
        <div class="tipe-low">
            <img class="suitcase" src="public/assets/img/suitcase.png" alt="Suitcase">
            <h3>
                Hybrid • Full-time
            </h3>
        </div>
        <hr>
        <?php if (isset($_GET['cv_error'])): ?>
            <p style="color:red;"><?php echo $_GET['cv_error']; ?></p>
        <?php endif; ?>

        <?php if (isset($_GET['video_error'])): ?>
            <p style="color:red;"><?php echo $_GET['video_error']; ?></p>
        <?php endif; ?>

        <form action="index.php?page=lamar-process" method="POST" enctype="multipart/form-data">
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
            <button type="submit" class="submit-application">SUBMIT APPLICATION</button>
        </form>
    </div>
</body>

</html>