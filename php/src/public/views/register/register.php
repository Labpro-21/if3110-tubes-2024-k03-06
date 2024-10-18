<!-- register.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./register.css">

    <script defer src="register.js"></script>
</head>
<body>

<header>
    <!-- <a href="../../../index.php"><img class="logo" src="../../assets/img/linkinPurry-Whole.png" alt="LinkinPurry logo"></a> -->
     <p>template</p>
</header>

<h1 class="main-sub">
    Make the most of your professional life
</h1>

<section class="reg-card">
    <form id="reg-form" method="POST">
        
        <div class="form-group">
            <label for="name">Register as</label>
            <select name="role" id="role" class="select-box">
                <option value="" disabled selected></option>
                <option value="job_seeker">Job Seeker</option>
                <option value="company">Company</option>
            </select>
            <small id="roleError" class="error"></small>
        </div>

        <!-- Job Seeker Form -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <small id="nameError" class="error"></small>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <small id="emailError" class="error"></small>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <small id="passwordError" class="error"></small>
        </div>

        <div class="form-group">
            <label for="repeatPassword">Confirm password</label>
            <input type="password" id="repeatPassword" name="repeatPassword">
            <small id="repeatPasswordError" class="error"></small>
        </div>

        <!-- Company Form -->
        <div id="companyAdditionalForm" class="hidden">
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location">
                <small id="locationError" class="error"></small>
            </div>

            <div class="form-group">
                <label for="about">About the Company</label>
                <textarea id="about" id="about" name="about"></textarea>
                <small id="aboutError" class="error"></small>
            </div>
        </div>

        <div class="button-container">
            <button type="submit" id="companySubmit">Agree & Join</button>
        </div>

    </form>

    <p class="login-href">
        Already on LinkinPurry? <a href="/public/views/login/login.php" class="">Log in</a>
    </p>

</section>

</body>
</html>