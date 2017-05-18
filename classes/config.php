<?php

namespace MerryPayout;

date_default_timezone_set('Africa/Lagos');

//------------- DATABASE CONFIGURATIONS ----------------------
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", '');
define("DB_NAME", 'nairabank');
define("DSN", "mysql:dbname=nairabank;host=localhost");
//-------------------------------------------------------------


define("VALID_PASSWORD_MIN_LENGTH", 1);

//------ SALT FOR TOKEN GENERATOR --------- //
define("TOKEN_SALT", "((WHHHiueo{d--9e_)j)ljoie%j5l*7");


define("MAX_PAYERS", 2);

define("APP_ROOT_DIR", "/merrypayout/");

//----------- Plans -------- //
define("BASIC_PLAN_AMOUNT", 5000);
define("CLASSIC_PLAN_AMOUNT", 10000);
define("ADVANCED_PLAN_AMOUNT", 20000);
    define("PRO_PLAN_AMOUNT", 50000);
    define("PROPLUS_PLAN_AMOUNT", 100000);
//--- GRACE INTERVAL -------//
define("GRACE_PERIOD", (60 * 60 * 12));
define ("INTERVAL", 'PT12H');

define("PROF_PIC_DIR", "/dashboard/upload/prof_pics/");