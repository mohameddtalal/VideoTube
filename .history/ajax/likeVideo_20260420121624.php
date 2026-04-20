<?php
require_once("../includes/config.php");
require_once("../includes/classes/Video.php");
req

$username =  $_SESSION["userLoggedIn"];
$videoId= $_POST["videoId"];


//connect to database
$video= new Video($con, $videoId,);



?>