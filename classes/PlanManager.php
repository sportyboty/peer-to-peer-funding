<?php

namespace MerryPayout;

require_once "config.php";

class PlanManager extends Queryable {

    public function __construct() {
        parent::__construct();
    }

    public static function getPlanValue(string $plan) : int {
        $amount = 0;
        switch ($plan) {
            case "basic":
                $amount = BASIC_PLAN_AMOUNT;
                break;
            case "classic":
                $amount = CLASSIC_PLAN_AMOUNT;
                break;
            case "advanced":
                $amount = ADVANCED_PLAN_AMOUNT;
                break;
            case "professional":
                $amount = PRO_PLAN_AMOUNT;
                break;
            case "proplus":
                $amount = PROPLUS_PLAN_AMOUNT;
                break;
        }
        return $amount;
    }
}