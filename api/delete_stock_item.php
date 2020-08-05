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
$stock = new StockItem($db);
 
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

if (empty($data->id_stock)){
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "No se proporciono id"
	));
	die();
}
// set product property values
$stock->id_stock = $data->id_stock;

// create the user
if(
    $stock->delete()
){
 
    // set response code
    http_response_code(200);
    // display message: user was created
    /*echo json_encode(array(
		"status" => "success",
		"message" => "success",
		"data" => ""
	));*/
	echo json_encode($stock->response);	
}
 
// message if unable to create user
else{
	//set response code
 	http_response_code(400);

	/*echo json_encode(array(
		"status" => "fail",
		"message" => "No se pudo crear el articulo"
	));*/
	echo json_encode($stock->response);	
}
?>