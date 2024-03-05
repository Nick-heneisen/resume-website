<?php
class SignupController extends Signup {
    private $email;
    private $password;
    private $cnfmpassword;

    public function __construct($email, $password, $cnfmpassword) {
        $this->email = $email;
        $this->password = $password;
        $this->cnfmpassword = $cnfmpassword;
    }

    public function signupUser() {
        if ($this->emptyInput() == false) {
            //echo "empty input"
            header("location: ../register_page.php?error=emptyinput");
            exit();
        }
        if ($this->passwordMatch() == false) {
            //echo "passwords dont match"
            $this->email = $email;
            header("location: ../register_page.php?error=passwordsdontmatch");
            exit();
        }
        if ($this->emailTakenCheck() == false) {
            //echo "email already taken"
            header("location: ../register_page.php?error=emailtaken");
            exit();
        }

        $this->setUser($this->email, $this->password);
    }

    private function emptyInput() {
        $result;
        if (empty($this->email) || empty($this->password) || empty($this->cnfmpassword)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


    private function passwordMatch() {
        $result;
        if ($this->password !== $this->cnfmpassword) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function emailTakenCheck() {
        $result;
        if (!$this->checkUser($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}