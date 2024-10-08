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

            http_response_code(200);
            echo json_encode(array(
                "status" => true,
                "message" => "Already Punched In"
            ));
        } else {
            http_response_code(200);
            echo json_encode(array(

                "status" => false,
                "message" => "Not Yet Punch In"
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
