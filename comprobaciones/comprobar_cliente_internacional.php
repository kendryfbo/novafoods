<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$funcion=trim($_POST["funcion"]);
	
	if ($funcion=="1")
	{	
		$nombre_cliente=trim($_POST["nombre_cliente"]);
 		
		$sql1="select nombre from cliente
		where nombre='".utf8_decode($nombre_cliente)."' and tipo_cliente=1";
		/*
		$sql1="select nombre_cliente from cliente_internacional
		where nombre_cliente='".utf8_decode($nombre_cliente)."'";
		*/

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
	else if  ($funcion=="2")
	{	
		$id_cliente_int=trim($_POST["id_cliente_int"]);
		$nombre_cliente=trim($_POST["nombre_cliente"]);
		$sql1="select nombre_cliente from cliente_internacional
				where nombre_cliente='".utf8_decode($nombre_cliente)."' and id_cliente <> ".$id_cliente_int;
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
	else if  ($funcion=="3")
	{
		$rut=trim($_POST["rut"]);
		$sql1="select rut from cliente_internacional
				where rut='".$rut."'";
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
	else if  ($funcion=="4")
	{
		$rut=trim($_POST["rut"]);
		$id_cliente_int=trim($_POST["id_cliente_int"]);
		$sql1="select rut from cliente_internacional
				where rut='".$rut."' and id_cliente <> ".$id_cliente_int;
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
?>	