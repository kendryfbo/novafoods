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
	<title>Consulta Bodega</title>
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
	$( "#list_lado" ).change(function() {
		var lado=$('#list_lado').val();
		var stream="lado="+lado;
		$.ajax({
			type: "POST",
			url: "select/trae_lado_bodega.php",
			data:stream,
			success: function(data) {
				//$("#tbl_detalle_posicion").html("");	
                                //alert(data);
				$("#bodega_lado").html("");
				$("#bodega_lado").append(data);
			}
		});
	});

});	
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>

<table class="table"id="tabla_1">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Consulta Bodega</p>
					</div>
					<div class="content">     
						<section>
                                                    <div class="fright"><a href="principal_operaciones.php"><input type="button" value="Volver &raquo;"/></a>
							</div>
                                                    <br><br>
							<article class="module width_full"> 
								
								<div class="module_content">
									<table class="tablesorter" id="tabla_2" width="100%"> 
										<thead> 
											<tr>
												<th>
													Seleccione Lado:<select id="list_lado">
                                                                                                        </select>
												</th>
                                                                                                
											</tr>
										</thead>										
                                                                        </table><br>
                                                                        <!--div  id='fechas_fil'>
                                                                        
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
                                                                                        <select id="id_cliente_nacional">
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
                                                                        <div id='fil4'>
                                                                            <table class='tablesorter' >
                                                                                
                                                                                <tr>
                                                                                    
                                                                                    <td>
                                                                                        <input type="submit" value="Consultar &raquo;" onClick='$(this).Filtro_ventas_nac();'/>
                                                                                    </td>
                                                                                    
                                                                                </tr>
                                                                            </table>
                                                                        </div-->
                                                                        <br>
                                                                        <div id='bodega_lado'width="100%">                                                                                    
                                                                                </div>
                                                                        <div id='detalle_expor'>                                                                                    
                                                                                </div>
                                                                        <br>
                                                                        <div id='detalle_expor2'>                                                                                    
                                                                                </div>
                                                                        <br>
                                                                        <div id='detalle_credito'>                                                                                    
                                                                                </div>
                                                                        
                                                                        <div id='detalle_credito2'>                                                                                    
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