<?php
	$id_genero=$_GET["id_genero"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	 $sql1="select * from generos 
			WHERE id_genero =".$id_genero;
 		 	
			$ejecuta=mysql_query($sql1,$conexion->link);

			while ($fila = mysql_fetch_array($ejecuta))
			{
				
			$salida[]=array("genero"=>$fila[1]);

			}
			echo json_encode($salida);
	 
		 


?>