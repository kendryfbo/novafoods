<?php
	$id_cliente=$_POST["id_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select id_region	from cliente_nacional where id_cliente=".$id_cliente;
 	$ejecuta=mysql_query($sql1,$conexion->link);
	$número_filas = mysql_num_rows($ejecuta);
	if ($número_filas<>0)
	{
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$sql1="select cliente_nacional.id_comuna,comunas.comuna from cliente_nacional 
			inner join comunas on comunas.id_comuna=cliente_nacional.id_comuna where cliente_nacional.id_cliente=".$id_cliente;				
			$ejecuta1=mysql_query($sql1,$conexion->link);
			$número_filas1 = mysql_num_rows($ejecuta1);
			if ($número_filas1<>0)
			{	
				$sql2="select id_comuna,comuna from comunas where id_region=".$fila[0];	
				$ejecuta2=mysql_query($sql2,$conexion->link);
				echo "<select id='list_comuna'>";
				while ($fila1 = mysql_fetch_array($ejecuta1))
				{
					echo "<option id=".$fila1[0]." selected >".utf8_encode($fila1[1])."</option>";
				}
				while ($fila2 = mysql_fetch_array($ejecuta2))
				{
					echo "<option id=".$fila2[0].">".utf8_encode($fila2[1])."</option>";							
				}
					echo "</select>";
			}
			else
			{
				$sql2="select id_comuna,comuna from comunas where id_region=".$fila[0];	
				$ejecuta2=mysql_query($sql2,$conexion->link);
				echo "<select id='list_comuna'>";
				echo "<option value=''  selected>Seleccione Comuna</option>";	
				while ($fila1 = mysql_fetch_array($ejecuta2))
				{
					echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
				}
					echo "</select>";
					echo "<div id='valida-comuna' style='display:none' class='errores'>Debe Ingresar Comuna</div>";
			}
		}
	}
	else
	{
		echo "<select id='list_comuna'>";
		echo "<option value=''  selected>Seleccione Comuna</option>";			 
	 	echo "</select>";
		echo "<div id='valida-comuna' style='display:none' class='errores'>Debe Ingresar Comuna</div>";
	}
				
?>