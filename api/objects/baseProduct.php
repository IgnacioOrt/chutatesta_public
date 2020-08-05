<?php
// 'Stock Item' object
class BaseProduct{

    // database connection and table name
    private $conn;
    private $table_name = "base_product";

    // object properties
    public $id_producto_base;
    public $nombre;
    public $descripcion;
    public $precio;
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
        precio = :precio";

    // prepare the query
        $stmt = $this->conn->prepare($query);

    // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->precio=htmlspecialchars(strip_tags($this->precio));

    // bind the values
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio);
    // execute the query, also check if query was successful
        try {
            if ($stmt->execute()){
                $this->response['id'] = $this->conn->lastInsertId();
                return true;
            }else{
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al crear. Porque?';    
                return false;
            }
        }catch (PDOException $e){
            $this->response['status'] = 'fail';
            $this->response['message'] = 'Fallo al crear.';
            $this->response['data'] = $e;   
            return false;
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
            $this->response['data'] = array('no-data' => 'No records');
            return false;
        }

        // return false if email does not exist in the database
        
    }

    function updateItem(){
        // Update query
        $query = "UPDATE " . $this->table_name . "
        SET
        nombre = :nombre,
        descripcion = :descripcion,
        cantidad = :cantidad,
        precio = :precio,
        id_proveedor = :id_proveedor,
        fecha_de_compra = :fecha_de_compra,
        fecha_de_caducidad = :fecha_de_caducidad,
        dias_de_soporte = :dias_de_soporte,
        unidad_de_medida = :unidad_de_medida
        WHERE id_stock= :id_stock
        ";

    // prepare the query
        $stmt = $this->conn->prepare($query);

    // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
        $this->id_proveedor=htmlspecialchars(strip_tags($this->id_proveedor));
        $this->fecha_de_compra=htmlspecialchars(strip_tags($this->fecha_de_compra));
        $this->fecha_de_caducidad=htmlspecialchars(strip_tags($this->fecha_de_caducidad));
        $this->dias_de_soporte=htmlspecialchars(strip_tags($this->dias_de_soporte));
        $this->unidad_de_medida=htmlspecialchars(strip_tags($this->unidad_de_medida));
        $this->id_stock=htmlspecialchars(strip_tags($this->id_stock));
    // bind the values
        $stmt->bindParam(':id_stock', $this->id_stock,PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $this->precio, PDO::PARAM_INT);
        $stmt->bindParam(':id_proveedor', $this->id_proveedor, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_de_compra', $this->fecha_de_compra);
        $stmt->bindParam(':fecha_de_caducidad', $this->fecha_de_caducidad);
        $stmt->bindParam(':dias_de_soporte', $this->dias_de_soporte, PDO::PARAM_INT);
        $stmt->bindParam(':unidad_de_medida', $this->unidad_de_medida);
    // execute the query, also check if query was successful
        try {
            if ($stmt->execute()){
                $this->response['status'] = 'success';
                $this->response['message'] = 'Dato actualizado';
                return true;
            }else{
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al actualizar';    
                return false;
            }
        }catch (PDOException $e){
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al actualizar';
                $this->response['data'] = $e;
            return false;
        }
    }
    function delete () {
        $query = "DELETE FROM " . $this->table_name . "
        WHERE id_producto_base = :id_producto_base
        ";

    // prepare the query
        $stmt = $this->conn->prepare($query);

    // sanitize
        $this->id_producto_base=htmlspecialchars(strip_tags($this->id_producto_base));
    // bind the values
        var_dump($this->id_producto_base);
        $stmt->bindParam(':id_producto_base', $this->id_producto_base,PDO::PARAM_INT);
    // execute the query, also check if query was successful
        try {
            if ($stmt->execute()){
                $this->response['status'] = 'success';
                $this->response['message'] = 'Dato eliminado';
                return true;
            }else{
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al eliminar';    
                return false;
            }
        }catch (PDOException $e){
                var_dump($e);
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al eliminar';
                $this->response['data'] = $e;
            return false;
        }
    }
}
?>