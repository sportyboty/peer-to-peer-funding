<?php


    namespace MerryPayout;

    use MerryPayout\exceptions\MerryPayoutUserException;

    require_once "config.php";

    class Merger extends Queryable {

        private $planManager;

        public function __construct() {
            parent::__construct();
            $this->planManager = new PlanManager();
        }

        /**
         * @param int $payerId
         * @param int $payeeId
         * @throws MerryPayoutUserException
         * @throws \Exception
         */
        public function merge(int $payerId, int $payeeId) {

            // First of all check if the participants are both activated
            try {
                if (!$this->dm->isActivated($payerId)) {
                    throw new MerryPayoutUserException("This user is not activated", $payerId);
                }
                elseif (!$this->dm->isActivated($payeeId)) {
                    throw new MerryPayoutUserException("This user is not activated", $payeeId);
                }
                else {
                    if (!$this->dm->isValidForGH($payeeId)) {
                        $payeeUsername = $this->dm->getUsername($payeeId);
                        throw new MerryPayoutUserException("The user <strong>{$payeeUsername}</strong> is not eligible
                         to receive help", $payeeId);
                    }
                    elseif (!$this->dm->isValidForPH($payerId)) {
                        $payerUsername = $this->dm->getUsername($payerId);
                        throw new MerryPayoutUserException("The user <strong>{$payerUsername}</strong> is not eligible to provide help", $payerId);
                    }
                    else {

                        $receiveHistoryCount = $this->dm->getReceiveHistoryCount($payeeId);
                        if ($receiveHistoryCount != 0 and $receiveHistoryCount % MAX_PAYERS == 0) {
                            throw new MerryPayoutUserException("The user already has " . MAX_PAYERS . " payers",
                                $payeeId);
                        }
                        else {
                            // Check if the user is already merged with the system max payers
                            $payersCount = $this->dm->getPayersCount($payeeId);
                            if ($payersCount >= MAX_PAYERS) {
                                $payeeUsername = $this->dm->getUsername($payeeId);
                                throw new MerryPayoutUserException("The user <strong>{$payeeUsername}</strong> already has " .
                                    MAX_PAYERS . " payers", $payeeId);
                            }
                            else {
                                // Both parties are eligible for transaction
                                // Calculate the amount to be paid to the payee
                                $amountToPay = $this->calculateAmountToBePaid($payerId, $payeeId);

                                // Send notification to the receiver and the payer. This message is seen in the user
                                // profile page
                                $payerDetails = $this->dm->getUserDetails($payerId);
                                $receiverDetails = $this->dm->getUserDetails($payeeId);

                                $date = date('d-m-Y');
                                $expiryDate = $this->calculateExpiry();
                                $showExpiry = new \DateTime($date);
                                $showExpiry = $showExpiry->add(new \DateInterval(INTERVAL))->format('d-m-Y');

                                // Generate token for the receiver to confirm
                                $receiverConfirmationToken = TokenGenerator::generateReceiverConfirmationToken();

                                $msgToReceiver = "<div>You have been merged to receive 
                        ‎₦{$amountToPay} from {$payerDetails["accName"]} on " . date('d-m-Y') . ".<br> Payer phone 
                        number is: {$payerDetails["phoneNum"]} .<br> Please 
                        confirm payment once you have been funded by the payer.<br>Transaction token: {$receiverConfirmationToken}</div>";

                                $msgToPayer = "You have been merged to pay the sum of ‎₦{$amountToPay}  to<br>  Bank Name: 
                        {$receiverDetails['bankName']} <br>
                            Account Name: {$receiverDetails['accName']} <br> Account Number: 
                            {$receiverDetails['accNum']} <br> on " . date('d-m-Y') . ".<br>Please pay before 
                            <strong style='color:red'>{$showExpiry}</strong> to avoid deactivation of your account
                            .<br>Receiver phone number is: 
                            {$receiverDetails['phoneNum']} <br> You will be confirmed by the receiver once you make 
                            the transaction.<br>";

                                $receiverUsername = $this->dm->getUsername($payeeId);

                                // Save the transaction in the merge table
                                $this->dm->mergeUsers($payeeId, $payerId, $amountToPay, $msgToReceiver, $msgToPayer, $date,
                                    $expiryDate, $receiverConfirmationToken);
                                $app = new App();

                                $app->sendReceiverConfirmationToken($receiverDetails['email'], $receiverUsername,
                                    $receiverConfirmationToken,
                                    $payerDetails["accName"], $payerDetails["username"]);
                            }
                        }
                    }
                }
            }
            catch (\PDOException $e) {
                throw new \PDOException("Error Processing Request " . $e->getMessage());
            }
        }

        public function sendPayerConfirmMsg($payerId) {
            $payerDetails = $this->dm->getUserDetails($payerId);

            $msg = "This payer has confirmed payment to your account.<br> 
        <label>Name: </label> {$payerDetails['accName']}<br>Please go to the confirm payment page and confirm his 
        payment.";

            $this->dm->updateReceiverMsg($payerId, $msg);
        }


        private function calculateExpiry() {
            return time() + GRACE_PERIOD;
        }

        private function calculateAmountToBePaid(int $payerId, int $payeeId) : int {
            $plan = $this->dm->getUserPlan($payerId);
            $amount = $this->planManager->getPlanValue($plan);
            $bonus = $this->dm->getReferralBonus($payeeId);
            $amountToPay = $amount + $bonus;

            return $amountToPay;
        }

        public function mergeAllUsers() {
            $validReceivers = $this->dm->getAllValidReceivers();
            //$donorsCount = $this->dm->getDonorsCount();
            $validReceiversCount = count($validReceivers);
            if ($validReceiversCount > 0) {
                foreach ($validReceivers as $receiver) {

                    //$payersCount = $this->dm->getPayersCount($receiver['id']);

                    //while ($payersCount != null && $donorsCount > 0 && $payersCount < 2) {
                    $payerId = $this->dm->getValidPayer($receiver["current_plan"]);
                    $payeeId = $receiver["id"];
                    //if ($payerId != null) {
                    try {
                        $this->merge($payerId, $payeeId);
                        //$payersCount++;
                        //$donorsCount--;
                    }
                    catch (\Exception $e) {
                        continue;
                    }
//                        }
                    //}
                }
            }
        }
    }