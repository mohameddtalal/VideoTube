<?php
class Video{

private $con, $sqlData ,$userLoggedInObj;
public function __construct($con,$input,$userLoggedInObj) {
    $this->con=$con;
    $this->userLoggedInObj=$userLoggedInObj;
    if(is_array($input)) {
        $this->sqlData = $input;
    }
    else {
        $query=$this->con->prepare("SELECT * FROM videos WHERE id=:id");
        $query->bindParam(":id",$input);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

}

public function getId() {
    return $this->sqlData["id"];
}

public function getUploadedBy() {
    return $this->sqlData["uploadedBy"];
}

public function getTitle() {
    return $this->sqlData["title"];
}

public function getDescription() {
    return $this->sqlData["description"];
}

public function getPrivacy() {
    return $this->sqlData["privacy"];
}
public function getFilePath() {
    return $this->sqlData["filePath"];
}

public function getCategory() {
    return $this->sqlData["category"];
}
public function getUploadDate() {
    return $this->sqlData["uploadDate"];
}

public function getViews() {
    return $this->sqlData["views"];
}
public function getDuration() {
    return $this->sqlData["duration"];
}

public function incrementViews() {
    $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
    $videoId = $this->getId();
    $query->bindParam(":id", $videoId);
    $query->execute();

    $this->sqlData["views"] = $this->sqlData["views"] + 1;


}

public function getLikes() {
  $query = $this->con->prepare("SELECT COUNT(*) as 'count' FROM likes WHERE videoId=:videoId ");
    $videoId = $this->getId();
    $query->bindParam(":videoId", $videoId);
    $query->execute();
     $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data["count"];
}

public function getDislikes() {
  $query = $this->con->prepare("SELECT COUNT(*) as 'count' FROM likes WHERE videoId=:videoId ");
    $videoId = $this->getId();
    $query->bindParam(":videoId", $videoId);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data["count"];
}

public function like() {
  $id=$this->getId();
  $query=$this->con->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
  $username=$this->userLoggedInObj->getUsername();
  $query->bindParam(":username", $username);
  $query->bindParam(":videoId", $id);
  $query->execute();
  //check if it has liked before if it has then remove the like otherwise add the like
  if($query->rowCount() > 0) {
    $query=$this->con->prepare("DELETE FROM likes WHERE username=:username AND videoId=:videoId");
    $query->bindParam(":username", $username);
    $query->bindParam(":videoId", $id);
    $query->execute();
    $r
  }
  else {

    $query=$this->con->prepare("DELETE FROM dislikes WHERE username=:username AND videoId=:videoId");
    $query->bindParam(":username", $username);
    $query->bindParam(":videoId", $id);
    $query->execute();


    $query=$this->con->prepare("INSERT INTO likes(username, videoId) VALUES(:username, :videoId)");
    $query->bindParam(":username", $username);
    $query->bindParam(":videoId", $id);
    $query->execute();
  }

}

public function wasLikedBy() {
    $id=$this->getId();
    $username=$this->userLoggedInObj->getUsername();

    $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
    $query->bindParam(":username", $username);
    $query->bindParam(":videoId", $id);
    $query->execute();

    return $query->rowCount() > 0;
}

public function wasDislikedBy() {
    $id=$this->getId();
    $username=$this->userLoggedInObj->getUsername();

    $query = $this->con->prepare("SELECT * FROM dislikes WHERE username=:username AND videoId=:videoId");
    $query->bindParam(":username", $username);
    $query->bindParam(":videoId", $id);
    $query->execute();

    return $query->rowCount() > 0;
}

}
?>