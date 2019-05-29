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

function checkLoginDetails() {
    $usr = htmlentities($_POST['username']);
    $pwd = htmlentities($_POST['password']);
        if (!isEmpty($usr) && !isEmpty($pwd)){
            $_SESSION['username'] = $usr;
            if(isValidDescript($usr) && isValidDescript($pwd)){
                if (isValidUserLogin($usr,$pwd)) {
                    $_SESSION["loggedIn"] = $usr;
                    return "";
                }
                return "** Incorrect Login details, please try again";                
            }
            return "** Login details contain invalid characters";
        }
        return "** Username & Password are required";
}



/**
 * Validation manages that local function to validate booking form.
 * @return bool - if no errors, false otherwise.
 */
function validateForm(){
    global $loginErr;
    $loginErr=checkLoginDetails();
    if(isEmpty($loginErr)){        
        return true;
    }else{
        return false;
    }
}


$formOK= validateForm(); // update variables local to bookARoom.php;
$loginErrors =$loginErr;
if ($formOK) {
    header("Location: admin.php");
    exit();
}
?>