<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkinPurry Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/public/views/login/login.css">
    <script defer src="/public/views/login/login.js"></script>
</head>

<body>
    <?php
    echo __DIR__;
    ?>
    <header>
        <!-- <a href="../../../index.php"><img class="logo" src="../../assets/img/linkinPurry-Whole.png" alt="LinkinPurry logo"></a> -->
        <p>Login</p>
    </header>

    <main class="app-content">
        <section class="login-card">
            <div class="header-content">
                <h1>Log in</h1>
            </div>
            <form id="login-form" method="POST">
                <div id="emailgroup" class="form-group">
                    <input type="text" id="email" name="email" placeholder="">
                    <label for="email">Email</label>
                    <small id="nameError" class="error"></small>
                </div>

                <div id="passwordgroup" class="form-group">
                    <input type="password" id="password" name="password" placeholder="">
                    <label for="email">Password</label>
                    <small id="passwordError" class="error"></small>
                </div>

                <div class="button-container">
                    <small id="loginError" style="color:red;"></small>
                    <button type="submit">Log in</button>
                </div>
            </form>
        </section>

        <div class="subtext">
            New to LinkinPurry? <a href="/register">Register</a>
        </div>
    </main>

</body>

</html>