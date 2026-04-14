<?php require_once("includes/header.php"); 
require_once("includes/classes/VedioDetailsFormProvider.php");

?>
<div class="column">
    <?php
    $formProvider = new VedioDetailsFormProvider($con);
    echo $formProvider->createUploadForm();





    ?>
</div>
<?php require_once("includes/footer.php"); ?>

<?php 
return "<form> ""
 </form>";  

?>
         