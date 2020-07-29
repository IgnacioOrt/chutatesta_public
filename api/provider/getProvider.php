<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once('../config.php');
//$rest_json = file_get_contents("php://input");
//$_POST = json_decode($rest_json, true);
$result = $conn->query($Provider);
if ($result->num_rows > 0) {
    while ( $row = $result->fetch_assoc() ){
        $request[] = $row;
    }
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode($request);
} else {
  $response = notFoundResponse();
}

header($response['status_code_header']);
if ($response['body']) {
	echo $response['body'];
}
?>
