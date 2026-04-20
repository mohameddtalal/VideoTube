<?php
class ButtonProvider {
    public static function createButton($text, $imageSrc, $action, $class) {
        $image=($imageSrc)
        return "<button class='$class' onclick='$action'>
                    <span>$text</span>
                    <img src='$imageSrc'>
                </button>";
    }
}   


?>