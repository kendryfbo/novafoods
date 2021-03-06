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
	<title>Creacion de Pallet Novafoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_produccion_productos_terminados.js"></script>
 	<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet"/>
	<script type="text/javascript" src="js/jQuery.print.js"></script>
</head> 
<script>
$(document).ready(function() {
	$("#popdetallestk").dialog({ 
		autoOpen:false,
		modal:true,
		width:900,
		height:500,
		buttons:{
			"Cerrar":function(){
				$(this).dialog("close");
			}
		}	
	});
	$("#imprimir_pallet_terminado").click(function (){
		$("#area_imprimir").print(); 
		$("#td_imprimir").hide();
	});
});
function ValidaSoloNumeros() {
 if ( (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Creacion de Pallet</p>
					</div>
					<div id='area_imprimir'>
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
												<label>Fecha de Produccion</label>
											</td>
											<td>
												<input type="text" id='fecha_produccion' placeholder="Fecha de Produccion" readonly/>
												<input type="hidden" id='idUsuario' value="<?php echo $idUsuario?>" readonly/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Turno</label>
											</td>
											<td>
												<input type="text" id='turno' placeholder="Turno" readonly/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Marca</label>
											</td>
											<td>
												<input type="text" id='marca' placeholder="Marca" readonly/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Formato</label>
											</td>
											<td>
												<input type="text" id='formato' placeholder="Formato" readonly/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Sabor</label>
											</td>
											<td>
												<input type="text" id='sabor'  placeholder="Sabor" readonly/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Codigo Producto</label>
											</td>
											<td>
												<input type="text" id='cod_prod'  placeholder="Codigo Producto" readonly/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Producto en Pallet</label>
											</td>
											<td>
												<input type="text" id='prod_pallet' placeholder="Producto en Pallet" readonly/>
											</td>
										</tr> 
										<tr>
											<td>
												<label>Lote</label>
											</td>
											<td>
												<input type="text" id='lote' placeholder="Lote" readonly/>
											</td>
										</tr> 
										<tr>
											<td>
												<label>Unidades</label>
											</td>
											<td>
												<input type="text" id='unidades'  placeholder="Unidades" readonly/>
												<input type="hidden" id='id_producto'/>
												<input type="hidden" id='id_familia'/>
												<input type="hidden" id='id_produccion'/>
												<div id="valida-unidades" style="display:none" class="errores">
													Debe Ingresar Unidades Primero
												</div> 
											</td>
										</tr> 
										<tr>
											<td>
												<label>Rechazadas</label>
											</td>
											<td>
												<input type="text" placeholder="Rechazadas" id='rechazadas' onkeypress="ValidaSoloNumeros()" onblur='$(this).rechazas_crear_pallet();'/>
											</td>
											<td>
											<div class="fright"><input type="submit" value="Buscar &raquo;" id='buscar'/>
											</div>
										</td>
										</tr> 
										<tr>
											<td>
												<label>Tamaño Pallet</label>
											</td>
											<td>
												<select id='tam_pallet'>
													<option value="" Selected>Ingrese Opcion...</option>
													<option value="alto">Alto</option>
													<option value="bajo">Bajo</option>
												</select>
												<div id="valida-tam" style="display:none" class="errores">
													Debe Ingresar Tamano Pallet
												</div> 
											</td>
										</tr> 
										<tr>									 
											<td>
												<label>Numero de Pallet Fisico</label>
											</td>
											<td>
												<input type="text" id='num_pallet_fis' placeholder="Numero de Pallet Fisico" readonly/>
											</td>
										</tr>
										<tr>									 
											<td>
												<label>Fecha de Vencimiento</label>
											</td>
											<td>
												<input type="text" id='fecha_vencimiento' placeholder="Fecha de Vencimiento" readonly/>
											</td>
										</tr>
										<tr>									 
											<td>
												<label>Destino / Ubicacion</label>
											</td>
											<td>
												<input type="text" id='destino' placeholder="Destino / Ubicacion"/>
												<div id="valida-familia_1" style="display:none" class="errores">
													Debe Ingresar Datos
												</div> 
												<div id="valida-familia_2" style="display:none" class="errores">
													Este Producto No Tiene Familia Registrada
												</div> 
											</td>
										</tr>
										<tr>
											<td>
												<label>Saldo</label>
											</td>
											<td>
												<input type="text" id='saldo' placeholder="Saldo">
											</td>
										</tr>
										<tr>
											<td>
												<label>Produccion Por Ingresar <br> Imprimir Produccion del Dia</label>
											</td>
											<td>
												<input type="text" id='Batch' value="<?php echo date('d-m-Y')?>"/>
											</td>
										</tr>
										<br>
										<tr>
											<td>
												<label>Codigo</label>
											</td>
											<td id='img_codigo_barra_imprimir'>											
											</td>
										</tr>
										<td colspan="2">
											<div class="fright"><input type="submit" style="display:none" id='imprimir_pallet_terminado' value="Imprimir &raquo;" />
											</div>
										</td>
										<td colspan="4">
											<div class="fright"><input type="submit" id='crear_codigo_barra_prod_terminado' value="Crear Codigo Barras &raquo;" />
											</div>
										</td>
									</table>
								</article>
							</section>
						</div>
					<div>
				</div>
			</div>
		</td>
	</tr>
</table>
<div id="popdetallestk"  title="Clave De Aprobacion">
	<table align="center" class="actions"  class='ui-widget ui-widget-content'>		
	</table>
</div> 
</body>
</html>		
 