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
        $videoData = $videoUploadData->videoData;
        
        $tempFilePath = $targetDir .uniqid().basename($videoData['name']); //temporary file path unique id
        $tempFilePath=str_replace(" ","_",$tempFilePath); //remove spaces from file path
        //uploads/videos/5aa3e9343c9ffdog_playing.flv
        $isValidData=$this->processData($videoData,$tempFilePath);
        echo $tempFilePath;
     
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
    }

    private function isValidSize($data) {
        return $data["size"] <= $this->sizelimit; //check there size
    }
    private function isValidType($type) {
        $lowercased=strtolower($type); //convert type to lowercase 
        return in_array($lowercased,$this->allowedTypes); //check if type is in allowed types
    }

}

?>