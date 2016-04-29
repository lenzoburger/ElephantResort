<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/27/15
 * Time: 10:51 PM
 *
 * Script that loads all current rooms, and manages their creation, edition, and deletion.
 */
if (session_id() === ""){
    session_start();
}

include("../privateFiles/validateFunctions.php");// a script that contains general utility functions
echo"<h3>All Rooms</h3>".
    "<div id='pendingList'>";
$noUpdateErrors = true;

if(isset($_POST['viewRooms']) || isset($_POST['editRoom'])){ // Load all current rooms [and the edit form]
    displayRooms('',$noUpdateErrors);
}
if(isset($_POST['deleteRoom'])){ // delete a room and reload all current rooms
    deleteRoom();
    displayRooms('',$noUpdateErrors);
}

if(isset($_POST['updateRoom'])){ // (update room information or display edit form errors) and reload all current rooms
    $updateRoomErrors= updateRoom();
    $noUpdateErrors = isEmpty($updateRoomErrors);
    echo $updateRoomErrors;
    if($noUpdateErrors){
        echo "<p class='errorCheck'>Room ".$_POST['updateNum']." successfully updated.</p>";
    }
    displayRooms('',$noUpdateErrors);
}

if(isset($_POST['addRoom'])){ // (add new room or display add room form errors) and reload all current rooms
    $addRoomErrors = addRoom();
    displayRooms($addRoomErrors,$noUpdateErrors);
}
echo"</div>";

/**
 * returns a select field of all current room types.
 * @param $name - the desired name of resulting select field.
 * @param $form - the form the select will be a part of.
 * @return string - a select html entity with room type options
 */
function getRoomTypes($name,$form){
    $sourceFile ="../xml/roomTypes.xml";
    $xml = simplexml_load_file($sourceFile);
    $roomTypes = $xml->xpath('//roomType');
    $types="<select name='$name' form='$form'>";
    foreach($roomTypes as $roomType) {
        $type = $roomType->id;
        $types.="<option value='$type' ".rememberFormInput($name,$type).">$type</option>";
    }
    return "$types</select>";
}

/**
 * Validates add room form and write new room to xml.
 * @return string - success message or errors processing form.
 */
function addRoom(){
    $error = "";
    $rmNum = htmlentities($_POST['rmNum']);
    $rmType = htmlentities($_POST['addrmType']);
    $rmDes = htmlentities($_POST['rmDes']);
    $rmPrice = htmlentities($_POST['rmPrice']);
    $_SESSION['addrmNum'] =  $rmNum;
    $_SESSION['addrmType'] = $rmType;
    $_SESSION['addrmDes'] =$rmDes;
    $_SESSION['addrmPrice'] =$rmPrice;
    if(isEmpty($rmNum)|| !isDigits($rmNum)){
        $error .= "<li> Please enter a valid room number</li>";
    }else if(!uniqueRoomNum($rmNum)){
        $error .= "<li>That room number is already in use</li>";
    }
    if(isEmpty($rmDes)|| !isValidDescript($rmDes)){
        $error .= "<li> Please enter a valid room description</li>";
    }

    if(isEmpty($rmPrice)|| !isDigits($rmPrice)){
        $error .= "<li> Please enter a valid room price</li>";
    }

    if(isEmpty($error)) {
        $sourceFile = "../xml/hotelRooms.xml";
        $xml = simplexml_load_file($sourceFile);
        $room = $xml->addChild('hotelRoom');
        $room->addChild('number', $rmNum);
        $room->addChild('roomType', $rmType);
        $room->addChild('description', $rmDes);
        $room->addChild('pricePerNight', str_replace(',','',number_format((float)$rmPrice,2)));
        $xml->saveXML($sourceFile);
        unset($_SESSION['addrmNum']);
        unset($_SESSION['addrmType']);
        unset($_SESSION['addrmDes']);
        unset($_SESSION['addrmPrice']);
        return "<p class='errorCheck'>Room $rmNum successfully added.</p>";
    }else{
        return "<ul class='errorCheck'>$error</ul>";
    }
}

/**
 * Validates edit room form, writes new details to xml,
 * and reflects room number changes in current booking details.
 * @return string - empty string or errors processing form messages.
 */
