<?php
session_start();

error_reporting(E_WARNING);

require_once "../vendor/autoload.php";
use MerryPayout\User;

$title = "Confirm Payment";
$pagename = "confirmpayment";

$user = new User();
$user->checkAuth();

$php_errormsg = "";


if (isset($_POST['payerConfirm'])) {

    if (!\MerryPayout\Validate::Image($_FILES['file'])) {
        $php_errormsg = "<div class='alert alert-danger'>Invalid image format</div>";
    }
    else {
        $receiverId = $_POST['receiverId'];
        $img = $_FILES["file"]['name'];
        $img_tmp = $_FILES['file']['tmp_name'];
        $upload_dir = 'upload';
        move_uploaded_file($img_tmp, "$upload_dir/$img");
        $user->saveTellerImage($receiverId, $img);
        $php_errormsg = "<div class='alert alert-success'> Operation successful. Wait for confirmation by the receiver </div>";
    }
}
elseif (isset($_POST['receiverConfirm'])) {

    $payerId = $_POST['payerId'];
    $token = $_POST['token'];
    $testimonial = $_POST['testimonial'];
    $dbToken = $user->receiveToken($payerId);
    if (!\MerryPayout\Validate::String($testimonial) || $testimonial == null || $testimonial == "") {
        $php_errormsg = "<div class='alert alert-danger'>Invalid testimonial message</div>";
    }
    else {
        if ($token == $dbToken) {
            $user->confirmPayment($payerId, $testimonial);
            $php_errormsg = "<div class='alert alert-success' id='alert-success'>You have successfully confirmed this user and this action can not be reversed</div>";
        }
        $php_errormsg = "<div class='alert alert-danger'>Sorry you can not confirm the payment at this time, because the 
            token does not match this transaction token. Please try again.</div>";
    }

}
?>

<?php
$userInfo = $user->getDetails();
require_once "includes/header.php";

?>
<body>

<div class="wrapper comic-sans">


    <?php require_once "includes/side-bar.php"; ?>
    <!-- left-bar -->
    <div class="content" id="content">

        <div class="overlay"></div>

        <?php require_once "includes/top-bar.php"; ?>
        <!-- /top-bar -->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row margin-top-30">
                        <div class="col-lg-12 col-md-12">

                            <?php
                            if ($php_errormsg != "") {
                                echo($php_errormsg);
                            }
                            ?>
                            <div class="panel panel-heading alert alert-info">

                                <?php
                                if ($user->isPayer()) {
                                $receiverDetails = $user->getReceiverDetails();
                                ?>
                                <h5>You are confirming payment sent to</h5>
                                <label>Account Name: </label> <?php echo $receiverDetails["accName"]; ?> <br>
                                <label>Username: </label><?php echo $receiverDetails["username"]; ?> <br>
                                <label>Account Number: </label> <?php echo $receiverDetails["accNum"]; ?> <br>
                                <label>Phone Number: </label> <?php echo $receiverDetails["phoneNum"]; ?> <br>

                                <div class="panel-body">
                                    <p class="text-small margin-bottom-20">
                                        Upload your prove of payment. should be in this format.(jpg,png)
                                    </p>
                                    <form role="form" class="form form-horizontal" enctype="multipart/form-data"
                                          method="post">
                                        <input type="hidden" name="receiverId"
                                               value="<?php echo $receiverDetails['id']; ?>">
                                        <!-- xinput group-->
                                        <div class="form-group">
                                            <label class="col-sm-1">Picture Copy:</label>
                                            <div class="col-md-4">
                                                <input type="file" class="form-control"
                                                       placeholder="Desired Deposit Amount" name="file">
                                            </div>

                                        </div>

                                        <button type="submit" name="payerConfirm" class="btn btn-success btn-lg">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                elseif ($user->isReceiver()) {

                    $payers = $user->unconfirmedPayers();
                    $confirmedPayersCount = 0;
                    foreach ($payers as $payer) {
                        if ($user->payerHasConfirmed($payer["id"])) {
                            $confirmedPayersCount++;
                            ?>
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-12">
                                        <div class="panel panel-white">
                                            <div class="panel panel-body">
                                                <strong>You are confirming payment sent by:</strong><br>
                                                <label>Account Name: </label><?php echo $payer["accName"] ?><br>
                                                <label>Username: </label><?php echo $payer["username"] ?><br>
                                                <label>Phone Number: </label><?php echo $payer["phoneNum"] ?><br>
                                                <label>Teller Image:</label><br>
                                                <img class="img img-responsive"
                                                     src="upload/<?php echo $payer['teller_img']; ?>"><br>
                                                <div class="panel-body">
                                                    <form role="form" class="form form-horizontal"
                                                          enctype="multipart/form-data"
                                                          method="post">
                                                        <div class="col-md-4">
                                                            <input type="hidden" name="payerId"
                                                                   value="<?php echo $payer['id']; ?>">
                                                            <label for="token">Enter Token</label>
                                                            <input type="text" name="token" class="form-control"
                                                                   title="token">
                                                            <br>
                                                            <label for="testimony">Testimonial message</label>
                                                            <textarea maxlength="100" class="form-control"
                                                                      title="testimony" name="testimony"
                                                                      rows="4"></textarea>
                                                            <br><br>
                                                            <button type="submit" class="btn btn-lg btn-success"
                                                                    name="receiverConfirm">
                                                                Confirm
                                                            </button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                    if ($confirmedPayersCount == 0) {
                        echo "<br><div class='alert alert-info'>None of your payers has confirmed payment </div>";
                    }
                }
                ?>
                <!-- row -->
            </div>

        </div>


    </div>
    <!-- wrapper -->


    <?php require_once "includes/footer.php"; ?>




