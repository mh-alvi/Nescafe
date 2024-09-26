<?php

include_once('../config/constants.php');

function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}

function attendance($attendanceInput)
{

    global $conn;

    if (!empty($attendanceInput)) {
        //table sales calculation

        date_default_timezone_set('Asia/Dhaka'); // CDT
        $current_date = date('d-m-Y');
        $emp_id = mysqli_real_escape_string($conn, $attendanceInput['emp_id']);
        $booth_id = mysqli_real_escape_string($conn, $attendanceInput['booth_id']);
        $time = mysqli_real_escape_string($conn, $attendanceInput['time']);
        $address = mysqli_real_escape_string($conn, $attendanceInput['address']);
        $location = mysqli_real_escape_string($conn, $attendanceInput['location']);
        $type = mysqli_real_escape_string($conn, $attendanceInput['type']);

        if($type == 1){
            // Punch in data
            $sql = "INSERT INTO tbl_attendance (employee_id, booth_id, punch_in, in_location, in_address, ad_date) VALUES ('$emp_id', '$booth_id', '$time', '$location', '$address', '$current_date')";

            $res = mysqli_query($conn, $sql);
        }
        else{
            //punch out data
            $sql2 = "SELECT * FROM tbl_attendance WHERE employee_id='$emp_id' AND ad_date='$current_date'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
            $data = mysqli_fetch_assoc($res2);
            $atd_id = $data['id'];
             
            $sql3 = "UPDATE tbl_attendance SET punch_out='$time', out_location='$location', out_address='$address' WHERE id='$atd_id'";

            $res = mysqli_query($conn, $sql3);
            }
        }
        

        if ($res) {
            http_response_code(200);
            $data = [
                'status' => true,
                'message' => 'Attendance Successfull!!',
            ];
            // header("HTTP/1.0 200 Created");
            echo json_encode($data);
        } else {
            http_response_code(200);
            $data = [
                'status' => false,
                'message' => 'Attendance Failed!!',
            ];
            // header("HTTP/1.0 200 Unprocessable Entity");
            echo json_encode($data);
        }
    }
}