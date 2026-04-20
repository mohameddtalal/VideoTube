<?php
require_once("../includes/config.php");

$username =  $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $username);
$videoId= $_POST["videoId"];
//connect to database


?>