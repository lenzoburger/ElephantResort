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
    <div id="LoginContainer" class="container fill-page">
        <div class="row text-center">
            <h2 class="section-heading">Login</h2>
        </div>

        <div class="row" style="margin: 60px auto; width: 400px; height: 400px;">
            <div class="fromContainer">
                <?php
                global $formOK;
                global $loginErrors;

                $formOK = false;
                $loginErrors = "";

                if (isset($_POST['loginForm'])) {
                    ?> <p class="errorCheck"> <?php include("../privateFiles/processLoginForm.php"); ?></p><?php
                                                                                                        }
                                                                                                        ?>
                <form method='POST' name="sentMessage" id="sentMessage">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="username">Username:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control " name="username" id="username" placeholder="Enter your name: (sample)" <?php echo rememberFormInput('username') ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="password">Password:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password: (password123)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="errorCheck"><?php print $loginErrors ?>
                        </span></div>
                    <div class="form-group row">
                        <div class="text-center">
                            <input type="submit" class="btn btn-lg btn-warning" name="loginForm" id="loginForm" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


<?php
include("../privateFiles/footer.php");
?>