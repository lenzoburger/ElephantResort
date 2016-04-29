<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 12:27 PM
 *
 * public administrator page for managing rooms and bookings.
 */
$scriptList = array();
?>
    <!DOCTYPE html>

    <?php
    include("../privateFiles/header.php");
    ?>

    <!-- Current bookings Section -->
    <section id="bookARoom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Staff and Management</h2>
                    <h3 class="section-subheading white">Manage bookings and hotel rooms</h3>
                </div>
            </div>

            <div id="pendingCart">
                    <?php
                    if (isset($_POST['viewBookings'])||isset($_POST['deleteBooking'])) {
                       include("../privateFiles/loadUpdateBookings.php");
                    }else  if (isset($_POST['viewRooms'])||isset($_POST['deleteRoom'])
                    || isset($_POST['editRoom'])||isset($_POST['updateRoom'])
                    ||isset($_POST['addRoom'])) {
                        include("../privateFiles/loadUpdateRooms.php");
                    }
                    ?>
            </div>

            <div class="viewBookingsContainer">
            <form method="POST" name="viewBookingsForm">
                <input type="submit" class="btn btn-xl admin-btn" name="viewBookings" id="viewBookings" value="View Bookings">
            </form>
            <form method="POST" name="viewRoomsForm">
                    <input type="submit" class="btn btn-xl admin-btn" name="viewRooms" id="viewRooms" value="View Hotel Rooms">
            </form>
            </div>
        </div>
    </section>
<?php
include("../privateFiles/footer.php");
?>