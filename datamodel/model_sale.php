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

            $sql7 = "SELECT * FROM tbl_sales AS ts RIGHT JOIN tbl_sales_cal AS tsc ON ts.sales_cal_id = tsc.id WHERE product_id='$product_id' AND booth_id='$booth_id'";

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
            } else {

                $slq6 = "INSERT INTO tbl_sales_mini (total_used, total_waste, total_sales,product_id,tsm_booth_id) VALUES ('$sum_used', '$sum_waste', '$sum_sales','$product_id2','$booth_id2')";

                $res6 = mysqli_query($conn, $slq6);
            }


            if ($res4 == true) {

                $sql11 = "SELECT * FROM tbl_sales_mini WHERE product_id='$product_id' And tsm_booth_id='$booth_id2'";

                $row11 =  $conn->query($sql11);
                foreach ($row11 as $rows) {
                    $total_sales_s = $rows['total_sales'];
                    $total_waste_s = $rows['total_waste'];
                    $pro_id = $rows['product_id'];
                    $booth_id = $rows['tsm_booth_id'];

                    $sql12 = "SELECT * FROM tbl_stock_tagging WHERE product_id='$pro_id'";
                    $row12 = $conn->query($sql12);

                    while ($rrow = $row12->fetch_assoc()) {

                        // $ing_id = $rrow['product_stock_id'];
                        $fol_wst = $rrow['ingredient_quantity'] * $total_waste_s;
                        $fol_sale = $rrow['ingredient_quantity'] * $total_sales_s;

                        $current_wst = $rrow['stock_waste'] + $fol_wst;

                        $stids[] = [
                            'sId' => $rrow['product_stock_id'],
                            'qty' => $rrow['ingredient_quantity'],
                            'pid' => $rows2['product_id'],
                            'west' => $fol_wst,
                            'sales' => $fol_sale

                        ];
                        $result_waste = array_reduce($stids, function ($carry, $item) {
                            if (!isset($carry[$item['sId']])) {
                                $carry[$item['sId']] = ['sId' => $item['sId'], 'west' => $item['west'], 'sales' => $item['sales']];
                            } else {
                                $carry[$item['sId']]['west'] += $item['west'];
                            }
                            return $carry;
                        });
                    }
                }
                // print_r($result_waste);

                foreach ($result_waste as $key => $idata) {
                    $i_id = $idata['sId'];
                    $i_wst = $idata['west'];
                    $i_sales = $idata['sales'];


                    //    print_r("id =
                    //    ".$i_id.""."WST = ".$i_wst." ");
                    $sql11 = "SELECT * FROM tbl_stock_report WHERE booth_id='$booth_id' AND stock_id='$i_id'";
                    $res11 = mysqli_query($conn, $sql11);
                    $row11 = mysqli_fetch_assoc($res11);

                    $stk_price = $row11['stock_price'];
                    $total_stk = $row11['total_stock'];
                    $stk_damage = $row11['stock_damage'];

                    $pre_cls_stk = $i_sales + $i_wst + $stk_damage;
                    $closing_stock = $total_stk - $pre_cls_stk;

                    $total_stock_price = $stk_price * $i_sales;


                    $sd = "UPDATE tbl_stock_report SET stock_waste='$i_wst',stock_used='$i_sales', closing_stock='$closing_stock', total_stock_price='$total_stock_price' WHERE booth_id='$booth_id' AND stock_id='$i_id'";
                    $rsd = mysqli_query($conn, $sd);
                }
            }
        }

        if ($rsd) {
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
}
