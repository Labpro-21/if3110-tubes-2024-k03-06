<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan WHERE company_id = :company_id");
$stmt->bindParam(':company_id', $_SESSION['user']->id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$lowonganList = $stmt->fetchAll();

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
        <link rel="stylesheet" href="./public/views/profile/profilecomp.css">
    </head>
    <body>
        <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>

        <div class="container">
            <div class="company-info">
                <h1>
                    <?php
                    echo $company['nama'];
                    ?>
                </h1>
                <p>Lokasi :</p>
            </div>
            <div class="company-description">
                <p>
                    <?php
                    echo $company['about'];
                    ?>
                </p>
            </div>

            <div class="edit-profile">
                <a href="/public/views/profile/updateprofile.php">
                    <button>Edit Profile</button>
                </a>
            </div>
        </div>
    </body>
</html>

   

