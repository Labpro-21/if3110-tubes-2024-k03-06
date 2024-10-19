<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./public/views/navbar/navbarcomp.css">
</head>
    <body>
        <div class="navbar">
            <div class="navbar-left">
                <i class='fab'>&#xf08c;</i>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Title, skill or company">
                </div>
            </div>

            <div class="navbar-right">
                <div class="nav-item">
                    <i class="fas fa-home"></i>
                    <a href="#">Home</a>
                </div>
                <div class="nav-item">
                    <i class='fas fa-briefcase'></i>
                    <a href="#">Company</a>
                </div>
                <div class="nav-item">
                    <i class='fas fa-sign-out-alt'></i>
                    <a href="#">Sign Out</a>
                </div>
            </div>
        </div>
    </body>
</html>