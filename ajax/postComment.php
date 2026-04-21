<?php
require_once("../includes/config.php");
require_once("../includes/classes/User.php");
require_once("../includes/classes/Comment.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])){
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
    
    if($query->execute()){
        $lastId = $con->lastInsertId();
        $userLoggedInObj = new User($con, $_SESSION["userLoggedIn"]);
        $newComment = new Comment($con, $lastId, $userLoggedInObj, $videoId);
        echo $newComment->create();
    } else {
        echo "failed to insert";
    }
}
else{
    echo "one or more parameters are not passed into postComment.php";
}
?>