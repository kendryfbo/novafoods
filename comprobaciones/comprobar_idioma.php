<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$idioma=trim($_POST["idioma"]);
	$id_idioma=trim($_POST["id_idioma"]);
 
 	if ($id_giro<>"")
	{
		$sql1="select idioma from idiomas
				where idioma='".utf8_decode($idioma)."' and id_idioma <> ".$id_idioma;
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
		$sql1="select idioma from idiomas
				where idioma='".utf8_decode($idioma)."'";
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