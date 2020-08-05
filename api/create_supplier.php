<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/supplier.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$supplier = new Supplier($db);
 
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

if ($data->nombre == '' ){
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "El nombre no es valido"
	));
	die();
}
// set product property values
$supplier->nombre = $data->nombre;
$supplier->direccion = $data->direccion;
$supplier->telefono = $data->telefono;

if (empty($supplier->nombre)){
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "El nombre no es valido"
	));
	die();
}

// create the user
if(
    !empty($supplier->nombre) &&
    $supplier->create()
){
 
    // set response code
    http_response_code(200);
    // display message: user was created
    /*echo json_encode(array(
		"status" => "success",
		"message" => "success",
		"data" => ""
	));*/
	echo json_encode($supplier->response);	
}
 
// message if unable to create user
else{
	//set response code
 	http_response_code(400);

	/*echo json_encode(array(
		"status" => "fail",
		"message" => "No se pudo crear el articulo"
	));*/
	echo json_encode($supplier->response);	
}
?>