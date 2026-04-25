<?php
require_once("ButtonProvider.php");
require_once("CommentControls.php");

class Comment{
private $con ,$sqlData,$userLoggedInObj,$videoId;


public function __construct($con ,$input,$userLoggedInObj,$videoId){
        if(!is_array($input)){ //this mean this is an id
        $query=$con->prepare("SELECT * FROM comments where id=:id");
        $query->bindParam(":id", $input);
        $query->execute();

        $input=$query->fetch(PDO::FETCH_ASSOC);
        
        }
        $this->sqlData=$input;
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
        $this->videoId=$videoId;
        var_dump($this->sqlData);

        }

        public function create(){
            $body=$this->sqlData["body"];
            $postedBy=$this->sqlData["postedBy"];
            $profileButton=ButtonProvider::createUserProfileButton($this->con,$postedBy);
            $timespan=""; //to do get time span
            $commentControlsObj=new CommentControls($this->con,$this,$this->userLoggedInObj);

            return "<div class='itemContainer'>
                      <div class='comment'>
                        $profileButton
                        <div class='mainContainer'>
                            <div class='commentHeader'>
                                <a href='profile.php?username=$postedBy'>
                                 <span class='username'>$postedBy</span>
                                 </a>
                                 <span class='timestamp'>$timespan</span>
                            </div>

                            <div class='body'>
                            $body
                            </div>
                        </div>
                    
                       </div>
                    </div>"; 

        }
        public function getId(){
            return $this->sqlData["id"];

        }
          public function getVideoId(){
            return $this->videoId;

        }

        public function getLikes(){
            $query=$this->con->prepare("SELECT count(*) as 'count' FROM likes WHERE commentId=:commentId");
            $commentId= $this->getId();
            $query=bindParam(":commentId" ,$commentId);
            $query->execute();

            $data=$query->fetch(PDO::FETCH_ASSOC);
            $numLikes=$data["count"];

            $query=$this->con->prepare("SELECT count(*) as 'count' FROM dislikes WHERE commentId=:commentId");
            $query=bindParam(":commentId" ,$commentId);
            $query->execute();

            $data=$query->fetch(PDO::FETCH_ASSOC);
            $numDisLikes=$data["count"];

            return $numLikes-$numDisLikes;


        }
        public function wasLikedBy() {
            $id=$this->getId();
            $username=$this->userLoggedInObj->getUsername();

            $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            return $query->rowCount() > 0;
        }

        public function wasDislikedBy() {
            $id=$this->getId();
            $username=$this->userLoggedInObj->getUsername();

            $query = $this->con->prepare("SELECT * FROM dislikes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            return $query->rowCount() > 0;
        }


}


?>