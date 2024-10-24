<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./public/views/homepage/homejs.css">
        <script defer src="/public/views/homepage/pagination.js"></script>
    </head>
    <body>
        <div class="navbar">
            <?php include __DIR__ . '/../navbar/navbarjs.php'; ?>
        </div>

        <nav class="navigation-bar">
            <div class="hamburger-menu" id="hamburger-menu">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links" id="nav-links">
                <li>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Title, skill or company">
                    </div>
                </li>
                <li>
                    <div class="nav-item">
                        <i class="fas fa-home"></i>
                        <a href="/home">Home</a>
                    </div>
                </li>
                <li>
                    <div class="nav-item">
                        <a href="/jobhistory">
                            <i class="fas fa-address-card"></i>
                            <span class="nav-text">History</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a href="/signout" class="nav-item-link">
                        <div class="nav-item">
                            <i class='fas fa-sign-out-alt'></i>
                            <span>Sign Out</span>
                        </div>
                    </a>
                </li>
            </ul>
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
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            echo isset($_SESSION['user']) ? $_SESSION['user']->nama : 'Guest';
                        ?>
                    </h4>
                    <!-- <p class="about">Undergraduate Student at Bandung Institute Of Technology </p> -->
                </div>

                <div class="filter">
                    <p class="filter-title">Job Preference :</p>
                    <div class="filter-container">
                        <div class="filter-section">
                            <p class="filter-section-title">Time</p>
                            <div class="filter-group">
                                <select id="job-sort" name="job-sort">
                                    <option value="">...</option>
                                    <option value="DESC">newest</option>
                                    <option value="ASC">oldest</option>
                                </select>
                            </div>
                        </div>
                        <div class="filter-section">
                        <p class="filter-section-title">Job Type</p>
                            <div class="filter-group">
                                <select id="job-type" name="job-type">
                                    <option value="">...</option>
                                    <option value="full-time">Full-time</option>
                                    <option value="part-time">Part-time</option>
                                    <option value="contract">Contract</option>
                                </select>
                            </div>
                        </div>
                        <div class="filter-section">
                        <p class="filter-section-title">Job Location</p>
                            <div class="filter-group">
                                <select id="job-location" name="job-location">
                                    <option value="">...</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="on-site">On-site</option>
                                    <option value="remote">Remote</option>
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
                <?php
                    echo isset($_GET['search']) ? '<h4>Showing search result for: "' . $_GET['search'] . '"</h4>': '';
                ?>
                
                <div class="joblist">

                </div>
                <!-- Akhir perulangan -->
                <div class="pagination">
                    <button id="prev-btn" class="pagination-button" disabled>
                        <i class="fas fa-angle-left"></i>
                    </button>   
                    <div id="page-buttons"></div>
                    <button id="next-btn" class="pagination-button" disabled>
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
                        <li><a href="home/guidance1" class="guidance-link">I want to improve my resume</a></li>
                        <li><a href="home/guidance2" class="guidance-link">I want to grow my network</a></li>
                        <li><a href="home/guidance3" class="guidance-link">I want to ace my interview</a></li>
                        <li><a href="home/guidance4" class="guidance-link">I need job search tips</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
    <script src="/public/views/navbar/navbar-responsive.js"></script>
</html>
