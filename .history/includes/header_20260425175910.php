<?php require_once("includes/config.php"); 
require_once("includes/classes/Video.php");
require_once("includes/classes/User.php");
require_once("includes/classes/VideoGrid.php");
require_once("includes/classes/ButtonProvider.php");
require_once("includes/classes/VideoGridItem.php");
require_once("includes/classes/SubscriptionsProvider.php");

session

$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);


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
        <script src="assets/js/commonActions.js"></script>
        <script src="assets/js/userActions.js"></script>
    </head>
    <body>
    <div id="pageContainer">
        
        <div id="mastHeadContainer">
            <button class="navShowHide">
                <img src="assets/images/icons/menu.png" >
            </button>
            <a class="logoContainer" href="index.php">
                <img src="assets/images/icons/VideoTubeLogo.png" title="logo" alt="Site logo">
            </a>
            <div class="searchBarContainer">
                <form action="search.php" method="GET">
                    <input type="text" class="searchBar" name="term" placeholder="Search...">
                    <button class="searchButton">
                        <img src="assets/images/icons/search.png">
                    </button>
                </form>
            </div>
            <div class="rightIcons">
                <a href="upload.php">
                    <img class="upload" src="assets/images/icons/upload.png">
                </a>
                <?php echo ButtonProvider::createUserProfileNavigationButton($con,$userLoggedInObj->getUsername());?>
            </div>
        </div>
        <div id="sideNavContainer" style="display: none;">

        </div>
        <div id="mainSectionContainer">
            <div id="mainContentContainer">
                