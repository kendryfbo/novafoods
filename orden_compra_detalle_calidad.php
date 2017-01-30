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
	<title>Orden de compra Detalle</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_calidad.js" type="text/javascript"></script> 
</head>
<script>
$(document).ready(function() {
	var numero_orden = "<?php echo $numero_orden; ?>"; 
	$("#num_ord_compra").val(numero_orden)
	$.getJSON("select/trae_datos_orden_imprimir.php",{numero_orden:numero_orden},function(resultado){
		for(i=0;i<resultado.length;i++)
		{
			$("#fecha_orden_compra").val(resultado[i].fecha);
	 		$("#area").val(resultado[i].area);
			$("#proveedor").val(resultado[i].proveedor);
		}		
	});
	var stream="numero_orden="+numero_orden;
	$.ajax({
		type: "POST",
		url: "select/trae_productos_materia_prima.php",
		data:stream,
		success: function(data) {
			$('#productos_pedidos').append(data);
			
		}			
	});
});
</script>
 <body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Detalle Orden de Compra</p>
					</div>
					<div class="content">  
						<br>         
							<div class="fright">
								<a href="aprobar_calidad_materia_prima.php" ><input type="button" value="Volver&raquo;"/></a>
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
									<input type="text" id="num_ord_compra" readonly />
								</td>
								<td colspan="2">
									<input type="text" id="proveedor" readonly />
								</td>
								<td>
									<input type="text" id="fecha_orden_compra" readonly />
								</td>
							</tr>
								<td>
									<label>Area</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="area" readonly />
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
													</tr> 
												</thead>
											 </table>
										</div>
									</article>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<div class="fright"> 
										<input type="submit" onClick='$(this).rechazar_orden_compra();' value="Rechazar Productos &raquo;" /> 
									</div>
									<div class="fright"> 
										<input type="submit" onClick='$(this).aprobar_orden_compra();' value="Aprobar Productos &raquo;" /> 
									</div>
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