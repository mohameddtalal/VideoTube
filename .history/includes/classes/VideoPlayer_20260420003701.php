<?php
class VideoPlayer {
    private $video;
    public function __construct($video) {
        $this->video = $video;
    }

    public function create($autoplay) {
        if($autoplay) {
            $autoplay = "autoplay";
        }
        else {
            $autoplay = "";
        }
        $filePath = $this->video->getFilePath();
        return "<video controls $autoplay>
                    <source src='$filePath' type='video/mp4'>
                </video>";
                
    }
}
?>