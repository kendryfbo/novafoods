<?php
	$id_cliente=$_POST["id_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			cliente.cond_pago,	
			condiciones_pago.Condicion	
			from cliente
			inner join condiciones_pago on condiciones_pago.id_condicion=cliente.cond_pago
			where cliente.id_cliente=".$id_cliente;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);

			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select id_condicion,Condicion from condiciones_pago";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='lista_pagos' >";
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
		 			$sql1="select id_condicion,Condicion from condiciones_pago";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='lista_pagos'>";
					echo "<option selected value='' >Seleccione Cond. Pâgo.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";	
					echo "<div id='valida-lista_pagos' style='display:none' class='errores'>Debe Ingresar Cond. Pago</div>";
				 
			}
				
?>