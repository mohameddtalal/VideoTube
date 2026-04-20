<?php
require_once("../includes/config.php");

$username = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$videoId= $_POST["videoId"];
//connect to database


?>