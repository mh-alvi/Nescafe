<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

include_once ('../datamodel/model_sales.php');
include_once ('../config/constants.php');

$sales=new sales($conn);

if($_SERVER['REQUEST_METHOD']==="POST")
    {
        $param = json_decode(file_get_contents("php://input"));
        if (!empty($param->product_id) && !empty($param->product_name) && !empty($param->opening) && !empty($param->closing) && !empty($param->wastage) && !empty($param->sales) && !empty($param->total) && !empty($param->due) && !empty($param->due) && !empty($param->other) && !empty($param->expense) && !empty($param->total_expense) && !empty($param->collection)) {
            $product->product_id = $param->product_id;
            $product->product_name = $param->product_name;
            $product->opening = $param->opening;
            $product->closing = $param->closing;
            $product->wastage = $param->wastage;
            $product->sales = $param->sales;
            $product->total = $param->total;
            $product->due = $param->due;
            $product->other = $param->other;
            $product->expense = $param->expense;
            $product->total_expense = $param->total_expense;
            $product->collection = $param->collection;
           
            $data=$product->post_sales();
            if($data->num_rows>0)
            {
        
                http_response_code(200);
                echo json_encode(array(
                    "status"=>true,
                    "message"=>"Data found"
                ));
               
            }

        }

      
    
    }else{
        http_response_code(503);
        echo json_encode(array(
    
            "status"=>false,
            "message"=>"Service not found",
            "data"=>null
        ));
    }
