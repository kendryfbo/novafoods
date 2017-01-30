<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$formato=trim($_POST["formato"]);
	$id_formato=trim($_POST["id_formato"]); 
 	if ($id_formato<>"")
	{
		$sql1="select formato from formatos
				where formato='".$formato."' and id_formato <> ".$id_formato;
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
		$sql1="select formato from formatos
				where formato='".$formato."'";
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