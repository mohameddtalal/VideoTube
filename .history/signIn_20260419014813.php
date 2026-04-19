<?php require_once("includes/config.php"); 
req

$account = new Account($con);

if(isset($_POST["submitButton"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $wasSuccessful = $account->login($username, $password);

    if($wasSuccessful) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
    else {
        echo "Registration failed";
    }

}





function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>VideoTube</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    </head>
    <body>
 <div class="signInContainer">
    <div class="column">
        <div class="header">
            <img src="assets/images/icons/VideoTubeLogo.png" title="logo" alt="Site logo">
            <h3>Sign In</h3>
            <span>to continue to VideoTube</span>
        </div>

        <div class="loginForm">
            <form action="signIn.php" method="POST">
                <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username"); ?>" autocomplete="off">
                <input type="password" name="password" placeholder="Password" required autocomplete="off">

                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
        </div>

        <a class="signInMessage" href="signUp.php">Need an account? Sign Up here!</a>
    </div>

 </div>

</body>
</html> 