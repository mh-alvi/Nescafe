<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

include_once ('../datamodel/model_products.php');
include_once ('../config/constants.php');

$product=new products($conn);

if($_SERVER['REQUEST_METHOD']==="POST")
    {
        $param = json_decode(file_get_contents("php://input"));
        if (!empty($param->booth_id)) {
            $product->booth_id = $param->booth_id;
           
            $data=$product->getReceiveStock_byBooth();
            if($data->num_rows>0)
            {
                $R_stock["records"] = array();
                while($row=$data->fetch_assoc())
                {
                    array_push($R_stock["records"],array(
                        "Stock_Name"=>$row['stock_name'],
                        "Stock_Receive"=>$row['stock_receive'],
                        "Unit"=>$row['stock_unit']
                    ));
                }
        
                http_response_code(200);
                echo json_encode(array(
                    "status"=>true,
                    "message"=>"Data found",
                    "data"=>$R_stock['records']
                ));
               
            } else {
                http_response_code(200);
                echo json_encode(array(
    
                    "status" => false,
                    "message" => "Received Stock Not Found"
    
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
