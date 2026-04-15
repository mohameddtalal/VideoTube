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
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>


<?php require_once("includes/footer.php"); ?>

    