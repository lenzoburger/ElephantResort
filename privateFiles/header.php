<?php
/**
 * Created by PhpStorm.
 * User: lburka
 * Date: 9/24/15
 * Time: 12:27 PM
 */
if (session_id() === ""){
    session_start();
}
$_SESSION['lastPage'] = $_SERVER['PHP_SELF'];

/**
 * returns (sets) previously entered value to html form element calling method if the the form field has been previously
 * selected or set by user.
 * @param $elementId - form elements id.
 * @return string - value entered previously by user.
 */
function rememberFormInput($elementId){
    global $elementId;
    if(func_num_args()>0){
        $elementId= func_get_arg(0);
    }
    if (isset($_SESSION["$elementId"])) {
        $name = $_SESSION["$elementId"];

        if(func_num_args()==1){
            return "value='$name'";
        }else{
            if($name==func_get_arg(1)){
                return "selected";
            }
        }
    }
}

function loggedIn(){
    if (isset($_SESSION["username"])) {
        $user = $_SESSION["username"];
        if ($_SESSION["loggedIn"] === $user) {
           return true;
        }
    }
    return false;
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Elephant Resort</title>
    <!-- Jquery scripts -->
    <script src="../js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/jquery-ui.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/stylish.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



    <!-- Custom scripts -->
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    if (isset($scriptList) && is_array($scriptList)) {
        foreach ($scriptList as $script) {
            echo "<script src='$script'></script>";
        }
    }
    ?>

</head>

<body class="index <?php if($currentPage === 'admin.php' ||$currentPage === 'bookARoom.php' ){ echo "fill-page";} ?>">

<!-- Navigation -->
<nav class="navbar navbar-default<?php
if($currentPage === "index.php"){
    echo ' navbar-fixed-top';
}else{
    echo ' ourRNavBar';
}?>">
    <div class="container">
        <!-- top nav bar -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">The Elephant Resort</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <?php
                if ($currentPage === 'index.php') {
                    echo '<li class="home" id="current">Home';
                } else {
                    echo '<li><a class="home" href="../index.php">Home</a>';
                }

                if ($currentPage === 'ourRooms.php') {
                    echo '<li class="page-scroll" id="current">Our Rooms';
                } else {
                    echo '<li><a class="page-scroll" href="../php/ourRooms.php">Our Rooms</a>';
                }

                if ($currentPage === 'bookARoom.php') {
                    echo '<li class="page-scroll" id="current">Book A Room';
                } else {
                    echo '<li><a class="page-scroll" href="../php/bookARoom.php">Book A Room</a>';
                }
                if (loggedIn()) {
                        echo '<li><a class="page-scroll" href="../php/logout.php">Logout</a>';                                          
                }else {
                    if ($currentPage === 'login.php') {
                        echo '<li class="page-scroll" id="current">Login';
                    } else {
                        echo '<li><a class="page-scroll" href="../php/login.php">Login</a>';
                    }                
                }
                
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
