<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select id_altillo from altillos  group by id_altillo ORDER BY id_altillo ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	echo "<select onChange='$(this).trae_altillo();' id='combo_altillo'>";
	
	echo "<option value=''  selected>Seleccione Altillo</option>";	
		
	while ($fila2 = mysql_fetch_array($ejecuta))
	{
		echo "<option id=".$fila2[0].">".$fila2[0]."</option>";							
	}
		echo "</select>";
?>