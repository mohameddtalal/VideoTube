function likeVideo(button, videoId) {
   $.post("ajax/likeVideo.php")
        .done(function(data) {
            alert("Video liked successfully!");
        })
       
}