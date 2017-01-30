<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$cargo=trim($_POST["cargo"]);
	$id_cargo=trim($_POST["id_cargo"]);
 
 	if ($id_cargo<>"")
	{
		$sql1="select cargo from cargos
				where cargo='".$cargo."' and id_cargo <> ".$id_cargo;
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
		$sql1="select cargo from cargos
				where cargo='".$cargo."'";
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