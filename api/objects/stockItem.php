<?php
// 'Stock Item' object
class StockItem{

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
        cantidad = :cantidad,
        precio = :precio,
        id_proveedor = :id_proveedor,
        fecha_de_compra = :fecha_de_compra,
        fecha_de_caducidad = :fecha_de_caducidad,
        dias_de_soporte = :dias_de_soporte,
        unidad_de_medida = :unidad_de_medida";

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
    // bind the values
        $nullParam = NULL;
        //Nombre
        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        //Descripcion
        $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
        //Cantidad
        $stmt->bindParam(':cantidad', $this->descripcion, PDO::PARAM_INT);
        //Precio
        $this->precio == '' ?
            $stmt->bindParam(':precio', $this->precio, PDO::PARAM_INT)
        :
            $stmt->bindParam(':precio', $this->precio, PDO::PARAM_STR );
        //Id proveedor
        $this->id_proveedor == '' ?
            $stmt->bindParam(':id_proveedor', $nullParam,PDO::PARAM_NULL)
        :
            $stmt->bindParam(':id_proveedor', $this->id_proveedor,PDO::PARAM_INT);
        //Fecha de compra
        $this->fecha_de_compra == '' ?
            $stmt->bindParam(':fecha_de_compra', $nullParam,PDO::PARAM_NULL)
        :
            $stmt->bindParam(':fecha_de_compra', $this->fecha_de_compra);
        //Fecha de expiracion
        $this->fecha_de_caducidad == '' ?
            $stmt->bindParam(':fecha_de_caducidad', $nullParam,PDO::PARAM_NULL)
        :
            $stmt->bindParam(':fecha_de_caducidad', $this->fecha_de_caducidad);
        //Dias de soporte
        $stmt->bindParam(':dias_de_soporte', $this->dias_de_soporte,PDO::PARAM_INT);
        //Unidad de medida
        $this->unidad_de_medida == '' ?
            $stmt->bindParam(':unidad_de_medida', $nullParam,PDO::PARAM_NULL)
        :
            $stmt->bindParam(':unidad_de_medida', $this->unidad_de_medida);
    // execute the query, also check if query was successful
        try {
            if ($stmt->execute()){
                $this->response['status'] = 'success';
                $this->response['message'] = 'Creado correctamente';
                return true;
            }else{
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al crear.';    
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
        WHERE id_stock = :id_stock
        ";

    // prepare the query
        $stmt = $this->conn->prepare($query);

    // sanitize
        $this->id_stock=htmlspecialchars(strip_tags($this->id_stock));
    // bind the values
        $stmt->bindParam(':id_stock', $this->id_stock,PDO::PARAM_INT);
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
                $this->response['status'] = 'fail';
                $this->response['message'] = 'Fallo al eliminar';
                $this->response['data'] = $e;
            return false;
        }
    }
}
?>