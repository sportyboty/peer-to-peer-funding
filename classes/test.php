<?php
    /**
     * Created by PhpStorm.
     * User: Chibuzo
     * Date: 27-Feb-17
     * Time: 2:29 PM
     */

    $date = new DateTime('2000-01-01');
    $date->add(new DateInterval('PT24H'));
    echo $date->format('Y-m-d') . "\n";
?>