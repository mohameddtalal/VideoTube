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
            // Insert into database
            return true;
        }
        else {
            return false;
        }
    }

    private function validateFirstName($firstName) {
        if(strlen($firstName) < 2 || strlen($firstName) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($lastName) {
        if(strlen($lastName) < 2 || strlen($lastName) > 25) {
            array_push($this->errorArray, "Your last name must be between 2 and 25 characters");
        }
    }

    private function validateUsername($username) {
        if(strlen($username) < 5 || strlen($username) > 25) {
            array_push($this->errorArray, "Your username must be between 5 and 25 characters");
            return;
        }
    }
    private function validateEmails($email, $email2) {
        if($email != $email2) {
            array_push($this->errorArray, "Your emails don't match");
            return;
        }


        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, "Email is invalid");
            return;
        }
    }

    private function validatePasswords($password, $password2) {
        if($password != $password2) {
            array_push($this->errorArray, "Your passwords don't match");
            return;
        }

        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, "Your password can only contain numbers and letters");
            return;
        }

        if(strlen($password) < 5 || strlen($password) > 30) {
            array_push($this->errorArray, "Your password must be between 5 and 30 characters");
            return;
        }
    }

}
?>