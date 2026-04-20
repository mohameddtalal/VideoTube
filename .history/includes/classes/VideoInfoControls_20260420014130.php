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
        $text=$this->video->getLikes();
        $videoId = $this->video->getId();
        $action = "likeVideo($videoId, this)";
       return ButtonProvider::createButton("like", null, "Like", "likeButton");
    }

    private function createDislikeButton() {
        $text=$this->video->getDislikes();
        $videoId = $this->video->getId();
        
        return ButtonProvider::createButton("dislike", null, "Dislike", "dislikeButton");
    }

}


?>