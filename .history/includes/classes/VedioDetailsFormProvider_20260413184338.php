<?php
class VedioDetailsFormProvider {
  
    public function createUploadForm() {
        return "<form  action='processing.php' method='POST' >
                    <div class='form-group";
    }
    private function createFileInput() {
        return "<div class="form-group">
                    <label for="exampleFormControlFile1">Example file input</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>";
                                    
    
}



?>