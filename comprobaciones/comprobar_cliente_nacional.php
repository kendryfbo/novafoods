<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$rut=trim($_POST["rut"]);
 	$id_cliente=trim($_POST["id_cliente"]);
	$rut = str_replace(".", "", $rut);
	if ($id_cliente<>"")
	{
		$sql1="select rut from cliente where rut='".$rut."' and id_cliente <> ".$id_cliente;
                //$sql1="select rut from cliente_nacional where rut='".$rut."' and id_cliente <> ".$id_cliente;
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
		$sql1="select rut from cliente where rut='".$rut."'";
                //$sql1="select rut from cliente_nacional where rut='".$rut."'";
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