<?php
	$id_prod=$_POST["id_prod"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$sql1="select productos.id_umed,umed.umed from productos inner join umed on umed.id_umed=productos.id_umed where productos.id_producto=".$id_prod;	
	$ejecuta=mysql_query($sql1,$conexion->link);
	$número_filas = mysql_num_rows($ejecuta);
	if ($número_filas<>0)
	{
		$fila1 = mysql_fetch_array($ejecuta);
		echo "<td>";	
		echo "<label> Unidad de Medida  </label>";
		echo "</td>";
		echo "<td>";
		echo "<select id='select_umed'>";
		echo "<option id=".$fila1[0]." selected>".utf8_encode($fila1[1])."</option>";
		$sql="select * from umed order by umed ";
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{	
			echo "<option id=".$fila[0].">".utf8_encode($fila[1])."</option>";
		}
		echo "</td>";
				
	}
	else
	{
		$fila1 = mysql_fetch_array($ejecuta);
		echo "<td>";
		echo "<label> Unidad de Medida  </label>";
		echo "</td>";
		echo "<td>";
		echo "<select id='select_umed'>";
		echo "<option value='' selected>Ingrese  Unidad de Medida........</option>";
		$sql="select * from umed  order by umed";	
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila1 = mysql_fetch_array($ejecuta))
		{	
			echo "<option id=".$fila1[0].">".utf8_encode($fila1[1])."</option>";
		}
		echo "</td>";
	}
?>