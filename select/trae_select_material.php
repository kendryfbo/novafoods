<?php
	$id_prod=$_POST["id_prod"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			productos.id_material,	
			materiales.material	
			from productos
			inner join materiales on materiales.id_material=productos.id_material
			where productos.id_producto=".$id_prod;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);

			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select id_material,material from materiales";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='materiales' onchange='$(this).select_material_pop_actualizar();' >";
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
		 			$sql1="select id_material,material from materiales";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='materiales' onchange='$(this).select_material_pop_actualizar();'>";
					echo "<option selected value='' >Seleccione Material.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";	
					echo "<div id='valida-material' style='display:none' class='errores'>Debe Ingresar Material</div>";
				 
			}
				
?>