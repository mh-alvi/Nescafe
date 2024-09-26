<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

include_once('../datamodel/model_products.php');
include_once('../config/constants.php');

$product = new products($conn);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $param = json_decode(file_get_contents("php://input"));
    if (!empty($param->booth_id)) {
        $product->booth_id = $param->booth_id;
        $product->employee_id = $param->employee_id;

        $data = $product->getAttedance_by();
        if ($data->num_rows > 0) {
            $attendance_by["records"] = array();
            while ($row = $data->fetch_assoc()) {
                array_push($attendance_by["records"], array(
                    "Punch_In" => $row['punch_in'],
                    "Punch_Out" => $row['punch_out'],
                    "In_Location" => $row['in_location'],
                    "Out_Location" => $row['out_location'],
                    "In_Address" => $row['in_address'],
                    "Out_Address" => $row['out_address'],
                    "Attendance_Date" => $row['ad_date']
                ));
            }

            http_response_code(200);
            echo json_encode(array(
                "status" => true,
                "message" => "Data found",
                "data" => $attendance_by['records']
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
