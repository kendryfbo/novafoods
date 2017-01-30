<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$marca=trim($_POST["marca"]);
  	$id_marca=trim($_POST["id_marca"]);
 
	if ($id_marca<>"")
	{
		$sql1="select marca from marcas
				where marca='".utf8_decode($marca)."'  and id_marca <> ".$id_marca;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		
		if ($mensaje[0]<>"")
		{

			echo "Error";
			return false;

		}
		else
		{
				echo "Ok";
		}
	}
	else
	{	
		$sql1="select marca from marcas
		where marca='".utf8_decode($marca)."'";
		$resultado=mysql_query($sql1,$conexion->link);
 		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]<>"")
		{
			echo "Error";
			return false;
		}
		else
		{		
				echo $mensaje[0];
		}
	
	}
?>	