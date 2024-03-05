<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Sign up </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css"/>
    </head>

    <body class="newcolor">
        <div class="form_container"> 
            <form action="includes/signup.inc.php" method="post">
                <h3> Register </h3>
                <?php 
                    if (isset($_GET['email'])) {
                        $email = $_GET['email'];
                        echo '<input type="email" name="email" placeholder="enter your email" class="box" value="'.$email.'" required>';
                    } else {
                        echo '<input type="email" name="email" placeholder="enter your email" class="box" required>';
                    }
                ?>
                <input type="password" name="password" placeholder="enter your password" class="box" required>
                <input type="password" name="cnfmpassword" placeholder="confirm your password" class="box" required>
                <input type="submit" value="register" name="submit" class="form-btn">
                <br />
                <a href="login_page.php">login</a>
                <a href="index.php">home</a>
                <?php
                    if (!isset($_GET['error'])) {
                        exit();
                    } else {
                        $errorCheck = $_GET['error'];

                        if ($errorCheck == 'emailtaken') {
                            echo " <p class='error'> email already in use. </p>";
                            exit();
                        } else if ($errorCheck == 'stmtfailed') {
                            echo " <p class='error'> stmt failed. </p>";
                            exit();
                        } else if  ($errorCheck == 'passwordsdontmatch'){
                            echo " <p class='error'> passwords do not match. </p>";
                            exit();
                        } else if ($errorCheck == 'emptyinput') {
                            echo " <p class='error'> please input in all boxes. </p>";
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