<?php
	include_once("clases/conexion.php"); 
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
	<title>Informe de Exportaciones</title>
	<meta charset="utf-8" />
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
	$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
 dayNamesShort: ['Dom','Lun','Mar','Mi�','Juv','Vie','S�b'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S�'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
//$(function () {

	$("#fecha1").datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#fecha2").datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	

});
</script>
<body>

<table class="table"id="tabla_1">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Informe de Exportaciones</p>
					</div>
					<div class="content">     
						<section>
                                                    <div class="fright"><a href="principal_comercializacion.php"><input type="button" value="Volver &raquo;"/></a>
							</div>
							<article class="module width_full"> 
								
								<div class="module_content">
									<table class="tablesorter" id="tabla_2"> 
										<thead> 
											<tr>
												<th>
													Seleccione datos a Filtrar :
												</th>
											</tr> 
										</thead>
                                                                                        <tr>
												<td>
													<input type="checkbox" name="ranfec" value="1" onClick='$(this).rango_fecha();'> Rango de Fecha
                                                                                                        <input type="checkbox" name="rancli" value="1" onClick='$(this).rango_cliente();'> Cliente
                                                                                                        <input type="checkbox" name="ranpro" value="1" onClick='$(this).rango_producto();'> Producto
												</td>
											</tr> 										
                                                                        </table><br>
                                                                        <div style="display:none" id='fechas_fil'>
                                                                            <table class='tablesorter' >
                                                                                <tr>
												<th>
													Seleccione las Fechas a Filtrar :
												</th>
											</tr> 
                                                                                <tr>
                                                                                    <td width="30%">
                                                                                        Inicio
                                                                                        <input type='text' id='fecha1'  placeholder='Fecha'  />
                                                                                        <div id="valida-fecha1" style="display:none" class="errores">
                                                                                            Debe Ingresar Fecha de Inicio
                                                                                        </div>
                                                                                        Termino
                                                                                        <input type='text' id='fecha2'  placeholder='Fecha' />
                                                                                        <div id="valida-fecha2" style="display:none" class="errores">
                                                                                            Debe Ingresar Fecha de Termino
                                                                                        </div>
                                                                                        
                                                                                    </td>
                                                                                    
                                                                                </tr>
                                                                            </table>
                                                                        </div><br>
                                                                        <div style="display:none" id='fechas_fil2'>
                                                                            <table class='tablesorter' >
                                                                                <tr>
												<th>
													Seleccione Cliente a Filtrar :
												</th>
											</tr> 
                                                                                <tr>
                                                                                    <td width="30%">
                                                                                        Cliente :
                                                                                        <select id="id_cliente_internacional">
                                                                                        </select>
                                                                                        <div id="valida-cliente" style="display:none" class="errores">
                                                                                            Debe Seleccionar Cliente
                                                                                        </div>
                                                                                    </td>                                                                                    
                                                                                </tr>
                                                                            </table>
                                                                        </div><br>
                                                                        <div style="display:none" id='fechas_fil3'>
                                                                            <table class='tablesorter' >
                                                                                <tr>
												<th>
													Seleccione Producto a Filtrar :
												</th>
											</tr> 
                                                                                <tr>
                                                                                    <td width="30%">
                                                                                        Producto :
                                                                                        <select id="list_prod_term_proforma" class="limpiar">
											</select>
                                                                                        <div id="valida-producto" style="display:none" class="errores">
                                                                                            Debe Seleccionar Producto
                                                                                        </div>
                                                                                    </td>                                                                                    
                                                                                </tr>
                                                                            </table>
                                                                        </div><br>
                                                                        <div style="display:none" id='fil4'>
                                                                            <table class='tablesorter' >
                                                                                
                                                                                <tr>
                                                                                    
                                                                                    <td>
                                                                                        <input type="submit" value="Consultar &raquo;" onClick='$(this).Filtro_ventas_export();'/>
                                                                                    </td>
                                                                                    
                                                                                </tr>
                                                                            </table>
                                                                        </div><br>
                                                                        <div id='detalle_expor'>                                                                                    
                                                                                </div>
                                                                        <br>
                                                                        <div id='detalle_expor2'>                                                                                    
                                                                                </div>
                                                                        <br>
                                                                        <div id='detalle_credito'>                                                                                    
                                                                                </div>
                                                                         <!--table class="tablesorter" id="tabla_3"> 
										<thead> 
											<tr>
												<th>
													Empresa
												</th>
												<th>
													Factura
												</th>
												<th>
													Fecha
												</th>
                                                                                                <th>
													Proforma
												</th>
												<th>
													Pais
												</th>
												<th>
													Cliente
												</th>
                                                                                                <th>
													Cajas
												</th>
												<th>
													FOB
												</th>
												<th>
													Freight
												</th>
                                                                                                <th>
													Insurance
												</th>
												<th>
													Total
												</th>
												<th>
													Revisar
												</th>
											</tr> 
										</thead>
                                                                                
                                                                         </table-->  
								</div>
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