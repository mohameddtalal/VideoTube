<?php
class VideoProcessor {
    private $con;
    private $sizelimit = 500000000; //4.5 giga
    private $allowedTypes = array("mp4","flv","webm","mkv","avi","mpeg","mp3","wav","ogg","flac","aac","opus");
    private $ffmpegPath = "C:/xampp/htdocs/VideoTube/ffmpeg/windows/ffmpeg.exe"; //path to ffmpeg
    public function __construct($con) {
        $this->con = $con;
        $this->ffmpegPath = realpath($this->ffmpegPath); //get real path to ffmpeg    
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
            if(!$this->convertVideoToMp4($tempFilePath,$finalFilePath)) { //convert video to mp4
                echo "Error converting video to mp4.";
                return false;
             }
            
            if(!$this->deleteFile($tempFilePath)) { //delete temporary file
                echo "Error deleting temporary file.";
                return false;
            }
            return true;
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
    private function insertVideoData($uploadData,$filePath){
        $query = $this->con->prepare("INSERT INTO videos(title,uploadedBy,description,privacy,category,filePath) VALUES(:title,:uploadedBy,:description,:privacy,:category,:filePath)");
        $title = $uploadData->getTitle();
        $uploadedBy = $uploadData->getUploadedBy();
        $description = $uploadData->getDescription();
        $privacy = $uploadData->getPrivacy();
        $category = $uploadData->getCategory();

        $query->bindParam(":title", $title);
        $query->bindParam(":uploadedBy", $uploadedBy);
        $query->bindParam(":description", $description);
        $query->bindParam(":privacy", $privacy);
        $query->bindParam(":category", $category);
        $query->bindParam(":filePath", $filePath);
        return $query->execute();
    }

    public function convertVideoToMp4($tempFilePath,$finalFilePath) {
        $cmd = "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1"; //path to ffmpeg
        $outputLog = array();
        exec($cmd, $outputLog, $returnCode); //execute command
        if($returnCode != 0) { //check if there was an error
          foreach($outputLog as $line) {
            echo $line . "<br>"; //print error log
          }
            return false;
        }
        return true;
    }

    private function deleteFile($filePath) {
        if(!unlink($filePath)) { //delete file
            echo "Error deleting file " . "<br>";
                return false;
        }
        return true;
    }

    public function generateTumbnails($filePath) {
        $thumbnailSize-"210x118";
        $numTuhmbnails=3;
        $pathTo = "uploads/thumbnails/"; //store thumbnails here
        $thumbnailPath = $thumbnailsDir . uniqid() . ".jpg"; //thumbnail file path unique id
        $cmd = "$this->ffmpegPath -i $filePath -ss 00:00:01.000 -vframes 1 $thumbnailPath 2>&1"; //path to ffmpeg
        $outputLog = array();
        exec($cmd, $outputLog, $returnCode); //execute command
        if($returnCode != 0) { //check if there was an error
          foreach($outputLog as $line) {
            echo $line . "<br>"; //print error log
          }
            return false;
        }
        return $thumbnailPath; //return thumbnail path

}

?>