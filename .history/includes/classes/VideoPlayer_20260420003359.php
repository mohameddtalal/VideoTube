<?php
class VideoPlayer {
    private $video;
    public function __construct($video) {
        $this->video = $video;
    }

    public function create() {
        $filePath = $this->video->getFilePath();
        return "<video controls autoplay>
                    <source src='$filePath' type='video/mp4'>
                </video>";
    }
}
?>