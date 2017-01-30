<?php
	$id_bodega=$_POST['id_bodega'];
	$proveedor=$_POST['proveedor'];
	include_once('../clases/conexion.php');
	$conexion= new conexion();  
	$fecha=date("d-m-Y");
	$fecha2=date("y-m-d H:i:s");
	$sql='select 
	productos.nombre_producto,
	calidad.cantidad,
	calidad.id_producto,
	orden_compra.id_proveedor,
	calidad.numero_orden_compra
	from calidad	
	inner join orden_compra on orden_compra.numero_orden_compra=calidad.numero_orden_compra
	inner join productos on calidad.id_producto=productos.id_producto
	where calidad.id_bodega='.$id_bodega;
	$ejecuta=mysql_query($sql,$conexion->link);
	$número_filas = mysql_num_rows($ejecuta);

	$sql3="INSERT INTO formulario_reclamos	(fecha)
		VALUES ('$fecha2')";
	$resultado=mysql_query($sql3,$conexion->link);
	$id_reclamo=mysql_insert_id(); 
	
	if ($número_filas<>0)
	{	
		while ($fila = mysql_fetch_array($ejecuta))
		{?>
			<script src="js/jquery.js"></script>
			<script src="js/jquery-ui-custom.min.js"></script>
			<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet"/>
			<script src="js/funcion_calidad.js" type="text/javascript"></script> 
			<script>
			$(document).ready(function() {
				$("#file").change(function() {
					data = new FormData();
					data.append('file',$('#file')[0].files[0]);
					$.ajax({
						url: "imagen_ajax/imagen_ajax.php",
						type:"POST",
						data:data,
						contentType:false,
						processData:false,
						success: function (datos)
						{
							$("#respuesta").html("");
							$("#respuesta").append(datos);
							$('#respuesta').fadeIn('slow'); 
							setTimeout(function(){$('#respuesta').fadeOut('slow');},1000); 
							$('#boton_ver_imagen').show(); 							
							$("#file").val("");
						}					
					});				
				});
				$("#detalle_foto").dialog({
					autoOpen:false,
					modal:true,
					width:900,
					height:800,
					buttons:{
						"Cerrar":function(){
							$(this).dialog("close");
						}
					}			
				});
				$("#borrar_imagenes").click(function() {
					$("#detalle_foto").html("");
					$("#detalle_foto").dialog("open");
					$("#detalle_foto").dialog("option","Fotos");
					var id_reclamo=	$("#num_reclamo").val();					
					var stream="id_reclamo="+id_reclamo;
					$.ajax({
						type: "POST",
						url: "select/traer_fotos_reclamo.php",
						data:stream,
						success: function(data) {
							$("#detalle_foto").append(data);
						}			
					});
				});
			});
			</script>
			<?php echo "<table class='table'>
					<tr>
						<input type='hidden' id='id_producto' value='".$fila[2]."'/>
						<input type='hidden' id='id_proveedor' value='".$fila[3]."'/>
						<td height='100%'>
							<div class='body'><div class='modulo widht_modulo_full'>
								<table class='tableform'>
									<tr>
										<td  width='30%'>
											<label>Numero de Reclamo</label>
										</td>
										<td width='30%'>
											<label>Fecha de Reclamo</label>
										</td>
										<td>
											<label>Proveedor</label>
										</td>
										<tr>
											<td>
												<input type='text' id='num_reclamo' placeholder='Numero de Reclamo' value='".$id_reclamo."' readonly/>
											</td>
											<td>
												<input type='text' id='fecha_reclamo' placeholder='Fecha de Reclamo' value='".$fecha." ' readonly/>
											</td>
											<td>
												<input type='text' id='proveedor_reclamo' placeholder='Proveedor' value='".utf8_encode($proveedor)."'
												readonly/>		
											</td>
										</tr>
										<tr>
											<td>
												<label>Producto</label>
											</td>
											<td>
												<label>Lote</label>
											</td>
											<td>
												<label>Cantidad</label>
											</td>
										</tr>
										<tr>
											<td>
												<input type='text' id='producto'  placeholder='Producto' value='".utf8_encode($fila[0])."' readonly/>
											</td>
											<td>
												<input type='text' id='lote' placeholder='Lote'/>
												<div id='valida-lote' style='display:none' class='errores'>
													Debe Ingresar Lote
												</div> 
											</td>
											<td>
												<input type='text' id='cantidad' placeholder='Cantidad' onkeypress='ValidaSoloNumeros()'/>
												<div id='valida-cantidad' style='display:none' class='errores'>
													Debe Ingresar Cantidad
												</div> 
												<div id='valida-cantidad_mayor' style='display:none' class='errores'>
													Debe Ingresar Cantidad Menor a la que va Ingresando
												</div> 
											</td>
										</tr>
										<tr>
											<td>
												<label>Descripcion del Defecto</label>
											</td>
										</tr>						
										<tr>
											<td width='92%' colspan='2'>
												<textarea id='descripcion' rows='10' cols='80' placeholder='Descricion del Defecto'></textarea>
												<div id='valida-descripcion' style='display:none' class='errores'>
													Debe Ingresar Observacion
												</div> 
											</td>
										</tr>
										<tr>
											<tr>
												<td>
													<label>Muestra Rechazada</label>
												</td>
											</tr>
											<td>
												<input type='radio' value='si' name='muestra_rechazada' class='muestra_rechazada' >Si<br>
												<input type='radio' value='no' name='muestra_rechazada' class='muestra_rechazada'  >No
												<div id='valida-rechazado' style='display:none' class='errores'>
													Debe Ingresar Muestra Rechazada
												</div>
											</td>
											<tr>
												<td>
													<label>Material Bloqueado</label>
												</td>
											</tr>
											<td>
												<input type='radio' value='si' name='material_bloqueado'  class='material_bloqueado'>Si<br>
												<input type='radio' value='no' name='material_bloqueado' class='material_bloqueado'>No
												<div id='valida-bloqueado' style='display:none' class='errores'>
													Debe Ingresar Material BLoqueado
												</div>
											</td>
											<tr>
												<td>
													<label>Informado por:</label>
												</td>
											</tr>
											<td>
												<input type='text' id='informante' placeholder='Informado por'/>
												<div id='valida-informante' style='display:none' class='errores'>
													Debe Quien Informa
												</div> 
											</td>
											<form method='post' id='formulario' enctype='multipart/form-data'>
											<tr>											
												<td>
													<input type='file' id='file' name='file[]' multiple>
													<div id='boton_ver_imagen' style='display:none'>
														<a href='#'id='borrar_imagenes' title='Editar Fotos' class='icon-editar info-tooltip'></a>														
													</div> 
												</td>
												<tr>
													<td>
														<div id='respuesta'></div>
													</td>
												</tr>
											</tr>
											</form>
											<tr>
												<td colspan='5'>
													<div class='fright'> 
														<input type='submit' onClick='$(this).ingresa_reclamo(".$fila[4].",".$id_bodega.");' value='Aceptar &raquo;'/> 
													</div>
												</td>
											</tr>
										</tr>
									</tr>
								</table>
							</div>
						</div>		
					</td>
				</tr>
			</table>
			<div id='detalle_foto'>
			</div>";

		}
				
	}
	else 
	{
		echo "Error Comunicarse con Informatica";
	}

						
?>