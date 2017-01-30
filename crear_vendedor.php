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
	<title>Vendedores Novafoods</title>
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
					<div class="title"><p>Crear Nuevo Vendedor</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="vendedores.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Vendedor</label>
										</td>
										<td>
											<input type="text" id='Vendedor' placeholder="Ingrese Vendedor" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-Vendedor" style="display:none" class="errores">
												Debe Ingresar Vendedor
											</div> 
											<div id="valida-Vendedor_reg" style="display:none" class="errores">
												Vendedor Se Encuentra Registrado
											</div> 
										</td>
										<td>
											<label>Iniciales</label>
										</td>
										<td>
											<input type="text" id='iniciales' placeholder="Ingrese Iniciales" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-iniciales" style="display:none" class="errores">
												Debe Ingresar Iniciales
											</div> 
											<div id="valida-iniciales_reg" style="display:none" class="errores">
												Iniciales Se Encuentran Registradas
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Crear Vendedor&raquo;" onClick='$(this).ingresa_Vendedor();'/>
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
 
