<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-Requested-With");
    header("Content-type: application/json");

    $timeout = 10;
    if (isset($_REQUEST['timeout'])) {
        $timeout = $_REQUEST["timeout"];
    }
    
    error_log("the output will be ready on: ".$timeout." s" );

    set_time_limit(0);
    sleep($timeout);

    $arr = array(
        "status" => "OK",
        "timeout" => $timeout
    );
    $productJSON = json_encode($arr);

    echo $productJSON;
?>