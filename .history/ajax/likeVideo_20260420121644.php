<?php
require_once("../includes/config.php");
require_once("../includes/classes/Video.php");
require_once("../includes/classes/User.php");

$username =  $_SESSION["userLoggedIn"];
$videoId= $_POST["videoId"];

$userLo
//connect to database
$video= new Video($con, $videoId,);



?>