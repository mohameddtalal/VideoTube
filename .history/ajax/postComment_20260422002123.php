<?php
require_once("../includes/config.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy'])  && isset($_POST['videoId'])){


$query=$con->prepare("INSERT INTO comments(postedBy,videoId,responseTo,body)
VALUES(:postedBy,:videoId,:responseTo,:body)");
  $query->bindParam(":postedBy" ,$postedBy);
  $query->bindParam(":videoId" ,$videoId);
  $query->bindParam(":responseTo" ,$responseTo);
  $query->bindParam(":body" ,$commentText);
  $postedBy=$_post['postedBy'];

}
else{
    echo"one or more parameters are not passes into susbscribe.php the file";
}


?>