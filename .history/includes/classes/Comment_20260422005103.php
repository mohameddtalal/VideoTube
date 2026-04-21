<?php
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
            $body=$this->sqlData["body"];
            $postedBy=$this->sqlData["postedBy"];
            $profileButton=ButtonProvider::createUserProfileButton($this->con,$postedBy);

            return "<div class='itemContainer'>
                      <div class='comment'>
                        $profileButton
                        <div class='mainContainer'>
                            <div class='commentHeader'>
                                <a href='profile.php
                            </div>

                        </div>
                    
                       </div>
                    </div>"; 

        }


}


?>