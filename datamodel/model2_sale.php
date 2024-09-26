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

function storeSales($salesInput)
{

    global $conn;

    if (!empty($salesInput)) {
        //table sales calculation

        date_default_timezone_set('Asia/Dhaka'); // CDT
        $current_date = date('d-m-Y | H:i:s');
        $booth_id = mysqli_real_escape_string($conn, $salesInput['booth_id']);
        $due = mysqli_real_escape_string($conn, $salesInput['due']);
        $other = mysqli_real_escape_string($conn, $salesInput['other']);
        $expense_item = mysqli_real_escape_string($conn, $salesInput['expense_item']);
        $expense = mysqli_real_escape_string($conn, $salesInput['expense']);
        $total_expense = mysqli_real_escape_string($conn, $salesInput['total_expense']);
        $collection = mysqli_real_escape_string($conn, $salesInput['collection']);
        $total_cash = mysqli_real_escape_string($conn, $salesInput['total_cash']);
        $created_by = mysqli_real_escape_string($conn, $salesInput['created_by']);
        $sales_date = mysqli_real_escape_string($conn, $salesInput['sales_date']);

        $sql = "INSERT INTO tbl_sales_cal (booth_id, due, other, expense_item, expense, total_expense, collection, total_cash, created_at, created_by, sales_date_cal) VALUES ('$booth_id', '$due', '$other', '$expense_item', '$expense', '$total_expense', '$collection', '$total_cash', '$current_date', '$created_by', '$sales_date')";

        $res = mysqli_query($conn, $sql);


        if ($res == true) {
            $sql2 = "SELECT * FROM tbl_sales_cal";
            $res2 = mysqli_query($conn, $sql2);
            $count = mysqli_num_rows($res2);
            if ($count > 0) {
                while ($data = mysqli_fetch_assoc($res2)) {
                    $sales_cal_id = $data['id'];
                }
            }
        }

        $s = $salesInput['product_list'];

        foreach ($s as $row) {
            //table sales
            date_default_timezone_set('Asia/Dhaka'); // CDT
            $current_date1 = date('d-m-Y | H:i:s');
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $opening = $row['opening'];
            $closing = $row['closing'];
            $wastage = $row['wastage'];
            $sales = $row['sales'];
            $total = $row['total'];
            $created_by1 = $row['created_by'];
            $sales_date1 = $row['sales_date'];

            $sql3 = "INSERT INTO tbl_sales (product_id, product_name, opening, closing, wastage, sales, total, created_at, created_by, sales_date, sales_cal_id) VALUES ('$product_id', '$product_name', '$opening', '$closing', '$wastage', '$sales', '$total', '$current_date1', '$created_by1', '$sales_date1', '$sales_cal_id')";

            $res3 = mysqli_query($conn, $sql3);

            $sql7 = "SELECT * FROM tbl_sales AS ts RIGHT JOIN tbl_sales_cal AS tsc ON ts.sales_cal_id = tsc.id WHERE product_id='$product_id'";

            $res7 = mysqli_query($conn, $sql7);
            $rows7 = mysqli_fetch_assoc($res7);
            $booth_id2 = $rows7['booth_id'];
            $product_id2 = $rows7['product_id'];

            $sql4 = "SELECT * FROM tbl_sales_mini WHERE product_id='$product_id2' AND tsm_booth_id='$booth_id2'";
            $res4 = mysqli_query($conn, $sql4);
            $rows2 = mysqli_fetch_assoc($res4);
            $s_total_used = $rows2['total_used'];
            $s_total_waste = $rows2['total_waste'];
            $s_total_sales = $rows2['total_sales'];

            $sum_used = $s_total_used + $total;
            $sum_waste = $s_total_waste + $wastage;
            $sum_sales = $s_total_sales + $sales;

            if ($s_total_sales > 0) {
                $slq5 = "UPDATE tbl_sales_mini SET total_used='$sum_used', total_waste='$sum_waste', total_sales='$sum_sales' WHERE product_id='$product_id2' AND tsm_booth_id='$booth_id2'";

                $res5 = mysqli_query($conn, $slq5);

                if ($res5 == true) {

                    $sql11 = "SELECT * FROM tbl_sales_mini WHERE product_id='$product_id' And tsm_booth_id='$booth_id2'";

                    $row11 =  $conn->query($sql11);
                    foreach ($row11 as $rows) {
                        $total_sales_s = $rows['total_sales'];
                        $total_waste_s = $rows['total_waste'];
                        $pro_id = $rows['product_id'];
                        $booth_id = $rows['tsm_booth_id'];

                        $sql12 = "SELECT * FROM tbl_stock_tagging WHERE product_id='$pro_id'";
                        $row12 =   $conn->query($sql12);

                        foreach ($row12 as $rows2) {
                            $ing_id = $rows2['product_stock_id'];
                            $ing_qty = $rows2['ingredient_quantity'];
                            $pro_id = $rows2['product_id'];

                            // $up_tsr2 = "SELECT * FROM tbl_stock_report WHERE booth_id='$booth_id' AND stock_id='$ing_id'";
                            // $res_tsr2 = mysqli_query($conn, $up_tsr2);

                            // $rowr2 = mysqli_fetch_assoc($res_tsr2);

                            // $stk_used = $rowr2['stock_used'];
                            // $stk_waste = $rowr2['stock_waste'];

                            $waste_cal = $ing_qty * $total_waste_s;
                        

                            // $waste_cals = $stk_waste + $waste_cal;
                            print_r($$dataz);


                            $sales_cal = $ing_qty * $total_sales_s;

                            $up_tsr = "UPDATE tbl_stock_report SET stock_waste='$waste_cal', stock_used='$sales_cal' WHERE booth_id='$booth_id' AND stock_id='$ing_id'";
                            $res_tsr = mysqli_query($conn, $up_tsr);
                        }
                    }
                }
            } else {

                $slq6 = "INSERT INTO tbl_sales_mini (total_used, total_waste, total_sales,product_id,tsm_booth_id) VALUES ('$sum_used', '$sum_waste', '$sum_sales','$product_id2','$booth_id2')";

                $res6 = mysqli_query($conn, $slq6);
            }


            if ($res6 == true) {

                $sql11 = "SELECT * FROM tbl_sales_mini WHERE product_id='$product_id' And tsm_booth_id='$booth_id2'";

                $row11 =  $conn->query($sql11);
                foreach ($row11 as $rows) {
                    $total_sales_s = $rows['total_sales'];
                    $total_waste_s = $rows['total_waste'];
                    $pro_id = $rows['product_id'];
                    $booth_id = $rows['tsm_booth_id'];

                    $sql12 = "SELECT * FROM tbl_stock_tagging WHERE product_id='$pro_id'";
                    $row12 =   $conn->query($sql12);


                    foreach ($row12 as $rows2) {
                        $ing_id = $rows2['product_stock_id'];
                        $ing_qty = $rows2['ingredient_quantity'];
                        $pro_id = $rows2['product_id'];

                        // $up_tsr2 = "SELECT * FROM tbl_stock_report WHERE booth_id='$booth_id' AND stock_id='$ing_id'";
                        // $res_tsr2 = mysqli_query($conn, $up_tsr2);

                        // $rowr2 = mysqli_fetch_assoc($res_tsr2);

                        // $stk_used = $rowr2['stock_used'];
                        // $stk_waste = $rowr2['stock_waste'];
                        // $waste_cals = $stk_waste + $waste_cal;

                        $waste_cal += $ing_qty * $total_waste_s;
                        print_r($waste_cal);

                        $sales_cal = $ing_qty * $total_sales_s;

                        $up_tsr = "UPDATE tbl_stock_report SET stock_waste='$waste_cal',stock_used='$sales_cal' WHERE booth_id='$booth_id' AND stock_id='$ing_id'";
                        $res_tsr = mysqli_query($conn, $up_tsr);
                    }
                }
            }
        }
    }


    if ($res_tsr) {
        http_response_code(200);
        $data = [
            'status' => true,
            'message' => 'Sales Posting Successfull!!',
        ];
        // header("HTTP/1.0 200 Created");
        echo json_encode($data);
    } else {
        http_response_code(200);
        $data = [
            'status' => false,
            'message' => 'Sales Posting Failed!!',
        ];
        // header("HTTP/1.0 200 Unprocessable Entity");
        echo json_encode($data);
    }
}
