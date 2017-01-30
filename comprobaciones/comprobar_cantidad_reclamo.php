<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
    $id_bodega=trim($_POST["id_bodega"]);
	$cantidad=trim($_POST["cantidad"]);

	$sql1="select cantidad from calidad
				where id_bodega=".$id_bodega;
	$resultado=mysql_query($sql1,$conexion->link);
	while ($mensaje=mysql_fetch_array($resultado))
	{
		
		if ($cantidad>$mensaje[0])
		{
			echo "Error";
			return false;
		}
		else
		{
			echo "Ok";
		}
	}
?>	