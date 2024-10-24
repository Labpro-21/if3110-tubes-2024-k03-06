<?php
$db = Database::getInstance();
$conn = $db->getConnection();

$stmt = $conn->prepare("
SELECT 
    lo.lowongan_id, 
    u.nama AS company_name, 
    lo.posisi, 
    lo.jenis_pekerjaan, 
    lo.jenis_lokasi, 
    lo.updated_at 
FROM 
    _lamaran la
    JOIN _lowongan lo ON la.lowongan_id = lo.lowongan_id
    JOIN (select user_id,nama from _user where role = 'company') u ON u.user_id = lo.company_id
WHERE 
    la.user_id = :user_id
");
$stmt->bindParam(':user_id', $_SESSION['user']->id);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./public/views/jobhistory/history.css">
    </head>
    <body>
        <div class="navbar">
            <?php include __DIR__ . '/../navbar/navbarjs.php'; ?>
        </div>
        <div class="container">
            <div class="sidebar">
                <div class="home-picture">
                    <img src="./public/assets/img/itb.jpeg">
                </div>
                <div class="profile-picture">
                    <img src="./public/assets/img/photo.jpeg">
                </div>
                <div class="profile-info">
                    <h4><?php echo $_SESSION['user']->nama ?></h4>
                </div>
            </div>
            <div class="main-content">
                <div class="job-history">
                    <h1>Job History</h1>
                    <div class="job-history-container">
                        <?php foreach ($result as $row) { ?>
                            <div class="job-history-item">
                                <div class="job-history-item-title">
                                    <a href="/lowongan?id=<?= $row['lowongan_id']?>">
                                        <h2><?= $row['posisi'] ?></h2>
                                    </a>
                                    <p><?= $row['company_name'] ?></p>
                                </div>
                                <div class="job-history-item-description">
                                    <p>Location: <?= $row['jenis_lokasi'] ?></p>
                                    <p>Job Type: <?= $row['jenis_pekerjaan'] ?></p>
                                    <p>last update: <?= $row['updated_at'] ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>