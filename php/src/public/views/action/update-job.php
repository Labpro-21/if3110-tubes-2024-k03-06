<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="/public/views/action/update-job.css">
    </head>
    <body>
        <div class="navbar">
            <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>
        </div>

        <div class="update-job-container">
             <!-- Sidebar -->
            <div class="sidebar">
                <div class="home-picture">
                    <img src="/public/assets/img/itb.jpeg">
                </div>
                <div class="profile-picture">
                    <img src="/public/assets/img/photo.jpeg">
                </div>
                <div class="profile-info">
                    <h4>Repsol Honda</h4>
                    <p class="about">Motorcycle Company </p>
                </div>
            </div>
            
            <div class="update-job">
                <div class="container">
                    <div class="back-button">
                        <i class='fas fa-arrow-circle-left'></i>
                    </div>
            
                    <div class="update-job-form">
                        <h1>Update Your Current Job</h1>
                        <div class="update-job-container">
                            <div class="job-title">
                                <p>Job Title:</p>
                                <input class="input-box" type="text" id="job-title" placeholder="job title" name="job-title" required>
                            </div>

                            <div class="job-description">
                                <p>Job Description:</p>
                                <input class="input-box" type="text" id="job-title" placeholder="job description" name="job-title" required>
                            </div>
                            
                            <div class="dragdown-container">
                                <div class="jobtype">
                                    <p class="update-job-section-title">Job Type:</p>
                                    <div class="update-job-section-left">
                                        <select id="job-type">
                                            <option value="...">...</option>
                                            <option value="full-time">Full-time</option>
                                            <option value="part-time">Part-time</option>
                                            <option value="contract">Contract</option>                            
                                        </select>
                                    </div>
                                </div>

                                <div class="job-location">
                                    <p class="update-job-section-title">Job Location:</p>
                                    <div class="update-job-section-right">
                                        <select id="job-type">
                                            <option value="...">...</option>
                                            <option value="hybrid">hybrid</option>
                                            <option value="on-site">on-site</option>
                                            <option value="remote">remote</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="upload-image">
                                <p class="add-job-section-title">Upload Job Image:</p>
                                <label for="job-image" class="custom-file-upload">Choose File</label>
                                <input type="file" id="job-image" accept="image/*" style="display: none;">
                                <span id="file-chosen">No file chosen</span>
                            </div>

                            <div class="update-button">
                                <button>Update</button>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </body>
</html>