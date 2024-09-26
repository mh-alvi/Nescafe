<?php

error_reporting(0);

include_once ('../datamodel/model_attendance.php');


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == 'POST'){

    $inputData=json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)){
        $attendance = attendance($_POST);
        
    }
    else{
        $attendance = attendance($inputData);
    }
    echo $attendance;

}
else{
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>