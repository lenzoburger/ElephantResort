<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 12:27 PM
 *
 * public page where user can find available rooms and book them.
 */
$scriptList = array();
?>
<!DOCTYPE html>

<?php
include("../privateFiles/header.php");
?>
<!-- Book A Room Section -->
<section id="bookARoom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Book A Room</h2>
                <h3 class="section-subheading white">Input date of desired arrival and checkout to find rooms available for your stay</h3>
            </div>
        </div>
        <div class="row">
            <?php
            global $roomsAvailable;
            global $formOK;
            global $nameErrors;
            global $chkInErrors;
            global $chkOutErrors;
            $formOK = false;
            $chkInErrors = "";            
            $chkOutErrors = "";
            $nameErrors = "";
            $roomsAvailable="";
            if (isset($_POST['availability'])) {
                ?> <p class="errorCheck"> <?php include("../privateFiles/processBookingForm.php");?></p><?php
            }
            ?>
            <form method='POST' name="sentMessage" id="sentMessage">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="checkIn">Check In Date:</label>
                            <input type="text" class="form-control" name="checkIn" id="checkIn" placeholder="dd-mm-yyyy" <?php echo rememberFormInput('checkIn')?>>
                            <span class="errorCheck"><?php print $chkInErrors?></span>
                        </div>

                        <div class="form-group">
                            <label for="checkOut">Check Out Date:</label>
                            <input type="text" class="form-control" name="checkOut" id="checkOut" placeholder="dd-mm-yyyy" <?php echo rememberFormInput('checkOut')?>>
                            <span class="errorCheck"><?php print $chkOutErrors?></span>
                        </div>
                        <div class="form-group">
                            <label for="Cname">Name:</label>
                            <input type="text" class="form-control" name="Cname" id="Cname" placeholder="Enter your name" <?php echo rememberFormInput('Cname')?>>
                            <span class="errorCheck"><?php print $nameErrors?></span>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-xl" name="availability" id="availability" value="Check Available Rooms">
                            <span class="errorCheck"></span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-lg-12">
            </div>
        </div>
        <?php if($formOK){
        ?>
            <div class="row" id="searchResults">
                <?php
                print $roomsAvailable;
                ?>
        </div>
            <?php
        }
        ?>

    </div>
</section>

<?php
include("../privateFiles/footer.php");
?>

