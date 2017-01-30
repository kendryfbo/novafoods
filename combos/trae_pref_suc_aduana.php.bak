<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();

	$id_prov=trim($_POST["id_prov"]);

	$sql="select * from comuna_cl where id_pr='$id_prov'";
	$ejecuta=mysql_query($sql,$conexion->link);
	
	echo "<option value='' selected>Seleccione Comuna...</option>";
	while ($fila = mysql_fetch_array($ejecuta))	{
		
		
		echo "<option id=".$fila[0].">".utf8_encode($fila[2])."</option>";

	}
	//echo json_encode($salida);


?>