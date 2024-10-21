<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./public/views/homepage/homejs.css">
        <script defer src="/public/views/homepage/homejs.js"></script>
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
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
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
                <h2>Top job picks for you</h2>
                <p class="main-content-text">Based on your profile, preferences, and activity like applies, searches, and saves</p>
                <div class="joblist">

                </div>
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
    </body>
</html>
