<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Max-Age: 360000");
header("Access-Control-Allow-Headers: Origin, Accept, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/stockItem.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$stockitem = new StockItem($db);

$data = json_decode(file_get_contents("php://input"));


if (!isset($data)) {
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "No se proporcionaron datos"
	));
	die();	
}
$stockitem->id_stock = $data->id_stock;
$stockitem->nombre = $data->nombre;
$stockitem->descripcion = $data->descripcion;
$stockitem->cantidad = $data->cantidad;
$stockitem->precio = $data->precio;
$stockitem->id_proveedor = $data->id_proveedor;
$stockitem->fecha_de_compra = $data->fecha_de_compra;
$stockitem->fecha_de_caducidad = $data->fecha_de_caducidad;
$stockitem->dias_de_soporte = $data->dias_de_soporte;
$stockitem->unidad_de_medida = $data->unidad_de_medida;

if ($stockitem->updateItem()){
	http_response_code(200);
    // display message: user was created
    echo json_encode($stockitem->response);	
}else{
	http_response_code(400);

	/*echo json_encode(array(
		"status" => "fail",
		"message" => "Error al realizar cambios"
	));*/
	echo json_encode($stockitem->response);	
}
$database->closeConnection();
?>