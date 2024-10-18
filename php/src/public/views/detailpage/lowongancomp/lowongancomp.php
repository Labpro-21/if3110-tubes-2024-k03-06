<?php
$_SESSION['lowongan_id'] = 1;
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan WHERE lowongan_id = :low_id");
$stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lowongan = $stmt->fetch();

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
    <link rel="stylesheet" href="public/views/detailpage/lowongancomp/lowongancomp.css">
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
                    <img src="public/assets/img/home.png" alt="PT Logo">
                    <h2>
                        PT Ordivo Teknologi Indonesia
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
                <!-- Actions -->
                <form method="POST">
                    <button type="button" class="close-lowongan">Tutup Lowongan</button>
                    <button type="button" class="delete-lowongan">Hapus Lowongan</button>
                </form>
            </div>
            <div class="right">
                <p class="deskripsi">
                    <?php
                    echo $lowongan['deskripsi'];
                    ?>
                </p>
                
                <h3>Daftar Pelamar</h3>
                <table class="lamaran-table">
                    <tr>
                        <th>Nama Pelamar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <tr>
                        <td>Rizky Pratama</td>
                        <td>Waiting</td>
                        <td><a href="#">Lihat Detail</a></td>
                    </tr>
                    <tr>
                        <td>Fajar Setiawan</td>
                        <td>Accepted</td>
                        <td><a href="#">Lihat Detail</a></td>
                    </tr>
                    <tr>
                        <td>Adi Putra</td>
                        <td>Rejected</td>
                        <td><a href="#">Lihat Detail</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>