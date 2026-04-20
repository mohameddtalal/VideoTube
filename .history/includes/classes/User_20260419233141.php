<?php
class User{

    private $con, $sqlData;
    
    public function __construct($con,$username){
        $this->con=$con;
        $query=$this->con->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username",$username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);


   }
}

?>