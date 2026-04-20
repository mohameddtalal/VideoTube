<?php
class Video{

private $con, $sqlData;
public function __construct($con,$input,$userLoggedInObj) {
   

}

public function getId() {
    return $this->sqlData["id"];
}

public function getTitle() {
    return $this->sqlData["title"];
}

public function getDescription() {
    return $this->sqlData["description"];
}

public function getPrivacy() {
    return $this->sqlData["privacy"];
}

public function getCategory() {
    return $this->sqlData["category"];
}




}
?>