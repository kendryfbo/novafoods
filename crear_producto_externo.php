<?php
	include_once("../clases/conexion.php");
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
	<title>Productos NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_listados.js"></script>
</head>
<script>
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<td height="100%">
		<div class="body">		 
			<div class="modulo widht_modulo_full">
				<div class="title"><p>Creacion de Producto Externo</p>
				</div>
				<div class="content">          
					<div>  
 						<div class="fright"><a href="javascript:history.back()"><input type="button" value="Volver &raquo;"/></a>
							</div>
						</div>
						<table class="tableform"> 
					 		<tr>
    							<td>
									<label>Marca</label>
								</td>
								<td>
									<select id="list_marc" onchange='$(this).select_marca();'>
									</select>
									<div id="valida-marca" style="display:none" class="errores">
										Debe Ingresar Marca
									</div> 
								</td>       
							</tr>
							<tr>
    							<td>
									<label>Nombre Producto</label>
								</td>
								<td>
									<input type="text" id='producto' placeholder="Ingrese Producto" readonly/>
									<div id="valida-prod" style="display:none" class="errores">
										Producto Ya Se Encuentra Ingresado Favor Volver a Ingresar
									</div> 
									<div id="valida-producto" style="display:none" class="errores">
										Producto no ingresado Favor Volver a Ingresar
									</div> 
								</td>
							</tr>
							<tr id='codigo' style="display:none">
    							<td>
									<label>Codigo de Producto</label>
								</td>
								<td>
									<input type="text" id='cod_prod' placeholder="Ingrese Codigo de Producto" readonly/>
									<div id="valida-cod_prod_r" style="display:none" class="errores">
										Su Codigo de Producto Se Encuentra Registrado Favor Volver a Ingresar
									</div>
									<div id="valida-cod_prod" style="display:none" class="errores">
										Codigo no ingresado Favor Volver a Ingresar
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Formato</label>
								</td>
								<td>
									<select id="list_formatos" onchange='$(this).select_formato();'> 
									</select> 
									<div id="valida-formato" style="display:none" class="errores">
										Debe Ingresar Formato
									</div>
								</td>	
							</tr>  
							<tr>
								<td>
									<br><label>Unidad de Medida</label>
								</td>
								<td>
									<select id="list_umed" > 
									</select>
									<div id="valida-umed" style="display:none" class="errores">
										Debe Ingresar Unidad de Medida
									</div>
								</td>	
							 </tr> 
							 <tr>
								<td>
									<label>Sabor</label>
								</td>
								<td>
									<select id="list_sabor" onchange='$(this).select_sabor();'> 
									</select> 
									<div id="valida-sabor" style="display:none" class="errores">
										Debe Ingresar Sabor
									</div>
								</td>	
							</tr>
							 <tr>
    							<td>
									<label>Peso Bruto</label>
								</td>
								<td>
									<input type="text" id='p_bruto' placeholder="Ingrese Peso Bruto" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-p_bruto" style="display:none" class="errores">
										Debe Ingresar Peso Bruto
									</div> 
								</td>
								<td>
									<label>KG</label>
								</td
							</tr>
							 <tr>
    							<td>
									<label>Peso Neto</label>
								</td>
								<td>
									<input type="text" id='peso_neto' placeholder="Ingrese Peso Neto" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-p_neto" style="display:none" class="errores">
										Debe Ingresar Peso Neto
									</div> 
								</td>
								<td>
									<label>KG</label>
								</td
							</tr>
							 <tr>
    							<td>
									<label>Volumen</label>
								</td>
								<td>
									<input type="text" id='volumen' placeholder="Ingrese Volumen" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-volumen" style="display:none" class="errores">
										Debe Ingresar volumen
									</div> 
								</td>
								<td>
									<label>M3</label>
								</td
							</tr>
							<tr>
								<td colspan="4">
									<div class="fright"><input onClick='$(this).ingresa_producto_ext();' type="submit" value="Crear&raquo;"/>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>		
			</div>
		 </div>
	 </td>
</table>
</body>
</html>