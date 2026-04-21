function postComment(button,postedBy,videoId,replyTo,containerClass){
    var textarea=$(button).siblings("textarea");
    var commentText= textarea.val();
    textarea.val("");

    if(commentText){
        $.post("ajax/postComment.php",{commentText:commentText,postedBy:postedBy ,videoId:videoId,responseTo:replyTo})
        .done(function(comment){
            alert(data);
        });

    }
    else{
        alert("you can't post an empty comment")
    }

}