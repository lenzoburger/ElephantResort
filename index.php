<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 12:27 PM
 *
 * public Home page
 */
$scriptList = array();
?>
<!DOCTYPE html>

<?php
include("privateFiles/header.php");
?>

<!-- Welcome page -->
<body>
    <div id="mainPageBackground" class="container">
        <div class="intro-text">
            <div class="intro-lead-in">Welcome To The Elephant Resort</div>
            <div class="intro-heading">It's Nice To Meet You</div>
            <a href="php/ourRooms.php" class="page-scroll btn btn-xl">Explore</a>
        </div>
    </div>
</body>
<?php
include("privateFiles/footer.php");
?>
