<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 		$funcion=trim($_POST["funcion"]);
	if ($funcion=="1")
	{
		$proveedor=trim($_POST["proveedor"]);
		$sql1="select nombre_proveedor from proveedores_internacionales
		where nombre_proveedor='".$proveedor."'";
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
	else if ($funcion=="2")
	{	
		
		$id_proveedor=trim($_POST["id_proveedor"]);
		$sql1="select nombre_proveedor from proveedores_internacionales
				where nombre_proveedor='".$proveedor."' and id_proveedor <> ".$id_proveedor;

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
	else if ($funcion=="3")
	{	
		$proveedor=trim($_POST["proveedor"]);
		$sql1="select rut from proveedor
				where nombre='".$proveedor."'";
                /*$rut=trim($_POST["rut"]);
		$sql1="select rut from proveedores_internacionales
				where rut='".$rut."'";*/
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje = mysql_fetch_array($resultado);
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
	else if ($funcion=="4")
	{	
		$rut=trim($_POST["rut"]);
		$id_proveedor=trim($_POST["id_proveedor"]);
		$sql1="select rut from proveedores_internacionales
				where rut='".$rut."' and id_proveedor <> ".$id_proveedor;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje = mysql_fetch_array($resultado);
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