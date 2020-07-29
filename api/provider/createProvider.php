<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('../config.php');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data)){
	http_response_code(204);
	echo json_encode(array (
		"status" => "fail",
		"message" => "No se proporciono información"
	));
	die();
}

$nombre = isset($data->nombre) ? addslashes($data->nombre) : '';
$direccion = isset($data->direccion) ? addslashes($data->direccion) : '';
$telefono = isset($data->telefono) ? $data->telefono : '';
$sql = createProvider($nombre, null, $telefono);

if ($conn->query($sql) === TRUE) {
	http_response_code(200);
	echo json_encode(array(
		"status" => "success",
		"message" => "success",
		"data" => ""
	));
} else {
	http_response_code(200);
	echo json_encode(array(
		"status" => "fail",
		"message" => "" .$conn->error
	));
}

$conn->close();
?>