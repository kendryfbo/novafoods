<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();
 
 


		$sql="select * from tipos_de_monedas  ORDER BY tipo_moneda ASC";
		$ejecuta=mysql_query($sql,$conexion->link);
		 
		 
		while ($fila = mysql_fetch_array($ejecuta))
		{
			
			
			$salida[]=array("id_tipo_moneda"=>$fila[0],"tipo_moneda"=>utf8_encode($fila[1]));

		}
		echo json_encode($salida);
	 


?>