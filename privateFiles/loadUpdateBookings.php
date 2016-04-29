<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/27/15
 * Time: 11:29 AM
 * A script that displays all current bookings and manages their deletion.
 */

if(isset($_POST['viewBookings'])){ // Load all bookings
    echo"<h3>Current Bookings</h3>".
        "<div id='pendingList'>";
    displayBookings();
    echo"</div>";
}

if(isset($_POST['deleteBooking'])){ // delete selected booking and reload all bookings
    echo"<h3>Current Bookings</h3>".
        "<div id='pendingList'>";
    deleteBooking();
    displayBookings();
    echo"</div>";
}

/**
 * Delete a particular booking based from xml
 */
function deleteBooking(){
    $sourceFile ="../xml/roomBookings.xml";
    $xml = simplexml_load_file($sourceFile);
    $bookings = $xml->xpath('//booking');
    $toRemove=null;

    foreach ($bookings as $booking) {
        $num = $booking->number;
        $checkin = $booking->checkin;
        $name = $booking->name;
        $takerCheckin = (int)$checkin->day . "-" . (int)$checkin->month . "-" . (int)$checkin->year;
        if($_POST['name']==$name && $_POST['checkin']==$takerCheckin && $_POST['num']==$num){
            echo "<p class='errorCheck'>** Deleted booking for $name. Staying in Room: $num. Checking in on: $takerCheckin.</p>";
            $toRemove= $booking;
        }
    }
    unset($toRemove[0][0]);
    $xml->saveXML($sourceFile);
}

/**
 * Generate and echo a table of all current bookings from roomBookings xml file.
 */
function displayBookings(){
    $xml = simplexml_load_file("../xml/roomBookings.xml");
    $bookings = $xml->xpath('//booking');
    $html = "<table><tr class='text-muted'><th>Name</th><th>Number</th><th>Checkin</th>".
        "<th>Checkout</th><th>Remove</th></tr>";
    $copy=$html;
    foreach ($bookings as $booking) {
        $num = $booking->number;
        $checkin = $booking->checkin;
        $checkout = $booking->checkout;
        $name= $booking->name;
        $takerCheckin = (int)$checkin->day."-".(int)$checkin->month."-".(int)$checkin->year;
        $takerCheckout = (int)$checkout->day."-".(int)$checkout->month."-".(int)$checkout->year;
        $html.="<tr><td>$name</td><td>$num</td><td> $takerCheckin</td>".
            "<td>$takerCheckout</td><td><form method='POST' name='deleteBookingsForm' class='deleteBookingsForm'>".
            "<input type='hidden' name='name' value='$name'>".
            "<input type='hidden' name='checkin' value='$takerCheckin'>".
            "<input type='hidden' name='num' value='$num'>".
            "<input type='submit' class='deleteBooking' name='deleteBooking' value='Delete'>".
            "</form>";
    }
    if($html===$copy){
        echo "<p>There currently no bookings to display</p>";
    }else{
        echo "$html</table>";
    }
}
?>