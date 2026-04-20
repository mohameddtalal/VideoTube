<?php
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

    return "<div class='videoInfo'>
                <h1>$title</h1>
                <div class='videoInfo'>$views views • Uploaded on $uploadDate</span>
                <p>$description</p>
            </div>";
}
private function createSecondaryInfo() {
    $uploadedBy = $this->video->getUploadedBy();
    $uploadedByObj = new User($this->con, $uploadedBy);
    $uploadedByProfilePic = $uploadedByObj->getProfilePic();
    $uploadedByUsername = $uploadedByObj->getUsername();

    return "<div class='videoInfo'>
                <h1>$title</h1>
                <span class='videoInfoDetails'>$views views • Uploaded on $uploadDate</span>
                <p>$description</p>
            </div>";
}



}


?>