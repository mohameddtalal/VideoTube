function likeVideo(button, videoId) {
   $.post("ajax/likeVideo.php", { videoId: videoId })
        .done(function(data) {
          var likeButton = $(button);
          var dislikeButton = likeButton.siblings(".dislikeButton");
          likeButton.addClass("active");
          dislikeButton.removeClass("active");
          
          var result = JSON.parse(data);
          likeButton.find(".text").text(result.likes);
          dislikeButton.find(".text").text(result.dislikes);

        });
       
}


function updateLikesValue(element,num) {
    var likesCountVal = element.text