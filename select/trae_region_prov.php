<?php
	$id_proveedor_nacional=$_POST["id_proveedor_nacional"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			proveedor.id_reg,	
			region_cl.str_descripcion	
			from proveedor
			inner join region_cl on region_cl.id_re=proveedor.id_reg
			where proveedor.id_proveedor=".$id_proveedor_nacional;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);

			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select id_re,str_descripcion from region_cl";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					//echo "<select id='lista_pagos' >";
					echo "<option id=".$fila[0]." selected >".utf8_encode($fila[1])."</option>";
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
					//	echo "</select>";				 
				}
			}
			else
			{
		 			$sql1="select id_re,str_descripcion from region_cl";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					//echo "<select id='lista_pagos'>";
					echo "<option selected value='' >Seleccione Region.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
					//	echo "</select>";	
					//echo "<div id='valida-lista_pagos' style='display:none' class='errores'>Debe Ingresar Cond. Pago</div>";
				 
			}
				
?>