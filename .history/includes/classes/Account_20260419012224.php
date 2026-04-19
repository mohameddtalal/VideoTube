<?php

class Account {

    private $con;
    private $errorArray;
    

    public function __construct($con) {
        $this->con = $con;
        $this->errorArray = array();
    }

    public function register($firstName, $lastName, $username, $email, $email2, $password, $password2) {
        $this->validateFirstName($firstName);
        $this->validateLastName($lastName);
        $this->validateUsername($username);
        $this->validateEmails($email, $email2);
        $this->validatePasswords($password, $password2);

        if(empty($this->errorArray)) {
            return $this->insertUserDetails($firstName, $lastName, $username, $email, $password);

        }
        else {
            return false;
        }
    }

    public function insertUserDetails($firstName, $lastName, $username, $email, $password) {
       $password = hash("sha512", $password);

        $profilePic = "assets/images/profilePictures/default.png";

      

        $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password, profilePic) VALUES (:firstName, :lastName, :username, :email, :password, :profilePic, :signUpDate)");

        $query->bindParam(":firstName", $firstName);
        $query->bindParam(":lastName", $lastName);
        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $password);
        $query->bindParam(":profilePic", $profilePic);
        $date = date("Y-m-d");
        $query->bindParam(":signUpDate", $date);
      

        return $query->execute();
    }

    private function validateFirstName($firstName) {
        if(strlen($firstName) < 2 || strlen($firstName) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }
 

    private function validateLastName($lastName) {
        if(strlen($lastName) < 2 || strlen($lastName) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($username) {
        if(strlen($username) < 5 || strlen($username) > 25) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }
    }


    private function validateEmails($email, $email2) {
        if($email != $email2) {
            array_push($this->errorArray, Constants::$emailsDontMatch);
            return;
        }


        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }
        $query = $this->con->prepare("SELECT email FROM users WHERE email=:email");
        $query->bindParam(":email", $email);
        $query->execute();
        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }

    private function validatePasswords($password, $password2) {
        if($password != $password2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            return;
        }

        if(strlen($password) < 5 || strlen($password) > 30) {
            array_push($this->errorArray, Constants::$passwordLength);
            return;
        }
    }
       public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }

}
?>