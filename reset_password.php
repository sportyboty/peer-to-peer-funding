
<?php

    require_once "vendor/autoload.php";
    require_once "classes/config.php";

    use MerryPayout\Validate;

    $dataManager = new \MerryPayout\DataManager();

    $submitted = false;
    $hasErrors = false;
    $php_errormsg = "";

    $userId = $_GET['uid'];
    $token = $_GET['tk'];

    if (!$dataManager->isRegisteredUser($userId)) {
        header("Location:404");
    }
    elseif (!$dataManager->resetPasswordTokenMatches($userId, $token)) {
        $php_errormsg = "Invalid token";
    }

    if (isset($_POST["resetPassword"])) {
        $submitted = true;

        $pwd1 = isset($_POST['password']) ? $_POST['password'] : null;
        $pwd2 = isset($_POST['password_again']) ? $_POST['password_again'] : null;

        if ($pwd1 == null && $pwd2 == null) {
            $php_errormsg = "Invalid input";
        }
        elseif (trim($pwd1) == "" || trim($pwd2) == "") {
            $php_errormsg = "Please fill the fields";
        }
        elseif (!Validate::Password($pwd1)) {
            $php_errormsg = "Invalid password";
        }
        elseif ($pwd1 !== $pwd2) {
            $php_errormsg = "The passwords do not match";
        }
        else {
            $dataManager->userUpdatePassword($userId , $pwd1);
            $dataManager->deletePasswordResetToken($userId);
        }
    }

?>

<?php

    $pageName = "signin";
    $title = "Forgot Password";

?>

<?php require_once "include/header.php" ?>
    <body class="header-floated loaded colour-2">

<?php require_once "include/nav.php"; ?>
    <div id="content-wrapper">
        <div class="container-above-header">
        </div>
        <div class="blocks-container">

            <!-- BLOCK "TYPE 18" -->
            <div class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 wow fadeInUp">
                            <div class="form-block">
                                <img class="img-circle form-icon" src="img/icon-118.png" alt=""/>
                                <div class="form-wrapper">
                                    <div class="row">
                                        <div class="block-header">
                                            <h2 class="title">Reset password </h2>
                                        </div>
                                    </div>
                                    <form method="post">
                                        <?php
                                            $style = "style='color:red;background-color:white;font-weight:bold'";
                                            if ($submitted) {
                                                if ($php_errormsg !== "") {
                                                    echo "<div class='alert alert-danger' $style> $php_errormsg </div>";
                                                }
                                                else {
                                                    echo "<div class='alert alert-success'> You have successfully 
                                                    changed your password. You can now login <a href='signin'>here</a>
                                                    </div>";
                                                }
                                            }

                                        ?>

                                        <div class="field-entry">
                                            <label for="field-1">Password *</label>
                                            <input type="password" name="password" id="field-1"/>
                                        </div>
                                        <div class="field-entry">
                                            <label for="field-2">Confirm Password *</label>
                                            <input type="password" name="password_again" id="field-1"/>
                                        </div>
                                        <div class="button">Submit<input type="submit" name="resetPassword"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="clear"></div>

                    </div>
                </div>
            </div>


        </div>

    </div>

<?php require_once "include/footer.php"; ?>