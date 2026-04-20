<?php
class ButtonProvider {
    public static function createButton($text, $imageSrc, $action, $class) {
        $image=($imageSrc==null)? "": "<img src='$imageSrc'>";
        return "<button class='$class' onclick='$action'>
                    <span>$text</span>
                    $image
                </button>";
    }
}   


?>