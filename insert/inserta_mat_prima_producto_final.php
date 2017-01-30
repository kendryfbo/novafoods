<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	$id_producto_terminado=trim($_POST["id_producto_terminado"]);
	$id_producto_hijo=trim($_POST["id_producto_hijo"]);
	$nivel=trim($_POST["nivel"]);
	$batch=trim($_POST["batch"]);
	$caja=trim($_POST["caja"]);
	$unidad=trim($_POST["unidad"]);
	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO formulas (id_producto_hijo,batch,caja,id_producto_padre,nivel,unidad)
				VALUES ('$id_producto_hijo','$batch','$caja','$id_producto_terminado','$nivel','$unidad')";
 			$resultado=mysql_query($sql3,$conexion->link);
		
			echo "Familia Ingresada";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		