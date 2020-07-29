<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/stockItem.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$stockitem = new StockItem($db);
 
if ($stockitem->getStock()){
	http_response_code(200);
    // display message: user was created
    echo json_encode($stockitem->response);	
}else{
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "No se obtuvo informacion"
	));
}
$database->closeConnection();
?>