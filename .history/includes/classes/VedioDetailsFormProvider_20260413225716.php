<?php
class VedioDetailsFormProvider {
  
    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        $categoriesInput = $this->createCategoriesInput();
        return "<form  action='processing.php' method='POST' >
                    $fileInput
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    $categoriesInput
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </form>";
    }
    private function createFileInput() {
        return "<div class='mb-3'>
                    <label for='exampleFormControlFile1'>Your file</label>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
                </div>";
    }

    private function createTitleInput() {
        return "<div class='mb-3'>
        <input class='form-control' type='text' placeholder='Title' name='titleInput' required>
        </div>";
    }
    private function createDescriptionInput() {
        return "<div class='mb-3'>
        <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3' required></textarea>
        </div>";
    }

    private function createPrivacyInput() {
        return "<div class='mb-3'>
        <select class='form-control'  name='privacyInput'>
            <option value='0'>Private</option>
            <option value='1'>Public</option>
            </select>
        </div>";
    }
    private function createCategoriesInput($con) {
        
    $query = $con->prepare("SELECT * FROM categories");
    $query->execute();
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo $row["name"] . "<br>";
    }
    }


    
}



?>