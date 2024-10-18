<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./public/views/homepage/homecomp.css">
    </head>
    <body>
        <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>
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
                    <h4>Repsol Honda</h4>
                    <p class="about">Motorcycle Company </p>
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
                <div class="job-card-container">
                    <div class="job-card-icon">
                        <i class='fas fa-trash-alt'> </i>
                        <i class='far fa-edit'> </i>
                    </div>
                    <div class="job-card">
                        <p class="job-title">Sr Operation Assurance and Operation Readiness Engineer</p>
                        <p class="job-details">Repsol | Jakarta, Indonesia (On-site)</p>
                        <p class="job-details">Promoted · Response time typically 5 days</p>
                    </div>
                </div>

                <div class="job-card-container">
                    <div class="job-card-icon">
                        <i class='fas fa-trash-alt'> </i>
                        <i class='far fa-edit'> </i>
                    </div>
                    <div class="job-card">
                        <p class="job-title">Sr Operation Assurance and Operation Readiness Engineer</p>
                        <p class="job-details">Repsol | Jakarta, Indonesia (On-site)</p>
                        <p class="job-details">Promoted · Response time typically 5 days</p>
                    </div>
                </div>

                <div class="job-card-container">
                    <div class="job-card-icon">
                        <i class='fas fa-trash-alt'> </i>
                        <i class='far fa-edit'> </i>
                    </div>
                    <div class="job-card">
                        <p class="job-title">Sr Operation Assurance and Operation Readiness Engineer</p>
                        <p class="job-details">Repsol | Jakarta, Indonesia (On-site)</p>
                        <p class="job-details">Promoted · Response time typically 5 days</p>
                    </div>
                </div>

                <div class="job-card-container">
                    <div class="job-card-icon">
                        <i class='fas fa-trash-alt'> </i>
                        <i class='far fa-edit'> </i>
                    </div>
                    <div class="job-card">
                        <p class="job-title">Sr Operation Assurance and Operation Readiness Engineer</p>
                        <p class="job-details">Repsol | Jakarta, Indonesia (On-site)</p>
                        <p class="job-details">Promoted · Response time typically 5 days</p>
                    </div>
                </div>

                <div class="job-card-container">
                    <div class="job-card-icon">
                        <i class='fas fa-trash-alt'> </i>
                        <i class='far fa-edit'> </i>
                    </div>
                    <div class="job-card">
                        <p class="job-title">Sr Operation Assurance and Operation Readiness Engineer</p>
                        <p class="job-details">Repsol | Jakarta, Indonesia (On-site)</p>
                        <p class="job-details">Promoted · Response time typically 5 days</p>
                    </div>
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
                <button>Add Job</button>
            </div>
        </div>
        <script src="./public/views/homepage/homecomp.js"></script>
    </body>
</html>
