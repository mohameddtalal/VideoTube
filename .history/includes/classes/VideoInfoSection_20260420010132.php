<?php
class VideoInfoSection{
private $video, $userLoggedInObj, $con;
public function __construct($con, $video, $userLoggedInObj) {
    $this->con = $con;
    $this->video = $video;
    $this->userLoggedInObj = $userLoggedInObj;
}

public function create() {
    $title = $this->video->getTitle();
    $description = $this->video->getDescription();
    $views = $this->video->getViews();
    $uploadDate = $this->video->getUploadDate();

    return "<div class='videoInfo'>
                <h1>$title</h1>
                <span class='videoInfoDetails'>$views views • Uploaded on $uploadDate</span>
                <p>$description</p>
            </div>";



}


?>