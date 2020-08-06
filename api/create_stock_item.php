<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/stockItem.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$stockItem = new StockItem($db);
 
// database connection will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

if (!isset($data)) {
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "No se proporcionaron datos"
	));
	die();	
}
if (!isset($data->nombre)){
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "El nombre es obligatorio"
	));
	die();
}
if ($data->nombre == ''){
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "El nombre no es valido"
	));
	die();
}

// set product property values
$stockItem->nombre = $data->nombre ;
$stockItem->descripcion = isset($data->descripcion) ? $data->descripcion : '';
$stockItem->cantidad = isset($data->cantidad) ? $data->cantidad : '';
$stockItem->precio = isset($data->precio) ? $data->precio : '';
$stockItem->id_proveedor = isset($data->id_proveedor) ? $data->id_proveedor : '';
$stockItem->fecha_de_compra = isset($data->fecha_de_compra) ? $data->fecha_de_compra : '';
$stockItem->fecha_de_caducidad = isset($data->fecha_de_caducidad) ? $data->id_proveedor : '';
$stockItem->dias_de_soporte = isset($data->dias_de_soporte) ? $data->dias_de_soporte : '';
$stockItem->unidad_de_medida = isset($data->unidad_de_medida) ? $data->unidad_de_medida : '';



// create the user
if(
    !empty($stockItem->nombre) &&
    $stockItem->create()
){
 
    // set response code
    http_response_code(200);
    // display message: user was created
    /*echo json_encode(array(
		"status" => "success",
		"message" => "success",
		"data" => ""
	));*/
	echo json_encode($stockItem->response);	
}
 
// message if unable to create user
else{
	//set response code
 	http_response_code(400);

	/*echo json_encode(array(
		"status" => "fail",
		"message" => "No se pudo crear el articulo"
	));*/
	echo json_encode($stockItem->response);	
}
?>