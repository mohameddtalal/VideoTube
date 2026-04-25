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
            $gridItems=$this->genrateItems();
        }else{
             $gridItems=$this->generateItemsFromVideos($videos);

        }
        $header="";
        if($title !=null){
            $header =$this->createGridHeader($title,$showFilter)
        }
        return "<div class='$this->gridClass'>
                $gridItems
        
        </div>";
  }

  public function genrateItems(){

  }
 
    public function generateItemsFromVideos($videos){
    
  }
}


?>