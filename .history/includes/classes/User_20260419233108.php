<?php
class User{

    private $con, $sqlData;
    
    public function __construct($con,$username){
        $this->con=$con;
        $this->sqlData = $this->con->query("SELECT * FROM users WHERE username='$username'");

   }
}

?>