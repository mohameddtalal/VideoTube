<?php
require_once("../includes/config.php");

if(isset($_POST['userTo']) && isset($_POST['userFrom'])){

    $userTo=$_POST['userTo'];
    $userFrom=$_POST['userFrom'];

    $query=$con->prepare("SELECT * FROM subscribers ")



}
else{
    echo"one or more parameters are not passes into susbscribe.php the file";
}


?>