function updateRoom(){
    $sourceFile ="../xml/hotelRooms.xml";
    $xml = simplexml_load_file($sourceFile);
    $error = "";
    foreach ($xml->children() as $Room) {
        $num = $Room->number;    
        if($_POST['updateNum']==$num) {
            $roomNum = $Room->number;
            $roomType = $Room->roomType;
            $roomDes = $Room->description;
            $roomPrice = $Room->pricePerNight;
            $_SESSION['rmNum'] =  $_POST['rmNum'];
            $_SESSION['rmType'] = $_POST['rmType'];
            $_SESSION['rmDes'] =$_POST['rmDes'];
            $_SESSION['rmPrice'] =$_POST['rmPrice'];
            if (isset($_POST['rmNum']) && !isEmpty($_POST['rmNum'])) {
                if (isDigits($_POST['rmNum'])) {
                    if(uniqueRoomNum($_POST['rmNum'])){
                        $roomNum = $_POST['rmNum'];
                    }else{
                        $error .= "<li>That room number is already in use</li>";
                    }
                } else {
                    $error .= "<li> Please enter a valid room number</li>";
                }
            }

            if (isset($_POST['rmType'])) {
                $roomType = $_POST['rmType'];
            }

            if (isset($_POST['rmDes']) && !isEmpty($_POST['rmDes'])) {
                if (isValidDescript($_POST['rmDes'])) {
                    $roomDes = $_POST['rmDes'];
                } else {
                    $error .= "<li> Please enter a valid room description</li>";
                }
            }

            if (isset($_POST['rmPrice']) && !isEmpty($_POST['rmPrice'])) {
                if (isDigits($_POST['rmPrice'])) {
                    $roomPrice = $_POST['rmPrice'];
                } else {
                    $error .= "<li> Please enter a valid room price</li>";
                }
            }

            if (isEmpty($error)) {
                $Room->number = $roomNum;
                updateBookings($_POST['updateNum']);
                $Room->roomType = $roomType;
                $Room->description = $roomDes;
                $Room->pricePerNight = str_replace(',','',number_format((float)$roomPrice, 2));
                unset($_SESSION['rmNum']);
                unset($_SESSION['rmType']);
                unset($_SESSION['rmDes']);
                unset($_SESSION['rmPrice']);
            } else {
                return "<ul class='errorCheck'>$error</ul>";
            }
        }
    }
    $xml->savexml($sourceFile);
    return "";
}

/**
 * In the case a room number is changed, booking in the
 * particular are updated.
 * @param $number - the new room number.
 */
function updateBookings($number){
    $sourceFile ="../xml/roomBookings.xml";
    $xml = simplexml_load_file($sourceFile);

    foreach ($xml->children() as $booking) {
        $num = $booking->number;
        if($num==$number){
            $booking->number=$_POST['rmNum'];
        }
    }
    $xml->saveXML($sourceFile);
}

/**
 * Deletes a particular room from xml
 */
function deleteRoom(){
    $sourceFile ="../xml/hotelRooms.xml";
    $xml = simplexml_load_file($sourceFile);
    $Rooms = $xml->xpath('//hotelRoom');
    $Roomnum = "";
    $toRemove=null;
    foreach ($Rooms as $Room) {
        $num = $Room->number;
        if($_POST['number']==$num){
            echo "<p class='errorCheck'>** Deleted room number: $num";
            $toRemove= $Room;
            $Roomnum = $_POST['number'];
        }
    }
    unset($toRemove[0][0]);
    $xml->savexml($sourceFile);
    deleteRoomBookings($Roomnum);
}

/**
 * Checks if any current rooms with the same room number
 * as number specified.
 * @param $number - The desired number of room
 * @return bool - true if room number is unique, false otherwise.
 */
function uniqueRoomNum($number){
    $sourceFile ="../xml/hotelRooms.xml";
    $xml = simplexml_load_file($sourceFile);
    $Rooms = $xml->xpath('//hotelRoom');
    foreach ($Rooms as $Room) {
        $num = $Room->number;
        if($num == $number){
            return false;
        }
    }
    return true;
}

/**
 * deletes all bookings in the room specified.
 * @param $number - the particular room number.
 */
function deleteRoomBookings($number){
    $sourceFile ="../xml/roomBookings.xml";
    $xml = simplexml_load_file($sourceFile);
    $bookings = $xml->xpath('//booking');
    $toRemove=array();
    $result = "";

    foreach ($bookings as $booking) {
        $num = $booking->number;
        $checkin = $booking->checkin;
        $name = $booking->name;
        $takerCheckin = (int)$checkin->day . "-" . (int)$checkin->month . "-" . (int)$checkin->year;
        if($num==$number){
            $result.="<li>** Deleted booking for $name. Staying in Room: $num. Checking in on: $takerCheckin.</li>";
            array_push($toRemove,$booking);
        }
    }
    echo "$result</p>";
    foreach ($toRemove as $booking) {
        unset($booking[0][0]);
    }
    $xml->saveXML($sourceFile);
}

