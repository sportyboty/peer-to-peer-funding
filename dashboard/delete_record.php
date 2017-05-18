<?php

include_once "../classes/DataManager.php";

if (isset($_GET['t_id'])) {
    $transaction_id = $_GET['t_id'];
    $dataManager = new \MerryPayout\DataManager();
    $dataManager->deleteMergeRecord($transaction_id);
    header("Location:view_merged_users");
}