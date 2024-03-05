<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Log in </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css"/>
    </head>

    <body class="newcolor">
        <div class="form_container"> 
            <form action="includes/login.inc.php" method="post">
                <h3> Sign in </h3>
                <?php 
                    if (isset($_GET['email'])) {
                        $email = $_GET['email'];
                        echo '<input type="email" name="email" placeholder="enter your email" class="box" value="'.$email.'" required>';
                    } else {
                        echo '<input type="email" name="email" placeholder="enter your email" class="box" required>';
                    }
                ?>
                <input type="password" name="password" placeholder="enter your password" class="box" required>
                <input type="submit" value="login" name="submit" class="form-btn">
                <br />
                <a href="register_page.php">register</a>
                <a href="index.php">home</a>

                <?php
                    if (!isset($_GET['error'])) {
                        exit();
                    } else {
                        $errorCheck = $_GET['error'];

                        if ($errorCheck == 'incorrectpassword') {
                            echo " <p class='error'> incorrect password. </p>";
                            exit();
                        } else if ($errorCheck == 'stmtfailed') {
                            echo " <p class='error'> stmt failed. </p>";
                            exit();
                        } else if  ($errorCheck == 'usernotfound'){
                            echo " <p class='error'> user not found. have you signed up? </p>";
                            exit();
                        } else if ($errorCheck == 'none') {
                            echo " <p class='success'> logged in successfully! </p>";
                            exit();
                        }
                    }
                ?>
            </form>
        </div>
    </body>

    <footer>

    </footer>

</html>