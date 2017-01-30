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
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Ingreso Productos NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_orden_compra.js"></script>
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery-barcode.js"></script>
<script>
function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
</script>
<body>
<table class="table" border="1">
	<tr  id='tr_tipo_forma'>
		<td>
			<div class="modulo widht_modulo_full" >
				<div>  
					<div class="fright"><a href="principal_operaciones.php"><input type="button" value="Volver &raquo;"/></a>
					</div>
				</div>
			</div>
			<div class="body" id="ingreso_orden">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Ingreso Por Proveedor</p>					
					</div>
					<div class="content" >          
						<table class="tableform" >
							<tr>
								<td width="22%">
									<label>Forma de Ingresar Productos</label>
								</td>
								<td>
									<select id="list_tipo_forma"  onChange='$(this).ingreso_tipo_foma();'>
										<option value="" selected >Seleccione Tipo de Forma....</option>
										<option id="1">Por Orden Compra</option>
										<option id="2">Por Proveedor</option>
									</select>
									<div id="valida-tipo_forma" style="display:none" class="errores">
										Debe Ingresar Tipo de Forma
									</div> 
								</td>
							</tr>
						</table> 
					</div>
				</div>
			</div>
		</td>
	</tr>
		<input type="hidden" id="numero_orden_compra" />
	<tr  id='tr_por_orden' style="display:none"><!--style="display:none"-->
		<td>
			<div class="modulo widht_modulo_full" >
				<div>  
					<div class="fright"><a href="principal.php"><input type="button" value="Volver &raquo;"/></a>
					</div>
				</div>
			</div>
			<div class="body" id="ingreso_orden">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Numero de Orden de Compra</p>					
				</div>
				<div class="content" >          
					<table class="tableform" >
						<tr>
							<td>
								<label>Orden de Compra</label>
							</td>
							<td>
								<input type="text" id="orden_compra" onkeypress="ValidaSoloNumeros()" placeholder="Numero de Orden de Compra"/>
								<div id="valida-orden" style="display:none" class="errores">
									Debe Ingresar Un Numero
								</div> 
								<div id="valida-orden_reg" style="display:none" class="errores">
									Numero Ingresado No Existe
								</div> 
							</td>										
						</tr>
					</table> 								
				<div> 
				<div class="fright">
					<input onClick='$(this).ingreso_por_forma(1);'type="submit" value="Ingresar&raquo;" id='ingreso'/>
				</div>
			</div>
		</td>
	</tr>
	<tr  id='tr_por_proveedor' style="display:none"><!--style="display:none"-->
		<td>
			<div class="modulo widht_modulo_full" >
				<div>  
					<div class="fright"><a href="principal.php"><input type="button" value="Volver &raquo;"/></a>
					</div>
				</div>
			</div>
			<div class="body" id="ingreso_orden">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Ingreso Por Proveedor</p>					
				</div>
				<div class="content" >          
					<table class="tableform" >
						<tr>
							<td width="22%">
								<label>Tipo de Proveedor</label>
							</td>
							<td>
								<select id="list_tipo_proveedor" >
									<option value="" selected >Seleccione Tipo de Proveedor....</option>
									<option id="1">Nacional</option>
									<option id="2">Internacional</option>
								</select>
								<div id="valida-tipo_proveedor" style="display:none" class="errores">
									Debe Ingresar Tipo de Proveedor
								</div> 
							</td>	
							<td width="20%">
								<label>Proveedor</label>
							</td>
							<td>
								<select id="list_proveedor"  onChange='$(this).ingreso_documentos_productos();'>
								</select>
								<div id="valida-proveedor" style="display:none" class="errores">
									Debe Ingresar Proveedor
								</div> 
							</td>
							<td width="20%" id='td_select_ordenes_titi' style="display:none">
								<label> Numero Documentos Pendientes Proveedor</label>
							</td>
							<td id='td_select_ordenes'>
							</td>
						</tr>
					</table> 								
				<div> 
				<div class="fright">
					<input onClick='$(this).ingreso_por_forma(2);'type="submit" value="Ingresar&raquo;" id='ingreso'/>
				</div>
			</div>
		</td>
	</tr>
	<tr  id='tr_datos' style="display:none"><!--style="display:none"-->
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="content">          
						<div>				
							<div class="title"><p>Datos</p>	
							</div>
							<table class="tableform">
								<tr>
									<td>
										<label>Tipo Documento</label>
									</td>
									<td>
										<select id="list_tipo_documento" class="limpiar" >
										</select>
										<div id="valida-tip_doc" style="display:none" class="errores">
											Debe Ingresar Tipo de Documento
										</div> 
									</td> 
									<td>
										<label>Numero de Tipo documento</label>
									</td>
									<td>
										<input type="text" id="num_tipo_documento" class="limpiar"  onkeypress="ValidaSoloNumeros()" placeholder="Ingrese Numero de Documento"/>
										<div id="valida-num_doc" style="display:none" class="errores">
											Debe Ingresar Numero de Documento
										</div> 
									</td>
									<td>								
										<div class="fright">
											<input onClick='$(this).ingreso_datos_traer_productos();'type="submit" value="Ingresar&raquo;" id='ingreso'/>
										</div>	
									</td>
								</tr>								
							</table>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
	<tr id="tr_productos_orden" style="display:none">
		<td>
			<div class="body">
				<div class="modulo widht_modulo_full">
			 		<div>				
						<div class="module_content">
							<br>
							<br>
							<div class="title"><p>Productos</p>	
							</div>
							<table class="tablesorter" id='productos_pedidos'>
							</table>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
 </body>
</html>