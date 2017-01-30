<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$color=trim($_POST["color"]);
	$id_color=trim($_POST["id_color"]); 
 	if ($id_color<>"")
	{
		$sql1="select color from colores
				where color='".$color."' and id_color <> ".$id_color;
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
		$sql1="select color from colores
				where color='".$color."'";
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