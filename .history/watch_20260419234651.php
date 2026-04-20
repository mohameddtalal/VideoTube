<?php require_once("includes/header.php"); 
if(!isset($_GET["id"])) {

}


?>

<div class="watchContainer">
    <div class="videoControls watchNav">
        <div class="leftControls">
            <button class="controlButton toggleMenu">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>

        <div class="rightControls">
            <button class="controlButton">
                <span class="material-symbols-outlined">videocam</span>
            </button>
            <button class="controlButton">
                <span class="material-symbols-outlined">search</span>
            </button>
            <button class="controlButton">
                <span class="material-symbols-outlined">account_circle</span>
            </button>
        </div>
    </div>

    <div class="videoPlayerContainer">
        <video controls autoplay>
            <source src='assets/videos/1.mp4' type='video/mp4'>
        </video>
    </div>

    <div class="videoInfoContainer">
        <h1>Video Title</h1>

        <div class="videoInfoButtons">
            <button><span class="material-symbols-outlined">thumb_up</span>123</button>
            <button><span class="material-symbols-outlined">thumb_down</span>4</button>
        </div>
    </div>

    <div class="commentsSection">
        Comments
    </div>
<?php require_once("includes/footer.php"); ?>
         