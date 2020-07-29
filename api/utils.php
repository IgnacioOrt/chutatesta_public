<?php

    function formatStockData ($row) {
        echo("<td>". $row["nombre"]. "</td>");
        $quantity = $row["cantidad"] . '<button type="button" data-toggle="modal" data-target="#modalStockAddItems" class="btn btn-success btn-sm ml-3" onclick="addItems(' . $row["id_stock"] . ', `' . $row["nombre"] . '`)"><i class="fa fa-plus"></i></button>';
        echo("<td>". $quantity. "</td>");
        echo("<td>". $row["descripcion"]. "</td>");
        $actions = '<td><button class="btn btn-primary btn-sm" onclick="editStockItem(' . htmlspecialchars(json_encode($row)) . ')"><i class="fa fa-edit"></i></button><button class="btn btn-danger btn-sm ml-3" onclick="deleteStockItem(' . $row['id_stock'] . ')"><i class="fa fa-trash-o"></i></button></td>';
        echo("<td>". $row["precio"]. "</td>");
        echo($actions);
        echo("<td>". $row["id_proveedor"]. "</td>");
        echo("<td>". $row["fecha_de_compra"]. "</td>");
        echo("<td>". $row["fecha_de_caducidad"]. "</td>");
        echo("<td>". $row["dias_de_soporte"]. "</td>");
    }

    function formatCategoryProducts($row){

    }

    function formatProducts ($row){
        
    }
?>