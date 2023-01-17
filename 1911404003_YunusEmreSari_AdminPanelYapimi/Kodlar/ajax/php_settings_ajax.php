<?php

    include("../dbConnect.php");

    set_time_limit(500); //File get contents için maksimum zaman aşımı (saniye)
    date_default_timezone_set('Europe/Istanbul');
    $datetime_now = date("Y-m-d H:i:s",strtotime("+6 days"));
    $date_now_str = strtotime($datetime_now);

?>