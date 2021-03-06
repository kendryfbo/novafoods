 <?php
 date_default_timezone_set('UTC');
 $fecha=date("Y-m-d");
 session_start();
if(!isset($_SESSION['usuario'])) 
{
  header('Location: index.php'); 
  exit();
}
$usuario=($_SESSION['usuario']);
$id_Usuario=($_SESSION['id_Usuario']);
?>
 <!DOCTYPE html> 
<html lang="es"> 
<head>
	<title>Material POP</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/funcion_pedido_productos.js" type="text/javascript"></script>
	<script src="js/funcion_ingreso_productos_bodega.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
	var id_Usuario = "<?php echo $id_Usuario;?>";
	var stream="id_Usuario="+id_Usuario+"&"+"funcion="+1;
	$.ajax({
		type: "POST",
		url: "insert/ingresos_manuales_mat_pop.php",
		data:stream,
		success: function(data) {	
			$("#num_ingreso").val(data);
		}			
	});
});
function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
</script>
</head>
<body>
<table class="table" border="1">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Ingreso Manual de Material POP</p></div>
						<div class="content">          
							<div>  
								<div class="fleft"><h1>Ingresar Datos</h1></div>
									<div class="fright"><a href="principal_comercializacion.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<br><br>
								<table class="tableform">
									<tr>									
										<td>
											<label>Numero de Ingreso</label>
										</td>
										<td>
											<input type="text" id="num_ingreso" readonly/>									
										</td>
										<td>
											<label>Fecha</label>
										</td>
										<td>
											<input type="date" id="fecha" placeholder="Fecha"  value="<?php echo $fecha?>" disabled/>
										</td>
										<td>
											<label>Responsable</label>
										</td>
										<td>
											<input type="text" id="user" value="<?php echo $usuario?>" readonly/>
											<input type="hidden" id="id_usuario" value="<?php echo $id_Usuario?>"/>
										</td>
										<!--<td>
											<label>Area</label>
										</td>
										<td>
											<select id="list_areas" >
										</td>-->
									</tr>
									<tr>
										<td id="texobs">
											<label>Observacion</label>
											<textarea placeholder="Ingrese Observacion" id='observacion'></textarea> 
											<div id="valida-obs" style="display:none" class="errores">
												Debe Ingresar Observacion
											</div> 
										</td>
									</tr>
								</table>
								<div>  
									<div class="fleft"  id="prod"> <!--style = " display : none "-->
										<h1>Solicitud de Productos</h1>
									</div>
								</div>
								<table class="tableform"  id="prod2">  <!--style = " display : none "-->
									<tr>
										<td colspan="3">      
											<select id="list_prod_pop" class="limpiar" onchange='$(this).select_lista_material_pop();'>
											</select>
											<div id="valida-prod" style="display:none" class="errores">
												Debe Ingresar Producto
											</div> 
											<div id="valida-prod_exst" style="display:none" class="errores">
												Producto ya esta Ingresado
											</div> 
											<div id="valida-sin_prod" style="display:none" class="errores">
												Debe Ingresar Algun Producto
											</div> 
										</td>	
										<td>
											<input type="text" id="cantidad" class="limpiar" onkeypress="ValidaSoloNumeros()" placeholder="Cantidad"/>
											 <!--<div id="valida-cant_mayor" style="display:none" class="errores">
												Debe Ingresar Cantidad Menor ya que Sobrepasa el Stock
											</div>-->
											<div id="valida-cant" style="display:none" class="errores">
												Debe Ingresar Cantidad
											</div>
										</td>	
									</tr>
										<td colspan="4">
											<div class="fright">
												<input type="submit" onClick='$(this).agregar_productos_ingreso_manual();' value="Ingresar Productos &raquo;"/>
											</div>
										 
										</td>
									</tr>
								</table> 
								<article class="module width_full">            
									<div class="module_content">
										<table class="tablesorter" >  <!--style = " display : none "-->
											<thead> 
												 <tr> 
													<th>
														Producto
													</th>
													<th>
														Solicitado
													 </th>
													 <th>
														Eliminar
													 </th> 
												</tr> 
											</thead>
											<tbody id="prod3">	
												<div id="valida-sin_prod_tbl" style="display:none" class="errores">
													Debe Ingresar Algun Producto
												</div> 
											</tbody> 
										</table>
									</div>
								</article>
								<div> 
									<div class="fright">
										<input onClick='$(this).crear_ingreso_manual_material_pop();'type="submit" value="Enviar Ingreso &raquo;"/>
									</div> 
								</div> 
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