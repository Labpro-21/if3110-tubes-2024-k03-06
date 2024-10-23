<?php
require_once __DIR__ . '/../../../config/Database.php';

header('Content-Type: application/json');

$db = Database::getInstance();
$conn = $db->getConnection();

$stmt = $conn->prepare("
    SELECT lo.lowongan_id, us.nama, lo.posisi, lo.jenis_pekerjaan, lo.jenis_lokasi, lo.updated_at 
    FROM _lowongan lo 
    JOIN (SELECT user_id, nama FROM _user WHERE role = 'company') us 
    ON lo.company_id = us.user_id 
    WHERE 1=1
");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

json_encode($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./public/views/jobhistory/history.css">
        <script defer src="/public/views/jobhistory/history.js"></script>
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
                    <h4>Dhika</h4>
                    <p class="about">student at itb</p>
                </div>
            </div>
            <div class="main-content">
                <div class="job-history">
                    <h1>Job History</h1>
                    <div class="job-history-container">
                        <div class="job-history-item">
                            <div class="job-history-item-title">
                                <h2>Software Engineer</h2>
                                <p>Repsol Honda</p>
                            </div>
                            <div class="job-history-item-description">
                                <p>Location: on-site</p>
                                <p>Job Type: Full-time</p>
                                <p>last update: ...</p>
                            </div>
                        </div>

                        <div class="job-history-item">
                            <div class="job-history-item-title">
                                <h2>Software Engineer</h2>
                                <p>Repsol Honda</p>
                            </div>
                            <div class="job-history-item-description">
                                <p>Location: on-site</p>
                                <p>Job Type: Full-time</p>
                                <p>last update: ...</p>
                            </div>
                        </div>
                        
                        <div class="job-history-item">
                            <div class="job-history-item-title">
                                <h2>Software Engineer</h2>
                                <p>Repsol Honda</p>
                            </div>
                            <div class="job-history-item-description">
                                <p>Location: on-site</p>
                                <p>Job Type: Full-time</p>
                                <p>last update: ...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>