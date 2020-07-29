<?php
header("Access-Control-Allow-Origin: *");
require_once("../config.php");
//$rest_json = file_get_contents("php://input");
//$_POST = json_decode($rest_json, true);
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
$response['status_code_header'] = 'HTTP/1.1 200 OK';
$response['body'] = json_encode($arr);
header($response['status_code_header']);
if ($response['body']) {
echo $response['body'];
}
?>
