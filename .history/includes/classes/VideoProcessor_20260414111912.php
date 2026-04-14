<?php
class VideoProcessor {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function upload($videoUploadData) {
        $targetDir = "uploads/videos/";   //store videos here
        $videoDataArray = $videoUploadData->videoDataArray;
        $tempFilePath = $target
        $originalFileName = $videoDataArray['name'];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . "." . $fileExtension;
        $targetFilePath = $targetDir . $uniqueFileName;

        if(move_uploaded_file($tempFilePath, $targetFilePath)) {
            return $targetFilePath;
        } else {
            return false;
        }
    }
}

?>