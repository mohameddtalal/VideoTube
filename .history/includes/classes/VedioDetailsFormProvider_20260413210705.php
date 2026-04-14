<?php
class VedioDetailsFormProvider {
  
    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        return "<form  action='processing.php' method='POST' >
                    $fileInput
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </form>";
    }
    private function createFileInput() {
        return "<div class='mb-2'>
                    <label for='exampleFormControlFile1'>Your file</label>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
                </div>";
    }

    private function createTitleInput() {
        return "<div class='mb-2'>
        <input class='form-control' type='text' placeholder='Title' name='titleInput' required>
        </div>";
    }
    private function createDescriptionInput() {
        return "<div class='mb-2'>
        <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3' required></textarea>
        </div>";
    }
    private function createPrivacyInput() {
        return "<div class='mb-2'>
        <select class='form-control'  name='privacyInput'>
            <option value='0'>Private</option>
            <option value='1'>Public</option>
            </select>
        </div>";
    }
    
}



?>