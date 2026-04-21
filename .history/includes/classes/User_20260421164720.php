<?php
class User{

    private $con, $sqlData;
    
    public function __construct($con, $username){
        $this->con = $con;

        if(empty($username)) {
            $this->sqlData = [];
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        $this->sqlData = $result ? $result : [];
    }

   public static function isLoggedIn() {
        return isset($_SESSION["userLoggedIn"]);
    }

   public function getUsername() {
        return $this->sqlData["username"] ?? null;
    }

    public function getFirstName(){
        return $this->sqlData["firstName"] ?? null;
    }

    public function getLastName(){
        return $this->sqlData["lastName"] ?? null;
    }

    public function getName(){
        return ($this->sqlData["firstName"] ?? "") . " " . ($this->sqlData["lastName"] ?? "");
    }

    public function getEmail(){
        return $this->sqlData["email"] ?? null;
    }

    public function getProfilePic(){
        return $this->sqlData["profilePic"] ?? null;
    }

    public function getSignUpDate(){
        return $this->sqlData["signUpDate"] ?? null;
    }
    public function isSubscribedTo($userTo){
        $query=$this->cin->prepare("SELECT * FROM subscribers ")
    }
}
?>