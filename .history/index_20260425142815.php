<?php require_once("includes/header.php"); ?>
<div class="videoSection">
 <?php
            $videoGrid= new VideoGrid($con , >userLoggedIn->getUsername());
            echo $videoGrid->create(null,null,false);

?>
</div>
<?php require_once("includes/footer.php"); ?>
         