<?php
class ButtonProvider {
    public static function createButton($text, $imageSrc, $action, $class) {
        $image=($imageSrc==null)
        return "<button class='$class' onclick='$action'>
                    <span>$text</span>
                    <img src='$imageSrc'>
                </button>";
    }
}   


?>