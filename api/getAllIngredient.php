<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

include_once ('../datamodel/model_products.php');
include_once ('../config/constants.php');

$product=new products($conn);

if($_SERVER['REQUEST_METHOD']==="GET")
    {
    
        $data=$product->getAllIngredient();
        if($data->num_rows>0)
        {
            $products["records"] = array();
            while($row=$data->fetch_assoc())
            {
                array_push($products["records"],array(
                    "ingredientId"=>$row['id'],
                    "ingredientName"=>$row['stock_name'],
                    "ingredientQuantity"=>$row['stock_quantity'],
                    "ingredientUnit"=>$row['stock_unit']
                ));
            }
    
            http_response_code(200);
            echo json_encode(array(
                "status"=>true,
                "message"=>"Data found",
                "data"=>$products['records']
            ));
           
        } else {
            http_response_code(200);
            echo json_encode(array(

                "status" => false,
                "message" => "Data Not Found"

            ));
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