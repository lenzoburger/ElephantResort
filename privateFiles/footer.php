<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 12:27 PM
 */
$currentPage = basename($_SERVER['PHP_SELF']);

?>
<footer>
    <div class="container linksContainer">
        <div class="row">

            <div <?php if (loggedIn()) {
                        echo 'class="col-sm-5"';
                    } else {
                        echo 'class="col-sm-6"';
                    } ?>>
                <?php
                if ($currentPage === 'contactUs.php') {
                    echo '<a class = "currentFooterLink">Contact us</a>';
                } else {
                    echo '<a href="../php/contactUs.php" id="contactUsLInk">Contact us</a>';
                }
                ?>
            </div>

            <div <?php if (loggedIn()) {
                        echo 'class="col-sm-5"';
                    } else {
                        echo 'class="col-sm-6"';
                    } ?>>
                <?php
                if ($currentPage === 'aboutUs.php') {
                    echo '<a class = "currentFooterLink">About us</a>';
                } else {
                    echo '<a href="../php/aboutUs.php" id="aboutUsLInk">About us</a>';
                }
                ?>
            </div>

            <?php

            if (loggedIn()) {
                ?>
                <div class="col-sm-2">
                    <?php
                    if ($currentPage === 'admin.php') {
                        echo '<a class = "currentFooterLink">Administration</a>';
                    } else {
                        echo '<a href="../php/admin.php" id="aboutUsLInk">Administration</a>';
                    }
                    #echo '<li><a class="page-scroll" href="../php/admin.php">Administration</a>';
                    ?>
                </div>
            <?php
        }
        ?>
        </div>
    </div>
</footer>
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap.js"></script>

<!-- Plugin JavaScript -->
<script src="../js/cbpAnimatedHeader.js"></script>

<!-- Bootstrap datepicker -->
<script>
    $("#checkIn").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
    });
    $("#checkOut").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
    });
</script>

</body>

</html>