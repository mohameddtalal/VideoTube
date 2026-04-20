<?php
class ButtonProvider {
    public static function createButton($text, $imageSrc, $action, $class) {
        return "<button class='$class' onclick='$action'>
            
                    <img src='$imageSrc'>
                </button>";
    }
}   


?>