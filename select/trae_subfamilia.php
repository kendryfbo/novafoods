<?php
	$id_subfamilia=$_GET["id_subfamilia"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select 
			familias.familia,
			sub_familias.sub_familia
			from sub_familias
			inner join	familias on familias.id_familia=sub_familias.id_familia
			WHERE id_subfamilia =".$id_subfamilia;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("familia"=>$fila[0],"subfamilia"=>$fila[1]);
	}
	echo json_encode($salida);
?>