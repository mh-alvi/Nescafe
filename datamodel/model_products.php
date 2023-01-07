<?php

class products
{
    // database connection and table name
    private $conn;
    private $table_product = "tbl_product";
    // object properties
    public $product_id;
    public $product_name;
    public $product_price;
    public $booth_id;
    public $unit;

    // constructor with $db as database connection //
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAllProduct()
    {
        $q1='SELECT * FROM ' .$this->table_product;
        $stmt1 = $this->conn->prepare($q1);
        $stmt1->execute();
        return $stmt1->get_result();
    }
    function getAllProduct_byBooth()
    {
        $q='SELECT * FROM ' .$this->table_product. ' WHERE booth_id= ?';
        $stmt = $this->conn->prepare($q);

        $stmt->bind_param("i",$this->booth_id);
        if($stmt->execute())
        {
            $data=$stmt->get_result();
            return $data;
        }
        
        return array();
    }
   

}
?>