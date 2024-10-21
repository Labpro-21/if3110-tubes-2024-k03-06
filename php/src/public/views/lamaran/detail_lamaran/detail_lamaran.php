<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lamaran JOIN _user ON _lamaran.user_id = _user.user_id WHERE lamaran_id = :lam_id");
$stmt->bindParam(':lam_id', $_SESSION['lamaran_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lamaran = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/views/lamaran/detail_lamaran/detail_lamaran.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

</head>

<body>
    <!-- Desktop Navbar -->
    <?php
    echo '<div id="desktop-navbar">';
    include_once __DIR__ . '/../../navbar/navbarcomp.php';
    echo '</div>';
    ?>

    <!-- Mobile Navbar -->
    <nav id="mobile-navbar">
        <img src="public/assets/img/back.png" alt="Back" class="back-button" onclick="history.back()">
    </nav>

    <div class="container">
        <div class="detail-lamar">
            <form id="form-review">
                <h3 id="details">
                    <?php echo $_SESSION['user']->nama ?>'s Application Details
                </h3>

                <!-- CV -->
                <h3>
                    Curriculum Vitae:
                </h3>
                <embed class="cv" src="<?php echo $lamaran['cv_path'] ?>" width="auto" height="auto"></embed>
                <br>

                <!-- Video Introduction -->
                <h3>
                    Video Introduction:
                </h3>
                <video width="100%" height="100%" controls>
                    <source src="<?php echo $lamaran['video_path'] ?>" type="video/mp4">
                </video>
                <br>
                <br>
                <!-- Status -->
                <h3>
                    Status : <?php echo $lamaran['status'] ?>
                </h3>
                <br>
                <?php
                if ($lamaran['status'] === 'waiting') {
                    echo '
                <label for="message">Message:</label>
                <div id="editor" style="height: 200px;"></div>
                <br>
                <br>

                <label for="status">Final Review:</label>
                <select id="status" name="status">
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                </select>
                <br>';
                    echo '<button type="submit" class="submit-application">Finish Review Application</button>';
                }
                ?>
            </form>
        </div>
    </div>

    <script src="public/views/lamaran/detail_lamaran/detail_lamaran.js">
    </script>

</body>

</html>