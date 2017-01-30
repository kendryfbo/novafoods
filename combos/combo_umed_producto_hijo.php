<?php
	$id_producto_hijo=$_POST["id_producto_hijo"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
		id_umed	
		from productos
                where id_producto=".$id_producto_hijo;
 	 	$ejecuta=mysql_query($sql1,$conexion->link);			 
		while ($fila = mysql_fetch_array($ejecuta)) 
		{
			echo $fila[0];
		}
				
?>