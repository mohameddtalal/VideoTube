<?php
require_once("../includes/config.php");
require_once("../includes/classes/Comment.php");
require_once("../includes/classes/User.php");

$username = $_SESSION["userLoggedIn"];
$videoId= $_POST["videoId"];

$userLoggedInObj = new User($con, $username);
//connect to database
$video= new Video($con, $videoId, $userLoggedInObj);

echo $video->like();



?>