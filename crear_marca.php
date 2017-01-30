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
<title>Marcas Novafoods</title>
<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
	<script src="js/funcion_combos.js"></script>
</head> 
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Marca</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_marcas.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='marca' placeholder="Ingrese  Marca"  style="text-transform:uppercase;"/>
											<div id="valida-marca" style="display:none" class="errores">
												Debe Ingresar Marca
											</div> 
											<div id="valida-marca_r" style="display:none" class="errores">
												Marca Se Encuentra Registrada
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Familia</label>
										</td>
										<td>
											<select id="list_familia2">
											</select>
											<div id="valida-familia" style="display:none" class="errores">
												Debe Ingresar Familia
											</div> 
										</td> 
									</tr>
									<tr>
										<td>
											<label>ILA</label>
										</td>
										<td>
											<select id="list_ila">
											  <option value='' selected>Ingrese Opcion</option>");
											  <option id="SI">SI</option>
											  <option id="NO">NO</option>
 
											</select>
											<div id="valida-ila" style="display:none" class="errores">
												Debe ingresar ILA
											</div> 
										</td> 
									</tr>
									<td colspan="2">
										<div class="fright"><input type="submit" value="Crear Marca&raquo;" onClick='$(this).ingresa_marca();'/>
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
 
