<?php require_once("includes/header.php"); 
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoInfoSection.php");
require_once("includes/classes/CommentSection.php");


if(!isset($_GET["id"])) {
    echo "No video ID passed into page.";
    exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
echo $video->getTitle();
$video->incrementViews();


?>
<script src="assets/js/videoPlayerActions.js"></script>
<script src="assets/js/videoPlayerActions.js"></script>

    <div class="watchLeftColumn">
    <?php
        $videoPlayer = new VideoPlayer($video);
        echo $videoPlayer->create(true);

        $videoInfoSection = new VideoInfoSection($con, $video, $userLoggedInObj);
        echo $videoInfoSection->create();

        $commentSection = new CommentSection($con, $video, $userLoggedInObj);
        echo $commentSection->create();



    ?>
   



</div>
<div class="suggestions">
<p>Suggestions will go here</p>
</div>

<?php require_once("includes/footer.php"); ?>
         