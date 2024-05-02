<?php

header('Access-Control-Allow-Origin: *');

$host = '127.0.0.1';
$db = 'vue_php_car_shop';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$action = "";

if(isset($_GET["action"]))
{
    $action = $_GET["action"];
}

if (isset($_GET['action']) && $_GET['action'] === 'post') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["carName"], $_POST["carPrice"], $_POST["carDescription"], $_POST["carModelYear"], $_POST["carImage"])) {
        
            $carName = $_POST["carName"];
            $carPrice = $_POST["carPrice"];
            $carDescription = $_POST["carDescription"];
            $carModelYear = $_POST["carModelYear"];
            
            // Extract and decode the base64 encoded image data
            $base64_image = $_POST["carImage"];
            $base64_image = str_replace('data:image/jpeg;base64,', '', $base64_image);
            $base64_image = str_replace(' ', '+', $base64_image);
            $image_data = base64_decode($base64_image);
            
            // Set the image filename and destination
            $img_name = uniqid() . '.jpg';
            $img_destination = "../assets/images/cars/" . $img_name;

            // Save the image to the destination folder
            if (file_put_contents($img_destination, $image_data)) {
            
                $sql = "INSERT INTO car (name, price, description, image, carModelYear) VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$carName, $carPrice, $carDescription, $img_name, $carModelYear]);
                
                // Send a response indicating success
                http_response_code(201);
                echo json_encode(array("message" => "Car added Successfully"));
            } else {
                // If saving the image fails
                http_response_code(500);
                echo json_encode(array("message" => "Failed to save image"));
            }
        } else {
            // If any required field is missing
            http_response_code(400);
            echo json_encode(array("message" => "Missing required fields"));
        }
    } else {
        // If the request method is not POST
        http_response_code(405);
        echo json_encode(array("message" => "Method Not Allowed"));
    }
} else {
    // If the action is not "post"
    http_response_code(400);
    echo json_encode(array("message" => "Invalid action"));
}
