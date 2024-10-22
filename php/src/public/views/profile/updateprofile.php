<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/public/views/profile/updateprofile.css">
    </head>
    <body>
        <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>
        <div class="container">
            <div class="update-profile-form">
                <div class="back-button">
                    <i class='fas fa-arrow-circle-left'></i>
                </div>
                <h1>Update Your Company Profile</h1>
                <div class="update-profile-container">
                    <div class="company-title">
                        <p>Company Name:</p>
                        <input class="input-box" type="text" id="company-title" placeholder="company-name" name="company-title" required>
                    </div>

                    <div class="company-description">
                        <p>About:</p>
                        <input class="input-box" type="text" id="company-title" placeholder="company description" name="company-title" required>
                    </div>
                            
                    <div class="dragdown-container">
                        <div class="company-location">
                            <p class="update-company-section-title">Company Location:</p>
                                <div class="update-company-section-right">
                                <select id="company-type">
                                    <option value="...">...</option>
                                    <option value="hybrid">hybrid</option>
                                    <option value="on-site">on-site</option>
                                    <option value="remote">remote</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="update-button">
                        <button>Update</button>
                    </div>
                </div>
            </div>             
        </div>
    </body>
</html>