<?php
require_once("ButtonProvider.php");

class CommentControls{
    private $con,$comment, $userLoggedInObj;
    public function __construct( $con,$comment, $userLoggedInObj) {
    
        $this->con = $con;
        $this->comment=$comment;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
    $replyButton
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
        $action = "likeVideo(this, $videoId)";
        $class = "likeButton";
        $imageSrc = "assets/images/icons/thumb-up.png";

        // change button image if video is already liked
        if($this->video->wasLikedBy($this->userLoggedInObj->getUsername())) {
            $imageSrc = "assets/images/icons/thumb-up-active.png";
        }

       return ButtonProvider::createButton($text, $imageSrc, $action,$class);
    }

    private function createDislikeButton() {
        $text=$this->video->getDislikes();
        $videoId = $this->video->getId();
        $action = "dislikeVideo(this, $videoId)";
        $imageSrc = "assets/images/icons/thumb-down.png";
        $class = "dislikeButton";
        if($this->video->wasDislikedBy($this->userLoggedInObj->getUsername())) {
            $imageSrc = "assets/images/icons/thumb-down-active.png";
        }
        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }

}


?>