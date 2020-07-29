<?php
    $Stock = "SELECT * FROM stock;";
    $Category = "SELECT *FROM category";
    
    function createCategory ($nombre){
        return "INSERT INTO category (nombre) VALUES ('$nombre')";    
    }
    
    function getProductByCategoryId($id){
        return "SELECT * FROM product WHERE 'id_categoria' = $id";
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
    
    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    
?>
