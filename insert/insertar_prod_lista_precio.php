<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$id_producto=trim($_POST["id_producto"]);
        $lista_precio=trim($_POST["lista_precio"]);
        $fecha= date ("Y-m-d");
        $precio=trim($_POST["precio"]);
        //precio
	$funcion=trim($_POST["funcion"]);	
	if ($funcion=="1")
        {
            try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO lista_precio_nacional (tipo_lista ,id_producto,fecha,precio)
				VALUES ('$lista_precio','$id_producto','$fecha','$precio')";
				$resultado=mysql_query($sql3,$conexion->link);
				echo "Producto Registrado";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}

        }
        else if ($funcion=="2")
        {
            try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="update lista_precio_nacional set precio='$precio' where  id_producto=".$id_producto." and tipo_lista=".$lista_precio;
				$resultado=mysql_query($sql3,$conexion->link);
				echo "Producto Actualizado!";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}

        }
	
	//$credito = str_replace(".", "", $credito);
	 

					
?>		