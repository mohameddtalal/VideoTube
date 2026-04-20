<?php
class VideoInfoControls{
    private $video, $userLoggedInObj;
    public function __construct( $video, $userLoggedInObj) {
    
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
       $likeButton = $this->createLikeButton();
       

        return "<div class='controls'>
                    $actionButtons
                </div>";
    }
}


?>