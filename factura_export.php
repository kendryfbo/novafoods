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
	<title>Factura Export</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
        <script src="js/funcion_combos.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_ventas_productos.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
</head>
<script>
$(document).ready(function() {	
	$("#fecha_factura").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$( "#fecha_factura" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_factura_vcto").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	 $("#fecha_factura_vcto").datepicker( $.datepicker.regional[ "es" ]);	
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
			var action = confirm('Esta seguro que desea Ingresar Esta Factura ?');
			if(action==true)
			{
				var factura=$("#factura").val();
				var stream="factura="+factura+"&"+"funcion="+13;
				$.ajax({
					type: "POST",
					url: "select/funciones_facturacion.php",
					data:stream,
					success: function(data)	{
                                            //alert(data);
						if (data==1)
						{
							$("#factura").attr('disabled',true);
							var proforma=$("#num_proforma").val();
							var stream="factura="+factura+"&"+"proforma="+proforma+"&"+"funcion="+17;
							$.ajax({
								type: "POST",
								url: "select/funciones_facturacion.php",
								data:stream,
								success: function(data)	{
								}
							});
						}
						else//si existe
						{
							
							var stream="factura="+factura+"&"+"funcion="+24;
							$.ajax({
								type: "POST",
								url: "select/funciones_facturacion.php",
								data:stream,
								success: function(data)	{
                                                                    //alert(data);
                                                                    $("#num_proforma").val(data);
                                                                    var num_proforma=$("#num_proforma").val();
                                                                    $("#num_proforma").attr('disabled',true);
                                                                    $("#factura").attr('disabled',true);
                                                                    //alert(num_proforma+" a qui");
                                                                    var stream="num_proforma="+num_proforma+"&"+"funcion="+11;
                                                                    $.ajax({
                                                                            type: "POST",
                                                                            url: "select/funciones_facturacion.php",
                                                                            data:stream,
                                                                            cache: false,
                                                                            dataType: 'json',
                                                                            success: function(data){
                                                                                    for(i=0;i<data.length;i++)
                                                                                    {
                                                                                            $('#cliente').val(data[i].cliente);
                                                                                            $('#direccion').val(data[i].direccion);
                                                                                            $('#pais').val(data[i].pais);
                                                                                            $('#medio_transporte').val(data[i].medio_transporte);
                                                                                            $('#lis_suc_aduanas').val(data[i].p_embarque);
                                                                                            //$('#p_embarque').val(data[i].p_embarque);
                                                                                            $('#list_aduanas').val(data[i].aduana);
                                                                                            $('#p_destino').val(data[i].p_destino);
                                                                                            $('#t_moneda').val(data[i].t_moneda);
                                                                                            $('#cent_venta').val(data[i].cent_venta);
                                                                                            $('#descripcion').val(data[i].descripcion);
                                                                                            $('#claus_venta').val(data[i].claus_venta);
                                                                                            $('#cond_pago').val(data[i].cond_pago);
                                                                                            $('#freight').val(data[i].freight);
                                                                                                var subfreight=$('#freight').val();
                                                                                                var sub_freight =parseFloat(subfreight);
                                                                                                sub_freight=sub_freight.toFixed(2);
                                                                                                $('#freight').val(sub_freight);
                                                                                            
                                                                                            $('#insurance').val(data[i].insurance);
                                                                                                var subinsurance=$('#insurance').val();
                                                                                                var sub_insurance =parseFloat(subinsurance);
                                                                                                sub_insurance=sub_insurance.toFixed(2);
                                                                                                $('#insurance').val(sub_insurance);
                                                                                            $('#total').val(data[i].total);
                                                                                                var totaltotals=$('#total').val();
                                                                                                var total_tot =parseFloat(totaltotals);
                                                                                                total_tot=total_tot.toFixed(2);
                                                                                                $('#total').val(total_tot);
                                                                                            $('#descuento').val(data[i].descuento);
                                                                                            
                                                                                            $('#subtotal').val(data[i].Subtotal);
                                                                                                var subtotals=$('#subtotal').val();
                                                                                                var sub_tot =parseFloat(subtotals);
                                                                                                sub_tot=sub_tot.toFixed(2);
                                                                                                $('#subtotal').val(sub_tot);
                                                                                            
                                                                                            var stream="num_proforma="+num_proforma+"&"+"funcion="+12;
                                                                                            $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/funciones_facturacion.php",
                                                                                                    data:stream,
                                                                                                    success: function(data)	{
                                                                                                            $('#productos_finanzas').append(data);
                                                                                                            $("#ingresa_fac").hide();	
                                                                                                            //$("#imprimir").show();	
                                                                                                    }
                                                                                            });									
                                                                                    }	
                                                                            }
                                                                    });
								}
							});
                                                        /*$("#factura").focus();
							$("#factura").val("");
							$('#valida-factura').fadeIn('slow'); 
							setTimeout(function(){$('#valida-factura').fadeOut('slow');},1000); 
							return false;*/
                                                        
						}				
					}			
				});	
			}
		}
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
							</div>
						</div>
					 	<table class="tableform">
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
 									<input type="text" id="num_proforma" onchange='$(this).ingresa_proforma_facturacion();' placeholder="Numero de Proforma"/>	
									<div id="valida-Proforma_no_exs" style="display:none" class="errores">
										Debe Ingresar Proforma Existente
									</div> 
									<div id="valida-Proforma_no_aceptada" style="display:none" class="errores">
										Debe Ingresar Proforma Que Haya Sido Aceptada
									</div> 
									<div id="valida-Proforma_rechazada" style="display:none" class="errores">
										Esta Proforma Fue Rechazada
									</div> 
									<div id="valida-Proforma_sin_ing" style="display:none" class="errores">
										Debe Ingresa Proforma  
									</div> 
									<div id="valida-Proforma_facturada" style="display:none" class="errores">
										Proforma ya se Encuentra Facturada 
									</div> 									
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
									<input type="text" id="fecha_factura"  value="<?php echo date('d-m-Y')?>" readonly/>
									<div id="valida-fecha_factura" style="display:none" class="errores">
										Debe Ingresar Fecha de Factura
									</div> 
								</td>
								<td>
									<input type="text" id="fecha_factura_vcto"  value="<?php echo date('d-m-Y')?>" readonly/>
									<div id="valida-fecha_factura_vcto" style="display:none" class="errores">
										Debe Ingresar Fecha de Vencimiento de Factura
									</div> 
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
									<select id="list_aduanas">
									</select>
									<div id="valida-aduanas" style="display:none" class="errores">
										Debe Ingresar Aduana
									</div> 
								</td>
                                                                <td>
									<label>Sucursal/Puerto de Embarque</label>
									<select id='lis_suc_aduanas'>
									</select>
									<!--input type="text" id="p_embarque" placeholder="Puerto de Embarque"/-->
									<div id="valida-p_enbarque" style="display:none" class="errores">
										Debe Ingresar Puerto de Embarque
									</div>
								</td>
                                                                <!--td>
									<label>Puerto de Embarque</label>
									<input type="text" id="p_embarque" placeholder="Puerto de Embarque" readonly/>
				 				</td-->
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
														<th style='text-align:right'>
															Cantidad
														</th>
														 <th style='text-align:right'>
															Precio
														</th>
														<th style='text-align:right'>
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
                                                                    <td>
                                                                            &nbsp;
                                                                    </td>

                                                                    <td>
                                                                        &nbsp;
                                                                    </td>
                                                                    <td>
                                                                        &nbsp;
                                                                    </td>
                                                                    <td style="text-align: right">
                                                                            <article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"> 
												<thead> 
													<tr>
                                                                                                            <td>
                                                                                                                    <label>Sub Total</label>
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                    <input type="text" id="subtotal" value="0" style="text-align: right" readonly/>
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                        &nbsp;
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                <td>
                                                                                                                        <label>DESCUENTO</label>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                        <input type="text" id="descuento" style="text-align: right" readonly/>
                                                                                                                </td>							 
                                                                                                                <td>								
                                                                                                                        <label>% Desc</label>									
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                
                                                                                                                <td>
                                                                                                                        <label>FREIGHT</label>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                        <input type="text" id="freight" value="0" style="text-align: right" readonly/>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                        &nbsp;
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                
                                                                                                                <td>
                                                                                                                        <label>INSURANCE</label>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                        <input type="text" id="insurance" value="0" style="text-align: right" readonly/>
                                                                                                                </td>
                                                                                                            
                                                                                                                <td>
                                                                                                                        &nbsp;
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                
                                                                                                                <td  id='tit_total'>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                        <input type="text" id="total" value="0" style="text-align: right" readonly/>
                                                                                                                </td>
                                                                                                            
                                                                                                                <td>
                                                                                                                        &nbsp;
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                <td colspan="5">
                                                                                                                        <div class="fright" id='ingresa_fac'> 
                                                                                                                                <input type="submit" onClick='$(this).ingresa_factura_expor();' value="Crear Factura &raquo;"/> 
                                                                                                                        </div>
                                                                                                                        <div class="fright" style="display:none" id='imprimir'> 
                                                                                                                                <input type="submit" onClick='$(this).imprimir_proforma();' value="Imprimir &raquo;"/> 
                                                                                                                        </div>
                                                                                                                </td>
                                                                                                        </tr>
												</thead> 
											</table>
										</div>
									</article>
                                                                    </td>
                                                                </tr>
                                                                <!--tr>
                                                                    <td>
                                                                            &nbsp;
                                                                    </td>
                                                                    <td>
                                                                            &nbsp;
                                                                    </td>

                                                                    <td colspan="1">
                                                                            <label>Sub Total</label>
                                                                    </td>
                                                                    <td>
                                                                            <input type="text" id="subtotal" value="0" style="text-align: right" readonly/>
                                                                    </td>
                                                                </tr>
                                                                <tr>
									<td>
										&nbsp;
									</td>
                                                                    <td>
										&nbsp;
									</td>
									<td>
										<label>DESCUENTO</label>
									</td>
									<td>
										<input type="text" id="descuento" style="text-align: right" readonly/>
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
										&nbsp;
									</td>
									<td>
										<label>FREIGHT</label>
									</td>
									<td>
										<input type="text" id="freight" value="0" style="text-align: right" readonly/>
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
										&nbsp;
									</td>
									<td>
										<label>INSURANCE</label>
									</td>
									<td>
										<input type="text" id="insurance" value="0" style="text-align: right" readonly/>
									</td>
                                                                </tr>
                                                                <tr>
									<td>
										&nbsp;
									</td>
                                                                        <td>
										&nbsp;
									</td>
									<td  id='tit_total'>
									</td>
									<td>
										<input type="text" id="total" value="0" style="text-align: right" readonly/>
									</td>
                                                                </tr>
								<tr>
									<td colspan="5">
										<div class="fright" id='ingresa_fac'> 
											<input type="submit" onClick='$(this).ingresa_factura_expor();' value="Crear Factura &raquo;"/> 
										</div>
                                                                                <div class="fright" style="display:none" id='imprimir'> 
											<input type="submit" onClick='$(this).imprimir_proforma();' value="Imprimir &raquo;"/> 
										</div>
									</td>
								</tr-->
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