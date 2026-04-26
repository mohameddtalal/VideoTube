<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/SettingsFormProvider.php");
require_once("includes/classes/Constants.php");

if(!User::isLoggedIn()){
    header("Location:signIn.php");
}

$detailsMessage="";
$passwordMessage="";
$formProvider= new SettingsFormProvider();


if(isset($_POST["saveDetailsButton"])){
    $account= new Account ($con);
    $firstName=FormSanitizer::santizeFormString($_POST["firstName"]);
    $lastName=FormSanitizer::santizeFormString($_POST["lastName"]);
    $email=FormSanitizer::santizeFormEmail($_POST["email"]);

    if($account->updateDetails($firstName,$lastName,$email,$userLoggedInObj->getUsername())){
        $detailsMessage="<div class='alert alert-success'>
                            <strong>SUCCESS!</strong> Details updated successfully!
                            </div>";
    }
    else{
        $errorMessage=$account->getFirstError();
        if($errorMessage=="") $errorMessage="Something went wrong";
        $detailsMessage="<div class='alert alert-danger'>

                            <strong>ERROR!</strong>$errorMessage
                            </div>";
    }
}


if(isset($_POST["savePasswordButton"])){
    $account= new Account ($con);
    $oldPassword=FormSanitizer::santizeFormPassword($_POST["oldPassword"]);
    $newPassword=FormSanitizer::santizeFormPassword($_POST["newPassword"]);
    $newPassword2=FormSanitizer::santizeFormPassword($_POST["newPassword2"]);

    if($account->updatePassword($oldPassword,$newPassword,$newPassword2,$userLoggedInObj->getUsername())){
        $passwordMessage="<div class='alert alert-success'>
                            <strong>SUCCESS!</strong> Password updated successfully!
                            </div>";
    }
    else{
        $errorMessage=$account->getFirstError();
        if($errorMessage=="") $errorMessage="Something went wrong";
        $passwordMessage="<div class='alert alert-danger'>

                            <strong>ERROR!</strong>$errorMessage
                            </div>";
    }

    
}
?>

<div class="settingContainer column">
    <div class="formSection">
        <div class="message">
            <?php echo $detailsMessage;?>

        </div>

        <?php
        echo $formProvider->createUserDetailsForm(
            isset($_POST["firstName"]) ? $_POST["firstName"] : $userLoggedInObj->getFirstName(),
            isset($_POST["lastName"]) ? $_POST["lastName"] : $userLoggedInObj->getLastName(),
             isset($_POST["email"]) ? $_POST["email"] : $userLoggedInObj->getEmail()
        );

        ?>
    </div>
    <div class="formSection">
        <div class="message">
            <?php echo $passwordMessage;?>

        </div>
        <?php
        echo $formProvider->createPasswordForm();
        ?>
    </div>
</div>