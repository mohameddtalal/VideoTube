<?php
require_once("includes/classes/ButtonProvider.php");

class VideoInfoControls{
    private $video, $userLoggedInObj;
    public function __construct( $video, $userLoggedInObj) {
    
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
       $likeButton = $this->createLikeButton();
         $dislikeButton = $this->createDislikeButton();

        return "<div class='controls'>
                    $likeButton
                    $dislikeButton
                </div>";
    }

    private function createLikeButton() {
        $videoId = $this->video->getId();
        $action = "likeVideo($videoId, this)";
        $class = "likeButton";
        $imageSrc = "assets/images/icons/thumb-up.png";
        return "<img src='$imageSrc' class='$class' onclick='$action'>";
    }

    private function createDislikeButton() {
        $videoId = $this->video->getId();
        $action = "dislikeVideo($videoId, this)";
        $class = "dislikeButton";
        $imageSrc = "assets/images/icons/thumb-down.png";
        return "<img src='$imageSrc' class='$class' onclick='$action'>";
    }

}


?>