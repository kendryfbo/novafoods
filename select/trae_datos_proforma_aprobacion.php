<?php	
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$sql1="select 
				numero_proforma,
				cliente_internacional.rut,
				cliente_internacional.nombre_cliente,
				proforma.forma_pago,
				proforma.total
				from proforma
				inner join  cliente_internacional on cliente_internacional.id_cliente=proforma.id_cliente
				where proforma.ingresada='Si' and proforma.aceptada='' and proforma.rechazada=''";
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			echo "<thead> 
						<tr>
							<th>
								N.vta
							</th>					 
							<th>
								Rut
							<th>
								Cliente
							</th>
							<th>
								Monto
							</th>
							<th>
								Condicion Vta
							</th>
							<th>
								Aceptar
							</th>
							<th>
								Rechazar
							</th>
							<th>
								Detalle
							</th>	
						</tr> 
					</thead>";
			while ($fila=mysql_fetch_array($ejecuta))
			{
				
				echo "<tbody >
						<tr>
							<td>".$fila[0]."</td>
							<td>".$fila[1]."</td> 
							<td>".$fila[2]."</td> 
							<td>".number_format($fila[4] ,2	 , "," ,".")."</td> 				 
							<td>".$fila[3]."</td> 
							<td class='width10'><a href='#' onClick='$(this).aceptar_proforma(".$fila[0].");' title='Aceptar' class='icon-editar info-tooltip'></a></td>
							<td class='width10'><a href='#' onClick='$(this).rechazar_proforma(".$fila[0].");' title='Rechazar' class='icon-editar info-tooltip'></a></td>
							<td class='width10'><a href='#' onClick='$(this).detalles_proforma(".$fila[0].");' title='Detalles' class='icon-ver info-tooltip'></a></td>
						</tr>
					</tbody>";
			}
		}
		else
		{
			echo "<td>No Existen Proformar Por Aprobar</td>"; 
		}
	}
	else if ($funcion==2)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		try{
			$sql1="UPDATE proforma	 
				set 		 
				aceptada='Si'
				where numero_proforma=".$numero_proforma;
			$resultado2=mysql_query($sql1,$conexion->link);
			echo "Proforma Aceptada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


	}
	else if ($funcion==3)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		try{

			$sql1="UPDATE proforma	 
				set 		 
				rechazada='Si'
				where numero_proforma=".$numero_proforma;
			$resultado2=mysql_query($sql1,$conexion->link);
		
			echo "Proforma Rechazada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==4)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="select 
			cliente_internacional.nombre_cliente,
			DATE_FORMAT(fecha_proforma, '%d/%m/%y') as fecha,
			centro_venta.centro_venta,
			cliente_internacional.direccion
		
			from proforma
		
			inner join cliente_internacional on cliente_internacional.id_cliente=proforma.id_cliente
			inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta			
			where numero_proforma=".$numero_proforma;
			$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila=mysql_fetch_array($ejecuta))
		{			
			echo "<table class='table'>
					<tr>
						<td height='100%'>
							<div class='body'>
								<div class='modulo widht_modulo_full'>
									<table class='tableform'>
										<tr>
											<td>
												<label>Numero Proforma</label>
											</td>
											<td>
												<label>Fecha</label>
											</td>
											<td>
												<label>Centro de Venta</label>
											</td>							
										</tr>
											<td>
												<input type='text' id='num_proforma' value=".$numero_proforma." readonly/>
											</td>
											<td>
												<input type='text' id='fecha_proforma'  value=".$fila[1]." readonly/>
											</td>
											<td>
												<input type='text' id='centro_venta'  value=".$fila[2]." readonly/>
											</td>
											<tr>
											<td>
												<label>Cliente</label>
											</td>
											<td>
												<label>Direccion</label>
											</td>
											<td>
												<label>Pais</label>
											</td>							
										</tr>
											<td>
												<input type='text' id='cliente' value=".$fila[0]." readonly/>
											</td>
											<td>		
												<input type='text' id='direccion' value=".$fila[3]." readonly/>
											</td>
											<td>		
												<input type='text' id='pais'   readonly/>
											</td>
										<tr>
											<td>
												<label>Medio de Transporte</label>
												<select id='medio_transporte'>
												</select>
											</td>
											<td>
												<label>Puerto de Embarque</label>
												<input type='text' id='p_embarque'/>
											</td>
											<td>
												<label>Puerto de Destino</label>
												<input type='text' id='p_destino' placeholder='Puerto de Destino'/>
											</td>
										</tr>
											<tr>
												<td>
													<label>Descripcion de la Mercaderia</label>
													<textarea rows='3' cols='30' id='descripcion' placeholder='Descripcion'></textarea>
												</td>
												<td>
													<label>Tipo de Moneda</label>
													<select id='list_tip_mon'>
													</select>
												</td>
												<td>
													<label>Condicion de Pago</label>
													<input type='text' id='c_pago'/>
												</td>
											</tr>
											<tr>
												<td>
													<label>Clausula de Venta</label>
													<select id='clausula_venta'>
														<option selected value='' >Seleccione Clausula.....</option>
														<option id='1'>C.I.F.</option>
														<option id='2'>FOB</option>
														<option id='3'>CFR</option>
												</select>
												</td>
											</tr>										
										<tr>
											<td colspan='5'>
												<article class='module width_full'>            
													<div class='module_content'>
														<table class='tablesorter'> 
															<thead> 
																<tr>
																	<th width='100'>
																		Codigo de	Producto
																	</th>
																	<th>
																		Producto
																	</th>
																	<th>
																		Solicitado
																	</th>
																	 <th>
																		Precio
																	</th>
																	<th>
																		Total
																	</th>
																</tr>";
																$sql1="select 
																	productos.codigo_producto,
																		productos.nombre_producto,
																		detalle_proforma.Cantidad,
																		detalle_proforma.Precio,
																		detalle_proforma.total
																		from detalle_proforma
																		inner join  productos on productos.id_producto=detalle_proforma.id_producto
																		where numero_proforma=".$numero_proforma;
																$ejecuta1=mysql_query($sql1,$conexion->link);
																while ($fila1=mysql_fetch_array($ejecuta1))
																{
																	echo "<tbody id='productos_finanzas'>	
																	<td>".$fila1[0]."</td>
																	<td>".$fila1[1]."</td> 
																	<td>".$fila1[2]."</td> 
																	<td>".number_format($fila1[3] ,2, "," ,".")."</td> 	
																	<td>".number_format($fila1[4] ,2, "," ,".")."</td> 	
																</tbody>";
																}
														echo "</thead>
														 </table>
													</div>
												</article>
											</td>
										</tr>
										<tr>
											<td>
												&nbsp;
											</td>
											<td colspan='1'>
												<label>Sub Total</label>
											</td>
											<td>
												<input type='text' id='subtotal' value='0' readonly/>
											</td>
											<tr>
												<td>
													&nbsp;
												</td>
												<td>
													<label>DESCUENTO</label>
												</td>
												<td>
													<input type='text' id='descuento' maxlength='2'/>
												</td>							 
												<td>								
													<label>% Desc</label>									
												</td>
											</tr>
											 <tr>
												<td>
													&nbsp;
												</td>
												<td>
													<label>FREIGHT</label>
												</td>
												<td>
													<input type='text' id='freight' value='0'/>
												</td>
												<td>
													&nbsp;
												</td>
											</tr>
											<tr>
												<td>
													&nbsp;
												</td>
												<td>
													<label>INSURANCE</label>
												</td>
												<td>
													<input type='text' id='insurance' value='0'/>													
												</td>
											</tr>
											<tr>
												<td>
													&nbsp;
												</td>
												<td  id='tit_total'>
												</td>
												<td>
													<input type='text' id='total' value='0' readonly/>
												</td>
											</tr>											
										</table>
									</div>
								</div>		
							</div>
						</div>
					</td>
				</tr>
			</table>";
		}
	}
?>