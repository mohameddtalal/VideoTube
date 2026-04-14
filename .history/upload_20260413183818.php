<?php require_once("includes/header.php"); 
require_once("includes/classes/VedioDetailsFormProvider.php");

?>
<div class="column">
 $formProvider = new VedioDetailsFormProvider($con);
    echo $formProvider->createUploadForm();
<?php require_once("includes/footer.php"); ?>
         