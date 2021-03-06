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
	<title>Orden de Despacho Exportación</title>
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
	$('#num_proforma_despacho').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#num_proforma_despacho").val())==="0") 
			{
				$("#num_proforma_despacho").focus();
				$('#valida-proforma_0').fadeIn('slow'); 
				setTimeout(function(){$('#valida-factura_0').fadeOut('slow');},1000); 
				$("#num_proforma_despacho").val('');
				return false;
			}
			if($.trim($("#num_proforma_despacho").val())==="") 
			{
				$("#num_proforma_despacho").focus();
				$('#valida-proforma_vacio').fadeIn('slow'); 
				setTimeout(function(){$('#valida-proforma_vacio').fadeOut('slow');},1000); 
				$("#num_proforma_despacho").val('');
				return false;
			}
			var numero_proforma=$("#num_proforma_despacho").val();
			var stream="numero_proforma="+numero_proforma+"&"+"funcion="+6;
			$.ajax({
				type: "POST",
				url: "insert/insertar_proforma.php",
				data:stream,
				success: function(data)	{	
				 	$('#productos_finanzas').html("");	
					$('#productos_finanzas').append(data);
				}			
			});
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
					<div class="title"><p>Orden de Despacho</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_comercializacion.php" ><input type="button" value="Volver&raquo;"/></a>
							</div>
						</div>
					 	<table class="tableform">
							<tr>
								<td>
									<label>Numero Proforma</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="num_proforma_despacho" placeholder="Numero de Proforma"/>	
									<div id="valida-proforma_0" style="display:none" class="errores">
										Numero de Proforma No puede ser 0
									</div>
									<div id="valida-proforma_vacio" style="display:none" class="errores">
										Ingrese Numero de Proforma
									</div>
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
														<th  style='text-align:right'>
															Solicitado
														</th>
														 <!--th>
															Precio
														</th>
														<th>
															Total
														</th-->
													</tr> 
													<tbody id='productos_finanzas'>
														<div id="valida-productos_proforma" style="display:none" class="errores">
															Sin DAtos
														</div> 
													</tbody>
												</thead>
											 </table>
										</div>
									</article>
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