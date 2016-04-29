<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 12:27 PM
 *
 * public page which displays all the current rooms and their information
 * categorised by room type.
 */
$scriptList = array('../js/showHide.js');
?>
<!DOCTYPE html>

<?php
include("../privateFiles/header.php");
?>
<!-- Our Rooms Section -->
<section id="ourRooms">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Our Rooms</h2>
                <h3 class="section-subheading text-muted">Enjoy modern decor, free wifi and great views.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php include("../privateFiles/loadOurRoomsInfo.php"); ?>;
            </div>
        </div>
    </div>
    </section>
    <?php
    include("../privateFiles/footer.php");
    ?>
