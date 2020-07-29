<?php
    require_once("../config.php");
    echo("editCategory.php");
    var_dump($_POST);
    if (isset($_POST['categoryNameEdit']) && isset($_POST['categoryId'])) {
        if ($conn->query(createCategory($_POST['categoryNameEdit'])) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: <br>" . $conn->error;
          }
          
          $conn->close();
    }else{
        echo("No data");
    }
    /* echo json_encode(array('returned_val' => 'yoho')); */

?>