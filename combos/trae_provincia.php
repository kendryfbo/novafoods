<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();

	$id_reg=trim($_POST["id_reg"]);

	$sql="select * from provincia_cl where id_re='$id_reg'";
	$ejecuta=mysql_query($sql,$conexion->link);
	
	echo "<option value='' selected>Seleccione Provincia...</option>";
	while ($fila = mysql_fetch_array($ejecuta))	{
		
		
		echo "<option id=".$fila[0]." value=".utf8_encode($fila[2]).">".utf8_encode($fila[2])."</option>";

	}
	//echo json_encode($salida);


?>