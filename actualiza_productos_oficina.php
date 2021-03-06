<?php
	$id_prod_of=$_GET["id_prod_of"];
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
</head> 
<script>
$(document).ready(function() {
	var id_prod = "<?php echo $id_prod_of;?>";	 
	var id_sector =2;	
	$.getJSON("select/trae_producto_mantencion.php",{id_prod:id_prod},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#cod_prod').val(data[i].codigo_producto);
			$('#producto').val(data[i].nombre_producto);
			$('#costo_producto').val(data[i].costo);
		}
	}); 
 	var stream="id_prod="+id_prod+"&"+"id_sector="+id_sector;
	$.ajax({
		type: "POST",
		url: "select/trae_select_productos.php",
		data:stream,
		success: function(data)	{
			$('#familia').html(data);
		}	
	}); 
	var stream="id_prod="+id_prod;
	$.ajax({
		type: "POST",
		url: "select/trae_select_sector_productos.php",
		data:stream,
		success: function(data)	{
			$('#sector').html(data);
		}	
	});
	var stream="id_prod="+id_prod;
	$.ajax({
		type: "POST",
		url: "select/trae_select_umed_productos.php",
		data:stream,
		success: function(data)	{
			$('#umed').html(data);
		}	
	});
	var stream="id_prod="+id_prod;
	$.ajax({
		type: "POST",
		url: "select/trae_select_sector_productos.php",
		data:stream,
		success: function(data)	{
			$('#sector').html(data);
		}	
	});
});
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Actualiza Producto Oficina</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_productos_oficina.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
									<input type="hidden" id="id_prod_of" value='<?php echo $id_prod_of?>'/>
								<table class="tableform">
									<tr>
										<td>
											<label>Codigo del Producto</label>
										</td>
										<td>
											<input type="text" readonly id="cod_prod"/> 
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
											<input type="text" id='producto' placeholder="Ingrese Nombre de Producto" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-producto" style="display:none" class="errores">
												Debe Ingresar el Nombre Producto
											</div> 
											<div id="valida-producto_r" style="display:none" class="errores">
												Su Producto Se Encuentra Registrado
											</div> 
										</td>
									</tr>
									<tr id='familia'>
										<tr>
											<td>
												<td>
													<div id="valida-familia" style="display:none" class="errores">
														Debe Ingresar Familia
													</div> 
												</td>
											</td>
										</tr>
									</tr>
									<tr id='umed'>
										<tr>
											<td>
												<td>
													<div id="valida-umed" style="display:none" class="errores">
														Debe Ingresar Unidad de Medida
													</div> 
												</td>
											</td>
										</tr>
									</tr>
									<tr>
										<td>
											<label>Costo Unitario</label>
										</td>
										<td>
											<input type="text" id='costo_producto' placeholder="Ingrese Costo del Producto" onkeypress="ValidaSoloNumeros()"/> 
											<div id="valida-costo_producto" style="display:none" class="errores">
												Debe Ingresar el Costo del Producto
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Sector del Producto</label>
										</td>
										<td id='sector'>
										</td>
									</tr>
									<td colspan="2">
										<div class="fright"><input type="submit" value="Actualizar&raquo;" onClick='$(this).actualizar_producto_of();'/>
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
 