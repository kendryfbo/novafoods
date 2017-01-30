<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$numero_orden_compra=trim($_POST["numero_orden_compra"]);

	$sql1="select numero_orden_compra from orden_compra
		where numero_orden_compra=".$numero_orden_compra." and id_estado_orden_compra=5 and id_area <>2";
	$resultado=mysql_query($sql1,$conexion->link);
	$mensaje=mysql_fetch_array($resultado);
 
	if ($mensaje[0]<>"")
	{
		echo "Error";
		return false;
	}
	else
	{
		echo "Ok";
	}
?>	