<?php
require_once("includes/header.php");
require_once("includes/classes/.php");
if(isset($_GET["username"])){
    $profileUsername = $_GET["username"];
}
else{
    echo "Channel not found";
    exit();
}


?>