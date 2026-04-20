function likeVideo(button, videoId) {
   $.post("ajax/likeVideo.php", { videoId: videoId })
        .done(function(data) {
          var likeButton = $(button);
          var dislikeButton = likeButton.siblings(".dislikeButton");
          likeButton.addClass("active");
          dislikeButton.removeClass("active");
          
          var result = JSON.parse(data);
            updateLikesValue(likeButton.find(".text"), result.likes);
            updateLikesValue(dislikeButton.find(".text"), -result.dislikes);
            if(result.likes < 0) {
                likeButton.removeClass("active");
                likeButton.find("img:first").attr("src", "assets/images/thumb-up.png");
            }
            else{
                likeButton.find("img:first").attr("src", "assets/images/thumb-up-active.png");
            }
        });
       
}


function updateLikesValue(element,num) {
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));

}

function dislikeVideo(button, videoId) {
    $.post("ajax/dislikeVideo.php", { videoId: videoId })

        .done(function(data) {
          var dislikeButton = $(button);
          var likeButton = dislikeButton.siblings(".likeButton");
          dislikeButton.addClass("active");
          likeButton.removeClass("active"); 
            var result = JSON.parse(data);
            console.log(result);
            updateLikesValue(dislikeButton.find(".text"), result.dislikes);
            updateLikesValue(likeButton.find(".text"), -result.likes);
        }
        );
}



