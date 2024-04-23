<?php
header('Access-Control-Allow-Origin: *');

//DB connection parameters
$host = "localhost";
$username = "root";
$password = "";
$db_name = "vue_php_car_shop";

$mysqli = new mysqli($host, $username, $password, $db_name);

//Check connection

if($mysqli->connect_errno) 
{
    $results = [
        "error" => true,
        "message" => "Error: " .$mysqli->connect_error
    ];
}else 
{
    $results = [
        "error" => false,
        "message" => "Successfully Connected!"
    ];
}

$mysqli->close();

echo json_encode($results);