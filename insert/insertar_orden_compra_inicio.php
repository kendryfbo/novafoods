<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$fecha=date("y-m-d H:i:s");
	$id_usuario=trim($_POST["id_usuario"]);
 
	
  try{
		$sql3="INSERT INTO orden_compra	 (id_estado_orden_compra,id_usuario)
		VALUES ('1','$id_usuario')";
		$resultado=mysql_query($sql3,$conexion->link);
		$valor=mysql_insert_id();

			echo $valor;
		 
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>	