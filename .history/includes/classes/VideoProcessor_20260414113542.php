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

    private funct
}

?>