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
                
             
            </div>";
}
private function createSecondaryInfo() {
    $uploadedBy =   $this->video->getUploadedBy();
    $description =  $this->video->getDescription();
    $uploadDate =   $this->video->getUploadDate();
    $profileButton = ButtonProvider::createUserProfileButton($this->con , $uploadedBy);
    if($uploadedBy == $this->userLoggedInObj->getUsername()){
        $actionButton = ButtonProvider::createEditVideoButton($this->video->getId());

    }else{
        $userToObject
     $actionButton = ButtonProvider::createSubscriberButton($this->con , );
    }

return "<div class='secondaryInfo'>
            <div class='topRow'>
                $profileButton
                <div class='uploadInfo'>
                    <span class='owner'>
                        <a href='profile.php?username=$uploadedBy'>$uploadedBy</a>
                    </span>
                    <span class='date'>Published on $uploadDate</span>
                </div> 
                $actionButton
            </div> 
            </div>";
}



}


?>