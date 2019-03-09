<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
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

if (isset($_REQUEST['title']) && 
    isset($_REQUEST['subtitle']) &&
    isset($_REQUEST['description']) &&
    isset($_REQUEST['image_url']) &&
    isset($_REQUEST['url']) &&
    isset($_REQUEST['button_text'])
    ){
        $title = $_REQUEST['title'];
        $subtitle = $_REQUEST['subtitle'];
        $description = $_REQUEST['description'];
        $image = $_REQUEST['image_url'];
        $url = $_REQUEST['url'];
        $button = $_REQUEST['button_text'];

        $optQuery = "INSERT INTO product (title,url,subtitle,image_url,description,button_text) VALUES ('$title','$url','$subtitle','$image','$button') RETURNING id;";
        $optQueryExec = pg_query($db,$optQuery);

        echo '{"status":200,"message":"1 data inserted}';
    }else{
        http_response_code(400);
    }
    pg_close($db);
?>