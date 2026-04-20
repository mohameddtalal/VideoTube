<?php
class Video{

private $con, $sqlData;
public function __construct($con,$input) {
    $this->con = $con;

    if(is_array($input)) {
        $this->sqlData = $input;
    }
    else {
        $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
        $query->bindParam(":id", $input);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

}


?>