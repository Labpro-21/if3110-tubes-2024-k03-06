<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/public/views/homepage/homecomp.css">
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
                    <i class='fas fa-briefcase'></i>
                    <a href="/profile">Company</a>
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
                <img src="./public/assets/img/skyscrapper-photo.jpeg">
            </div>
            <div class="profile-picture">
                <img src="./public/assets/img/company-photo.jpeg">
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

                <?php
                    echo isset($_GET['search']) ? '<h4>Showing search result for: "' . $_GET['search'] . '"</h4>': '';
                ?>
                
                <div class="joblist">

                </div>

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
</body>
<script src="/public/views/navbar/navbar-responsive.js"></script>
<script src="./public/views/homepage/homecomp.js"></script>

</html>