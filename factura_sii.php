<?php
	date_default_timezone_set('UTC');
	$fecha=date("Y-m-d");
	include_once("clases/conexion.php"); 
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	} 
	$user=($_SESSION['usuario']);
	$id_Usuario=($_SESSION['id_Usuario']);  
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Factura Sii</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_ventas_productos.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
</head>
<script>
$(document).ready(function() {	
	$('#factura').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#factura").val())==="0") 
			{
				$("#factura").focus();
				$('#valida-factura_0').fadeIn('slow'); 
				setTimeout(function(){$('#valida-factura_0').fadeOut('slow');},1000); 
				$("#factura").val('');
				return false;
			}
			if($.trim($("#factura").val())==="") 
			{
				$("#factura").focus();
				$('#valida-factura_1').fadeIn('slow'); 
				setTimeout(function(){$('#valida-factura_1').fadeOut('slow');},1000); 
				$("#factura").val('');
				return false;
			}	
			var factura=$("#factura").val();
			var stream="factura="+factura+"&"+"funcion="+23;
			$.ajax({
				type: "POST",
				url: "select/funciones_facturacion.php",
				data:stream,
				success: function(data)	{
					if (data==1)
					{
						alert ("Factura Vacia Ingrese Otra");
						location.href = "factura_sii.php";	
					}
					else if (data==2)
					{
						$('#div_anular').show();
						var factura=$("#factura").val();
						var stream="factura="+factura+"&"+"funcion="+18;
						$.ajax({
							type: "POST",
							url: "select/funciones_facturacion.php",
							data:stream,
							cache: false,
							dataType: 'json',
							success: function(data)	{
								for(i=0;i<data.length;i++)
								{
									if (data[i].valor==1)
									{
										alert ("Factura Vacia Ingrese Otra");
										location.href = "factura_sii.php";	
									}
									else
									{
										$('#productos_finanzas').html('');					
										$('#num_proforma').val(data[i].numero_proforma);
										$('#fecha_factura').val(data[i].fecha_factura);
										$('#fecha_factura_vcto').val(data[i].fecha_vencimiento);
										$('#cliente').val(data[i].nombre_cliente);	
										$('#direccion').val(data[i].direccion);
										$('#pais').val(data[i].pais);	
										$('#medio_transporte').val(data[i].medio_de_transporte);	
										$('#p_embarque').val(data[i].puerto_embarque);	
										$('#p_destino').val(data[i].puerto_destino);
										$('#cond_pago').val(data[i].forma_pago);
										$('#cent_venta').val(data[i].centro_venta);
										$('#descripcion').val(data[i].observacion);	
										$('#subtotal').val(data[i].Subtotal);
										$('#freight').val(data[i].freight);
										$('#insurance').val(data[i].insurance);
										$('#total').val(data[i].total);
										$('#descuento').val(data[i].descuento);
										$('#claus_venta').val(data[i].clausula_venta);
										$('#t_moneda').val(data[i].tipo_moneda);
										var stream="factura="+factura+"&"+"funcion="+19;
										$.ajax({
											type: "POST",
											url: "select/funciones_facturacion.php",
											data:stream,
											success: function(data)	{
												$('#productos_finanzas').append(data);
											}
										});
									}
								}
							}			
						});
					}
					else if (data==3)
					{
						$('#anulada_td').show();
						var factura=$("#factura").val();
						var stream="factura="+factura+"&"+"funcion="+18;
						$.ajax({
							type: "POST",
							url: "select/funciones_facturacion.php",
							data:stream,
							cache: false,
							dataType: 'json',
							success: function(data)	{
								for(i=0;i<data.length;i++)
								{
									if (data[i].valor==1)
									{
										alert ("Factura Vacia Ingrese Otra");
										location.href = "factura_sii.php";	
									}
									else
									{
										$('#productos_finanzas').html('');					
										$('#num_proforma').val(data[i].numero_proforma);
										$('#fecha_factura').val(data[i].fecha_factura);
										$('#fecha_factura_vcto').val(data[i].fecha_vencimiento);
										$('#cliente').val(data[i].nombre_cliente);	
										$('#direccion').val(data[i].direccion);
										$('#pais').val(data[i].pais);	
										$('#medio_transporte').val(data[i].medio_de_transporte);	
										$('#p_embarque').val(data[i].puerto_embarque);	
										$('#p_destino').val(data[i].puerto_destino);
										$('#cond_pago').val(data[i].forma_pago);
										$('#cent_venta').val(data[i].centro_venta);
										$('#descripcion').val(data[i].observacion);	
										$('#subtotal').val(data[i].Subtotal);
										$('#freight').val(data[i].freight);
										$('#insurance').val(data[i].insurance);
										$('#total').val(data[i].total);
										$('#descuento').val(data[i].descuento);
										$('#claus_venta').val(data[i].clausula_venta);
										$('#t_moneda').val(data[i].tipo_moneda);
										var stream="factura="+factura+"&"+"funcion="+19;
										$.ajax({
											type: "POST",
											url: "select/funciones_facturacion.php",
											data:stream,
											success: function(data)	{
												$('#productos_finanzas').append(data);
											}
										});
									}
								}
							}			
						});
					}
				}
			});
		}
	});
	$("#anular").click(function() {
		var factura=$("#factura").val();
		if($.trim($("#factura").val())==="") 
		{
			$("#factura").focus();
			$('#valida-factura').fadeIn('slow'); 
			setTimeout(function(){$('#valida-factura').fadeOut('slow');},1000); 
			$("#factura").val('');
			return false;
		}
		if($.trim($("#factura").val())==="0") 
		{
			$("#factura").focus();
			$('#valida-factura_0').fadeIn('slow'); 
			setTimeout(function(){$('#valida-factura_0').fadeOut('slow');},1000); 
			$("#factura").val('');
			return false;
		}
		var stream="factura="+factura+"&"+"funcion="+22;
		$.ajax({
			type: "POST",
			url: "select/funciones_facturacion.php",
			data:stream,
			success: function(data)	{
				alert ("Factura Anulada");	
				location.href = "factura_sii.php";
			}
		});
	});
});
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Factura Exportacion</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_comercializacion.php"><input type="button" value="Volver&raquo;"/></a>
								<a href="factura_sii.php"><input type="button" value="Nuevo&raquo;"/></a>
								<div id='div_anular' style="display:none">
									<a href="#"><input type="button" id='anular' value="Anular&raquo;"/></a>
								</div>
							</div>
						</div>
					 	<table class="tableform">
							<tr>
								<td style="display:none" id="anulada_td" >
								<input type="text" id="anulada"  value='Anulada' readonly style="border:1px solid #FD0C0C"/>	
								</td>
							</tr>
							<tr>
								<td>
									<label>Numero Proforma</label>
								</td>
								<td>
									<label>Factura</label>
								</td>
								<td>
									<label>Fecha</label>
								</td>
								<td>
									<label>Fecha de Vencimiento</label>
								</td>							
							</tr>
								<td>
 									<input type="text" id="num_proforma" readonly placeholder="Numero de Proforma"/>	
								</td>
								<td>
 									<input type="text" id="factura" placeholder="Factura"/>	
									<div id="valida-factura" style="display:none" class="errores">
										Factura Se encuenta Ingresada En el Sistema  
									</div> 
									<div id="valida-factura_1" style="display:none" class="errores">
										Ingrese Factura  
									</div> 
									<div id="valida-factura_0" style="display:none" class="errores">
										Factura  no Puede ser 0
									</div> 
								</td>
								<td>
									<input type="text" id="fecha_factura" placeholder="Fecha Factura" readonly/>
								</td>
								<td>
									<input type="text" id="fecha_factura_vcto" placeholder="Fecha de Vencimiento" readonly/>
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
								<td>		
									<label>Medio de Transporte</label>
								</td>		
							</tr>
								<td>
 									<input type="text" id="cliente" placeholder="Cliente" readonly/>
								</td>
								<td>
									<input type="text" id="direccion" placeholder="Direccion" readonly/>
								</td>
								<td>
									<input type="text" id="pais" placeholder="Pais" readonly/>
								</td>
								<td>								
									<input type="text" id="medio_transporte" placeholder="Medio de Transporte" readonly/>
								</td>
							<tr>
								<td>
									<label>Puerto de Embarque</label>
									<input type="text" id="p_embarque" placeholder="Puerto de Embarque" readonly/>
				 				</td>
								<td>
									<label>Puerto de Destino</label>
									<input type="text" id="p_destino" placeholder="Puerto de Destino" readonly/>
								</td>
								<td>
									<label>Tipo de Moneda</label>
									<input type="text" id="t_moneda" placeholder="Tipo de Moneda" readonly/>
								</td>
								<td>
									<label>Centro de Venta</label>
									<input type="text" id="cent_venta" placeholder="Centro de Venta" readonly/>
								</td>
							</tr>
							<tr>
								<td>
									<label>Descripcion de la Mercaderia</label>
									<textarea rows="3" cols="30" id='descripcion' placeholder="Descripcion" readonly></textarea>
								</td>									
								<td>
									<label>Condicion de Pago</label>
									<input type="text" id="cond_pago" placeholder="Condicion de Pago" readonly/>
									<div id="valida-c_pago" style="display:none" class="errores" >
										Debe Ingresar Condicion de Pago
									</div> 
								</td>
								<td>
									<label>Clausula de Venta</label>
									<input type="text" id="claus_venta" placeholder="Clausula de Venta" readonly/> 
								</td>
							</tr>							 
							<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter" > 
												<thead> 
													<tr>
														<th width="100">
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
													</tr> 
													<tbody id='productos_finanzas'>
														<div id="valida-productos_pedidos" style="display:none" class="errores">
															Debe Ingresar Productos para crear Proforma
														</div> 
														<div id="valida-productos_repetidos" style="display:none" class="errores">
															Productos ya se Encuentran en la Proforma
														</div> 
													</tbody>
												</thead>
											 </table>
										</div>
									</article>
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
								<td colspan="1">
									<label>Sub Total</label>
								</td>
								<td>
									<input type="text" id="subtotal" value="0" readonly/>
								</td>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>DESCUENTO</label>
									</td>
									<td>
										<input type="text" id="descuento" readonly/>
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
										<input type="text" id="freight" value="0" readonly/>
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
										<input type="text" id="insurance" value="0" readonly/>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td  id='tit_total'>
									</td>
									<td>
										<input type="text" id="total" value="0" readonly/>
									</td>
								</tr>
								<td colspan="5">
										<div class="fright"> 
											<input type="submit" onClick='$(this).imprimir_fact_int();' value="Imprimir Factura &raquo;"/> 
										</div>
									</td>
							</table>
						</div>
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>