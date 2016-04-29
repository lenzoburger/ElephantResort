<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 10/1/15
 * Time: 3:16 PM
 * Script to load particular room information and images from xml and categorise
 * information according to room type using html entities.
 */


/**
 * Returns a list containing a tabulated information of each room
 * which are all of a specific type.
 * @param $type - The particular type of rooms
 * @return string - html containing a tabulated information of each room
 */
function loadRoomInfo($type){
    $sourceFile ="../xml/hotelRooms.xml";
    $xml = simplexml_load_file($sourceFile);
    $hotelRooms = $xml->xpath('//hotelRoom');
    $information="<li class='information'>";
    foreach($hotelRooms as $hotelRoom){
        $roomType ="".$hotelRoom->roomType;
        if($roomType == $type){
            $num = $hotelRoom->number;
            $des = $hotelRoom->description;
            $ppn = $hotelRoom->pricePerNight;
            $ppn=number_format((float)$ppn, 2);
            $information.="<div class='hotelImagesContainer'>".
                "<img class='img-responsive hotelRooms' src='../img/$num.jpg'".
                " width='300' height='300' alt=''>".
                "<div class='roomInfoDiv'>".
                "<table class='roomInfoTable text-muted'><tr><th>Number</th><th>Description</th><th>Price</th></tr>".
                "<tr><td class='rNum'>$num</td>".
                "<td class='rDes'>$des</td> ".
                "<td class='ppn'>$$ppn</td>".
                "</tr></table></div></div>";
        }
    }
    return "$information</li>";
}

/**
 * Returns an unordered list containing images and information for all room types
 * categorised by room type.
 * which are all of a specific type.
 * @return string - html containing categorical data and images of all room types.
 */
function loadCategories(){
    $sourceFile ="../xml/roomTypes.xml";
    $xml = simplexml_load_file($sourceFile);
    $roomTypes = $xml->xpath('//roomType');
    $categories = "<ul class='Categories'>";
    foreach($roomTypes as $roomType){
        $type = $roomType->id;
        $descr = $roomType->description;
        $max = $roomType->maxGuests;
        $roomInfo = loadRoomInfo($type);
        $type_img=str_replace(' ','_',$type);
        $categories.="<li class='roomTypes'>".
            "<div class='Categories-img'>".
            "<div class='Categories-image'>".
            "<img class='img-circle img-responsive' src='../img/$type_img.jpg' alt=''>".
            "</div></div>".
            "<div class='Categories-panel'>".
            "<div class='Categories-heading'>".
            "<h3 class='subheading'>$type</h3>".
            "<div class='Categories-body'>".
            "<p class='text-muted'><b>Configuration: </b> $descr</p>".
            "<p class='text-muted'><b>Maximum Number of Guests: </b> $max</p>".
            "</div></div></div></li>$roomInfo";
    }
    return "$categories</ul>";
}
echo loadCategories();
?>