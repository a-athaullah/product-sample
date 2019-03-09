<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-type: application/json");


$db_host = "ec2-174-129-236-21.compute-1.amazonaws.com";
$db_name = "d39pgl7bkn08d4";
$db_user = "efzoujkkvdnkkp";
$db_pass = "b8149b10a3c2a78eff917d1d0162e3fe800bd1283916b57f4e82265f6fe0b3f2";
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
