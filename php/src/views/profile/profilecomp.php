<?php
$db = Database::getInstance();
$conn = $db->getConnection();
// $stmt = $conn->prepare("SELECT * FROM _lowongan WHERE company_id = :company_id");
// $stmt->bindParam(':company_id', $_SESSION['user']->id);
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// $lowonganList = $stmt->fetchAll();

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
        <link rel="stylesheet" href="/public/styles/profile/profilecomp.css">
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
        <div class="main-container">
            <div class="container">
                <div class="company-info">
                    <h1>
                        <?php
                        echo $company['nama'];
                        ?>
                    </h1>
                    <p>Lokasi : 
                        <?php
                            echo $company['lokasi'];
                        ?>
                    </p>
                </div>
                <div class="company-description">
                    <p>
                        <?php
                        echo $company['about'];
                        ?>
                    </p>
                </div>

                <div class="edit-profile">
                    <a href="/profile/update">
                        <button>Edit Profile</button>
                    </a>
                </div>
            </div>
        </div>
    </body>
    <script src="/public/scripts/navbar/navbar-responsive.js"></script>
</html>

   

