<?php
require_once("includes/classes/VideoInfoControls.php");

class VideoInfoSection{
private $video, $userLoggedInObj, $con;
public function __construct($con, $video, $userLoggedInObj) {
    $this->con = $con;
    $this->video = $video;
    $this->userLoggedInObj = $userLoggedInObj;
}

public function create() {
    $primaryInfo = $this->createPrimaryInfo();
    $secondaryInfo = $this->createSecondaryInfo();

    return "<div class='videoInfoSection'>
                $primaryInfo
                $secondaryInfo
            </div>";

}
private function createPrimaryInfo() {
    $title = $this->video->getTitle();
    $description = $this->video->getDescription();
    $views = $this->video->getViews();
    $uploadDate = $this->video->getUploadDate();

    $videoInfoControls = new VideoInfoControls($this->video, $this->userLoggedInObj);
    $controls = $videoInfoControls->create();

    return "<div class='videoInfo'>
                <h1>$title</h1>
                <div class='bottomSection'>
                <span class='viewCount'>$views views • Uploaded on $uploadDate </span>
                   $controls
                </div>
                <p>$description</p>
             
            </div>";
}
private function createSecondaryInfo() {
    $uploadedBy = $this->video->getUploadedBy();
    $uploadedByObj = new User($this->con, $uploadedBy);
    $uploadedByProfilePic = $uploadedByObj->getProfilePic();
    $uploadedByUsername = $uploadedByObj->getUsername();

    return "<div class='secondaryInfo'>
                <div class='uploaderInfo'>
                    <img src='$uploadedByProfilePic' class='profilePic'>
                    <span class='uploaderUsername'>$uploadedByUsername</span>
                </div>
            </div>";
}



}


?>