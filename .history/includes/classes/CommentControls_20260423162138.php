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
    $replyButton=$this->createReplyButton();
    $likesCount=$this->createLikesCount();
    $likeButton = $this->createLikeButton();
    $dislikeButton = $this->createDislikeButton();
    $replySection=$this->createReplySection();

        return "<div class='controls'>
                    $replyButton
                    $likesCount
                    $likeButton
                    $dislikeButton
                </div>";
    }

    private function createReplyButton(){
        $text="REPLY";
        $action="toggleReply(this)";
        return ButtonProvider::createButton($text,null,$action,null);
    }
    private function createLikesCount(){
        $text=$this->comment->getLikes();
        if($text==0){
            $text="";
        }
        return "<span class='likesCount'> $text </span>";
    }
    private function createReplySection(){
  
    $postedBy =$this->userLoggedInObj->getUsername();
    $videoId=$this->comment->getVideoId();
    $commentId=$this->comment->getId();

    $profileButton = ButtonProvider :: createUserProfileButton($this->con ,$postedBy );

    $cancelButtonAction="toggleReply(this)";
    $cancelButton=ButtonProvider::createButton("Cancel" , null ,$cancelButtonAction,"cancelComment");

    $postButtonAction="postComment(this,\"$postedBy\", $video ,$commentId,\"repliesSection\")";
    $postButton=ButtonProvider::createButton("Reply" , null ,$postButtonAction,"postComment");

   

    return "  <div class='commentForm'>
                     $profileButton
                      <textarea id='commentForm' class='commentBodyClass' placeholder='Add a public comment'></textarea>
                     $cancelButton
                     
                   </div>";
  
    }

    private function createLikeButton() {
        $text=$this->comment->getLikes();
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "likeComment($commentId,this, $videoId)";
        $class = "likeButton";
        $imageSrc = "assets/images/icons/thumb-up.png";

        // change button image if video is already liked
        if($this->comment->wasLikedBy()) {
            $imageSrc = "assets/images/icons/thumb-up-active.png";
        }

       return ButtonProvider::createButton("", $imageSrc, $action,$class);
    }

    private function createDislikeButton() {
       $text=$this->comment->getLikes();
        $commentId = $this->comment->getId();
         $videoId = $this->comment->getVideoId();
        $action = "dislikeComment($commentId,this, $videoId)";
        $imageSrc = "assets/images/icons/thumb-down.png";
        $class = "dislikeButton";
        if($this->comment->wasDislikedBy()) {
            $imageSrc = "assets/images/icons/thumb-down-active.png";
        }
        return ButtonProvider::createButton("", $imageSrc, $action, $class);
    }

}


?>