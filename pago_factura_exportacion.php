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
	<title>Pago Factura Exportacion</title>
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
	$("#fecha_deposito").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$( "#id_cliente_internacional" ).change(function() {
		var id_cliente=$("#id_cliente_internacional option:selected").attr('id');
		var stream="id_cliente="+id_cliente+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/select_pagos_finanzas.php",
			data:stream,
			success: function(data)	{	
				$('#finanzas_internacional').html("");	
				$('#finanzas_internacional').append(data);
				var stream="id_cliente="+id_cliente+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/trae_suma_factura_pagos.php",
					data:stream,
					success: function(data) {
						$("#credito").val(data);
					}
				});
			}			
		});
	});
});
$.fn.aceptar_abono=function(){		
	if($.trim($("#id_cliente_internacional").val())==="") 
	{
		$("#id_cliente_internacional").focus ();
		$('#valida-c_inter').fadeIn('slow'); 
		setTimeout(function(){$('#valida-c_inter').fadeOut('slow');},1000); 
		return false;
	}
	if($.trim($("#fecha_deposito").val())==="") 
	{
		$("#fecha_deposito").focus ();
		$('#valida-fecha_deposito').fadeIn('slow'); 
		setTimeout(function(){$('#valida-fecha_deposito').fadeOut('slow');},1000); 
		return false;
	}
	if($.trim($("#monto").val())==="") 
	{
		$("#monto").focus ();
		$('#valida-monto').fadeIn('slow'); 
		setTimeout(function(){$('#valida-monto').fadeOut('slow');},1000); 
		return false;
	}
	if($.trim($("#n_documento").val())==="") 
	{
		$("#n_documento").focus ();
		$('#valida-n_documento').fadeIn('slow'); 
		setTimeout(function(){$('#valida-n_documento').fadeOut('slow');},1000); 
		return false;
	}
	var cliente=$("#id_cliente_internacional option:selected").attr('id');
	var fecha=$("#fecha_deposito").val();
	var monto=$("#monto").val();
	var n_documento=$("#n_documento").val();
	var stream="cliente="+cliente+"&"+"fecha="+fecha+"&"+"monto="+monto+"&"+"n_documento="+n_documento+"&"+"funcion="+2;
	$.ajax({
		type: "POST",
		url: "select/select_pagos_finanzas.php",
		data:stream,
		success: function(data) {
			alert (data);
		}
	});
}
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<input type="hidden" id="id_usuario" value="<?php echo $id_Usuario?>" />	
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Pago Factura Exportacion</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_finanzas.php"><input type="button" value="Volver&raquo;"/></a>
							</div>
						</div>
					 	<table class="tableform">
							<tr>
								<td>
									<label>Cliente</label>
								</td>
							</tr>
							<td>
 								<select id="id_cliente_internacional">
								</select>
								<div id="valida-c_inter" style="display:none" class="errores">
									Debe Ingresar Cliente Internacional
								</div> 
							</td>
							<tr>
								<td>
									<label>Fecha Deposito</label>
									<input type="text" id="fecha_deposito"  value="<?php echo date('d-m-Y')?>" placeholder="Fecha" readonly/>
									<div id="valida-fecha_deposito" style="display:none" class="errores">
										Debe Ingresar Fecha de Deposito
									</div> 
								</td>							
								<td>
									<label>Credito</label>
									<input type="text" id="credito" placeholder="Credito"/>
									<div id="valida-credito" style="display:none" class="errores">
										Debe Ingresar Credito
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Monto de Deposito</label>
									<input type="text" id="monto" placeholder="Monto de Deposito"/>
									<div id="valida-monto" style="display:none" class="errores">
										Debe Ingresar Monto de Deposito
									</div> 
								</td>
								<td>
									<label>N Documento de Pago</label>
									<input type="text" id="n_documento" placeholder="Numero de Documento"/>
									<div id="valida-n_documento" style="display:none" class="errores">
										Debe Ingresar Numero de Documento
									</div> 
								</td>
							</tr>
						</table>
  						<div class="module_content">
							<table class="tablesorter" id='finanzas_internacional'> 
							</table>							
							<div class="fright"> 
								<input type="submit" onClick='$(this).aceptar_abono();' value="Aceptar &raquo;"/> 
							</div>
						</div>
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>