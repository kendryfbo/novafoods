<?php
	$id=$_GET["id"];
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$sql1="select 
			batch,
			caja,
			unidad
			from formulas 
			where id=".$id;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))
			{
				
			$salida[]=array("batch"=>$fila[0],"caja"=>$fila[1],"unidad"=>$fila[2]);
			}
			echo json_encode($salida);
	 
		 


?>