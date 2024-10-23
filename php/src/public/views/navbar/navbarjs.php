<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/public/views/navbar/navbarjs.css">
</head>
<body>
<div class="navbar">
    <div class="navbar-left">
        <a href="/home">
            <i class='fab'>&#xf08c;</i>
        </a>
        <form class="search-bar" action="/home" method="GET">
            <i class="fas fa-search"></i>
            <input type="text" id="search-bar" name="search" placeholder="Title, skill or company">
        </form>
    </div>

    <div class="navbar-right">
        <div class="nav-item">
            <a href="/home">
                <i class="fas fa-home"></i>
                <span class="nav-text">Home</span>
            </a>
        </div>
        <?php 
            if ((isset($_SESSION["user"]) && $_SESSION["user"]->role == "jobseeker")) :
        ?>
            <div class="nav-item">
                <a href="#">
                    <i class="fas fa-address-card"></i>
                    <span class="nav-text">History</span>
                </a>
            </div>

            <div class="nav-item" id="profile-nav">
                <img src="/public/assets/img/photo.jpeg">
                <a class="nav-text" href="#">Me</a>

                <div class="dropdown-menu">
                    <a class="dropdown" href="/signout" id="signout">Sign Out</a>
                </div>
            </div>
        <?php 
            endif;
        ?>
        <?php 
            if ((isset($_SESSION["user"]) && $_SESSION["user"]->role == "company")) :
        ?>
            <div class="nav-item">
                <a href="/profile">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-text">Company</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="/signout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Sign Out</span>
                </a>
            </div>
        <?php 
            endif;
        ?>
        <?php
            if (!isset($_SESSION["user"])) :
        ?>
            <div class="nav-item">
                <a href="/login" class="loginButton">Log In</a>
            </div>
            <div class="nav-item">
                <a href="/register" class="registerButton">Register</a>
            </div>
        <?php 
            endif;
        ?>
    </div>
</div>

<script src="./public/views/navbar/navbarjs.js"></script>

</body>
</html>