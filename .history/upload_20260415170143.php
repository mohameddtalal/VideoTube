<?php require_once("includes/header.php"); 
require_once("includes/classes/VideoDetailsFormProvider.php");
?>

<div class="column">
    <?php
    $formProvider = new VideoDetailsFormProvider($con);
    echo $formProvider->createUploadForm();
    ?>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
       please wait. Your video is being processed. This may take a few minutes.
       <img src="assets/images/icons/loading-spinner.gif" class="loader">

      </div>
    </div>
  </div>
</div>


<?php require_once("includes/footer.php"); ?>

    