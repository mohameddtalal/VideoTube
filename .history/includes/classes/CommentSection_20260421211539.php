<?php
require_once("includes/classes/VideoInfoControls.php");

class CommentSection{
private $video, $userLoggedInObj, $con;

public function __construct($con, $video, $userLoggedInObj) {
    $this->con = $con;
    $this->video = $video;
    $this->userLoggedInObj = $userLoggedInObj;
}

public function create() {
   

}



}

?>