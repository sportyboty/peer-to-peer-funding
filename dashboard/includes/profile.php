<div class="alert alert-info"><strong>We want to notify you that merging of users stops 9pm everyday and start again
        by 8am.
        From 9pm we attend to user related issues on our live chat support.</strong></div>

<?php

$user = new \MerryPayout\User();
$user->checkAuth();
$userInfo = $user->getDetails();

$isPayer = $user->isPayer();
$isReceiver = $user->isValidForGH();
$activeTransaction = $user->isPayer() || $user->isReceiver();

$payerMsg = "";
$receiverMessages = array();

if ($user->isPayer()) {
    $expiry = $user->getExpiry();
    $now = time();
    $remSeconds = $expiry - $now;
    $remHours = ceil($remSeconds / 3600);
    $remSeconds = $remSeconds % 3600;

    $remMins = ceil($remSeconds / 60);
    $remSeconds = $remSeconds % 60;

    $countDown = "<strong style='color:red'> <span id='remHours'>$remHours</span> Hours : <span id='remMins'>$remMins</span> 
Mins : <span id='remSecs'>$remSeconds</span> Seconds </strong>";
}

if ($user->isAdmin()) {

    if ($user->isValidForPH() and !$isPayer) { // if the user is available for providing help and is not yet merged
        $payerMsg = $user->getInfo();
        echo "<div class='alert alert-info'> <strong>We shall merge you shortly with a receiver.</strong> </div>";
    }
    elseif ($user->isValidForGH() and !$activeTransaction) {
        echo "<div class='alert alert-info'><strong>Please wait while we merge you with an available donor soon
            .</strong></div>";
    }
    else {
        if ($isPayer) {
            $payerMsg = $user->getMessage();
            echo "<div class='alert alert-warning'> <strong>$payerMsg <br>
                Count Down Timer : <span id='countDown'>$countDown</span></strong></div>";
        }
        elseif ($isReceiver) {
            $receiverMessages = $user->getAllMessages();
            foreach ($receiverMessages as $msg) {
                echo "<div class='alert alert-info'><strong> $msg </strong></div>";
            }
        }
    }
}

if (!$user->isAdmin()) {


    if ($user->isValidForPH() and !$isPayer) { // if the user is available for providing help and is not yet merged
        $payerMsg = $user->getInfo();
        echo "<div class='alert alert-info'> <strong>We shall merge you shortly with a receiver.</strong> </div>";
    }
    elseif ($user->isValidForGH() and !$activeTransaction) {
        echo "<div class='alert alert-info'><strong>Please wait while we merge you with an available donor soon
            .</strong></div>";
    }
    else {
        if ($isPayer) {
            $payerMsg = $user->getMessage();
            echo "<div class='alert alert-warning'> <strong>$payerMsg <br>
                Count Down Timer : <span id='countDown'>$countDown</span></strong></div>";
        }
        elseif ($isReceiver) {
            $receiverMessages = $user->getAllMessages();
            foreach ($receiverMessages as $msg) {
                echo "<div class='alert alert-info'><strong> $msg </strong></div>";
            }
        }
    }
}
?>


<div class="col-md-4 nopad-right comic-sans">
    <div class="piluku-panel no-pad panel comic-sans">
        <div class="ios-profile-widget">
            <div class="header_cover">
                <img
                        src="<?php echo ($userInfo['prof_pic'] != null or $userInfo['prof_pic'] != "") ? 'upload/' .
                            $userInfo['prof_pic'] : '../images/one.png'; ?>"
                        alt="">
                <h3 class="comic-sans"><?php echo $userInfo['username']; ?></h3>
                <i class="ion ion-android-b/ulb"><span class="comic-sans"
                                                       style="text-transform: uppercase; color: #2ECC71;">
                        <?php echo
                        $userInfo['current_plan'] !=
                        null ? $userInfo['current_plan'] . "  " . 'Plan' : 'Free Member'; ?> </span> </i>
            </div>
            <!-- cover -->
            <ul class="list-inline interactive_btn comic-sans">
                <li>
                    <a href="edit_profile" class=""><i class="ion-android-settings"></i></a>
                </li>
                <li>
                    <a href="givehelp"><i class="ion-ios-plus"></i></a>
                </li>
                <li>
                    <a href="referral"><i class="ion-ios-people"></i></a>
                </li>
            </ul>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge site-green-background"
                    ><?php echo $userInfo["valid_for_ph"] == 1 ? "Yes"
                            : "No";
                        ?></span>
                    <strong class="comic-sans">Am I a donor</strong>
                </li>
                <li class="list-group-item">
                    <span class="badge site-green-background"
                    ><?php echo $userInfo["valid_for_gh"] == 1 ? "Yes" : "No" ?></span>
                    <strong class="comic-sans">Am I a receiver</strong>
                </li>
                <li class="list-group-item">
                    <span class="badge site-green-background"
                    ><?php echo $activeTransaction ? "Yes" : "No" ?></span>
                    <strong class="comic-sans">Do I have an active transaction</strong>
                </li>

            </ul>

        </div>
        <!-- ios-profile -->
    </div>
    <!-- panel -->
</div>
<script>
    seconds = document.getElementById("remSecs");
    minutes = document.getElementById("remMins");
    hours = document.getElementById("remHours");

    function countDown() {
        var secs = parseInt(seconds.innerText);
        if (secs > 0) {
            seconds.innerText = secs - 1 < 10 ? "0" + (secs - 1) : secs - 1;
        }
        else {
            resetSeconds();
            decreaseMins();
        }
    }
    function resetSeconds() {
        seconds.innerText = "59";
    }
    function decreaseMins() {
        var mins = parseInt(minutes.innerText);
        if (mins > 0) {
            minutes.innerText = mins - 1 < 10 ? "0" + (mins - 1) : mins - 1;
        }
        else {
            resetMins();
            decreaseHours();
        }
    }
    function resetMins() {
        minutes.innerText = "59";
    }
    function decreaseHours() {
        var hrs = parseInt(hours.innerText);
        if (hrs > 0) {
            hours.innerText = hrs - 1 < 10 ? "0" + (hrs - 1) : hrs - 1;
        }
        else {
            document.getElementById("countDown").innerText = "Your grace period has expired. You will soon be deactivated.";
        }
    }
    setInterval(function () {
        countDown();
    }, 1000);
</script>