<?php
class Signup extends Dbh {

    protected function setUser($email, $password) {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_email, users_password) VALUES (?, ?);');

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($email, $hashedPwd))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($email) {
        $stmt = $this->connect()->prepare('SELECT users_email FROM users WHERE users_email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        //checks if in database
        $resultCheck;
        if($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

}