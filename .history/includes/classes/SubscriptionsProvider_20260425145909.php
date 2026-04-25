<?php
class SubscriptionsProvider{

    private $con,$userLoggedInObj;
    public function __construct($con,$userLoggedInObj){
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
    }

    public function getVideos(){
        $videos=array();
        $subscriptions=$this->userLoggedInObj->getSubscriptions();

        if(sizeof($subscriptions)>0){
            //user1,user2,user3

            $query=bindParam(1,)
            $condition="";
            $i=0;

            while($i<sizeof($subscriptions)){

            }

        }
        return $videos;
    }
}


?>