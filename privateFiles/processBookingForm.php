<?php
if (session_id() === ""){
    session_start();
}
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 10:57 PM
 *
 * A script which contains validation function specific to the room booking form.
 */
include("../privateFiles/validateFunctions.php");

/**
 * Check to see if the name appears valid.
 * @return String - empty string if nor errors, error messages if not.
 */
function checkName() {
    $name = htmlentities($_POST['Cname']);
        if (!isEmpty($name)){
            $_SESSION['Cname'] = $name;
            if(isValidText($name)&&!isDigits($name)){
                return "";
            }
            return "** A valid name may only contain letters and symbols";
        }
        return "** Please enter your name";
}

/**
 * validates the checkin date supplied.
 * @return string - empty if no errors, error messages otherwise.
 */
function checkChkinDate(){
    $checkinDate = htmlentities($_POST['checkIn']);
    if (!isEmpty($checkinDate)){
        $_SESSION['checkIn'] = $checkinDate;
        if(isValidDate($checkinDate)){
            if(isGreaterDate($checkinDate,date('d-m-Y')) >= 0){
                if(isEmpty(checkChkoutDate())){
                    $checkoutDate = htmlentities($_POST['checkOut']);
                    if(isGreaterDate($checkoutDate,$checkinDate)>0){
                        return "";
                    }
                    return "** Checkin date must be at least 1 day prior to checkout date";
                }else{
                    return "";
                }
            }
            return "** Checkin date cannot be in the past";
        }
        return "** $checkinDate is not a VALID date, please enter/select a valid date";
    }
    return "** Please enter a date in format dd/mm/yyyy or select using the date picker";
}

/**
 * validates the checkout date supplied.
 * @return string - empty if no errors, error messages otherwise.
 */
function checkChkoutDate(){
    $checkoutDate = htmlentities($_POST['checkOut']);
    if (!isEmpty($checkoutDate)){
        $_SESSION['checkOut'] = $checkoutDate;
        if(isValidDate($checkoutDate)){
            if(isGreaterDate($checkoutDate,date('d-m-Y')) >= 0){
                return "";
            }
            return "** Checkout date cannot be in the past";
        }
        return "** $checkoutDate is not a VALID date, please enter/select a valid date";
    }
    return "** Please enter a date in format dd/mm/yyyy or select using the date picker";
}

/**
 * loads all rooms in xml that are not booked during a specified period.
 * @return string - tabulated and formatted data all the available rooms.
 */
function displayAvailableRooms(){
    $xml = simplexml_load_file("../xml/roomBookings.xml");
    $roomInfo = simplexml_load_file("../xml/hotelRooms.xml");
    $hotelRooms = $roomInfo->xpath('//hotelRoom');
    $availableRooms = "";
    foreach ($hotelRooms as $hotelRoom) {
        $booked=false;
        $number = $hotelRoom->number;
        $bookings = $xml->xpath('//booking');
        foreach ($bookings as $booking) {
            $num = $booking->number;
            if((int)$number==(int)$num){
                $checkin = $booking->checkin;
                $checkout = $booking->checkout;
                $takerCheckin = $checkin->day."-".$checkin->month."-".$checkin->year;
                $takerCheckout = $checkout->day."-".$checkout->month."-".$checkout->year;
                $wantsCheckin = htmlentities($_POST['checkIn']);
                $wantsCheckout = htmlentities($_POST['checkOut']);
                if((isGreaterDate($takerCheckin,$wantsCheckin)>0 && isGreaterDate($takerCheckin,$wantsCheckout)>=0)||
                    (isGreaterDate($wantsCheckin,$takerCheckout)>0 && isGreaterDate($wantsCheckout,$takerCheckout)>0)){
                }else{
                    $booked=true;
                    break;
                }
            }
        }
        if(!$booked){
            $roomType = $hotelRoom->roomType;
            $pricePerNight= $hotelRoom->pricePerNight;
            $pricePerNight=number_format((float)$pricePerNight, 2);
            $availableRooms.="<div class='unbooked'> <img src='../img/$number.jpg' width='300' height='300' alt='Hotel room image'>".
                "<table class='roomInfoTable text-muted'> <tr> <th>Number</th> <th>Description</th><th>Price</th> </tr>".
                "<tr class='dataRow'><td class='rNum'> $number</td>".
                "<td class='rDes'>$roomType</td>".
                "<td class='ppn'>$$pricePerNight</td></tr></table>".
                "<form class='bookNowForm' method='POST' action='../php/confirmBooking.php'>".
                "<input type='hidden' name='number' value='$number'>".
                "<input type='hidden' name='roomType' value='$roomType'>".
                "<input type='hidden' name='pricePerNight' value='$$pricePerNight'>".
                "<p><input type='submit' name='bookRoom' class='btn btn-m bookRoom' value='Book Now'></p></form></div>";
        }
    }
    return $availableRooms;
}

/**
 * Validation manages that local function to validate booking form.
 * @return bool - if no errors, false otherwise.
 */
function validateForm(){
    global $nameErr;
    global $chkInErr;
    global $chkOutErr;
    global $availRooms;
    $availRooms="";
    $nameErr= checkName();
    $chkOutErr=checkChkoutDate();
    $chkInErr =checkChkinDate();
    $error="$nameErr$chkInErr$chkOutErr";
    if(isEmpty($error)){
        $availRooms= displayAvailableRooms();
        return true;
    }else{
        return false;
    }
}

$formOK= validateForm(); // update variables local to bookARoom.php;
$nameErrors= $nameErr;
$chkInErrors =$chkInErr;
$chkOutErrors=$chkOutErr;
$roomsAvailable = $availRooms;
?>