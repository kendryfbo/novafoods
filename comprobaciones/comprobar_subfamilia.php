<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$subfamilia=trim($_POST["subfamilia"]);
 	$id_subfamilia=trim($_POST["id_subfamilia"]);
	
	if ($id_subfamilia<>"")
	{
		$sql1="select sub_familia from sub_familias
				where sub_familia='".$subfamilia."' and id_subfamilia <> ".$id_subfamilia;
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
		$sql1="select sub_familia from sub_familias
		where sub_familia='".$subfamilia."'";
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