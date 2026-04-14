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
                    <label for='exampleFormControlFile1'>Example file input</label>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1'>
                </div>";
                            
    
}



?>