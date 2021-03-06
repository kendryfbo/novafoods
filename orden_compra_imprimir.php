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
$numero_orden= $_GET["numero_orden"];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Orden de compra Imprimir</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_orden_compra.js" type="text/javascript"></script> 
</head>
<script>
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<script>
$(document).ready(function() {
	var numero_orden = "<?php echo $numero_orden; ?>"; 
	$("#num_ord_compra").val(numero_orden)
	$.getJSON("select/trae_datos_orden_imprimir.php",{numero_orden:numero_orden},function(resultado){
		for(i=0;i<resultado.length;i++)
		{
			$("#fecha_orden_compra").val(resultado[i].fecha)
			$("#list_tip_mon").val(resultado[i].moneda)
			$("#area").val(resultado[i].area)
			$("#descuento").val(resultado[i].descuento)
			$("#proveedor").val(resultado[i].proveedor)
			$("#condicion_pago").val(resultado[i].cond_pago)
			if (resultado[i].exenta==1)
			{
				$('#exenta').prop('checked', true);
			}
			else
			{
				$('#exenta').prop('checked', false);
			}
		}		
	});
	var stream="numero_orden="+numero_orden+"&"+"funcion="+1;
	$.ajax({
		type: "POST",
		url: "select/trae_productos_orden.php",
		data:stream,
		success: function(data) {
			$('#productos_pedidos').append(data);
			var numero_orden_compra = "<?php echo $numero_orden; ?>";
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
});
 function printpage()
 {
	$('#volver').hide();  
	$('#imprimir').hide(); 
	window.print()
	$('#volver').show();  
	$('#imprimir').show();  
}
</script>
 <body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Imprimir Orden de Compra</p>
					</div>
					<div class="content">  
						<br>         
							<div class="fright">
								<a href="listado_ordenes_compra.php" ><input type="button" id='volver' value="Volver&raquo;"/></a>
								<input id="imprimir" type="button" value="Imprimir Pdf" onclick="printpage()"/> 
							</div>
						</div>
					 	<table class="tableform">
							<tr>
								<td width="15%">
									<label>Numero</label>
								</td>
								<td width="62%" colspan="2">
									<label>Proveedor</label>
								</td>
								<td width="62%" colspan="2">
									<label>Fecha Orden de Compra</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="num_ord_compra" readonly/>
								</td>
								<td colspan="2">
									<input type="text" id="proveedor" readonly/>
								</td>
								<td>
									<input type="text" id="fecha_orden_compra" readonly/>
								</td>
							</tr>
								<td colspan="2">
									<label>Condiciones de Pago</label>
								</td>
								<td>
									<label>Moneda</label>
								</td>
								<td>
									<label>Area</label>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="text" id="condicion_pago" readonly/>
								</td>
								<td>
									<input type="text" id="list_tip_mon" readonly/>
								</td>	
								<td>
									<input type="text" id="area" readonly/>
								</td>						
							</tr>
							<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"  id='productos_pedidos'> 
												<thead> 
													<tr> 
														<th width="100">
															Producto
														</th>
														<th>
															Solicitado
														</th>
														 
														<th>
															Total
														</th>
													</tr> 
													<tbody>
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
										<input type="text" id="descuento" onkeypress="ValidaSoloNumeros()" readonly maxlength="2"/>
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
										<input type="text" id="totaliva" value="0" readonly/>
									</td>
									<td>									 
										<input type="checkbox" id="exenta" onclick="return false"/>Exenta
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
										<input type="text" id="TotalPago" value="0" readonly />
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