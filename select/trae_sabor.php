<?php
	
	$id_sabor=$_POST["id_sabor"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	
	$sql1="select
			sabor_espanol,
			sabor_ingles
			from sabores 
		 	WHERE id_sabor =".$id_sabor;
 		
		$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$salida[]=array("sabor_esp"=>utf8_encode($fila[0]),"sabor_ing"=>utf8_encode($fila[1]));
		}
			echo json_encode($salida);
	 
 

?>