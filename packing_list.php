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
	<title>Packing List</title>
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
	$('#num_guia').keypress(function (e) {
		if(e.which==13)
		{
			var action = confirm('Desea Traer Guia de Despacho?');
			if(action==true)
			{
				if($.trim($("#num_guia").val())==="") 
				{
					$("#num_guia").focus();
					$('#valida-num_guia').fadeIn('slow'); 
					setTimeout(function(){$('#valida-num_guia').fadeOut('slow');},1000); 
					return false;
				}
				if ($.trim($("#num_guia").val())==="0") 
				{
					$('#num_guia').val('')
					$("#num_guia").focus ();
					$('#valida-num_guia_0').fadeIn('slow'); 
					setTimeout(function(){$('#valida-num_guia_0').fadeOut('slow');},1000); 
					return false;
				}
				var numero_guia=$("#num_guia").val ();
				var stream="numero_guia="+numero_guia+"&"+"funcion="+17;		 
			
				$.ajax({
					type: "POST",
					url: "insert/insertar_proforma.php",
					data:stream,
					success: function(data)	{
			 			if (data==1)
						{
							var stream="numero_guia="+numero_guia+"&"+"funcion="+18;		 
							$.ajax({
								type: "POST",
								url: "insert/insertar_proforma.php",
								data:stream,
								success: function(data)	{
									$('#productos_finanzas').html("");	
									$('#productos_finanzas').append(data);	
									var factura=$('#factura_num').val();	
									var cliente=$('#cliente_nom').val();	
									var contenedor=$('#contenedor_num').val();	
									$('#cliente').val(cliente);	
									$('#factura').val(factura);	
									$('#contenedor').val(contenedor);
								}
							});
						}
						else if (data==2)
						{
							$('#num_guia').val('')
							$("#num_guia").focus ();
							$('#valida-num_guia_val').fadeIn('slow'); 
							setTimeout(function(){$('#valida-num_guia_val').fadeOut('slow');},1000); 
							return false;
						}
					}
				});
			}
		}
	});	
});
function ValidaSoloNumeros() {
 if ( (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<input type="hidden" id="id_guia"/>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Packing List</p>
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
								<tr>
									<td>
										<label>Numero de Guia</label>
									</td>
								</tr>
									<td>
										<input type="text" id="num_guia"  placeholder="Numero de Guia" onkeypress="ValidaSoloNumeros()"/>
										<div id="valida-num_guia" style="display:none" class="errores">
											Debe Ingresar Numero de Guia
										</div> 
										<div id="valida-num_guia_0" style="display:none" class="errores">
											Numero de Guia No Puede Ser 0 !!!
										</div> 
										<div id="valida-num_guia_val" style="display:none" class="errores">
											Debe Ingresar Numero de Guia Valido
										</div> 
									</td>
								<tr>
									<td>
										<label>Factura</label>
									</td>
								</tr>
									<td>
										<input type="text" id="factura"  placeholder="Numero de Factura" readonly/>
									</td>
								<tr>
									<td>
										<label>Contenedor</label>
									</td>
								</tr>
								<td>
									<input type="text" id="contenedor"  placeholder="Numero de Contenedor" readonly/>
								</td>
								<tr>
									<td>
										<label>Cliente</label>
									</td>
								</tr>
								<td>
									<input type="text" id="cliente"  placeholder="Cliente" readonly/>
								</td>
							</tr>	
							<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"> 
												<thead> 
													<tr>
														<th width="100">
															Solicitado
														</th>
														<th>
															Producto
														</th>
														<th>
															Formato
														</th>
														<th>
															Peso Bruto
														</th>
														<th>
															Peso Neto
														</th>
														<th>
															Volumen
														</th>
													</tr> 
													<tbody id='productos_finanzas'>
													</tbody>
												</thead>
											 </table>
										</div>
									</article>
								</td>
							</tr>							
						</div>
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>