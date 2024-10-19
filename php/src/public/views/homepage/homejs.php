<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lowonganList = $stmt->fetchAll();  // Mengambil semua data dari query

$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$companynameList = $stmt->fetchAll();  // Mengambil semua data dari query
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./public/views/homepage/homejs.css">
    </head>
    <body>
        <div class="navbar">
            <?php include __DIR__ . '/../navbar/navbarjs.php'; ?>
        </div>

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
                    <h4>Mohammad Andhika Fadillah</h4>
                    <p class="about">Undergraduate Student at Bandung Institute Of Technology </p>
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
                <h2>Top job picks for you</h2>
                <p class="main-content-text">Based on your profile, preferences, and activity like applies, searches, and saves</p>
                <?php foreach ($lowonganList as $lowongan): ?>
                    <div class="job-card">
                        <p class="job-title">
                            <?php echo $lowongan['posisi']; ?>
                        </p>
                        <p class="job-details">Location: 
                            <?php echo $lowongan['jenis_lokasi']; ?>
                        </p>
                        <p class="job-details">Job Type: 
                            <?php echo $lowongan['jenis_pekerjaan']; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
                <!-- Akhir perulangan -->
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

            <!-- Job seeker guidance -->
            <div class="guidance">
                <div class="guidance-section">
                    <p class="guidance-title">Job seeker guidance</p>
                    <p class="guidance-text">Explore our curated guide of expert-led courses, such as how to improve your resume and grow your network, to help you land your next opportunity.</p>
                    <ul>
                        <li><a href="#" class="guidance-link">I want to improve my resume</a></li>
                        <li><a href="#" class="guidance-link">I want to grow my network</a></li>
                        <li><a href="#" class="guidance-link">I want to ace my interview</a></li>
                        <li><a href="#" class="guidance-link">I need job search tips</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="./public/views/homepage/homejs.js"></script>
    </body>
</html>
