<?php
	$id_cliente=$_POST["id_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			tipo_lista_precio.id,	
			tipo_lista_precio.nombre	
			from cliente
			inner join tipo_lista_precio on tipo_lista_precio.id=cliente.tipo_lista
			where cliente.id_cliente=".$id_cliente;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);

			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select id,nombre from tipo_lista_precio";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='lista_precio' >";
					echo "<option id=".$fila[0]." selected >".utf8_encode($fila[1])."</option>";
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";				 
				}
			}
			else
			{
		 			$sql1="select id,nombre from tipo_lista_precio";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='lista_precio'>";
					echo "<option selected value='' >Seleccione Listado de Precio.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";	
					echo "<div id='valida-lista_precio' style='display:none' class='errores'>Debe Seleccionar Listado de Precio</div>";
				 
			}
				
?>