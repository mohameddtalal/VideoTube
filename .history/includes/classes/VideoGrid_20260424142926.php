<?php
class VideoGrid{

private $con,$userLoggedInObj;
private $largeMode=false;
private $gridClass="videoGrid";

public function __construct($con,$userLoggedInObj){
    $this->con=$con;
    $this->userLoggedInObj=$userLoggedInObj;

    }

public function create($videos,$title,$showFilter){

        if($videos==null){
            $gridItems=$this->generateItems();
        }else{
             $gridItems=$this->generateItemsFromVideos($videos);

        }
        return "<div class='$this->gridClass'>

        
        </div>";
  }

  public function genrateItems

}


?>