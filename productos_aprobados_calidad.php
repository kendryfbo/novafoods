<?php
	include_once("clases/conexion.php"); 
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	}
	$user=($_SESSION['usuario']);
	$id_Usuario=($_SESSION['id_Usuario']); 
	include_once("menu/menu_operaciones.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>NovaFoods</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_ingreso_productos_bodega.js" type="text/javascript"></script>
	<script src="js/jquery-ui-custom.min.js"></script>
	<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jQuery.print.js"></script>
</head>
<style>
.ui-dialog-titlebar-close{
    display: none;
}
</style>	
<script>
$(document).ready(function() {
	var stream="";
	$.ajax({
		type: "POST",
		url: "select/trae_productos_ingreso_veredas.php",
		data:stream,
		success: function(data)	{	
			$("#orden").append(data);
		}			
	});	
	$( "#dialog" ).dialog({ 
		 autoOpen:false,
		modal:true,
		width:900,
		height:500,
		buttons:{
			"Cerrar":function(){
				if ($('#num_pallet option').length==1)
				{
					var action = confirm('Desea Cerrar La Impresion de Codigos de Barra?');
					if(action==true)
					{
						location.href = 'productos_aprobados_calidad.php'
					}
				}
			}
		}	
	});
	$("#imprimir").click(function (){
		$("#area_imprimir").print(); 
		$("#td_imprimir").hide();
	});	
});
function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
</script>
<body> 
<div id="dialog">
	<table class="tableform" id='tbl_pallet'>
		<tr>
			<td>
				<label>Cantidad de Pallet</label>
			</td>
			<td>
				<input type="text" id="cantidad_pallet" onkeypress="ValidaSoloNumeros()" placeholder='Ingrese Cantidad'/>
				<div id="valida-cantidad_pallet" style="display:none" class="errores">
					Debe Ingresar Cantidad
				</div>
				<div id="valida-cantidad_pallet_cero" style="display:none" class="errores">
					Debe Ingresar Cantidad Mayor a 0
				</div>
			</td>
			<tr id='td_ingreso'>
			</tr>
		</tr>
	</table>
	<table style="display:none"  id='img_cod_barra' >
		<tr>
			<td>
				<select id='num_pallet'>
				</select>
				<input type="submit" id='id_pallet' value="Aceptar"/>
			</td>
		</tr>
	</table>
	<div id='area_imprimir'>
		<table border='1' width='70%' align='center' id='tabla_codigo_barra' style="display:none">
			<tr>
				<td colspan='4'>Codigos Ingreso de Materias Primas:<br><br></td>			
			</tr>
			<tr>
				<tr>
					<td id='td_imprimir' >
						<input type="submit" id='imprimir' value="Imprimir"/>
					</td>		 
				</tr>
				<tr>
					<td colspan='3'>
						Numero de Codigo:
					</td>
					<td id='numero'> 
					</td>			
				</tr>
				<tr>
					<td colspan='3'>
						Cantidad:
					</td>
					<td id='cantidad'>					
					</td>			
					
				</tr>
				<tr>
					<td colspan='3' width='80'>
						Producto:
					</td>
					<td id='producto'>					 
					</td>		
				</tr>
				<tr>
					<td colspan='3'>
						Codigo de Barra :
					</td>
					<td align='center' id='img_codigo_barra_imprimir'>
					</td>
				</tr>
			</tr>	
		</table>
	</div>
</div> 
<table class="table">
	<input type="hidden" id="id_familia"/>
	<input type="hidden" id="id_calidad"/>
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div class="module_content">
									<table class="tablesorter"> 
										<thead> 
											<tr>
												<th>
													Fecha
												</th>
												<th>
													Orden de Compra
												</th>											 
												<th>
													Cantidad
												<th>
													Producto
												</th>
												<th>
												</th>
											</tr> 
										</thead>
										<tbody id='orden'>
										</tbody>
									</table>
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