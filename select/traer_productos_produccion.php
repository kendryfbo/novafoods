<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	
	$sql="select numero_pallet,unidades_producidas,productos.nombre_producto,id_produccion
	from produccion
	inner join productos on productos.id_producto=produccion.id_producto
	where espera<>'Si'";				
	$ejecuta=mysql_query($sql,$conexion->link);
	

		echo "
			<thead>
				<tr>				 
				<td width='6%' align='center' bgcolor='#cacaca'></td>				
			 	<td width='15%' align='center' bgcolor='#cacaca'><label>Numero de Pallet</label></td>				
				<td width='15%' align='center' bgcolor='#cacaca'><label>Cantidad</label></td>	
				<td width='40%' align='center' bgcolor='#cacaca'><label>Producto</label></td>	
			 </tr>
			 </thead>";
	while ($fila = mysql_fetch_array($ejecuta))
	{
	echo  "<tbody>
			 <tr>
				<td><input type='radio' name='producto' value=".$fila[3]."></td>
				<td><label>".$fila[0]."</label></td>			 
				<td><label>".$fila[1]."</label></td>			 
				<td><label>".$fila[2]."</label></td>				
			 </tr>";
			 
	}
	echo "<tr>
			<td colspan='4'>
				<div class='fright'><input type='submit' onClick='$(this).aceptar_prod_produccion();' value='Aceptar &raquo;'/></div> 
				<div id='valida-producto' style='display:none' class='errores'>
					Debe Seleccionar Alguna Opcion
				</div> 
			</td>
		</tr>	
		</tbody>"; 
?>