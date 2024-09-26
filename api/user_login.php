<?php
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=utf-8");

include_once('../config/constants.php');
include_once('../datamodel/model_user.php');


$user = new user($conn);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $param = json_decode(file_get_contents("php://input"));
    if (!empty($param->username) && !empty($param->password)) {
        $user->username = $param->username;
        $user->password = $param->password;

        $data = $user->login();
        if (!empty($row = $data->fetch_assoc())) {
            $em_id = $row['employee_id'];
            $employee_recordz = array();

             $sql = "SELECT * FROM tbl_authentication AS ta RIGHT JOIN tbl_employee AS te ON ta.employee_id = te.id
             RIGHT JOIN tbl_employee_details AS ted ON (ta.employee_id = te.id AND te.employee_details_id = ted.id) WHERE ta.employee_id=$em_id";

             $sql2 = "SELECT * FROM tbl_tagging AS tt RIGHT JOIN tbl_booth AS tb ON tb.id = tt.booth_id
             WHERE tt.employee_id=$em_id";

            $res = mysqli_query($conn, $sql);
            $res2 = mysqli_query($conn, $sql2);
            if ($res && $res2 == true) {
                $row2 = mysqli_fetch_assoc($res);
                $row3 = mysqli_fetch_assoc($res2);

                $employee_recordz=array(
                    "empId" => $row['employee_id'],
                    "userName" => $row2['employee_name'],
                    "userJobId" => $row2['job_id'],
                    "userJoindate" => $row2['join_date'],
                    "userBoothId" => $row2['booth_id'],
                    "userDesignation" => $row2['em_designation'],
                    "userEmail" => $row2['em_email'],
                    "userPhone" => $row2['em_phone'],
                    "userGender" => $row2['em_gender'],
                    "userImage" => $row2['image_name'],
                    "userBoothName" => $row3['booth_name'],
                    "userBoothAddress" => $row3['booth_address']

                );
            }
            http_response_code(200);
            echo json_encode(array(

                "status" => true,
                "message" => "Login Successfully!!",
                "data" => $employee_recordz

            ));
        } else {
            http_response_code(200);
            echo json_encode(array(

                "status" => false,
                "message" => "Employee Not Found"

            ));
        }
    } else {
        http_response_code(503);
        echo json_encode(array(

            "status" => false,
            "message" => "All Data Needed"

        ));
    }
}
