<?php
// 'Stock Item' object
class Supplier{
 
    // database connection and table name
    private $conn;
    private $table_name = "supplier";
 
    // object properties
    public $id_supplier;
    public $nombre;
    public $direccion;
    public $telefono;
    public $response;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
    
    function create(){

    // insert query
        $query = "INSERT INTO " . $this->table_name . "
        SET
        nombre = :nombre,
        direccion = :direccion,
        telefono = :telefono";

    // prepare the query
        $stmt = $this->conn->prepare($query);

    // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->direccion=htmlspecialchars(strip_tags($this->direccion));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));

    // bind the values
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        try {
            if ($stmt->execute()){
                $this->response['status'] = 'success';
                $this->response['message'] = 'Proveedor creado';
                return true;
            }else{
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al crear proveedor';    
                return false;
            }
        }catch (PDOException $e){
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al crear proveedor';
                $this->response['data'] = $e;
            return false;
        }
    }

    function getSuppliers()
    {
        $query = "SELECT * FROM ". $this->table_name;

        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){

        // get record details / values
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $request[] = $row;
            }
            $this->response['status'] = 'success';
            $this->response['message'] = 'Consulta realizada correctamente';
            $this->response['data'] = $request;
        // return true because email exists in the database
            return true;
        }else{
            $this->response['status'] = 'no-data';
            $this->response['message'] = 'Consulta realizada correctamente';
            $this->response['data'] = array('no-data' => 'No records');;            
        }

        // return false if email does not exist in the database
        return false;
    }

}
?>