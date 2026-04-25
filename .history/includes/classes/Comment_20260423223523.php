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
        }

        public function create(){
            $id=$this->sqlData["id"];
            $videoId=$this->getVideoId();
            $body=$this->sqlData["body"];
            $postedBy=$this->sqlData["postedBy"];
            $profileButton=ButtonProvider::createUserProfileButton($this->con,$postedBy);
            $timespan=$this->time_elapsed_string($this->sqlData["datePosted"]);
            $commentControlsObj=new CommentControls($this->con,$this,$this->userLoggedInObj);
            $commentControls=$commentControlsObj->create();

            $numResponses= $this->getNumberOfReplies();
      

            if($numResponses> 0){
                 $viewRepliesText = "<span class='repliesSection viewReplies' onclick='getReplies($id, $videoId)'>
                            view all $numResponses replies
                        </span>";
            }
            else{
                $viewRepliesText="<div class='repliesSection'></div>";
            }

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
                       $commentControls
                       $viewRepliesText
                    </div>"; 

        }



        function time_elapsed_string($datetime, $full = false) {
                $now = new DateTime;
                $ago = new DateTime($datetime);
                $diff = $now->diff($ago);

                // ✅ Use a plain array instead of setting undefined property on DateInterval
                $weeks = floor($diff->d / 7);
                $days  = $diff->d - ($weeks * 7);

                $string = array(
                    'y' => array($diff->y, 'year'),
                    'm' => array($diff->m, 'month'),
                    'w' => array($weeks,   'week'),
                    'd' => array($days,    'day'),
                    'h' => array($diff->h, 'hour'),
                    'i' => array($diff->i, 'minute'),
                    's' => array($diff->s, 'second'),
                );

                foreach ($string as $k => &$v) {
                    if ($v[0]) {
                        $v = $v[0] . ' ' . $v[1] . ($v[0] > 1 ? 's' : '');
                    } else {
                        unset($string[$k]);
                    }
                }

                if (!$full) $string = array_slice($string, 0, 1);
                return $string ? implode(', ', $string) . ' ago' : 'just now';
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
            $query->bindParam(":commentId" ,$commentId);
            $query->execute();

            $data=$query->fetch(PDO::FETCH_ASSOC);
            $numLikes=$data["count"];

            $query=$this->con->prepare("SELECT count(*) as 'count' FROM dislikes WHERE commentId=:commentId");
            $query->bindParam(":commentId" ,$commentId);
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

        public function getNumberOfReplies(){
            $query=$this->con->prepare("SELECT count(*) as 'count' FROM comments WHERE responseTo=:responseTo");
            $id=$this->sqlData["id"];
            $query->bindParam(":responseTo",$id);
            $query->execute();

            return $query->fetchColumn();  //get first column
        }


        public function like() {
        $id=$this->getId();
        $username=$this->userLoggedInObj->getUsername();

        //check if it has liked before if it has then remove the like otherwise add the like
        if($this->wasLikedBy()) {
            $query=$this->con->prepare("DELETE FROM likes WHERE username=:username AND commentId=:commentId");
            
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();
            return -1;
        }

        else {

            $query=$this->con->prepare("DELETE FROM dislikes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();
            $count=$query->rowCount();



            $query=$this->con->prepare("INSERT INTO likes(username, commentId) VALUES(:username, :commentId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

           return 1+$count;
        }

        }
        public function dislike() {
        $id=$this->getId();
        $username=$this->userLoggedInObj->getUsername();

        //check if it has disliked before if it has then remove the dislike otherwise add the dislike
        if($this->wasDislikedBy()) {
            $query=$this->con->prepare("DELETE FROM dislikes WHERE username=:username AND commentId=:commentId");
            
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();
           return 1;
        }

        else {

            $query=$this->con->prepare("DELETE FROM likes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();
            $count=$query->rowCount();



            $query=$this->con->prepare("INSERT INTO dislikes(username, commentId) VALUES(:username, :commentId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            
            return -1-$count;
        }

        }
        public function getReplies(){
             $query = $this->con->prepare("SELECT * FROM comments WHERE responseTo=:commentId ORDER BY  datePosted ASC");
                $id = $this->getId();
                $query->bindParam(":commentId" , $id);
                $query->execute();

                $comments="";
                $videoId=

                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $comment=new Comment($this->con,$row,$this->userLoggedInObj,$videoId);
                    array_push($comments,$comment);
                }
                return $comments;

                    }

}


?>