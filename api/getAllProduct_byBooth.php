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
           
            $data=$product->getAllProduct_byBooth();
            if($data->num_rows>0)
            {
                $products["records"] = array();
                while($row=$data->fetch_assoc())
                {
                    array_push($products["records"],array(
                        "productId"=>$row['id'],
                        "productName"=>$row['product_name'],
                        "productPrice"=>$row['product_price'],
                        "productUnit"=>$row['unit']   
                    ));
                }
        
                http_response_code(200);
                echo json_encode(array(
                    "status"=>true,
                    "message"=>"Data found",
                    "data"=>$products['records']
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

?>
    