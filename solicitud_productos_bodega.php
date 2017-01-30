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
<title>Pedido NovaFoods</title>
<meta charset="utf-8" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/funcion_combos_pedidos.js"></script>
<script src="js/funcion_pedido_productos.js"></script>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function(){
	$("#list_semanas").html("<option value='' selected>Seleccione Semana...</option>");
	for(i=1;i<=52;i++)
	{
		$("#list_semanas").append(new Option(i, "value"));
	}
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
					<div class="title"><p>Formulario de requerimiento de materia prima e insumos para Produccion</p></div>
						<div class="content">          
							<div>  
								<div class="fright"><a href="principal_operaciones.php" ><input type="button" value="Volver &raquo;"/></a>
								</div>
								<br><br>
								<table class="tableform">
									<tr>
										<td>
											<label>Numero</label>
										</td>
										<td>
											<input type="text" id="Numero" placeholder="Nuemro_solicitud" disabled />
										</td>
										<td>
											<label>Fecha</label>
										</td>
										<td>
											<input type="date" id="fecha" placeholder="Fecha"  value="<?php echo $fecha?>" Readonly />
										</td>
										<td>
											<label>Responsable</label>
										</td>
										<td>
											<input type="text" id="usuario" value="<?php echo $usuario?>" readonly />
											<input type="hidden" id="id_usuario" value="<?php echo $id_Usuario?>" readonly />
										</td>
										<td>
											<label>Semana</label>
										</td>
										<td>
											<select id="list_semanas">
											</select>
										</td>
									</tr>
								</table>
								<div >  
									<div class="fleft"> <!--style = " display : none "-->
										<h1>Solicitud de Productos</h1>
									</div>
									<div class="clear subtitle_form">
									</div>
								</div>
								<table class="tableform">  <!--style = " display : none "-->
									<tr>
										<td>
											<label>Cantidad</label>
										</td>
										<td>
											<input type="text" id="cantidad"  class="limpiar" onkeypress="ValidaSoloNumeros()" onchange='$(this).valida_cantidad();' placeholder="Cantidad"/>
											<div id="valida-cantidad" style="display:none" class="errores">
												Debe Ingresar Cantidad
											</div>
											<label style=" font-family: Verdana, Arial, Helvetica, sans-serif; color: #0000FF; font-size: 12" id="stock">
											</label>
										</td>
										<td id='productos'> 
										</td>
										<td>
										<select id="list_sector_pedidos" class="limpiar" onchange='$(this).producto_sector();' >
										</select>
										</td>
										<td>
											<select id="list_proceso">
											</select>
											<div id="valida-proceso" style="display:none" class="errores">
												Debe Ingresar El Proceso
											</div> 
				 						</td>
										<td>
											<input type="submit" onClick='$(this).productos_requerimiento_produccion();' value="Ingresar Producto&raquo;" />
																				 
										</td>
									</tr>
								</table> 
								<article class="module width_full">            
									<div class="module_content">
										<table class="tablesorter" id="prod3">  <!--style = " display : none "-->
											<thead> 
												 <tr> 
													<th>
														Producto
													</th>
													<th>
														Solicitado
													 </th>
													 <th>
														Acciones
													 </th> 
												</tr> 
											</thead>
											<tbody>	 
											</tbody> 
										</table>
									</div>
								</article>
								<div> 
									<div class="fright">
										<input  disabled onClick='$(this).envio_solcitud();'id='envio_salida' type="submit" value="Enviar Solicitud &raquo;"   /> <!--style = " display : none "-->
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