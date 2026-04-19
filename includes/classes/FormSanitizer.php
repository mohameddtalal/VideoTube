<?php
class FormSanitizer {

    public static function santizeFormString($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        $inputText = ucfirst(strtolower($inputText));
        return $inputText;
    }

    public static function santizeFormUsername($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }

    public static function santizeFormPassword($inputText) {
        $inputText = strip_tags($inputText);
        return $inputText;
    }

    public static function santizeFormEmail($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }
}
?>
