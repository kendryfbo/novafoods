<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$giro=trim($_POST["giro"]);
	$id_giro=trim($_POST["id_giro"]);
 
 	if ($id_giro<>"")
	{
		$sql1="select giro from giros
				where giro='".$giro."' and id_giro <> ".$id_giro;
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
		$sql1="select giro from giros
				where giro='".$giro."'";
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