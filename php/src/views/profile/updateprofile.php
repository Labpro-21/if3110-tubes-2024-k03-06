<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _user JOIN _company_detail ON _user.user_id = _company_detail.user_id WHERE _user.user_id = :id");
$stmt->bindParam(':id', $_SESSION['user']->id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$company = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/public/styles/profile/updateprofile.css">

        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <script defer src="/public/scripts/profile/updateprofile.js"></script>
    </head>
    <body>
        <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>
        <div class="container">
            <div class="update-profile-form">
                <div class="back-button" onclick="history.go(-1);">
                    <i class='fas fa-arrow-circle-left'></i>
                </div>
                <h1>Update Your Company Profile</h1>
                <form id="update-form" class="update-profile-container" method="POST" enctype="multipart/form-data" action="/profile/updateCompany">
                    <div class="company-title">
                        <label for="company-title">Company Name</label>
                        <input class="input-box" type="text" id="company-title" name="company-title" value="<?php echo $company['nama']?>">
                        <small id="nameError" class="error"></small>
                    </div>

                    <div class="company-location">
                        <label for="company-loc">Company Location</label>
                        <input class="input-box" type="text" id="company-loc" name="company-loc" value="<?php echo $company['lokasi']?>">
                        <small id="locError" class="error"></small>
                    </div>

                    <div class="company-description">
                        <label for="company-desc">About</label>
                        <div id="editor"><?php echo $company['about']?></div>
                        <input type="hidden" id="company-desc" name="company-desc" value="">
                        <small id="descError" class="error"></small>
                    </div>

                    <div class="update-button">
                        <button id="updateButton" type="submit">Update</button>
                    </div>
                </form>
            </div>             
        </div>
    </body>
</html>