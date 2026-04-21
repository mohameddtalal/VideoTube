function subscribe(userTo,userFrom,button){
    if(userTo==userFrom){
        alert("you can't subscribe yourself")
        return;
    }

    $.post("ajax/subscribe.php",user)
      .done(function() {
        console.log("done")

    });
}