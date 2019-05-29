<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 12:27 PM
 *
 * public page where user can view contact us details.
 */
$scriptList = array();
?>
<!DOCTYPE html>

<?php
include("../privateFiles/header.php");
?>
<!-- Book A Room Section -->

<body>
    <div id="contactUsContainer" class="container fill-page">
        <div class="row text-center">
            <h2 class="section-heading">Contact us</h2>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-sm-4 text-center">
                <span class="contactUsIcons">
                    <i class="fa fa-home"></i>
                </span>
                <p class="contactUsHeadings">VISIT US</p>                
                <p class="contactUsInfo">
                    12 Elephantidea Crescent, Mammalia, Tulundi
                </p>
            </div>

            <div class="col-sm-4 text-center">
                <span class="contactUsIcons">
                    <i class="fa fa-phone"></i>
                </span>
                <p class="contactUsHeadings">PHONE US</p>
                <p class="contactUsInfo">
                    +621 1201201021012
                </p>                
            </div>

            <div class="col-sm-4 text-center">
                <span class="contactUsIcons">
                    <i class="fa fa-envelope"></i>
                </span>
                <p class="contactUsHeadings">EMAIL US</p>
                <p class="contactUsInfo">
                elephantresort@xpe.co.tu
                </p>                
            </div>
        </div>
    </div>
</body>


<?php
include("../privateFiles/footer.php");
?>