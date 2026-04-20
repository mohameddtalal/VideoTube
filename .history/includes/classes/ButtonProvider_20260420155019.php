<?php
class ButtonProvider {

    public  static function createLink($text, $href) {
        return "<a href='$href'>$text</a>";
    }
    public static function createButton($text, $imageSrc, $action, $class) {
        $image=($imageSrc==null)? "": "<img src='$imageSrc'>";
        //change action if needed
        return "<button class='$class' onclick='$action'>
                    $image
                    <span class='text'>$text</span>
                   
                </button>";
    }
}   


?>