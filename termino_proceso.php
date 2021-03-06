<?php
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	}
	$user=($_SESSION['usuario']);
	$idUsuario=($_SESSION['id_Usuario']);  
?>
<!DOCTYPE html> 
<html lang="es"> 
<head>
	<title>Termino de Proceso Novafoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_produccion_productos_terminados.js"></script>
</head> 
<script>
$(document).ready(function() {
	$("#fecha_produccion").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#fecha_produccion").datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_vencimiento").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#fecha_vencimiento").datepicker( $.datepicker.regional[ "es" ]);
});
</script>
<body>
 <table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Termino de Proceso</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="principal_operaciones.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>	
								<table class="tableform">
									<tr>
										<td>
											<label>Numero de Pallet Fisico</label>
										</td>
										<td>
											<input type="text" id='num_pallet_fis' placeholder="Numero de Pallet Fisico"/>
											<div id="valida-num_pallet_fis" style="display:none" class="errores">
												Debe Ingresar Numero de Pallet Fisico
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Fecha de Produccion</label>
										</td>
										<td>
											<input type="text" id='fecha_produccion' placeholder="Fecha de Produccion" value="<?php echo date('d-m-Y')?>" readonly/>
											<input type="hidden" id='idUsuario' value="<?php echo $idUsuario ?>" readonly/>
										</td>
									</tr>
									<tr>
										<td>
											<label>Turno</label>
										</td>
										<td>
											<input type="radio" name="turno" id="d">
											Dia<br>
											<input type="radio" name="turno" id="t">
											Tarde<br>
											<input type="radio" name="turno" id="n">
											Noche<br>
											<div id="valida-turno" style="display:none" class="errores">
												Debe Ingresar  Turno
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Unidades Producidas</label>
										</td>
										<td>
											<input type="text" id='unid_prod' placeholder="Unidades Producidas"/>
											<div id="valida-unid_prod" style="display:none" class="errores">
												Debe Ingresar Unidades Producidas
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Unidades Rechazadas</label>
										</td>
										<td>
											<input type="hidden" id='id_producto'/>
											<input type="text" id='unid_rech' placeholder="Unidades Rechazadas"/>
											<div id="valida-unid_rech" style="display:none" class="errores">
												Debe Ingresar Unidades Rechazadas
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Marca</label>
										</td>
										<td>
											<select id="list_marc" onchange='$(this).selecciona_marca();'>
											</select>
											<div id="valida-marca" style="display:none" class="errores">
												Debe Ingresar Marca
											</div> 
										</td>       
									</tr>
									<tr>
										<td>
											<label>Formato</label>
										</td>
										<td id="listado_formatos">
										</td>	
									</tr> 
									 <tr>
										<td>
											<label>Sabor</label>
										</td>
										<td id="listado_sabores">
										</td>	
									</tr>
									<tr>
										<td>
											<label>Codigo de Producto</label>
										</td>
										<td>
											<input type="text" id='cod_prod' placeholder="Codigo de Producto" Readonly/>
											<div id="valida-cod_prod" style="display:none" class="errores">
												Debe Ingresar Codigo del Producto
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Producto en Pallet</label>
										</td>
										<td>
											<input type="text" id='producto' placeholder="Producto en Pallet" Readonly/>
											<div id="valida-producto" style="display:none" class="errores">
												Debe Ingresar Producto
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Fecha de Vencimiento</label>
										</td>
										<td>
											<input type="text" id='fecha_vencimiento' placeholder="Fecha de Vencimiento" readonly/>
											<div id="valida-fecha_vencimiento" style="display:none" class="errores">
												Debe Ingresar Fecha de Vencimiento
											</div> 
										</td>
									</tr>
									<tr>									 
										<td>
											<label>Maquina</label>
										</td>
										<td>
											<input type="text" id='maq' placeholder="Maquina"/>
											<div id="valida-maq" style="display:none" class="errores">
												Debe Ingresar Maquina
											</div> 
										</td>
									</tr>
									<tr>
									 	<td>
											<label>Operario</label>
										</td>
										<td>
											<input type="text" id='oper' placeholder="Operario"/>
											<div id="valida-oper" style="display:none" class="errores">
												Debe Ingresar Operario
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Cod</label>
										</td>
										<td>
											<input type="text" id='cod' placeholder="COD"/>
											<div id="valida-cod" style="display:none" class="errores">
												Debe Ingresar Cod
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Batch</label>
										</td>
										<td>
											<input type="text" id='Batch' placeholder="BATCH" onblur='$(this).numero_lote_productos();'/>
											<div id="valida-Batch" style="display:none" class="errores">
												Debe Ingresar Batch
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Lote</label>
										</td>
										<td>
											<input type="text" id='lote' placeholder="LOTE" readonly/>
											<div id="valida-lote" style="display:none" class="errores">
												Debe Ingresar Lote
											</div> 
										</td>
									</tr>
									<td colspan="4">
										<div class="fright"><input type="submit" value="Aceptar &raquo;" onclick='$(this).ingresar_pallet_produccion();'/>
										</div>
									</td>
								</table>
							</article>
						</section>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>		
 