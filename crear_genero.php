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
	<title>Generos NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<body> 
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Creacion de Generos </p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_generos.php"><input type="button" value="Volver &raquo;"/></a>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='genero' placeholder="Ingrese Genero"/>
											<div id="valida-genero" style="display:none" class="errores">
												Debe Ingresar Genero
											</div> 
											<div id="valida-genero_r" style="display:none" class="errores">
												Genero Se Encuentra Registrado
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Crear Genero&raquo;" onClick='$(this).ingresa_genero();'/>
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
 
