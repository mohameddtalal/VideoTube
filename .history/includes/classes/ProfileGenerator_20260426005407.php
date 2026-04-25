<?php
require_once("ProfileData.php");

class ProfileGenerator{

private $con,$userLoggedInObj,$profileData;

public function __construct($con,$userLoggedInObj,$profileUsername)
{
$this->con=$con;
$this->userLoggedInObj=$userLoggedInObj;
$this->profileData=new ProfileData($con,$profileUsername);
}


public function create(){
$profileUsername=$this->profileData->getProfileUsername();
if(!$this->profileData->userExists()){
    return "User doesn't exist";
}

$coverPhotoSection = $this->createCoverPhotoSection();
$headerSection = $this->createHeaderSection();
$tabsSection = $this->createTabsSection();
$contentSection = $this->createContentSection();

return "<div class='profileContainer'>
        $coverPhotoSection
        $headerSection
        $tabsSection 
        $contentSection 
        </div>";

   }

   public function createCoverPhotoSection(){
    $coverPhotoSrc=$this->profileData->getCoverPhoto();
    $name=$this->profileData->getProfileUserFullName();

    return "<div class='coverPhotoContainer'>
            <img src='$coverPhotoSrc' class='coverPhoto'>
            <span class='channelName'>$name</span>
            </div>";

   }
   public function createHeaderSection(){
        $profileImage=$this->profileData->getProfilePic();
        $name=$this->profileData->getProfileUserFullName();
        $subCount=$this->profileData->getSubscriberCount();

        $button=$this->createHeaderButton();

        return "<div class='profileHeader'>
                    <div class='userInfoContainer'>
                    <img class='profileImage' src='$profileImage'>
                            <div class='userInfo'>
                            <span class='title'>$name</span>
                            <span class='subscriberCount'>$subCount subscribers</span>
                            </div>
                    </div>
                    <div class='buttonContainer'>
                      <div class='buttonItem'>
                            $button
                            </div>
                    </div>
                </div>";

   }  
   public function createTabsSection(){
    return "<ul class='nav nav-tabs'  role='tablist'>
  <li class='nav-item' >
    <button class='nav-link active' id='videos-tab' data-bs-toggle='tab' data-bs-target='#videos' type='button' role='tab' aria-controls='videos' aria-selected='true' href='#videos'>VIDEOS</button>
  </li>
  <li class='nav-item' >
    <button class='nav-link' id='about-tab' data-bs-toggle='tab' data-bs-target='#about' type='button' role='tab' aria-controls='about' aria-selected='false' href='#about'>ABOUT</button>
  </li>
</ul>";

   }  

   public function createContentSection(){
    $videos=$this->profileData->getUsersVideos();

    if(sizeof($videos)>0){
        $videoGrid= new VideoGrid($this->con ,$this->userLoggedInObj);
        $videoGridHtml =$videoGrid->create($videos,null,false);
    }
    else{
        $videoGridHtml="<span>This user has no videos</span>";
    }

    return "<div class='tab-content channelContent' >
                    <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab' tabindex='0'>
                        videoGridHtml
                    </div>
                    <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab' tabindex='0'>
                        About tab
                    </div>
                   
            </div>";

   }
   private function createHeaderButton(){
    if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()){
        return "";
    }
    else{
        return ButtonProvider::createSubscriberButton($this->con,$this->profileData->getprofileUserObj(),$this->userLoggedInObj);
    }
   }

}



?>

