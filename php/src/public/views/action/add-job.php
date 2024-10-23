<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="/public/views/action/add-job.css">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <script src="/public/views/action/add-job.js"></script>
    </head>
    <body>
        <div class="navbar">
            <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="home-picture">
                <img src="/public/assets/img/itb.jpeg">
            </div>
            <div class="profile-picture">
                <img src="/public/assets/img/photo.jpeg">
            </div>
            <div class="profile-info">
                <?php echo '<h3>' . $_SESSION['user']->nama . '</h3>'; ?>
                <p class="about">Motorcycle Company </p>
            </div>
        </div>
        
        <div class="add-job">
            <div class="container">
                <div class="back-button">
                    <i class='fas fa-arrow-circle-left'></i>
                </div>
        
                <div class="add-job-form">
                    <h1>Post a New Job Here</h1>
                    <div class="add-job-container">
                        <div class="job-title">
                            <p>Job Title:</p>
                            <input class="input-box" type="text" id="job-title" placeholder="job title" name="job-title" required>
                        </div>

                        <div class="job-description">
                            <p>Job Description:</p>
                            <div id="editor" style="height: 200px;"></div>
                        </div>
                        
                        <div class="dragdown-container">
                            <div class="jobtype">
                                <p class="add-job-section-title">Job Type:</p>
                                <div class="add-job-section-left">
                                    <select id="job-type">
                                        <option value="...">...</option>
                                        <option value="full-time">Full-time</option>
                                        <option value="part-time">Part-time</option>
                                        <option value="contract">Contract</option>                            
                                    </select>
                                </div>
                            </div>

                            <div class="job-location">
                                <p class="add-job-section-title">Job Location:</p>
                                <div class="add-job-section-right">
                                    <select id="job-location">
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
                            <input type="file" id="job-image" accept="image/*" style="display: none;" multiple>
                            <span id="file-chosen">No file chosen</span>
                        </div>
                        <div id="preview"></div>

                        <div class="add-button">
                            <button id="add-button">Add</button>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </body>
</html>