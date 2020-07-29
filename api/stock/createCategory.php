<?php
    require_once("../config.php");
    if (isset($_POST['categoryName'])) {
        if ($conn->query(createCategory($_POST['categoryName'])) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
          
          $conn->close();
    }else{
        
    }
    /* echo json_encode(array('returned_val' => 'yoho')); */

?>