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
	<title>Productos NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
	<script src="js/funcion_combos.js" type="text/javascript"></script>
</head> 
<script>
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Creacion de Producto Material POP</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_productos_pop.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr  style="display:none" id='codigo'>
										<td>
											<label>Codigo del Producto</label>
										</td>
										<td>
											<input type="text" readonly id="cod_prod" /> 
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
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='producto' placeholder="Ingrese Nombre de Producto" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly/> 
											<div id="valida-producto" style="display:none" class="errores">
												Nombre Producto no ingresado Favor Volver a Ingresar
											</div> 
											<div id="valida-producto_r" style="display:none" class="errores">
												Su Producto Se Encuentra Registrado
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Material</label>
										</td>
										<td>
											<select id="list_material"  onchange='$(this).select_material_pop();'>
											</select>
											<div id="valida-material" style="display:none" class="errores">
												Debe Ingresar Material
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Color</label>
										</td>
										<td>
											<select id="list_color" onchange='$(this).select_color_pop();'>
											</select>
											<div id="valida-color" style="display:none" class="errores">
												Debe Ingresar Color
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Marca</label>
										</td>
										<td>
											<select id="list_marc" onchange='$(this).select_marca_pop();' >
											</select>
											<div id="valida-marc" style="display:none" class="errores">
												Debe Ingresar marca
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Fomato</label>
										</td>
										<td>
											<select id="list_formatos" onchange='$(this).select_formato_pop();'>
											</select>
											<div id="valida-formato" style="display:none" class="errores">
												Debe Ingresar Formato
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Familia</label>
										</td>
										<td>
											<select id="list_familia_pop" onchange='$(this).select_familia_pop();'>
											</select>
											<div id="valida-familia" style="display:none" class="errores">
												Debe Ingresar Familia
											</div> 
										</td>
									</tr>
									<tr id='subfamillia'>
									</tr>
										<tr>
											<td>
												<td>
													<div id="valida-subfamila" style="display:none" class="errores">
														Debe Ingresar Subfamilia
													</div> 
												</td>
											</td>
										</tr>
									<tr>
									<tr>
										<td>
											<label>Talla</label>
										</td>
										<td>
											<select id="list_tallas" disabled>
											</select>
											<div id="valida-talla" style="display:none" class="errores">
												Debe Ingresar Talla
											</div> 
										</td>
									</tr>
										<tr>
										<td>
											<label>Unidad de Medida</label>
										</td>
										<td>
											<select id="list_umed" >
											</select>
											<div id="valida-umed" style="display:none" class="errores">
												Debe Ingresar Unidad de Medida
											</div> 
										</td>
									</tr>
									</tr>
									<tr>
										<td>
											<label>Genero</label>
										</td>
										<td>
											<select id="list_genero" disabled>
											</select>
											<div id="valida-genero" style="display:none" class="errores">
												Debe Ingresar Genero
											</div> 
										</td>
									</tr>
										<td colspan="2">
											<div class="fright"> <input type="submit" value="Crear &raquo;"	onClick='$(this).ingresa_producto_pop();'/>
											</div>
										</td>
									</tr>
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
 