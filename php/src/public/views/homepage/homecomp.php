<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan WHERE company_id = :company_id");
$stmt->bindParam(':company_id', $_SESSION['user']->id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lowonganList = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT lokasi FROM _company_detail WHERE user_id = :id");
$stmt->bindParam(':id', $_SESSION['user']->id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$company_loc = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./public/views/homepage/homecomp.css">
</head>

<body>
    <nav>
        <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>
    </nav>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="home-picture">
                <img src="./public/assets/img/itb.jpeg">
            </div>
            <div class="profile-picture">
                <img src="./public/assets/img/photo.jpeg">
            </div>
            <div class="profile-info">
                <h4>
                    <?php
                    echo $_SESSION['user']->nama;
                    ?>
                </h4>
            </div>
            <div class="filter">
                <p class="filter-title">Job Preference :</p>
                <div class="filter-container">
                    <div class="filter-section">
                        <p class="filter-section-title">Time</p>
                        <div class="filter-group">
                            <select id="job-type">
                                <option value="...">...</option>
                                <option value="newest">newest</option>
                                <option value="oldest">oldest</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-section">
                        <p class="filter-section-title">Job Type</p>
                        <div class="filter-group">
                            <select id="job-type">
                                <option value="...">...</option>
                                <option value="full-time">Full-time</option>
                                <option value="part-time">Part-time</option>
                                <option value="contract">Contract</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-section">
                        <p class="filter-section-title">Job Location</p>
                        <div class="filter-group">
                            <select id="job-type">
                                <option value="...">...</option>
                                <option value="hybrid">hybrid</option>
                                <option value="on-site">on-site</option>
                                <option value="remote">remote</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="search-button">
                    <button>Search</button>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="main-content">
            <h2>Available Job Listings</h2>
            <p class="main-content-about">Here's your company's open jobs</p>
            <?php foreach ($lowonganList as $lowongan): ?>
                <div class="job-card-container">
                    <div class="job-card-icon">
                        <i class="fas fa-trash-alt" data-id="<?php echo $lowongan['lowongan_id']; ?>"></i>
                        <i class='far fa-edit' data-id="<?php echo $lowongan['lowongan_id']; ?>"> </i>
                    </div>
                    <div class="job-card">
                        <p class="job-title">
                            <a href="/lowongan?id=<?php echo $lowongan['lowongan_id'] ?>">
                                <?php echo $lowongan['posisi']; ?>
                            </a>
                        </p>
                        <p class="job-details">
                            <?php echo $company_loc['lokasi'] . ' (' . $lowongan['jenis_lokasi'] . ')'; ?>
                        </p>
                        <p class="job-details">
                            Last Update: <?php echo $lowongan['updated_at']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="pagination">
                <button id="prev-btn" class="pagination-button" disabled>
                    <i class="fas fa-angle-left"></i>
                </button>
                <div id="page-buttons"></div>
                <button id="next-btn" class="pagination-button">
                    <i class="fas fa-angle-right"></i>
                </button>
            </div>
        </div>
        <!-- add job -->
        <div class="add-jobs">
            <button id="add-job">Add Job</button>
        </div>
    </div>
    <script src="./public/views/homepage/homecomp.js"></script>
</body>

</html>