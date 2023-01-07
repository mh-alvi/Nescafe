<?php

class user
{

    // database connection and table name
    private $conn;
    private $table_auth = "tbl_authentication";
    private $table_employee = "tbl_employee";
    private $table_emp_dtls = "tbl_employee_details";
    private $table_booth = "tbl_booth";

    // object properties
    public $auth_id;
    public $em_id;
    public $username;
    public $password;
    public $auth_status;

    public $emp_id;
    public $employee_name;
    public $jod_id;
    public $join_date;
    public $em_status;




    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // login user method
  public function login()
    {

        $q="SELECT * FROM " .$this->table_auth. " WHERE em_username=? AND em_password=? AND auth_status=1";
        $stmt = $this->conn->prepare($q);

        $stmt->bind_param("ss",$this->username,$this->password);
        if($stmt->execute())
        {
            $data=$stmt->get_result();
            return $data;
        }
        
        return array();
    }
}
?>