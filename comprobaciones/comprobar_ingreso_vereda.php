<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$vereda=trim($_POST["vereda"]);
	 
 	$sql3="select id_vereda from veredas where id_vereda=".$vereda;
	$resultado=mysql_query($sql3,$conexion->link);
	$mensaje=mysql_fetch_array($resultado);
	if ($mensaje[0]<>"")
	{
		echo "Error";
		return false;
	}
	else
	{
		echo "ok";	
	}
				
?>		