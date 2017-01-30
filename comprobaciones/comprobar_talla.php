<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$talla=trim($_POST["talla"]);
	$id_talla=trim($_POST["id_talla"]); 
 	if ($id_talla<>"")
	{
		$sql1="select talla from tallas
				where talla='".$talla."' and id_talla <> ".$id_talla;
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
		$sql1="select talla from tallas
				where talla='".$talla."'";
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