<?php
require_once("../includes/config.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy'])  && isset($_POST['videoId'])){
$postedBy = $_POST['postedBy'];
$videoId = $_POST['videoId'];
$responseTo = $_POST['responseTo'];
$commentText = $_POST['commentText'];

$query = $con->prepare("INSERT INTO comments (postedBy,videoId,responseTo,body)
VALUES(:postedBy,:videoId,:responseTo,:body)");
$query->bindParam(":postedBy", $postedBy);
$query->bindParam(":videoId", $videoId);
$query->bindParam(":responseTo", $responseTo);
$query->bindParam(":body", $commentText);
$query->execute();
  

$newComment= new Comment($con , $con->)



}
else{
    echo"one or more parameters are not passes into susbscribe.php the file";
}


?>