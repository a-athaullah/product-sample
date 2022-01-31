<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-type: application/json");


$db_host = "ec2-3-223-39-179.compute-1.amazonaws.com";
$db_name = "d86udt7janmlla";
$db_user = "jtmddppfbrldjg";
$db_pass = "77b896d58bb593c0713a12d018abbde5a21ae95d78a7abbd387fe92ab78ed327";
$db_port = "5432";

$db_conn_string = "host=".$db_host." port=".$db_port." dbname=".$db_name." user=".$db_user." password=".$db_pass;

$db = pg_connect($db_conn_string);

if (!$db) {
    echo "DB error occurred.\n";
    exit;
}

$query = "SELECT title,url,subtitle,image_url,description,button_text FROM product";

if (isset($_REQUEST['keyword'])){
    $keyword = strtolower ( $_REQUEST['keyword'] );
    $query = $query." WHERE LOWER(title) LIKE '%".$keyword."%'";
}


$query .= " LIMIT 5";

// echo $query;

$result = pg_query($db, $query);
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$arr = pg_fetch_all($result);

pg_close($db);  
// print_r($arr);

$productJSON = json_encode($arr);

echo $productJSON;



?>
