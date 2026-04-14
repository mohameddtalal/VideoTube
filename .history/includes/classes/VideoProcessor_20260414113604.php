<?php
class VideoProcessor {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function upload($videoUploadData) {
        $targetDir = "uploads/videos/";   //store videos here
        $videoDataArray = $videoUploadData->videoDataArray;
        $tempFilePath = $targetDir .uniqid().basename($videoDataArray['name']); //temporary file path unique id
        $tempFilePath=str_replace(" ","_",$tempFilePath); //remove spaces from file path
        //uploads/videos/5aa3e9343c9ffdog_playing.flv
        $isValidData=$this->processData($videoUploadData,$tempFilePath);
        echo $tempFilePath;
     
    }

    private function processData($videoUploadData,$filePath) {
        $videoDataArray = $videoUploadData->videoDataArray;
        $title = $videoUploadData->getTitle();
        $description = $videoUploadData->getDescription();
        $privacy = $videoUploadData->getPrivacy();
        $category = $videoUploadData->getCategory();
        $uploadedBy = $videoUploadData->getUploadedBy();

        if(!$this->isValidVideo($videoDataArray)) {
            echo "Invalid video file";
            return false;
        }

        if(!move_uploaded_file($videoDataArray['tmp_name'], $tempFilePath)) {
            echo "Error uploading file";
            return false;
        }

        //insert video details into database
        $query = $this->con->prepare("INSERT INTO videos(title, description, privacy, category, uploadedBy, filePath) VALUES(:title, :description, :privacy, :category, :uploadedBy, :filePath)");
        $query->bindParam(":title", $title);
        $query->bindParam(":description", $description);
        $query->bindParam(":privacy", $privacy);
        $query->bindParam(":category", $category);
        $query->bindParam(":uploadedBy", $uploadedBy);
        $query->bindParam(":filePath", $tempFilePath);

        return $query->execute();
    }
}

?>