<?php

class products
{
    // database connection and table name
    private $conn;
    private $table_product = "tbl_product";
    private $table_ingredient = "tbl_product_stock";
    private $tbl_stock_report = "tbl_stock_report";
    // object properties
    public $product_id;
    public $product_name;
    public $product_price;
    public $booth_id;
    public $employee_id;
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
    function getAllIngredient()
    {
        $q2='SELECT * FROM ' .$this->table_ingredient;
        $stmt2 = $this->conn->prepare($q2);
        $stmt2->execute();
        return $stmt2->get_result();
    }
    // function getAllProduct_byBooth()
    // {
    //     $q='SELECT * FROM ' .$this->table_product. ' WHERE booth_id= ?';
    //     $stmt = $this->conn->prepare($q);

    //     $stmt->bind_param("i",$this->booth_id);
    //     if($stmt->execute())
    //     {
    //         $data=$stmt->get_result();
    //         return $data;
    //     }
        
    //     return array();
    // }
    function getAllProduct_byBooth()
    {
        $q='SELECT * FROM tbl_product_tagging AS tpt RIGHT JOIN tbl_product AS tp ON tpt.product_id=tp.id WHERE booth_id= ?';
        $stmt = $this->conn->prepare($q);

        $stmt->bind_param("i",$this->booth_id);
        if($stmt->execute())
        {
            $data=$stmt->get_result();
            return $data;
        }
        
        return array();
    }
    function getCurrentStock_byBooth()
    {
        // $q='SELECT * FROM ' .$this->tbl_stock_report. ' WHERE booth_id= ?';
        $q = "SELECT * FROM tbl_stock_report AS tsr RIGHT JOIN tbl_product_stock AS tps ON tsr.stock_id=tps.id WHERE booth_id= ?";
        $stmt = $this->conn->prepare($q);

        $stmt->bind_param("i",$this->booth_id);
        if($stmt->execute())
        {
            $data=$stmt->get_result();
            return $data;
        }
        
        return array();
    }
    function getReceiveStock_byBooth()
    {
        $q = "SELECT * FROM tbl_stock_report AS tsr RIGHT JOIN tbl_product_stock AS tps ON tsr.stock_id=tps.id WHERE booth_id= ?";
        $stmt = $this->conn->prepare($q);

        $stmt->bind_param("i",$this->booth_id);
        if($stmt->execute())
        {
            $data=$stmt->get_result();
            return $data;
        }
        
        return array();
    }
    function getAttedance_by()
    {
        $q = "SELECT * FROM tbl_attendance WHERE booth_id=? AND employee_id=?";
        $stmt = $this->conn->prepare($q);

        $stmt->bind_param("ii",$this->booth_id,$this->employee_id);
        if($stmt->execute())
        {
            $data=$stmt->get_result();
            return $data;
        }
        
        return array();
    }
   

}
