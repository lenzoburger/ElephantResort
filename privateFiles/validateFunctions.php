<?php

if (session_id() === ""){
    session_start();
}

/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/8/15
 * Time: 11:41 AM
 */

/**
 * Check to see if a string is composed entirely of the digits 0-9.
 * Note that this is different to checking if a string is numeric since
 * +/- signs and decimal points are not permitted.
 *
 * @param string $str The string to check.
 * @return True if $str is composed entirely of digits, false otherwise.
 */
function isDigits($str) {
    $pattern='/^[0-9.]+$/';
    return preg_match($pattern, $str);
}

/**
 * Check to see if a string contains any content or not.
 * Leading and trailing whitespace are not considered to be 'content'.
 *
 * @param string $str The string to check.
 * @return True if $str is empty, false otherwise.
 */
function isEmpty($str) {
    return strlen(trim($str)) == 0;
}

function isValidText($str) {
    $pattern='/^[A-Za-z \-_\',.]+$/';
    return preg_match($pattern, $str);
}

function isValidDescript($str) {
    $pattern='/^[A-Za-z0-9 \-_\',.]+$/';
    return preg_match($pattern, $str);
}

function isValidUserLogin($usr, $pwd){
    $username = "sample";
    $password = "password123";

    if ($usr == $username && $pwd == $password) {
        return true;
    }else {
        return false;
    }
}


/**
 * Check to see if a string looks like an email.
 * Email validation is actually fairly complex, so this is a thin wrapper
 * around a PHP filter function.
 *
 * @param string $str The string to check.
 * @result True if $str looks like a valid email address, false otherwise.
 */
function isEmail($str) {
    // There's a built in PHP tool that has a go at this
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}

/**
 * Check to see if the length of a string is a given value, ignoring leading
 * and trailing whitespace.
 *
 * @param string $str The string to check.
 * @param integer $len The expected length of $str.
 * @result True if $str has length $len, false otherwise.
 */
function checkLength($str, $len) {
    return strlen(trim($str)) === $len;
}

function isValidDate($str) {
    $pattern='/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/';
    return preg_match($pattern, $str);
}

function isGreaterDate($isGreater,$challenger){
    $isGArray = explode("-",$isGreater);
    $chArray = explode("-",$challenger);

    if(checkLength($isGArray[1],1)){
        $isGArray[1]="0$isGArray[1]";
    }
    if(checkLength($isGArray[0],0)){
        $isGArray[0]="0$isGArray[0]";
    }

    $isGreater=(int) $isGArray[2].$isGArray[1].$isGArray[0];
    $challenger = (int) $chArray[2].$chArray[1].$chArray[0];

    if($isGreater > $challenger){
        return 1;
    }else if($isGreater < $challenger){
        return -1;
    }else{
        return 0;
    }
}


?>

