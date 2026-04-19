<?php 
require_once("includes/config.php"); 
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
re
$account = new Account($con);

if(isset($_POST["submitButton"])) {
    $firstName = FormSanitizer::santizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::santizeFormString($_POST["lastName"]);

    $username = FormSanitizer::santizeFormUsername($_POST["username"]);

    $email = FormSanitizer::santizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::santizeFormEmail($_POST["email2"]);

    $password = FormSanitizer::santizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::santizeFormPassword($_POST["password2"]);

    $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
    if($wasSuccessful) {
        // echo "Registration successful";
        header("Location: signIn.php");
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
            <h3>Sign up</h3>
            <span>to continue to VideoTube</span>
        </div>

        <div class="loginForm">
            <form action="signUp.php" method="POST">
                <input type="text" name="firstName" placeholder="First Name" required autocomplete="off">
                <input type="text" name="lastName" placeholder="Last Name" required autocomplete="off">
                <input type="text" name="username" placeholder="Username" required autocomplete="off">


                <input type="email" name="email" placeholder="Email" required autocomplete="off">
                <input type="email" name="email2" placeholder="Confirm Email" required autocomplete="off">

                <input type="password" name="password" placeholder="Password" required autocomplete="off">
                <input type="password" name="password2" placeholder="Confirm Password" required autocomplete="off">

                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
        </div>

        <a class="signInMessage" href="signIn.php">Already have an account? Sign In here!</a>
    </div>

 </div>

</body>
</html> 