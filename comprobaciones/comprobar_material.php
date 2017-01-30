<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$material=trim($_POST["material"]);
	$id_material=trim($_POST["id_material"]); 
 	if ($id_material<>"")
	{
		$sql1="select material from materiales
				where material='".$material."' and id_material <> ".$id_material;
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
		$sql1="select material from materiales
				where material='".$material."'";
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