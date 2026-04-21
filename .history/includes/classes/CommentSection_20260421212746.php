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
   return $this->createCommentSection();

}

private function createCommentSection(){
    $numComments =$this->video->getNumberOfComments();
    $postedBy =$this->userLoggedInObj->getUsername();
    $videoId=$this->video->getId();

    $profileButton = ButtonProvider :: createUserProfileButton($this->con ,$postedBy );
    $commentAction=""


}

}

?>