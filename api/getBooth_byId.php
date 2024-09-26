<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

include_once('../datamodel/model_booth.php');
include_once('../config/constants.php');

$booth = new boothz($conn);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $param = json_decode(file_get_contents("php://input"));
    if (!empty($param->id)) {
        $booth->id = $param->id;
        $data = $booth->getAllBoothInfo_byBooth();
        if ($data->num_rows > 0) {
            $boothinfo = array();
            while ($row = $data->fetch_assoc()) {
                $boothinfo = array(
                    "boothId" => $row['id'],
                    "boothName" => $row['booth_name'],
                    "boothAddress" => $row['booth_address'],
                    "boothCode" => $row['booth_code']
                );
            }

            http_response_code(200);
            echo json_encode(array(
                "status" => true,
                "message" => "Data found",
                "data" => $boothinfo
            ));
        } else {
            http_response_code(200);
            echo json_encode(array(

                "status" => false,
                "message" => "Data Not Found"

            ));
        }
    }
} else {
    http_response_code(503);
    echo json_encode(array(

        "status" => false,
        "message" => "Service not found",
        "data" => null
    ));
}
