<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$familia=trim($_POST["familia"]);
 	$id_familia=trim($_POST["id_familia"]);
	$id_sector=trim($_POST["id_sector"]);
	
	if ($id_familia<>"")
	{
		$sql1="select familia from familias
				where familia='".$familia."' and id_familia <> ".$id_familia." and id_sector_producto <> ".$id_sector;

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
		$sql1="select familia from familias
		where familia='".$familia."' and id_sector_producto= ".$id_sector;
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