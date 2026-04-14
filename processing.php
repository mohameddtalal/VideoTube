<?php require_once("includes/header.php"); 
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

if(!isset($_POST["uploadButton"])) {
    echo "No file sent to the page";
    exit();
}

// 1) create file upload data
$videoUploadData = new VideoUploadData(
    $_FILES["fileInput"],
    $_POST["titleInput"],
    $_POST["descriptionInput"],
    $_POST["privacyInput"],
    $_POST["categoriesInput"],
    "Replace-This-With-Username"

);


// 2) process video data (upload)
$videoProcessor = new VideoProcessor($con);
$wasSuccessful = $videoProcessor->upload($videoUploadData);




//3) check if upload was successful




?>


<?php require_once("includes/footer.php"); ?>