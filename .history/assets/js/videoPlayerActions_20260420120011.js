function likeVideo(button, videoId) {
   $.post("ajax/likeVideo.php")
        .done(function(data) {
            console.log(data);
        })
        .fail(function() {
            console.log("Failed to like video.");
        });
}