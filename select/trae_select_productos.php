<?php
	$id_prod=$_POST["id_prod"];
	$id_sector=$_POST["id_sector"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$sql1="select productos.id_familia,familias.familia from productos inner join familias on familias.id_familia=productos.id_familia where productos.id_producto=".$id_prod;	
	$ejecuta=mysql_query($sql1,$conexion->link);
	$número_filas = mysql_num_rows($ejecuta);
	if ($número_filas<>0)
	{
		$fila1 = mysql_fetch_array($ejecuta);
		echo "<td>";	
		echo "<label> Familia  </label>";
		echo "</td>";
		echo "<td>";
		echo "<select id='familias'>";
		echo "<option id=".$fila1[0]." selected>".utf8_encode($fila1[1])."</option>";
		$sql="select id_familia,familia from familias where id_sector_producto=".$id_sector." order by familia";	
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
		echo "<label> Familia  </label>";
		echo "</td>";
		echo "<td>";
		echo "<select id='familias'>";
		echo "<option value='' selected>Ingrese  Familia........</option>";
		$sql="select id_familia,familia from familias  where id_sector_producto=".$id_sector." order by familia";	
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila1 = mysql_fetch_array($ejecuta))
		{	
			echo "<option id=".$fila1[0].">".utf8_encode($fila1[1])."</option>";
		}
 		echo "</td>";
	}
?>