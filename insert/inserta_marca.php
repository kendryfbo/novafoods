<?php	
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$marca=trim($_POST["marca"]);
	$id_familia=trim($_POST["id_familia"]);
	$ila=trim($_POST["ila"]);
  
  try{
		mysql_query("SET NAMES 'utf8'");
		$sql3="INSERT INTO marcas (marca,id_familia,ila)
			VALUES ('$marca','$id_familia','$ila')";
		$resultado=mysql_query($sql3,$conexion->link);
			
		echo "Marca ha sido Ingresada";
	}
		catch (Exception $e)
	{    
		echo $e->getMessage();
	}


					
?>		