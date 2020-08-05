<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/baseProduct.php';
include_once 'objects/ingredient.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$baseProduct = new BaseProduct($db);
 
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

if ($data->nombre == ''){
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "El nombre no es valido"
	));
	die();
}

if (!isset($data->ingredients)){
	http_response_code(400);

	echo json_encode(array(
		"status" => "fail",
		"message" => "El nombre no es valido"
	));
	die();
}

// set product property values
$baseProduct->nombre = $data->nombre;
$baseProduct->descripcion = $data->descripcion;
$baseProduct->precio = $data->precio;
$ingredients = $data->ingredients;

// create the user
if($baseProduct->create()){
	$id_base_product = $baseProduct->response['id']; 
	$fail = false;
	$Ingredient = new Ingredient($db);
	
	foreach ($ingredients as $ingredient => $value) {
		$Ingredient->nombre = $value->name;
		$Ingredient->cantidad = $value->quantityValue;
		$Ingredient->unidad_de_medida = $value->measure;
		$Ingredient->id_stock = $value->id_stock;
		$Ingredient->costo = $value->cost;
		$Ingredient->id_producto = NULL;
		echo "$Ingredient->id_producto";
		$Ingredient->id_producto_base = $id_base_product;
		if (!$Ingredient->create()){
			$fail = true;
			break;
		}
	}
	if ($fail) {
		$baseProduct->id_producto_base = $id_base_product;
		$baseProduct->delete();
		http_response_code(400);
		echo json_encode($Ingredient->response);
	}else{
		// set response code
    	http_response_code(200);
    	// display message: user was created
		echo json_encode($Ingredient->response);
	}
    	
}
 
// message if unable to create user
else{
	//set response code
 	http_response_code(400);

	/*echo json_encode(array(
		"status" => "fail",
		"message" => "No se pudo crear el articulo"
	));*/
	echo json_encode($baseProduct->response);	
}
?>