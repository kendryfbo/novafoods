<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$cod_prod=trim($_POST["cod_prod"]);
 
		$sql1="select codigo_producto from productos
		where codigo_producto='".utf8_decode($cod_prod)."'";
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
	
	
?>	
	 