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
	<title>Nota de Credito exportacion</title>
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
	$("#fecha_nota_venta").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});	
	$("#id_cliente_internacional").change(function() {
		var id_cliente_internacional=$('#id_cliente_internacional option:selected').attr('id');
		var stream="id_cliente_internacional="+id_cliente_internacional+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "insert/funciones_notas_credito.php",
			data:stream,
			cache: false,
			dataType: 'json',
			success: function(data)	{
				for(i=0;i<data.length;i++)
				{
					$('#direccion').val(data[i].direccion);
					$('#pais').val(data[i].pais);
				}
			}
		});	
	});
	$('#factura_nota_credito').keypress(function (e) {
		if(e.which ==13)
		{
			var action = confirm('Desea Traer Factura?');
			if(action==true)
			{
				var factura_nota_credito=$("#factura_nota_credito").val ();
                                //alert(factura_nota_credito);
				var stream="factura_nota_credito="+factura_nota_credito+"&"+"funcion="+22;
				$.ajax({
					type: "POST",
					url: "insert/ingresa_nota_venta.php",
					data:stream,
					cache: false,
					dataType: 'json',
					success: function(data)	{
                                            //alert(data);
						for(i=0;i<data.length;i++)
						{
							$('#id_cliente_internacional').val(data[i].nombre_cliente);
							$('#direccion').val(data[i].direccion);
							$('#pais').val(data[i].pais);
							$('#total').val(data[i].total);
							$('#centro_venta').val(data[i].centro_venta);
							$('#list_tip_mon').val(data[i].tipo_moneda);
						}
					}
				});	
			}
		}
	});	
	$('#n_credito').keypress(function (e) {
		if(e.which ==13)
		{	
			var nota_credito=$('#n_credito').val();
			var id_Usuario=$('#id_Usuario').val();			
			var stream="id_Usuario="+id_Usuario+"&"+"funcion="+7;
			$.ajax({
				type: "POST",
				url: "insert/funciones_notas_credito.php",
				data:stream,
				success: function(data)	{
					$('#n_credito').val(data);
					$('#n_credito').attr('disabled',true);
				}
			});			
		}
	});	
	var stream="funcion="+5;
	$.ajax({
		type: "POST",
		url: "insert/funciones_notas_credito.php",
		data:stream,
		success: function(data)	{
			$('#n_credito').val(data);		
		}
	});
});
$.fn.ingresa_nota_credito_exportacion=function(){	
	
	if ($('#n_credito').is(":not(:disabled)"))
	{
		$("#n_credito").focus ();
		$('#valida-n_credito_crear').fadeIn('slow'); 
		setTimeout(function(){$('#valida-n_credito_crear').fadeOut('slow');},1000); 
		return false;			
	}
	else
	{
		if($.trim($("#centro_venta").val())==="") 
		{
			$("#centro_venta").focus();
			$('#valida-c_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_nota_venta").val())==="") 
		{
			$("#fecha_nota_venta").focus();
			$('#valida-fecha_nota_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_nota_venta').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#id_cliente_internacional option:selected").attr('id'))==="") 
		{
			$("#id_cliente_internacional").focus();
			$('#valida-c_inter').fadeIn('slow'); 
			setTimeout(function(){$('#valida-c_inter').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_tip_mon").val())==="") 
		{
			$("#list_tip_mon").focus();
			$('#valida-moneda').fadeIn('slow'); 
			setTimeout(function(){$('#valida-moneda').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#total").val())==="") 
		{
			$("#total").focus();
			$('#valida-total').fadeIn('slow'); 
			setTimeout(function(){$('#valida-total').fadeOut('slow');},1000); 
			return false;
		}
		var centro_venta = $('#centro_venta option:selected').attr('id');
		var fecha_nota_venta=$('#fecha_nota_venta').val();
 		var id_cliente_internacional=$('#id_cliente_internacional option:selected').attr('id');
		var nota_credito=$('#n_credito').val();	
		var factura_nota_credito=$('#factura_nota_credito').val();
		var obs_nota_credito=$('#obs_nota_credito').val();
		var tip_moneda=$('#list_tip_mon option:selected').attr('id');
		var total_nota=$('#total').val();
		var stream="nota_credito="+nota_credito+"&"+"centro_venta="+centro_venta+"&"+"fecha_nota_venta="+fecha_nota_venta
			+"&"+"id_cliente_internacional="+id_cliente_internacional+"&"+"factura_nota_credito="+factura_nota_credito
			+"&"+"obs_nota_credito="+obs_nota_credito+"&"+"total_nota="+total_nota+"&"+"tip_moneda="+tip_moneda+"&"+"funcion="+6;
		$.ajax({
			type: "POST",
			url: "insert/funciones_notas_credito.php",
			data:stream,
			success: function(data)	{
				alert (data);
				location.href = "nota_credito_exportacion.php";
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
		<input type="hidden" id="id_Usuario" value="<?php echo $id_Usuario?>"/>	
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Nota de Credito Exportacion</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_comercializacion.php"><input type="button" value="Volver&raquo;"/></a>
								<a href="nota_credito_exportacion.php"><input type="button" value="Nueva&raquo;"/></a>
							</div>
						</div>
					 	<table class="tableform">
							<tr>
								<td>
									<label>Nota de Credito</label>
									<input type="text" id="n_credito" onkeypress="ValidaSoloNumeros()" placeholder="Nota de Credito" readonly/>	
									<div id="valida-n_credito_crear" style="display:none" class="errores">
										Debes Crear Nota de Credito
									</div> 
								</td>
								<td>
									<label>Centro de Venta</label>
									<select id="centro_venta" class='limpiar'>
									</select>
									<div id="valida-c_venta" style="display:none" class="errores">
										Debe Ingresar Centro de Venta
									</div>  
								</td>
								<td>
									<label>Fecha</label>
									<input type="text" id="fecha_nota_venta" placeholder="Fecha" value="<?php echo date('d-m-Y')?>" readonly/>
									<div id="valida-fecha_nota_venta" style="display:none" class="errores">
										Debe Ingresar Fecha de Nota de Credito
									</div>
								</td>
								<td>
									<label>Cliente</label>
									<select id="id_cliente_internacional">
									</select>
									<div id="valida-c_inter" style="display:none" class="errores">
										Debe Ingresar Cliente Internacional
									</div> 
								</td>
								<td>
									<label>Tipo de Moneda</label>
									<select id="list_tip_mon">
									</select>
									<div id="valida-moneda" style="display:none" class="errores">
										Debe Ingresar Tipo de Moneda
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<label>Factura</label>
									<input type="text" id="factura_nota_credito" onkeypress="ValidaSoloNumeros()" placeholder="Factura"/>	
								</td>
								<td colspan='2'>
									<label>Detalle de Nota de Credito</label>
									<textarea rows="2" cols="40" id='obs_nota_credito' class='limpiar' placeholder="Observacion"></textarea>
								</td>
								<td>
									<label>Direccion</label>
									<input type="text" id="direccion"  placeholder="Direccion" readonly/>
								</td>
								<td>
									<label>Pais</label>
									<input type="text" id="pais"  placeholder="Pais" readonly/>
								</td>								
							</tr>
							<tr>
								<td>
									<label>Total</label>
								</td>
								<td>
									<input type="text" id="total" class='limpiar_2' onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-total" style="display:none" class="errores">
										Debe Ingresar total de la Nota de Credito
									</div>
								</td>
							</tr>													
						</table>
						<div class="fright"> 
							<input type="submit" onClick='$(this).ingresa_nota_credito_exportacion();' value="Ingresar &raquo;"/> 
						</div>
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>