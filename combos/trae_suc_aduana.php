<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();

	$id_adu=trim($_POST["id_adu"]);

	$sql="select * from suc_aduanas where id_aduana	='$id_adu'";
	$ejecuta=mysql_query($sql,$conexion->link);
	
	echo "<option value='' selected>Seleccione Sucrusal/Embarque...</option>";
	while ($fila = mysql_fetch_array($ejecuta))	{
		
		
		echo "<option id=".$fila[0]." value=".utf8_encode($fila[2]).">".utf8_encode($fila[1])."</option>";

	}
	//echo json_encode($salida);


?>