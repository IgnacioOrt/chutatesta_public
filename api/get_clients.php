<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/clients.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$client = new Client($db);
 
if ($client->getClients()){
	http_response_code(200);
    // display message: user was created
    echo json_encode($client->response);	
}else{
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "No se obtuvo informacion"
	));
}


?>