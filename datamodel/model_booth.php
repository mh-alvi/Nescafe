<?php

class boothz
{
    // database connection and table name
    private $conn;
    private $table_booth = "tbl_booth";
    // object properties
    public $id;
    public $booth_name;
    public $booth_address;
    public $booth_code;
  

    // constructor with $db as database connection //
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAllBooth()
    {
        $q1='SELECT * FROM ' .$this->table_booth;
        $stmt1 = $this->conn->prepare($q1);
        $stmt1->execute();
        return $stmt1->get_result();
    }
    function getAllBoothInfo_byBooth()
    {
        $q='SELECT * FROM ' .$this->table_booth. ' WHERE id= ?';
        $stmt = $this->conn->prepare($q);

        $stmt->bind_param("i",$this->id);
        if($stmt->execute())
        {
            $data=$stmt->get_result();
            return $data;
        }
        
        return array();
    }

}
?>