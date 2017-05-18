<?php
    session_start();

    require_once "../vendor/autoload.php";

    $title = "Send Payment";

    $pagename = "givehelp";

    use MerryPayout\User;

    $user = new User();
    $user->checkAuth();
    $userInfo = $user->getDetails();

    $activeTransaction = $user->isPayer() || $user->isReceiver();

    $msg = "";

    if (isset($_POST['make_deposit'])) {
        $plan = $_POST['plan'];
        $planName = "";

        if ($user->isReceiver()) {
            $msg = "<div class='alert alert-danger'> You are a receiver so are not eligible for giving help for now.</div>";
        }
        elseif (!\MerryPayout\Validate::Number($plan)) {
            $msg = "<div class='alert alert-danger'>You must select a plan</div>";
        }
        else {
            $planName = "";
            switch ($plan) {
                case BASIC_PLAN_AMOUNT:
                    $planName = "basic";
                    break;
                case CLASSIC_PLAN_AMOUNT:
                    $planName = "classic";
                    break;
                case ADVANCED_PLAN_AMOUNT:
                    $planName = "advanced";
                    break;
            }
            $user->makeDonor($planName);
            $msg = "<div class='alert alert-success'>Your operation was successful , you will merged shortly</div>";
        }
    }

    if (isset($_POST['cancel_transaction'])) {
        $user->cancelTransaction();
    }

?>

<?php

    require_once "includes/header.php";

?>
<body>

<div class="wrapper ">


    <?php require_once "includes/side-bar.php"; ?>
    <!-- left-bar -->
    <div class="content comic-sans" id="content">

        <div class="overlay"></div>

        <?php require_once "includes/top-bar.php"; ?>
        <!-- /top-bar -->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row margin-top-30">
                        <div class="col-lg-6 col-md-12">

                            <?php if ($user->isValidForPH() && !$user->isPayer()) { ?>

                                <div class="alert alert-info">
                                    <strong>You will be merged shortly with a receiver.</strong>
                                </div>
                                <div>
                                    <form method='post'>
                                        <button type='submit' name='cancel_transaction' class='btn btn-info btn-round'>
                                            Undo Plan Selection
                                        </button>
                                    </form>
                                </div>

                            <?php }
                            elseif ($user->isPayer() || $user->isReceiver()) { ?>

                                <div class="alert alert-danger">
                                    <strong>You already have an active transaction going on.</strong>
                                </div>

                            <?php }
                            elseif ($user->isValidForGH()) { ?>

                                <div class="alert alert-info">
                                    <strong>You are a receiver so cannot give help right now.</strong>
                                </div>

                            <?php }
                            else { ?>

                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Deposit Form</h5>
                                    </div>
                                    <div class="panel-body">
                                        <p class="text-small margin-bottom-20">
                                            You are making a new investment with the selected payment method.
                                        </p>
                                        <form class="form form-horizontal" method="post">
                                            <?php
                                                if ($msg != "") {
                                                    echo $msg;
                                                }
                                            ?>
                                            <!-- xinput group-->
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Amount:</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
								<span class="input-group-addon bg">
									<i>‎₦</i>
								</span><select class="name_search form-control" id="amount" name="plan"
                                               tabindex="-1" style="display: none;"
                                               onchange="calcReturns()">
                                                            <option>Select a plan</option>
                                                            <option value="<?php echo BASIC_PLAN_AMOUNT; ?>">Basic
                                                                (<?php echo BASIC_PLAN_AMOUNT; ?>)
                                                            </option>
                                                            <option value="<?php echo CLASSIC_PLAN_AMOUNT; ?>">Classic
                                                                (<?php echo CLASSIC_PLAN_AMOUNT; ?>)
                                                            </option>
                                                            <option value="<?php echo ADVANCED_PLAN_AMOUNT; ?>">Advanced
                                                                (<?php echo ADVANCED_PLAN_AMOUNT; ?>)
                                                            </option>
                                                        </select>

                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                            </div>
                                            <!-- xinput group-->


                                            <!-- xselectize form   -->
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Method:</label>
                                                <div class="col-sm-8">
                                                    <select class="name_search form-control" name="method" tabindex="-1"
                                                            style="display: none;">
                                                        <option value="bank">Bank Deposit</option>
                                                        <option value="bank">Bank Transfer</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <!-- xselect form   -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input name="make_deposit" type="submit"
                                                           class="btn btn-success pull-right"
                                                           value="Make a Deposit">
                                                </div>
                                            </div>

                                            <div class="form-heading">
                                                Estimated Earnings
                                            </div>

                                            <!-- xinput group-->
                                            <!-- xinput group-->

                                            <!-- xinput group-->
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Total Return:</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
								<span class="input-group-addon bg">
									<i>‎₦</i>
								</span>
                                                        <input type="text" class="form-control"
                                                               placeholder="Total Return"
                                                               id="total-return" disabled="">
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                            </div>
                                            <!-- xinput group-->

                                            <script type="text/javascript">
                                                function calcReturns() {
                                                    var input_number = $("#amount").val();
                                                    input_number = $.trim(input_number);
                                                    input_number = Number(input_number);

                                                    total_return = input_number * 2;

                                                    $("#total-return").val(total_return);
                                                }
                                            </script>


                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>


            <!-- row -->
        </div>

    </div>


</div>
<!-- wrapper -->


<?php require_once "includes/footer.php"; ?>




