<?php
	$id_familia=$_POST["id_familia"];
 	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$sql1="select id_subfamilia,sub_familia from sub_familias where id_familia=".$id_familia;	
	$ejecuta=mysql_query($sql1,$conexion->link);
	$número_filas = mysql_num_rows($ejecuta);
	if ($número_filas<>0)
	{
		$fila1 = mysql_fetch_array($ejecuta);
		echo "<td>";	
		echo "<label> Subfamilia  </label>";
		echo "</td>";
		echo "<td>";
		echo "<select id='Subfamilia'>";
		echo "<option value='' selected>Ingrese  Subfamilia........</option>";
		while ($fila = mysql_fetch_array($ejecuta))
		{	
			echo "<option id=".$fila[0].">".utf8_encode($fila[1])."</option>";
		}
		echo "</td>";
				
	}
	else
	{
		echo "<td>";
		echo "<label> Subfamilia  </label>";
		echo "</td>";
		echo "<td>";
		echo "<select id='Subfamilia'>";
		echo "<option value='' selected>Ingrese  Subfamilia........</option>";
		$sql="select id_subfamilia,sub_familia from sub_familias  order by sub_familia";	
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila1 = mysql_fetch_array($ejecuta))
		{	
			echo "<option id=".$fila1[0].">".utf8_encode($fila1[1])."</option>";
		}
 		echo "</td>";
	}
?>