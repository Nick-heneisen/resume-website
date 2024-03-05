<?php
class Login extends Dbh {

    protected function getUser($email, $password) {
        $stmt = $this->connect()->prepare('SELECT users_password FROM users WHERE users_email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../login_page.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../login_page.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $pwdHashed[0]["users_password"]);

        if($checkPwd == false) {
            $stmt = null;
            header("location: ../login_page.php?error=incorrectpassword&email=$email");
            exit();
        } else if ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_email = ? AND users_password = ?;');

            if (!$stmt->execute(array($email, $pwdHashed[0]['users_password']))) {
                $stmt = null;
                header("location: ../login_page.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../login_page.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useremail"] = $user[0]["users_email"];

        }

        $stmt = null;
    }
}