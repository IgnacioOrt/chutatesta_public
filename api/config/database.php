<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "chuta";
    private $username = "root";
    private $password = "";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            http_response_code(500);
            echo json_encode(array(
                "status" => "error",
                "message" => "Connection failed: " . $exception->getMessage()
            ));
            die();            
        }
 
        return $this->conn;
    }

    public function closeConnection(){
        $this->conn = null;
    }
}
?>