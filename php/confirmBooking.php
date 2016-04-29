<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 12:27 PM
 *
 * public page which only appears when a user makes a booking,
 * to confirm a booking and its details.
 */

if (session_id() === ""){
    session_start();

    $lastpage="";
    if (isset($_SESSION['lastPage']) && $_SESSION['lastPage']!=$_SERVER['PHP_SELF']) {
        $lastpage.=$_SESSION['lastPage'];
    }else{
        $lastpage.='../php/bookARoom.php';
    }

    if (!isset($_POST['bookRoom'])) {
        header("Location: $lastpage");
        exit;
    }

$scriptList = array();

}
?>
<!DOCTYPE html>
<?php
include("../privateFiles/header.php");?>
    <section class="fill-page">
    <div class="col-lg-12 text-center white">
        <h2 class="section-heading">Thank You</h2>
    </div>
    <?php
    include("../privateFiles/saveBookings.php");
   ?>
</section>
<?php
include("../privateFiles/footer.php");
?>