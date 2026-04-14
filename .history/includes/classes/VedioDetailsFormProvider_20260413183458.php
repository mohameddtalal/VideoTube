<?php
class VedioDetailsFormProvider {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function createUploadForm() {
        return "<div class='column'>
                    <h1>Upload Video</h1>
                    <form action='upload.php' method='POST' enctype='multipart/form-data'>
                        <div class='form-group'>
                            <label for='videoFile'>Select video file:</label>
                            <input type='file' class='form-control-file' id='videoFile' name='videoFile' required>
                        </div>
                        <div class='form-group
                            <label for='title'>Title:</label>
                            <input type='text' class='form-control' id='title' name='title' required>
                        </div>
                        <div class='form-group
                            <label for='description'>Description:</label>
                            <textarea class='form-control' id='description' name='description' rows='3' required></textarea>
                        </div>
                        <div class='form-group
                        


?>