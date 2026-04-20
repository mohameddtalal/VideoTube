<?php require_once("includes/header.php"); 
require_once("includes/classes/VideoPlayer.php");

if(!isset($_GET["id"])) {
    echo "No video ID passed into page.";
    exit();
}
$video = new Video($con, $_GET["id"], $userLoggedInObj);
echo $video->getTitle();
$video->incrementViews();


?>

    <div class="watchLeftColumn">
    <?php
        $videoPlayer = new VideoPlayer($video);
        echo $videoPlayer->create(true);
    ?>
    </div>
    <div class="
<?php require_once("includes/footer.php"); ?>
         