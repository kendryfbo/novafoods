<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$genero=trim($_POST["genero"]);
	$id_genero=trim($_POST["id_genero"]); 
 	if ($id_genero<>"")
	{
		$sql1="select genero from generos
				where genero='".$genero."' and id_genero <> ".$id_genero;
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
		$sql1="select genero from generos
				where genero='".$genero."'";
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