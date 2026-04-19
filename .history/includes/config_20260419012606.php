<?php 
ob_start();    //turns on output buffering
s
date_default_timezone_set("Africa/Cairo");
try{
    $con = new PDO("mysql:dbname=vediotube;host=localhost","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


?>