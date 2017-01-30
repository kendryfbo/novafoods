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
	<title>Cancelaciones</title>
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
	var id_usuario = "<?php echo $id_Usuario; ?>";
	$("input[name=tipo_pago]").change(function() {
		if($("input[name='tipo_pago']:checked").val()==1)
		{
			$('#cuentas_banco').show();
			$('#cancelacion_efectivo').hide();
		}
		else if ($("input[name='tipo_pago']:checked").val()==2)
		{
			$('#cancelacion_efectivo').show();
			$('#cuentas_banco').hide();
		}
	});
	$("#fecha_cancelacion").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$( "#fecha_cancelacion" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_Vencimiento").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	 $( "#fecha_Vencimiento" ).datepicker( $.datepicker.regional[ "es" ]);
});
$.fn.ingresa_pago=function(tipo){		
	if (tipo==1)
	{	 
		if($('#id_cliente_nacional option:selected').val()==="") 
		{
			$("#id_cliente_nacional").focus();
			$('#valida-c_nac').fadeIn('slow'); 
			setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
			return false;
		}
		if($('#list_bancos option:selected').val()==="") 
		{
			$("#list_bancos").focus();
			$('#valida-banco').fadeIn('slow'); 
			setTimeout(function(){$('#valida-banco').fadeOut('slow');},1000); 
			return false;
		}
		if($('#n_cheque').val()==="") 
		{
			$("#n_cheque").focus();
			$('#valida-n_cheque').fadeIn('slow'); 
			setTimeout(function(){$('#valida-n_cheque').fadeOut('slow');},1000); 
			return false;
		}
		if($('#fecha_Vencimiento').val()==="") 
		{
			$("#fecha_Vencimiento").focus();
			$('#valida-fecha_Vencimiento').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_Vencimiento').fadeOut('slow');},1000); 
			return false;
		}
		if($('#monto_cheque').val()==="") 
		{
			$("#monto_cheque").focus();
			$('#valida-monto_cheq').fadeIn('slow'); 
			setTimeout(function(){$('#valida-monto_cheq').fadeOut('slow');},1000); 
			return false;
		}
		var id_cliente_nacional=$("#id_cliente_nacional option:selected").attr('id');
		var id_banco=$("#list_bancos option:selected").attr('id');
		var numero_cheque=$("#n_cheque").val();
		var fecha_vencimiento=$("#fecha_Vencimiento").val();
		var monto_cheque=$("#monto_cheque").val();
		var tipo_pago=$("input[name='tipo_pago").val();
		var stream="id_cliente_nacional="+id_cliente_nacional+"&"+"id_banco="+id_banco+"&"+"numero_cheque="+numero_cheque
			+"&"+"fecha_vencimiento="+fecha_vencimiento+"&"+"monto_cheque="+monto_cheque+"&"+"tipo_pago="+tipo_pago+"&"+"funcion="+3; 
		$.ajax({
			type: "POST",
			url: "select/select_pagos_finanzas.php",
			data:stream,
			success: function(data)	{	
				alert (data);
				location.href = "cancelaciones_nacional.php";			
			}			
		});
	}
	else if (tipo==2)
	{
		if($('#id_cliente_nacional option:selected').val()==="") 
		{
			$("#id_cliente_nacional").focus();
			$('#valida-c_nac').fadeIn('slow'); 
			setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
			return false;
		}
		if($('#fecha_cancelacion').val()==="") 
		{
			$("#fecha_cancelacion").focus();
			$('#valida-fecha_canc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_canc').fadeOut('slow');},1000); 
			return false;
		}
		if($('#monto_efectivo').val()==="") 
		{
			$("#monto_efectivo").focus();
			$('#valida-monto_efec').fadeIn('slow'); 
			setTimeout(function(){$('#valida-monto_efec').fadeOut('slow');},1000); 
			return false;
		}
		if($('#documento').val()==="") 
		{
			$("#documento").focus();
			$('#valida-documento').fadeIn('slow'); 
			setTimeout(function(){$('#valida-documento').fadeOut('slow');},1000); 
			return false;
		}
		var id_cliente_nacional=$("#id_cliente_nacional option:selected").attr('id');
		var fecha_cancelacion=$("#fecha_cancelacion").val();
		var monto_efectivo=$("#monto_efectivo").val();
		var documento=$("#documento").val();
		var tipo_pago=$("input[name='tipo_pago").val();
		var stream="id_cliente_nacional="+id_cliente_nacional+"&"+"fecha_cancelacion="+fecha_cancelacion
			+"&"+"monto_efectivo="+monto_efectivo+"&"+"documento="+documento+"&"+"tipo_pago="+tipo_pago+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "select/select_pagos_finanzas.php",
			data:stream,
			success: function(data)	{	
				alert (data);
				location.href = "cancelaciones_nacional.php";			
			}			
		});
	}
}
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
					<div class="title"><p>Cancelaciones Clientes Nacional</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_finanzas.php"><input type="button" value="Volver&raquo;"/></a>
							</div>
						</div>
							<br>
							<br>
							<input type="radio" name="tipo_pago" id='tipo_pago' value='1' checked >Cheque
							<input type="radio" name="tipo_pago" id='tipo_pago' value='2'>Efectivo
						<table class="tableform">
							<tr>
								<td>
									<label>Cliente</label>
								</td>
								<td>
									<select id="id_cliente_nacional">
									</select>
									<div id="valida-c_nac" style="display:none" class="errores">
										Debe Ingresar Cliente 
									</div> 
								</td>
							</tr>
						</table>
					 	<table class="tableform" id='cancelacion_efectivo'  style="display:none">
							<tr>
								<td>
									<label>Fecha Cancelacion</label>
								</td>
								<td>
									<input type="text" id="fecha_cancelacion" placeholder="Fecha"  value="<?php echo date('d-m-Y')?>" readonly/>
									<div id="valida-fecha_canc" style="display:none" class="errores">
										Debe Ingresar Fecha de Cancelacion
									</div> 
								</td>
							</tr>							
							<tr>
								<td>
									<label>Monto</label>
								</td>
								<td>
									<input type="text" id="monto_efectivo" placeholder="Monto" onkeypress="ValidaSoloNumeros()" />		
									<div id="valida-monto_efec" style="display:none" class="errores">
										Debe Ingresar Monto
									</div> 
								</td>								
							</tr>
							<tr>
								<td>
									<label>Numero de Documento</label>
								</td>
								<td>
									<input type="text" id="documento" placeholder="Numero Documento"/>			
									<div id="valida-documento" style="display:none" class="errores">
										Debe Ingresar Numero de Documento
									</div> 
								</td>
								<td colspan="2">
									<div class="fright"> <input type="submit" value="Crear &raquo;"	onClick='$(this).ingresa_pago(2);'/>
									</div>
								</td>
							</tr>
						</table>
					 	<table class="tableform " id='cuentas_banco'>
							<tr>
								<td>
									<label>Banco</label>
								</td>
								<td>
									<select id="list_bancos">
									</select>
									<div id="valida-banco" style="display:none" class="errores">
										Debe Ingresar Banco
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Numero de Cheque</label>
								</td>
								<td>
									<input type="text" id="n_cheque" placeholder="Numero de Cheque" />
									<div id="valida-n_cheque" style="display:none" class="errores">
										Debe Ingresar Numero de Cheque
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Fecha Vencimiento</label>
								</td>
								<td>
									<input type="text" id="fecha_Vencimiento" placeholder="Fecha"  value="<?php echo date('d-m-Y')?>" readonly/>
									<div id="valida-fecha_Vencimiento" style="display:none" class="errores">
										Debe Ingresar Fecha de Vencimiento
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Monto de Cheque</label>
								</td>
								<td>
									<input type="text" id="monto_cheque" placeholder="Monto de Cheque" onkeypress="ValidaSoloNumeros()" />				<div id="valida-monto_cheq" style="display:none" class="errores">
										Debe Monto de Cheque
									</div> 
								</td>
								<td colspan="2">
									<div class="fright"> <input type="submit" value="Crear &raquo;"	onClick='$(this).ingresa_pago(1);'/>
									</div>
								</td>
							</tr>
						</table>
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>