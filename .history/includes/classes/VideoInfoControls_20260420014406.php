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
        $class = "likeButton";
        $imageSrc = "assets/images/icons/thumb-up.png";

        //change button image if video is already liked
        if($this->video->wasLikedBy($this->userLoggedInObj->getUsername())) {
            $imageSrc = "assets/images/icons/thumb-up-active.png";
        }

       return ButtonProvider::createButton($text, $imageSrc, "Like", "likeButton");
    }

    private function createDislikeButton() {
        $text=$this->video->getDislikes();
        $videoId = $this->video->getId();
        $action = "dislikeVideo($videoId, this)";
        $imageSrc = "assets/images/icons/thumb-down.png";
        return ButtonProvider::createButton("dislike", $imageSrc, "Dislike", "dislikeButton");
    }

}


?>