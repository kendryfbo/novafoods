<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$id_producto_terminado=trim($_POST["id_producto_terminado"]);
	$id_producto_hijo=trim($_POST["id_producto_hijo"]); 
	$nivel=trim($_POST["nivel"]); 

		$sql1="select id_producto_hijo from formulas
				where id_producto_padre=".$id_producto_terminado." and nivel =".$nivel. " and id_producto_hijo =".$id_producto_hijo;
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

?>	