/**
 * generates tabulated information of all current room from xml.
 * Also relays any error for forms.
 * @param $addRoomErrors - errors to relay from add room form processing.
 * @param $noUpdateErrors - errors to relay from edit room form processing.
 */
function displayRooms($addRoomErrors,$noUpdateErrors){
    $sourceFile ="../xml/hotelRooms.xml";
    $xml = simplexml_load_file($sourceFile);
    $Rooms = $xml->xpath('//hotelRoom');
    $html = "<table id='allRoomsTable'><tr class='text-muted'><th>Number</th><th>Type</th><th>Description</th>".
        "<th>Price</th><th>Remove</th><th>Update</th></tr>";
    $copy=$html;
    foreach ($Rooms as $Room) {
        $num = $Room->number;
        $roomType= $Room->roomType;
        $description= $Room->description;
        $pricePerNight= $Room->pricePerNight;
        $pricePerNight = number_format((float)$pricePerNight, 2);
        $html.="<tr";
        if((isset($_POST['editRoom']) && $_POST['number']==$num) || (!$noUpdateErrors && $_POST['updateNum']== $num)){
            $html.=" class='UpdateDetails'";
        }
            $html.="><td>$num</td><td>$roomType</td><td> $description</td>".
            "<td>$$pricePerNight</td><td><form action='#pendingList' method='POST' name='deleteRoomsForm' class='deleteRoomsForm'>".
            "<input type='hidden' name='number' value='$num'>".
            "<input type='submit' class='deleteBooking' name='deleteRoom' value='Delete'>".
            "</form></td><td><form action='#editButton$num' method='POST' name='editRoomsForm' class='editRoomsForm'>".
            "<input type='hidden' name='number' value='$num'>".
            "<input type='submit' class='deleteBooking' name='editRoom' id='editButton$num' value='Edit'>".
            "</form></td></tr>";
        if((isset($_POST['editRoom']) && $_POST['number']==$num) || (!$noUpdateErrors && $_POST['updateNum']== $num)){
            $html.="<tr class='UpdateDetails'><td><input type='text' name='rmNum' size='5' form='editRoomsForm$num' placeholder='000'".rememberFormInput('rmNum')."></td>".
                "<td>".getRoomTypes("rmType","editRoomsForm$num")."</td>".
                "<td><input type='text' name='rmDes' size='25' form='editRoomsForm$num' placeholder='Brief room description'".rememberFormInput('rmDes')."></td>".
                "<td><input type='text' name='rmPrice' size='5' form='editRoomsForm$num' placeholder='00.00'".rememberFormInput('rmPrice')."></td>".
                "<td colspan='2'><form action='#pendingList' method='POST' name='editRoomsForm' id='editRoomsForm$num'>".
                "<input type='hidden' name='updateNum' value='$num'>".
                "<input type='submit' class='deleteBooking' name='updateRoom' value='Update'>".
                "</form></td>".
                "</tr>";
        }
    }
    $addTable = "<div id='addRoomSection'>$addRoomErrors<table><caption class='viewBookingsContainer'>Add a new room</caption>".
        "<tr class='text-muted'><th>Number</th><th>Type</th><th>Description</th>".
        "<th>Price</th><th>Add Room</th></tr>".
    "<tr><td><input type='text' name='rmNum' size='5' form='addRoomForm' placeholder='000' ".rememberFormInput('addrmNum')."></td>".
        "<td>".getRoomTypes("addrmType","addRoomForm")."</td>".
        "<td><input type='text' name='rmDes' size='25' form='addRoomForm' placeholder='Brief room description' ".rememberFormInput('addrmDes')."></td>".
        "<td><input type='text' name='rmPrice' size='5' form='addRoomForm' placeholder='00.00' ".rememberFormInput('addrmPrice')."></td>".
        "<td><form method='POST' action='#addRoomSection' name='editRoomsForm' id='addRoomForm' ".rememberFormInput('rmNum').">".
        "<input type='hidden' name='updateNum' value='$num'>".
        "<input type='submit' class='deleteBooking' name='addRoom' value='Add'>".
        "</form></td>".
        "</tr></table></div>";
    if($html===$copy){
        echo "<p>There currently no Rooms to display</p>$addTable";
    }else{
        echo "$html</table>$addTable";
    }
}
?>