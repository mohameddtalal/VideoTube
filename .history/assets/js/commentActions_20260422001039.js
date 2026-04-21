function postComment(button,postedBy,videoId,replyTo,containerClass){
    var textarea=$(button).siblings("textarea");
    var commentText= textarea.val();
    textarea.val("");

    if(commentText){
        $.post("ajax/postComment.php")
        .done()

    }
    else{
        alert("you can't post an empty comment")
    }

}