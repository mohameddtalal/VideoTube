<?php
class VideoInfoControls{
    private $video, $userLoggedInObj, $con;
    public function __construct( $video, $userLoggedInObj) {
    
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
        $videoId = $this->video->getId();
        $username = $this->userLoggedInObj->getUsername();

        $query = $this->con->prepare("SELECT * FROM videoLikes WHERE username=:username AND videoId=:videoId");
        $query->bindParam(":username", $username);
        $query->bindParam(":videoId", $videoId);
        $query->execute();

        $buttonClass = "likeButton";
        if($query->rowCount() > 0) {
            $buttonClass .= " active";
        }

        return "<div class='videoInfoControls'>
                    <button class='$buttonClass' onclick='likeClicked($videoId, this)'>
                        <i class='fas fa-thumbs-up'></i>
                    </button>
                </div>";
    }
}


?>