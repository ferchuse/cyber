<?php
		HEADER("Content-Type:: application/json");
    include ('../conexi.php');
    $link = Conectarse();
    $respuesta = array();
    $tabla = $_POST["tabla"];
    $id_registro = $_POST["id_campo"];
    $name = $_POST["name"];
    $id_field = 'id_'.$tabla;
    $name_field = 'nombre_'.$tabla;

    // TODO
      // HACER DINAMICO id_ y nombre_ para que se adapte a cualquier TABLA
    
    $query = "INSERT INTO $tabla ($id_field, $name_field) 
    VALUES('$id_registro', '$name')
    ON DUPLICATE KEY UPDATE $name_field = '$name'";
    $result = mysqli_query($link, $query);
   
    if($result){
			
       $respuesta["estatus"] = "success";
       $respuesta["mensaje"] = "Se guardó correctamente";
    }
    else{ 
			$respuesta["estatus"] = "error";
			$respuesta["consulta"] = $query;
       $respuesta["mensaje"] = mysqli_error($link);
      	
    }
		echo json_encode($respuesta);
?>