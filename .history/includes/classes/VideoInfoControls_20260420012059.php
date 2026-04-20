<?php
class VideoInfoControls{
    private $video, $userLoggedInObj;
    public function __construct( $video, $userLoggedInObj) {
    
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
        $videoId = $this->video->getId();
        $actionButtons = $this->createActionButtons($videoId);

        return "<div class='videoInfoControls'>
                    $actionButtons
                </div>";
    }
}


?>