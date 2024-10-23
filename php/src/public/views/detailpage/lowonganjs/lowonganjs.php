<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan l join _user u on l.company_id = u.user_id WHERE lowongan_id = :low_id");
$stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lowongan = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM _attachment_lowongan WHERE lowongan_id = :low_id");
$stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
$stmt->execute();
$attachment = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM _lamaran WHERE lowongan_id = :low_id AND user_id = :userid");
$stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
$stmt->bindParam(':userid', $_SESSION['user']->id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lamaran = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan</title>
    <link rel="stylesheet" href="public/views/detailpage/lowonganjs/lowonganjs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Desktop Navbar -->
    <?php
    echo '<div id="desktop-navbar">';
    include_once __DIR__ . '/../../navbar/navbarjs.php';
    echo '</div>';
    ?>

    <!-- Mobile Navbar -->
    <div id="mobile-navbar">
        <nav>
            <img src="public/assets/img/back.png" alt="Back" class="back-button" onclick="history.back()">
        </nav>
    </div>

    <div class="container">
        <div class="detail_low">
            <div class="left">
                <div class="nama-pt">
                    <i class="fas fa-building"></i>
                    <h2>
                        <?php
                        echo $lowongan['nama'];
                        ?>
                    </h2>
                </div>
                <h3 class="posisi">
                    <?php
                    echo $lowongan['posisi'];
                    ?>
                </h3>
                <div class="tipe-low">
                    <img class="suitcase" src="public/assets/img/suitcase.png" alt="Suitcase">
                    <h3>
                        <?php
                        echo $lowongan['jenis_lokasi'] . " • " . $lowongan['jenis_pekerjaan'];
                        ?>
                    </h3>
                </div>
                <div class="job-attachment">
                    <h4 class="job-details"> Job Attachment: </h4>
                    <?php foreach ($attachment as $row) {
                        echo '<a href="' . $row['file_path'] . '" target="_blank">';
                        echo '<img src="' . $row['file_path'] . '" class="image" alt="' . basename($row['file_path']) . '">';
                        echo '</a>';
                    } ?>
                </div>
                <h4 class="job-details">
                    Created At: <span><?php echo $lowongan['created_at']?></span></h4>
                <h4 class="job-details">
                    Last Update: <span><?php echo $lowongan['updated_at']?></span></h4>
                <?php
                if ($lamaran) {
                    echo '<a href="' . $lamaran['cv_path'] . '"> Link To Your CV </a>';
                    if ($lamaran['video_path'] !== '') {
                        echo '<a href="' . $lamaran['video_path'] . '"> Link To Your Video </a>';
                    }
                    echo '<h4> Status Lamaran: ' . $lamaran['status'] . '</h4>';
                    if ($lamaran['status_reason'] !== '') {
                        echo '<h4> Message:</h4>';
                        echo '<div class="message">';
                        echo $lamaran['status_reason'];
                        echo '</div>';
                    }
                } else {
                    if ($lowongan['is_open']) {
                        echo
                        '<a href="/lamar">
                                <button class="lamar-button" id="lamar-button">
                                    Lamar
                                </button>
                            </a>';
                    } else {
                        echo '<h4> Maaf Lowongan ini sudah ditutup </h4>';
                    }
                }
                ?>
            </div>
            <div class="right">
                <p class="deskripsi">
                    <?php
                    echo $lowongan['deskripsi'];
                    ?>
                </p>
            </div>
        </div>
    </div>
</body>

</html>