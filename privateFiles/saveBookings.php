<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/26/15
 * Time: 5:41 PM
 * Script which saves a selected booking to roomBookings.xml.
 */
if (isset($_POST['bookRoom'])) {
    $sourceFile ="../xml/roomBookings.xml";
    $bookings = simplexml_load_file($sourceFile);
    $newbooking = $bookings->addChild('booking');

    $newbooking->addChild('number', $_POST['number']);
    $newbooking->addChild('name', $_SESSION['Cname']);

    $checkin = $newbooking->addChild("checkin");
    $checkinDATE = explode("-",$_SESSION['checkIn']);
    $checkin->addChild("day",$checkinDATE[0]);
    $checkin->addChild("month",$checkinDATE[1]);
    $checkin->addChild("year",$checkinDATE[2]);

    $checkout = $newbooking->addChild("checkout");
    $checkoutDATE = explode("-",$_SESSION['checkOut']);
    $checkout->addChild("day",$checkoutDATE[0]);
    $checkout->addChild("month",$checkoutDATE[1]);
    $checkout->addChild("year",$checkoutDATE[2]);
    $bookings->saveXML($sourceFile);

    echo "<div class='row' id='searchResults'><p><i>You have booked: </i> <b>Room ".$_POST['number']."</b></p>".
    "<p>Room Type: <b>".$_POST['roomType']."</b></p>".
    "<p>Price per Night <b>$".$_POST['pricePerNight']."</b></p>".
    "<p>Checking in on: <b>".$_SESSION['checkIn']."</b></p>".
    "<p>Checking out on: <b>".$_SESSION['checkOut']."</b></p>".
    "<p><b><i>We look forward to hosting you ".$_SESSION['Cname']."</i></b></p>".
    "<p><form METHOD='POST' ACTION='../php/bookARoom.php'><input type='submit' class='btn btn-gray' name='goBack' id='goBack' value='Go Back'></form>".
    "<form METHOD='POST' ACTION='../php/index.php'><input type='submit' class='btn btn-gray' name='goHome' id='goHome' value='Go Home'><p></form></div>";
}
?>