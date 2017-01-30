<?php
	
	$id_marca=$_POST["id_marca"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	
	$sql1="select
			marcas.marca,
			familias.familia,
			marcas.ila
			from marcas 
			inner join familias on marcas.id_familia=familias.id_familia
			WHERE marcas.id_marca =".$id_marca;
 		
		$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$salida[]=array("marca"=>utf8_encode($fila[0]),"familia"=>$fila[1],"ila"=>$fila[2]);
		}
			echo json_encode($salida);
	 
		 


?>