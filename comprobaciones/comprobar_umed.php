<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$umed=trim($_POST["umed"]);
  	$id_umed=trim($_POST["id_umed"]);
	
  	if ($id_umed<>"")
	{
		$sql1="select umed from umed
				where umed='".utf8_decode($umed)."'and id_umed <> ".$id_umed;

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
		$sql1="select umed from umed
				where umed='".utf8_decode($umed)."'";
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