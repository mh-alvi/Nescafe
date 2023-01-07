<?php

class sales
{
    // database connection and table name
    private $conn;
    private $table_sales = "tbl_sales";
    // object properties
    public $product_id;
    public $product_name;
    public $opening;
    public $closing;
    public $wastage;
    public $sales;
    public $total;
    public $due;
    public $other;
    public $expense;
    public $total_expense;
    public $collection;

    // constructor with $db as database connection //
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAllProduct()
    {
        $q1='SELECT * FROM ' .$this->table_sales;
        $stmt1 = $this->conn->prepare($q1);
        $stmt1->execute();
        return $stmt1->get_result();
    }
    function post_sales()
    {
        //$q='SELECT * FROM ' .$this->table_sales. ' WHERE booth_id= ?';
        $q='INSERT INTO '.$this->table_sales.'VALUE(opening=? AND closing=? AND opening=? AND wastage=? AND sales=? AND total=? AND due=? AND other=? AND expense=? AND total_expense=? AND collection=?)';
        $stmt = $this->conn->prepare($q);

        $stmt->bind_param("i",$this->product_id);
        if($stmt->execute())
        {
            $data=$stmt->get_result();
            return $data;
        }
        
        return array();
    }
   

}
?>