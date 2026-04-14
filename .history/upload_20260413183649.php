<?php require_once("includes/header.php"); 
?>
<div class="column">
    <h1>Upload Video</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="videoFile">Select video file:</label>
            <input type="file" class="form-control-file" id="videoFile" name="videoFile" required>
        </div>
        <div class="form-group
<?php require_once("includes/footer.php"); ?>
         