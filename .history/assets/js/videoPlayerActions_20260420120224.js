function likeVideo(button, videoId) {
   $.post("ajax/likeVideo.php")
        .done(function() {
            alert("Video liked successfully!");
        })
       
}