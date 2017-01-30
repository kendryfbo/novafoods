<?php
	$id_talla=$_GET["id_talla"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select * from tallas 
			WHERE id_talla =".$id_talla;
 		 	
			$ejecuta=mysql_query($sql1,$conexion->link);

			while ($fila = mysql_fetch_array($ejecuta))
			{
				
			$salida[]=array("talla"=>$fila[1]);

			}
			echo json_encode($salida);
?>