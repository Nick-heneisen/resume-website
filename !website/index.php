<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <div class="centered"> 

            <title> NFL Predictions </title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css"/>
            <script src="filereader.js"></script>
            <h1 class="title"> NFL Predictions </h1>
            <?php if(isset($_SESSION["useremail"])) { ?>

                <h3> Your account: <?php echo $_SESSION["useremail"]; ?> </h3>

            <?php } else { ?>

                <h3> Not logged in </h3>

            <?php } ?>
            <br />
            <div class="container">

                <?php
                    if(isset($_SESSION["useremail"])) {
                ?>
                    
                    <div class="four columns">
                        <a class="buttons" href="league.php"> Real League </a>
                    </div>

                    <div class="four columns">
                        <a class="buttons" href="fantasy.php"> Your League </a>
                    </div>

                    <div class="four columns">
                        <a class="buttons" href="includes/logout.inc.php"> Logout </a>
                    </div>
                        
                <?php
                    } else {
                ?>

                    <div class="four columns">
                        <a class="buttons" href="league.php"> Real League </a>
                    </div>

                    <div class="four columns">
                        <a class="buttons" href="register_page.php"> Sign up </a>
                    </div>

                    <div class="four columns">
                        <a class="buttons" href="login_page.php"> Login </a>
                    </div>

                <?php
                    }
                ?>
            </div>
        </div>
    </head>
        
    <body class="newcolor" onload="weekReader()">
        <hr />

        <div class="centered">
            <h3 class="headerline"> Make your predictions! </h3>

            <label for="weeks"> Select week: </label>
            <select name="weeks" id="weeks" onchange="weekReader()">
                    <option value="1">Week 1</option>
                    <option value="2">Week 2</option>
                    <option value="3">Week 3</option>
                    <option value="4">Week 4</option>
                    <option value="5">Week 5</option>
                    <option value="6">Week 6</option>
                    <option value="7">Week 7</option>
                    <option value="8">Week 8</option>
                    <option value="9">Week 9</option>
                    <option value="10">Week 10</option>
                    <option value="11">Week 11</option>
                    <option value="12">Week 12</option>
                    <option value="13">Week 13</option>
                    <option value="14">Week 14</option>
                    <option value="15">Week 15</option>
                    <option value="16">Week 16</option>
                    <option value="17">Week 17</option>
                    <option value="18">Week 18</option>
            </select>
        </div>
        <br />
        <div class="predicChart" id="startReq">
            <!-------------------------------------------------------------------->
            <div class="row">
                <div class="four columns centered">
                    <h3> <u> AFC </u> </h3>
                </div>

                <div class="four columns centered">
                    <h3> <u> Cross-conference </u> </h3>
                </div>

                <div class="four columns centered">
                    <h3> <u> NFC </u> </h3>
                </div>
            </div>
        </div>
        <div class="centered">
            <button type="submit" id="result">Submit</button>
        </div>
        <br />
    </body>
</html>
