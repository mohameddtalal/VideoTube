function likeVideo(button, videoId) {
   $.post("ajax/likeVideo.php")
        .done(function(data) {
            console.log(data);
        })
}