<?php
class ButtonProvider {

    public  static function createLink($link) {
        return User::isLoggedIn() ? $link : "javascript:void(0)";
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