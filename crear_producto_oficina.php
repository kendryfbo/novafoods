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
					<div class="title"><p>Creacion de Producto de Oficina</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_productos_oficina.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr  style="display:none" id='codigo'>
										<td>
											<label>Codigo del Producto</label>
										</td>
										<td>
											<input type="text" readonly id="cod_prod_of" /> 
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
											<input type="text" id='producto_of' placeholder="Ingrese Nombre de Producto" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-producto_of" style="display:none" class="errores">
												Debe Ingresar el Nombre Producto
											</div> 
											<div id="valida-producto_r" style="display:none" class="errores">
												Su Producto Se Encuentra Registrado
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Familia</label>
										</td>
										<td>
											<select id="list_familia_of">
											</select>
											<div id="valida-familia" style="display:none" class="errores">
												Debe Ingresar Familia
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Unidad de Medida</label>
										</td>
										<td>
											<select id="list_umed" onchange='$(this).select_umed();'>
											</select>
											<div id="valida-umed" style="display:none" class="errores">
												Debe Ingresar Unidad de Medida
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Costo Unitario</label>
										</td>
										<td>
											<input type="text" id='costo_producto_of' placeholder="Ingrese Costo del Producto" onkeypress="ValidaSoloNumeros()"/> 
											<div id="valida-costo_producto_of" style="display:none" class="errores">
												Debe Ingresar el Costo del Producto
											</div> 
										</td>
									</tr>
										<td colspan="2">
											<div class="fright"> <input type="submit" value="Crear &raquo;"	onClick='$(this).ingresa_producto_ofi();'/>
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
 