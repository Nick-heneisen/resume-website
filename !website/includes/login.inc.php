<?php
if(isset($_POST["submit"]))
{
    //grabbing data
    $email = $_POST["email"];
    $password = $_POST["password"];

    //instantiate SignupController class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginController($email, $password);

    //running error handlers
    $login->loginUser();

    //going back to home page
    header("location: ../index.php?error=none");
}
?>