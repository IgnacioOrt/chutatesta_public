<?php
// 'Stock Item' object
class Supplier{
 
    // database connection and table name
    private $conn;
    private $table_name = "stock";
 
    // object properties
    public $id_stock;
    public $nombre;
    public $descripcion;
    public $cantidad;
    public $precio;
    public $id_proveedor;
    public $fecha_de_compra;
    public $fecha_de_caducidad;
    public $dias_de_soporte;
    public $unidad_de_medida; 
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
        descripcion = :descripcion,
        precio = :precio,
        id_proveedor = :id_proveedor,
        dias_de_soporte = :dias_de_soporte,
        unidad_de_medida = :unidad_de_medida";

    // prepare the query
        $stmt = $this->conn->prepare($query);

    // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
        $this->id_proveedor=htmlspecialchars(strip_tags($this->id_proveedor));
        $this->dias_de_soporte=htmlspecialchars(strip_tags($this->dias_de_soporte));
        $this->unidad_de_medida=htmlspecialchars(strip_tags($this->unidad_de_medida));

    // bind the values
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':id_proveedor', $this->id_proveedor);
        $stmt->bindParam(':dias_de_soporte', $this->dias_de_soporte);
        $stmt->bindParam(':unidad_de_medida', $this->unidad_de_medida);
    // execute the query, also check if query was successful
        try {
            if ($stmt->execute()){
                return true;
            }
            return false;
        }catch (PDOException $e){
            return $e;
        }
    }

    function getStock()
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