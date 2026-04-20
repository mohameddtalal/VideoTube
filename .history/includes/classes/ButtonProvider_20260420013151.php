<?php
class ButtonProvider {
    public static function createButton($text, $imageSrc, $action) {
        return "<button class='button' onclick='$action'>
                    <img src='$imageSrc'>
                    <span>$text</span>
                </button>";
    }
}   


?>