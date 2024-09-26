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

function stockPosting($stockInput)
{

    global $conn;

    if (!empty($stockInput)) {
        //table sales calculation

        $s = $stockInput;
        foreach ($s as $row) {
            date_default_timezone_set('Asia/Dhaka'); // CDT
            $current_date = date('d-m-Y | H:i:s');
            $booth_id = $row['booth_id'];
            $created_by = $row['created_by'];
            $posting_date = $row['posting_date'];
            $product_stock_id = $row['product_stock_id'];
            $ing_price = $row['ing_price'];
            $ing_receive = $row['ing_receive'];
            $ing_opening = $row['ing_opening'];
            $ing_damage = $row['ing_damage'];


            $sql5 = "SELECT * FROM tbl_stock WHERE product_stock_id='$product_stock_id' AND booth_id='$booth_id'";
            $res5 = mysqli_query($conn, $sql5);

            $rows = mysqli_fetch_assoc($res5);
            $ing_receive2 = $rows['ing_receive'];
            $booth_id2 = $rows['booth_id'];

            if ($ing_receive2 > 0) {

                $sql7 = "SELECT * FROM tbl_stock WHERE product_stock_id='$product_stock_id' AND booth_id='$booth_id2'";
                $res7 = mysqli_query($conn, $sql7);

                $data2 = mysqli_fetch_assoc($res7);
                $stock_qty = $data2['ing_receive'];
                $stock_dmg = $data2['ing_damage'];


                if ($stock_qty > 0) {
                    $sum2 = $stock_qty + $ing_receive;
                    $sum3 = $stock_dmg + $ing_damage;
                } else {
                    $sum2 = $ing_receive;
                    $sum3 = $ing_damage;
                }

                if ($res7 == true) {
                    $sql8 = "UPDATE tbl_stock SET ing_receive='$sum2', ing_opening='$ing_opening', ing_damage='$sum3' WHERE product_stock_id='$product_stock_id' AND booth_id='$booth_id'";

                    $res8 = mysqli_query($conn, $sql8);
                }
            } else {
                $sql = "INSERT INTO tbl_stock (ing_price, ing_receive, ing_opening, ing_damage, product_stock_id, booth_id, created_at, created_by, posting_date) VALUES ('$ing_price', '$ing_receive', '$ing_opening', '$ing_damage', '$product_stock_id', '$booth_id', '$current_date', '$created_by', '$posting_date')";

                $res = mysqli_query($conn, $sql);
            }

            if ($ing_receive > 0) {
                $sqls = "SELECT SUM(ing_opening) AS Opening FROM tbl_stock WHERE product_stock_id='$product_stock_id'";

                $ress = mysqli_query($conn, $sqls);
                $data = mysqli_fetch_assoc($ress);
                $opening_sum = $data['Opening'];

                $sql10 = "SELECT * FROM tbl_product_stock WHERE id='$product_stock_id'";
                $res10 = mysqli_query($conn, $sql10);

                if ($res10 == true) {
                    $count = mysqli_num_rows($res10);
                    if ($count > 0) {
                        while ($rows3 = mysqli_fetch_assoc($res10)) {
                            $stk_qty = $rows3['stock_quantity'];
                            $stk_damage = $rows3['stock_damage_pro'];
                            $opening_stock = $rows3['opening_stock_pro'];

                            $stk_qty2 = $stk_qty + $ing_receive;
                            $stk_dmg = $stk_damage + $ing_damage;
                        }
                    }
                }
                $sql4 = "UPDATE tbl_product_stock SET stock_quantity='$stk_qty2', opening_stock_pro='$opening_sum', stock_damage_pro='$stk_dmg' WHERE id='$product_stock_id'";
                $res = mysqli_query($conn, $sql4);


                $sql9 = "SELECT * FROM tbl_stock_report WHERE stock_id='$product_stock_id' AND booth_id='$booth_id'";
                $res9 = mysqli_query($conn, $sql9);
                $rows2 = mysqli_fetch_assoc($res9);
                $stock_receive2 = $rows2['stock_receive'];
                $opening_stock2 = $rows2['opening_stock'];
                $stk_dmg2 = $rows2['stock_damage'];

                $total_stock = $sum2 + $opening_stock2;
                $stock_damage = $stk_dmg2 + $ing_damage;

                if ($stock_receive2 > 0) {
                    $slq2 = "UPDATE tbl_stock_report SET stock_receive='$sum2', opening_stock='$ing_opening', total_stock='$total_stock', stock_damage='$stock_damage' WHERE stock_id='$product_stock_id'";
                    $res = mysqli_query($conn, $slq2);
                } else {
                    $slq = "INSERT INTO tbl_stock_report (stock_price, opening_stock, stock_receive, total_stock, stock_damage, stock_id, booth_id, created_at, created_by, posting_date) VALUES ('$ing_price', '$ing_opening', '$ing_receive', '$ing_opening'+'$ing_receive', '$ing_damage', '$product_stock_id', '$booth_id', '$current_date', '$created_by', '$posting_date')";

                    $res = mysqli_query($conn, $slq);
                }
            }
        }


        if ($res) {
            http_response_code(200);
            $data = [
                'status' => true,
                'message' => 'Stock Posting Successfull!!',
            ];
            // header("HTTP/1.0 200 Created");
            echo json_encode($data);
        } else {
            http_response_code(200);
            $data = [
                'status' => false,
                'message' => 'Stock Posting Failed!!',
            ];
            // header("HTTP/1.0 200 Unprocessable Entity");
            echo json_encode($data);
        }
    }
}
