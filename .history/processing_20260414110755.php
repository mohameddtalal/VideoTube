<?php require_once("includes/header.php"); 
ew

if(!isset($_POST["uploadButton"])) {
    echo "No file sent to the page";
    exit();
}

// 1) create file upload data
$videoUploadData = new VideoUploadData(
    $_POST["fileInput"],
    $_POST["titleInput"],
    $_POST["descriptionInput"],
    $_POST["privacyInput"],
    $_POST["categoriesInput"],
    "Replace-This-With-Username"

);


// 2) process video data (upload)





//3) check if upload was successful




?>


<?php require_once("includes/footer.php"); ?>