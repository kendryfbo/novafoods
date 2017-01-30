<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$id_area=$_POST["id_area"];	
	
	$sql1="select 
			id_producto,	
			nombre_producto	
			from productos
			where id_sector_producto=".$id_area." and habilitado='s' order by nombre_producto ";
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);

		if ($número_filas<>0)
		{
			echo "<label>Producto</label>";
			echo "<select id='lista_productos' onchange='$(this).select_producto();'>";
			echo "<option selected value='' >Seleccione Producto.....</option>";
			while ($fila = mysql_fetch_array($ejecuta))
			{
				echo "<option id=".$fila[0].">".utf8_encode($fila[1])."</option>";
			}
			echo "</select>";
			echo "<div id='valida-producto' style='display:none' class='errores'>Debe Ingresar Producto	</div>"; 
			echo "<div id='valida-producto_orden' style='display:none' class='errores'>Producto ya Se Encuentra Registado en la Orden de Compra	</div>"; 
		}
?>