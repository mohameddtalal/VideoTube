<?php
class VedioDetailsFormProvider {
  
    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        return "<form  action='processing.php' method='POST' >
                    $fileInput
                    $titleInput
                    $descriptionInput
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </form>";
    }
    private function createFileInput() {
        return "<div class='mb-2'>
                    <label for='exampleFormControlFile1'>You file</label>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
                </div>";
    }

    private function createTitleInput() {
        return "<div class='mb-2'>
        <input class='form-control' type='text' placeholder='Title' name='titleInput' required>
        </div>";
    }
    private function createDescriptionInput() {
        return "<div class='form-group'>
        <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3' required></textarea>
        </div>";
    }
    private function createPrivacyInput() {
        return "<div class='form-group'>
        <select class='form-control' id='exampleFormControlSelect1' name='privacyInput'>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </div>";
    }
    
}



?>