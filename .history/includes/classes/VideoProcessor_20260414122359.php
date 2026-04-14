<?php
class VideoProcessor {
    private $con;
    private $sizelimit = 500000000; //4.5 giga
    private $allowedTypes = array("mp4","flv","webm","mkv","avi","mpeg","mp3","wav","ogg","flac","aac","opus");

    public function __construct($con) {
        $this->con = $con;
    }

    public function upload($videoUploadData) {
        $targetDir = "uploads/videos/";   //store videos here
        $videoData = $videoUploadData->videoDataArray; //get video data array from video upload data object

        $tempFilePath = $targetDir .uniqid().basename($videoData['name']); //temporary file path unique id
        $tempFilePath=str_replace(" ","_",$tempFilePath); //remove spaces from file path
        //uploads/videos/5aa3e9343c9ffdog_playing.flv
        $isValidData=$this->processData($videoData,$tempFilePath);
        if(!$isValidData) {
            return false;
        }
        if(move_uploaded_file($videoData["tmp_name"],$tempFilePath)) { //move file to target directory
          $finalFilePath = $targetDir . uniqid() . ".mp4"; //final file path unique id
          if(!$this->insertVideoData($videoUploadData,$finalFilePath)) { //insert video data into database
            echo "Error inserting video data into database.";
            return false;
          
          }
        }
        else {
            echo "Error moving the uploaded file.";
            return false;
        } 
     
    }

    private function processData($videoData,$filePath) {
       $videoType= pathinfo($filePath,PATHINFO_EXTENSION); 

       if(!$this->isValidSize($videoData)){
        echo "File size is too large. Can't be more than " . $this->sizelimit . " bytes";
         return false;
       }
       else if(!$this->isValidType($videoType)){
        echo "Invalid file type. Allowed types are: " . implode(", ", $this->allowedTypes);
         return false;
       }
         else if($this->hasError($videoData)){
          echo "There was an error uploading the file. Error code: " . $videoData["error"];
            return false;
         }
          return true;
       
       
    }

    private function isValidSize($data) {
        return $data["size"] <= $this->sizelimit; //check there size
    }
    private function isValidType($type) {
        $lowercased=strtolower($type); //convert type to lowercase 
        return in_array($lowercased,$this->allowedTypes); //check if type is in allowed types
    }
    private function hasError($data) {
        return $data["error"] != 0; //check if there is an error
    }

}

?>