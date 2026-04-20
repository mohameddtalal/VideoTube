<?php
class VideoPlayer {
    private $video;
    public function __construct($video) {
        $this->video = $video;
    }

    public function create($autoplay) {
        $filePath = $this->video->getFilePath();
        $autoplay = ($autoplay) ? "autoplay" : "";
        return "<video controls $autoplay>
                    <source src='$filePath' type='video/mp4'>
                </video>";
    }
}
?>