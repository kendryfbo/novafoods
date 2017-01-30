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
	$usuario=($_SESSION['usuario']);
	$id_Usuario=($_SESSION['id_Usuario']);   
	if (!isset($_GET["numero_orden_compra"]))
	{
		$numero_orden_compra=0;
	}
	else
	{
		$numero_orden_compra=$_GET["numero_orden_compra"];
	}	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Orden de compra</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_orden_compra.js" type="text/javascript"></script> 
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
 </head>
<script>
$(document).ready(function() {
 	var numero_orden_compra = "<?php echo $numero_orden_compra; ?>";
	var id_usuario = "<?php echo $id_Usuario; ?>";
	var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
	$.ajax({
		type: "POST",
		url: "insert/ingresa_orden_compra.php",
		data:stream,
		success: function(data)	{		
			$("#num_ord_compra").val (data);
		}			
	});	
	 $('#num_ord_compra').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#num_ord_compra").val())==="0") 
			{
				$("#num_ord_compra").focus();
				$('#valida-orden_facturada_cero').fadeIn('slow'); 
				setTimeout(function(){$('#valida-orden_facturada_cero').fadeOut('slow');},1000); 
				$("#num_ord_compra").val('');
				return false;
			}
			if($.trim($("#num_ord_compra").val())==="") 
			{
				$("#num_ord_compra").focus();
				$('#valida-orden_sin_ing').fadeIn('slow'); 
				setTimeout(function(){$('#valida-orden_sin_ing').fadeOut('slow');},1000); 
				$("#num_ord_compra").val('');
				return false;
			}
			var numero_orden_compra=$("#num_ord_compra").val();
			var stream="numero_orden_compra="+numero_orden_compra+"&"+"funcion="+3;
			$.ajax({
				type: "POST",
				url: "insert/ingresa_orden_compra.php",
				data:stream,
				success: function(data)	{
					if (data==1)
					{
						var stream="funcion="+4;
						$.ajax({
							type: "POST",
							url: "insert/ingresa_orden_compra.php",
							data:stream,
							success: function(data)	{
								$("#num_ord_compra").val(data);
							}			
						});	
					}
					else if (data==2)
					{
						var action = confirm('Desea Traer Orden de Compra?');
						if(action==true)
						{
							$('#btn_modificar_prod').show();
							$('#btn_ingresar_prod').hide();
							$('#actualizar_orden').show();
							$('#ingrear_orden').hide();
							var numero_orden_compra=$("#num_ord_compra").val();
							var stream="numero_orden_compra="+numero_orden_compra+"&"+"funcion="+5;
							$.ajax({
								type: "POST",
								url: "insert/ingresa_orden_compra.php",
								data:stream,
								cache: false,
								dataType: 'json',
								success: function(data)	{	
									for(i=0;i<data.length;i++)
									{
										if (data[i].resultado=="Error")
										{
											alert ("Orden de Compra Vacia");
											location.href = "crear_orden_compra.php";	
										}
										else
										{
											$("#fecha_orden_compra").val(data[i].fecha);
											$("#list_tip_mon").val(data[i].moneda);
											$("#list_areas").val(data[i].area);
											$("#descuento").val(data[i].descuento);
											$("#list_proveedor").append('<option id='+data[i].id_prov+' selected="selected">'+data[i].proveedor+'</option>');
											$("#condicion_pago").val(data[i].cond_pago);
											$("#list_tipo_proveedor").val(data[i].tipo_prov);	
											$("#rut_proveedor").val(data[i].rut);
											$("#atencion").val(data[i].Contacto);										
											if (data[i].exenta==1)
											{
												$('#exenta').prop('checked', true);
											}
											else
											{
												$('#exenta').prop('checked', false);
											}										
										}
									}	
									var stream="numero_orden="+numero_orden_compra+"&"+"funcion="+2;
									$.ajax({
										type: "POST",
										url: "select/trae_productos_orden.php",
										data:stream,
										success: function(data) {
											$('#productos_pedidos').html("");
											$('#productos_pedidos').append(data);
											var stream="numero_orden_compra="+numero_orden_compra+"&"+"funcion="+1;
											$.ajax({
												type: "POST",
												url: "select/trae_sub_total.php",
												data:stream,
												success: function(data) {
													if($("#exenta").is(':checked'))
													{					
														$('#subtotal').val(data);
														var subtotal=$('#subtotal').val(); 
														var descuento=$("#descuento").val();
														var total_descuento=(subtotal*descuento)/100;
														var total_neto=(subtotal-total_descuento);
														$('#neto').val(total_neto);
														$('#TotalPago').val(total_neto);
													}
													else
													{						
														$('#subtotal').val(data);
														var descuento=$("#descuento").val();
														var subtotal=$('#subtotal').val(); 
														var total_descuento=(subtotal*descuento)/100;
														var total_neto=(subtotal-total_descuento);
														$('#neto').val(total_neto);
														var iva=(total_neto*19)/100;
														var valor_iva=(total_neto+iva);
														$('#totaliva').val(iva);
														$('#TotalPago').val(valor_iva);
													}
												}			
											});
										}			
									});
								}
							});
						}
					}
					else if (data==3)
					{
						var stream="funcion="+4;
						$.ajax({
							type: "POST",
							url: "insert/ingresa_orden_compra.php",
							data:stream,
							success: function(data)	{
								$("#num_ord_compra").val(data);
							}			
						});
					}				
				}			
			});	
		}
	});
	// hace el descuento de los valores al anotar el valor/****//
	$("#descuento").change(function(){
		if($("#exenta").is(':checked'))
		{
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total_neto=(subtotal-total_descuento);
			$('#neto').val(total_neto);
  			$('#TotalPago').val(total_neto);
		}
		else
		{	
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total_neto=(subtotal-total_descuento);
			$('#neto').val(total_neto);
			var iva=(total_neto*19)/100;
			var valor_iva=(total_neto+iva);
			$('#totaliva').val(iva);
			$('#TotalPago').val(valor_iva);
		}
	});
	//ve si esta excenta de iva y no descuenta los valores
	$("#exenta").change(function(){
		if($("#exenta").is(':checked'))
		{   
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total_neto=(subtotal-total_descuento);
			$('#neto').val(total_neto);
  			$('#TotalPago').val(total_neto);
			$('#totaliva').val("");
			$('#totaliva').prop('disabled', true);
		}
		else
		{
			$('#totaliva').prop('disabled', false);
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total_neto=(subtotal-total_descuento);
			$('#neto').val(total_neto);
			var iva=(total_neto*19)/100;
			var valor_iva=(total_neto+iva);
			$('#totaliva').val(iva);
			$('#TotalPago').val(valor_iva);
		}
	});
	///****trae  los productos por el sector selecccionado***///
	$("#list_areas").change(function(){
		var id_area = $('#list_areas option:selected').attr('id');
		var stream="id_area="+id_area;
		$.ajax({
			type: "POST",
			url: "select/trae_select_productos_x_sector.php",
			data:stream,
			success: function(data) {					
				$("#productos").html(data);	
			}			
		});
	});
	$("#fecha_orden_compra").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	 $( "#fecha_orden_compra" ).datepicker( $.datepicker.regional[ "es" ]);
	///****trae  el contacto del proveeedor ***///
	$("#list_proveedor").change(function(){
		var id_proveedor = $('#list_proveedor option:selected').attr('id');
		var id_tipo_proveedor = $('#list_tipo_proveedor option:selected').attr('id');
		var stream="id_proveedor="+id_proveedor+"&"+"id_tipo_proveedor="+id_tipo_proveedor;
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "select/trae_contacto_segun_proveedor.php",
			data:stream,
			success: function(data) {
				for(i=0;i<data.length;i++)
				{
					$("#atencion").val(data[i].contacto);
					$("#rut_proveedor").val(data[i].rut_proveedor);
				}			
			}			
		});
	});	
});
</script>
<script>
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
					<div class="title"><p>Crear Orden de Compra</p>
					</div>
					<div class="content">  
						<br>         
							<div class="fright">
								<a href="listado_ordenes_compra.php"><input type="button" value="Volver&raquo;"/></a>
								<a href="crear_orden_compra.php"><input type="button" value="Nueva&raquo;"/></a>
							</div>
						</div>
					 	<table class="tableform">
							<tr>
								<td width="15%">
									<label>Numero</label>
								</td>
								<td width="35%" >
									<label>Tipo de Proveedor</label>
								</td>
								<td width="42%" colspan="2">
									<label>Proveedor</label>
								</td>
								<td>
									<label>Rut</label>
								</td>
							</tr>
								<input type="hidden" id="id_usuario" value="<?php echo $id_Usuario; ?>">
							<tr>
								<td>
									<input type="text" id="num_ord_compra" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-orden_no_exs" style="display:none" class="errores">
										Debe Ingresar Orden de Compra Existente
									</div> 
									<div id="valida-orden_no_aceptada" style="display:none" class="errores">
										Debe Ingresar Orden de Compra Que Haya Sido Aceptada
									</div> 
									<div id="valida-orden_rechazada" style="display:none" class="errores">
										Esta Orden de Compra Fue Rechazada
									</div> 
									<div id="valida-orden_sin_ing" style="display:none" class="errores">
										Debe Ingresa Orden de Compra  
									</div> 
									<div id="valida-orden_facturada" style="display:none" class="errores">
										Orden de Compra ya se Encuentra Facturada 
									</div>
									<div id="valida-orden_facturada_cero" style="display:none" class="errores">
										Orden de Compra no puede ser 0 !!!
									</div>	
									<div id="valida-orden_vacio" style="display:none" class="errores">
										Debe Ingresar Orden de Compra
									</div>
									<input type="hidden" id="id_usuario" value="<?php echo $id_Usuario?>"/>
								</td>
								<td>
									<select id="list_tipo_proveedor" >
										<option value="" selected >Seleccione Tipo de Proveedor....</option>
										<option id="1">Nacional</option>
										 <option id="2">Internacional</option>
									</select>
								</td>
								<td colspan="2">
									<select id="list_proveedor" >
									</select>
									<div id="valida-proveedor" style="display:none" class="errores">
										Debe Ingresar Proveedor
									</div> 
									<div id="valida-tipo_proveedor" style="display:none" class="errores">
										Debe Ingresar Tipo de Proveedor
									</div> 
								</td>
								<td colspan="2">
									<input type="text" id="rut_proveedor" readonly/>
								</td>
							</tr>
							<tr>
								<td>
									<label>Condiciones de Pago</label>
								</td>
								<td>
									<label>Moneda</label>
								</td>
								<td>
									<label>Fecha</label>
								</td>
								<td>
									<label>Area</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="condicion_pago" readonly/>
								</td>
								<td>
									<select id="list_tip_mon">
									</select>
									<div id="valida-moneda" style="display:none" class="errores">
										Debe Ingresar Tipo de moneda
									</div> 
								</td>
								<td>
									<input type="text" id="fecha_orden_compra" placeholder="Fecha"/>
									<div id="valida-fecha_orden" style="display:none" class="errores">
										Debe Ingresar Fecha Orden De Compra
									</div> 
								</td>
								<td>
									<select id="list_areas">
									</select>
									<div id="valida-area" style="display:none" class="errores">
										Debe Ingresar Area
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Atencion</label>
								</td>
								<td >
									<label></label>
								</td>
							</tr>
							<tr>
								<td width="62%" colspan="2">
									<input type="text" id="atencion" readonly/>
								</td>
							</tr>
							<tr>
								<td>
									<label>Cantidad</label>
							 		<input type="text"  id="cantidad" onkeypress="ValidaSoloNumeros()" disabled placeholder="Cantidad"/>
									<div id="valida-cantidad" style="display:none" class="errores">
										Debe Ingresar Cantidad
									</div> 
								</td>
								<td>
									<label>Precio</label>
									<input type="text" id="precio"  onkeypress="ValidaSoloNumeros()" disabled placeholder="Precio"/>
									<div id="valida-precio" style="display:none" class="errores">
										Debe Ingresar Precio
									</div> 
								</td>
								<td id='productos'>
								</td>
								<td>
									<label>Unidad De Medida</label>
									<input type="text" id="umed" disabled placeholder="Umed" readonly/>
								</td>
								<td>
									<div class="fright"  id='btn_ingresar_prod'>
										<input type="submit" onClick='$(this).ingresa_producto_finanzas();' value="Agregar Productos &raquo;"/>
									</div>
									<div class="fright" style="display:none" id='btn_modificar_prod'>
										<input type="submit" onClick='$(this).ingresa_producto_finanzas_modificar();' value="Agregar Productos &raquo;"/>
									</div>
								</td>
							</tr>
			 				<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"> 
												<thead> 
													<tr> 
														<th>
															Codigo 
														</th>
														<th>
															Producto
														</th>
														<th>
															Solicitado
														</th>
														<th>
															Costo Unitario
														</th>													
														<th>
															Total
														</th>
														<th>
															Eliminar
														</th>													
													</tr> 
													<tbody id='productos_pedidos'>
														<div id="valida-productos_pedidos" style="display:none" class="errores">
															Debe Ingresar Productos para crear orden
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
									<label>Subtotal</label>
								</td>
								<td>
									<input type="text" id="subtotal" value=0 readonly/>
								</td>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>Descuento</label>
									</td>
									<td>
										<input type="text" id="descuento" onkeypress="ValidaSoloNumeros()" maxlength="2"/>
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
										<label>Total Neto</label>
									</td>
									<td>
										<input type="text" id="neto" value=0 readonly/>
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
										<label>Total Iva</label>
									</td>
									<td>
										<input type="text" id="totaliva" value="0"  readonly/>
									</td>
									<td>									 
										<input type="checkbox" id="exenta"/>Exenta
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>Total Pago</label>
									</td>
									<td>
										<input type="text" id="TotalPago" value="0" onchange="format(this)" readonly/>
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<div class="fright" id='ingrear_orden'> 
											<input type="submit" onClick='$(this).ingresa_orden_compra();' value="Crear Orden &raquo;"/> 
										</div>
										<div class="fright" style="display:none" id='actualizar_orden'> 
											<input type="submit" onClick='$(this).actualizar_orden_compra();' value="Actualizar Orden &raquo;"/> 
										</div>
									</td>
								</tr>
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