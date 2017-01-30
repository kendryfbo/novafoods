<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$nom_prod=trim($_POST["nom_prod"]);
	$id_producto=trim($_POST["id_producto"]);
	
	if ($id_producto<>"")
	{	
		$sql1="select nombre_producto from productos
			where nombre_producto='".utf8_decode($nom_prod)."'  and id_producto <> ".$id_producto;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);	
		if ($mensaje[0]<>"")
		{
			echo "Error";
			return false;
		}
		else
		{
			echo $sql1;
		}
	}
	else
	{	
		$sql1="select nombre_producto from productos
		where nombre_producto='".utf8_decode($nom_prod)."'";
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
	 