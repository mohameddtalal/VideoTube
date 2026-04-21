<?php
require_once("../includes/config.php");
require_once("../includes/classes/User.php");
require_once("../includes/classes/Comment.php");



if(isset($_POST['commentText']) && isset($_POST['postedBy'])  && isset($_POST['videoId'])){
$postedBy = $_POST['postedBy'];
$videoId = $_POST['videoId'];
$responseTo = isset($_POST['responseTo']) ? $_POST['responseTo'] : 0;
$commentText = $_POST['commentText'];

$query = $con->prepare("INSERT INTO comments (postedBy,videoId,responseTo,body)
VALUES(:postedBy,:videoId,:responseTo,:body)");
$query->bindParam(":postedBy", $postedBy);
$query->bindParam(":videoId", $videoId);
$query->bindParam(":responseTo", $responseTo);
$query->bindParam(":body", $commentText);
$query->execute();
  
$userLoggedInObj= new User ($con,$_SESSION["userLoggedIn"]);
$newComment= new Comment($con , $con->lastInsertId(),$userLoggedInObj,$videoId);
if($query->execute()){
    echo "insert success, id = " . $con->lastInsertId();
} else {
    print_r($query->errorInfo());
}
echo $newComment->create();



}
else{
    echo"one or more parameters are not passes into susbscribe.php the file";
}


?>