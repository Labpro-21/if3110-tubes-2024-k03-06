<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan WHERE lowongan_id = :low_id");
$stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lowongan = $stmt->fetch();

$stmt = $conn->prepare("
    SELECT u.nama, l.status, l.lamaran_id 
    FROM _lamaran l
    JOIN _user u ON l.user_id = u.user_id
    WHERE l.lowongan_id = :low_id
");
$stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
$stmt->execute();
$pelamar = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    include_once __DIR__ . '/../../navbar/navbarcomp.php';
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
                        <?php
                        echo $_SESSION['user']->nama;
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
                <!-- Actions -->
                <?php
                if ($lowongan['is_open']) {
                    echo '<button type="button" class="buttons close-lowongan" data-id="' . $lowongan['lowongan_id'] . '">Tutup Lowongan</button>';
                } else {
                    echo '<button type="button" class="buttons open-lowongan" data-id="' . $lowongan['lowongan_id'] . '">Buka Lowongan</button>';
                }
                ?>

                <button type="button" class="buttons delete-lowongan" data-id="<?php echo $lowongan['lowongan_id']; ?>">Hapus Lowongan</button>

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
                    <?php foreach ($pelamar as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><a href="/detaillamaran?lamaran_id=<?php echo $row['lamaran_id']; ?>">Lihat Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <script src="./public/views/detailpage/lowongancomp/lowongancomp.js"></script>
</body>

</html>