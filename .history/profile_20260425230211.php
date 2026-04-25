<?php
require_once("includes/header.php");
if(isset($_GET["username"])){
    $profileUsername = $_GET["username"];
}
else{
    echo "Channel not found";
    exit
}


?>