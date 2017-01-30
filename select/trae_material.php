<?php
	$id_material=$_GET["id_material"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select * from materiales 
			WHERE id_material =".$id_material;
 		 	
			$ejecuta=mysql_query($sql1,$conexion->link);

			while ($fila = mysql_fetch_array($ejecuta))
			{
				
			$salida[]=array("material"=>$fila[1]);

			}
			echo json_encode($salida);
	 
		 


?>