<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$numero_codigo_barra=trim($_POST["numero_codigo_barra"]);
	
	$sql="select detalle_veredas.id_vereda,productos.nombre_producto,detalle_veredas.tipo_producto
	from detalle_veredas
	inner join productos on productos.id_producto=detalle_veredas.id_producto
	where detalle_veredas.id=".$numero_codigo_barra." and detalle_veredas.ingresado <> 'si' ";
	$resultado=mysql_query($sql,$conexion->link);
	$numero_filas1 = mysql_num_rows($resultado);
	if ($numero_filas1==0)
	{
		$sql3="select 
		detalle_veredas.id_vereda,productos.nombre_producto,detalle_veredas.tipo_producto,detalle_veredas.id_produccion,detalle_veredas.id,detalle_veredas.numero_orden_compra,detalle_veredas.id_producto
		from detalle_veredas
		inner join productos on productos.id_producto=detalle_veredas.id_producto
		inner join bodega_producto_terminado on bodega_producto_terminado.id_produccion=detalle_veredas.id_produccion
		where detalle_veredas.id=".$numero_codigo_barra." and detalle_veredas.retirado <> 'si' ";		
		$resultado3=mysql_query($sql3,$conexion->link);
		$numero_filas = mysql_num_rows($resultado3);	
		if ($numero_filas==0)
		{
			echo "Codigo de Barra ya Se Encuentra Obsoleto";
		}
		else
		{			
			$mensaje3 = mysql_fetch_array ($resultado3);
	
			echo"<tr>
					<td>
						Producto
					</td>
					<td>"
						.$mensaje3[1].
					"</td>			 
				</tr>
				<tr>";
			if ($mensaje3[2]=="pt")
			{	
				$sql4="SELECT IFNULL((SELECT SUM( cantidad ) FROM bodega_producto_terminado	WHERE 										
				id_produccion=".$mensaje3[3].") , 0) AS suma_bodega";
				$resultado4=mysql_query($sql4,$conexion->link);
				$mensaje4 = mysql_fetch_array ($resultado4);
				echo	"<td>
							Cantidad
						</td>
						<td>"
							.$mensaje4[0]. " Cajas
						</td>";
			}
			else
			{
				$sql2="SELECT IFNULL((SELECT SUM( cantidad ) FROM bodega_producto_materia_prima	WHERE 										
				id=".$numero_codigo_barra.") , 0) AS suma_bodega"; 
				$resultado2=mysql_query($sql2,$conexion->link);
				$mensaje2 = mysql_fetch_array ($resultado2);
				echo "<td>
							Cantidad
						</td>
						<td>"
							.$mensaje2[0]." Kilos
						</td>";			
			}
			$sql1="select id_estado_vereda from veredas
			where id=".$mensaje3[0];
			$resultado1=mysql_query($sql1,$conexion->link);
			$mensaje1 = mysql_fetch_array ($resultado1);
			if  ($mensaje1[0]==3 && $mensaje3[2]=="pt" )
			{
				echo "<tr>
						<td colspan='2'>
							<input type='submit'  onClick='$(this).retirar_producto_bodega(1);' value='Retirar &raquo;'/>
						</td>
					</tr>"; 
			}
			else if ($mensaje1[0]==3 && $mensaje3[2]=="mp")
			{
					echo "<tr>
						<td colspan='2'>
							<input type='submit'  onClick='$(this).retirar_producto_bodega(2);' value='Retirar &raquo;'/>
						</td>
					</tr>"; 
			}
		}			
	}
	else
	{
		$mensaje = mysql_fetch_array ($resultado);		
		echo "<tr>
				<td>
					Producto
				</td>
				<td>"
					.$mensaje[1].
				"</td>			 
			</tr>
			<tr>";
		if ($mensaje[2]=="pt")
		{	
			$sql2="select cajas from detalle_veredas where id=".$numero_codigo_barra;
			$resultado2=mysql_query($sql2,$conexion->link);
			$mensaje2 = mysql_fetch_array ($resultado2);
			echo	"<td>
						Cantidad
					</td>
					<td>"
						.$mensaje2[0]. " Cajas
					</td>";
		}
		else
		{
			
			$sql2="select kilos from detalle_veredas where id=".$numero_codigo_barra;
			$resultado2=mysql_query($sql2,$conexion->link);
			$mensaje2 = mysql_fetch_array ($resultado2);
			echo "<td>
						Cantidad
					</td>
					<td>"
						.$mensaje2[0]." Kilos
					</td>";			
		}
		$sql1="select id_estado_vereda from veredas
		where id=".$mensaje[0];
		$resultado1=mysql_query($sql1,$conexion->link);
		$mensaje1 = mysql_fetch_array ($resultado1);
		if ($mensaje1[0]==2 && $mensaje[2]=="pt" )
		{	
			echo "<tr>
					<td colspan='2'>
						<input type='submit'  onClick='$(this).aceptar_producto_terminado_bodega();' value='Ingresar &raquo;'/>
					</td>
				</tr>"; 
		}
		else if ($mensaje1[0]==2 && $mensaje[2]=="mp" )
		{
			echo "<tr>
					<td colspan='2'>
						<input type='submit' onClick='$(this).aceptar_producto_materia_prima();' value='Ingresa &raquo;'/>
					</td>
				</tr>"; 
		}
			/*else if  ($mensaje1[0]==3 && $mensaje[2]=="pt" )
			{
				echo "<tr>
						<td colspan='2'>
							<input type='submit'  onClick='$(this).retirar_producto_terminado_bodega();' value='Retirar &raquo;'/>
						</td>
					</tr>"; 
			}*/
		
	}
?>	