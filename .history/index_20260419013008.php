<?php require_once("includes/header.php"); ?>
<?php 
if(isset($_SESSION["userLoggedIn"])) {
    echo "Welcome, " . $_SESSION["userLoggedIn"];
}
else{
    
}
?>
<?php require_once("includes/footer.php"); ?>
         