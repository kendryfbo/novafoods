<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$lista_precio=trim($_POST["lista_precio"]);
  	$id_producto=trim($_POST["id_producto"]);
 
	
		$sql1="select tipo_lista from lista_precio_nacional
				where tipo_lista='".$lista_precio."'  and id_producto = ".$id_producto;
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
	/*
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
	
	}*/
?>	