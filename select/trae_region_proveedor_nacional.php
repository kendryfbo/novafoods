<?php
	$id_proveedor_nacional=$_POST["id_proveedor_nacional"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			regiones.id_region,	
			regiones.region	
			from proveedores_nacionales
			inner join regiones on regiones.id_region=proveedores_nacionales.id_region
			where id_proveedor=".$id_proveedor_nacional;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);

			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select id_region,region from regiones";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select  onchange='$(this).select_region();' id='regiones'>";
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
		 			$sql1="select id_region,region from regiones";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select  onchange='$(this).select_region();' id='regiones'>";
					echo "<option value='' selected>Seleccione Region</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0].">".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";
					echo "<div id='valida-region' style='display:none' class='errores'>Debe Ingresar Region</div>";
						
			}
				
?>