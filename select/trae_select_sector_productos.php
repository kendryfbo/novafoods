<?php
	$id_prod=$_POST["id_prod"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$sql1="select productos.id_sector_producto,sector_productos.Sector_producto from productos inner join sector_productos on sector_productos.id_sector_producto=productos.id_sector_producto where productos.id_producto=".$id_prod;	
	$ejecuta=mysql_query($sql1,$conexion->link);
	$número_filas = mysql_num_rows($ejecuta);
	if ($número_filas<>0)
	{
		$fila1 = mysql_fetch_array($ejecuta);
		echo "<td>";
		echo "<select id='sector_prod'>";
		echo "<option id=".$fila1[0]." selected>".utf8_encode($fila1[1])."</option>";
		$sql="select * from sector_productos order by Sector_producto ";
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
		echo "<select id='sector_prod'>";
		echo "<option value='' selected>Ingrese  Sector........</option>";
		$sql="select * from sector_productos  order by Sector_producto";	
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila1 = mysql_fetch_array($ejecuta))
		{	
			echo "<option id=".$fila1[0].">".utf8_encode($fila1[1])."</option>";
		}
		
		echo "<div id='valida-sector' style='display:none' class='errores'>Debe Ingresar Sector para el Producto</div>"; 
		echo "</td>";
	}
?>