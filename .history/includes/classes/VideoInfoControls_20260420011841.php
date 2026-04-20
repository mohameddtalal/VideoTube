<?php
class VideoInfoControls{
    private $video, $userLoggedInObj, $con;
    public function __construct($con, $video, $userLoggedInObj) {
        $this->con = $con;
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    
}


?>