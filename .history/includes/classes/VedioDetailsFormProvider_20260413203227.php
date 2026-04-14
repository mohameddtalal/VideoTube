<?php
class VedioDetailsFormProvider {
  
    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        return "<form  action='processing.php' method='POST' >
                    $fileInput
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </form>";
    }
    private function createFileInput() {
        return "<div class='form-group'>
                    <label for='exampleFormControlFile1'>You file</label>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileinput' required>
                </div>";
    }
    
}



?>