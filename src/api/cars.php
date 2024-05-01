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

$action = "";

if(isset($_GET["action"]))
{
    $action = $_GET["action"];
}

function generateRandomString($length = 10)
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLNOPQRSTUVWXYZ";
    $characters_length = strlen($characters);
    $random_string = "";
    for($i = 0; $i < $length; $i++)
    {
        $random_string .= $characters[rand(0, $characters_length - 1)];
    }

    return $random_string;
}
//CRUD
if($action == "read")
{
    $results["calling_read"] = true;
}

if($action == "update")
{
   //files
   $img_name = "";
   $upload_path = "";

   if(isset($_FILES["image"]["name"]))
   {
        $img_name = $_FILES["image"]["name"];
        $valid_extensions = array("png", "jpeg", "jpg", "gif");
        $extensions = pathinfo($img_name, PATHINFO_EXTENSION);
        if(in_array($extensions, $valid_extensions))
        {
            $new_generated_id = generateRandomString(75);
            $upload_path = '../assets/cars/' . $new_generated_id . "." . $extensions;

            if(file_exists($upload_path))
            {
                $new_generated_id = generateRandomString(75);
                $img_name = $new_generated_id . "." . $extensions;
            }else{
                $img_name = $new_generated_id . "." . $extensions;
            }
        }else{
            $results["error"] = true;
            $results["message"] = "Car Image must be: PNG, JPEG, JPG, or GIF";
        }
   } else{
        $results["error"] = true;
        $results["message"] = "Please Select a Car Image";
   }
   $results["newImageUploaded"] = $img_name;

   if($img_name != "" && $upload_path != "")
   {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $modelYear = $_POST["modelYear"];

        if(move_uploaded_file($_FILES["image"]["tmp_name"], $upload_path))
        {
            $results["added_new_car"] = true;
            //insert into database
            $sql = mysql_query("insert into `car` 
            (name, price, description, image, modelYear) 
            values 
            ('$name', '$price', '$description', '$img_name', '$modelYear') ");

            if($sql) 
            {
                $results["error"] = false;
                $results["message"] = "Added New Car Successfully!";
                $results["added_data"] = true;

            }else{
                $results["error"] = true;
                $results["message"] = "Failed Saving the Car";
                $results["added_new_car"] = false;
            }
            
        }else {
            $results["error"] = true;
            $results["message"] = "Failed saving the car image";
            $results["added_new_car"] = false;
        }
   }
}

echo json_encode($results);
$mysqli->close();