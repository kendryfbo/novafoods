<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$banco=trim($_POST["banco"]);
	$id_banco=trim($_POST["id_banco"]); 
 	if ($id_banco<>"")
	{
		$sql1="select banco from bancos
				where banco='".$banco."' and id_banco <> ".$id_banco;
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
		$sql1="select banco from bancos
				where banco='".$banco."'";
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