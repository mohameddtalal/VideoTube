function likeVideo(button, videoId) {
   $.post("ajax/likeVideo.php", { videoId: videoId })
        .done(function(data) {
          var likeButton = $(button);
          var dislikeButton = likeButton.siblings(".dislikeButton");
          likeButton.addClass("active");
          dislikeButton.removeClass("active");
          
          var result = JSON.parse(data);

        });
       
}