<?php require_once("includes/header.php"); ?>
<?php 
if(isset($_SESSION["userLoggedIn"])) {
    echo "Welcome, " . $userLoggedInObj->getName();
}
else{
    header("Location: signIn.php");
}
?>
<?php require_once("includes/footer.php"); ?>
         