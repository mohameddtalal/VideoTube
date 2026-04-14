<?php
class VideoProcessor {
    private $con;
    private $sizelimit = 500000000; //4.5 giga

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

    private function processData($videoData,$filePath) {
       $videoType= pathinfo($filePath,PATHINFO_EXTENSION); 

       if(!$this->isValidSize($videoData)){
        echo "File size is too large. Can't be more than " . $this->sizelimit . " bytes";
         return false;
        return false;
       }
       else if(!$this->isValidType($videoType)){
        echo "Invalid file type. Only mp4,flv,webm,mkv are allowed";
        return false;
       }
       else if(move_uploaded_file($videoData->videoDataArray["tmp_name"],$filePath)){
        echo "File uploaded successfully";
        return true;
       }
       else{
        echo "Error uploading file";
        return false;
       }
    }

    private function isValidSize($data) {
        return $data["size"] <= $this->sizelimit; //check there size
    }
    private function isValidType($type) {
        
        $allowedTypes = ["mp4","flv","webm","mkv"];
        return in_array($type,$allowedTypes); //check if type is in allowed types
}

?>