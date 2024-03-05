<?php
if(isset($_POST["submit"]))
{
    //grabbing data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cnfmpassword = $_POST["cnfmpassword"];

    //instantiate SignupController class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupController($email, $password, $cnfmpassword);

    //running error handlers
    $signup->signupUser();

    //going back to home page
    header("location: ../index.php?error=none");
}
?>