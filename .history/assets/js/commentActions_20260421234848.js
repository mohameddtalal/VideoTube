function postComment(button,postedBy,videoId,replyTo,containerClass){
    var textarea=$(button).siblings("textarea");
    var commentText= teaxtarea.val();
    textarea.val("");

    if(commentText){

    }
    else{
        alert("you can't post an empty comment")
    }

}