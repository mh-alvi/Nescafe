<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);

$search_value = $data['search'];

// $search_value = isset($_GET['id']) ? $_GET['id'] : die();

include('../config/constants.php');

$sql = "SELECT * FROM tbl_authentication WHERE id LIKE '%{$search_value}%'";
$res = mysqli_query($conn, $sql);

if($res == true){
    $count = mysqli_num_rows($res);
    if($count > 0){
        while ($rows = mysqli_fetch_assoc($res)) {
            echo json_encode($rows);
        }
    }else{
        echo json_encode(array('message' => 'No Search Found.', 'status' => false));
    }
}

?>