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
	<title>Aduana Novafoods</title>
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
					<div class="title"><p>Crear Nueva Aduana</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="aduanas.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Aduana</label>
										</td>
										<td>
											<input type="text" id='Aduana' placeholder="Ingrese Aduana" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-Aduana" style="display:none" class="errores">
												Debe Ingresar Aduana
											</div> 
											<div id="valida-Aduana_reg" style="display:none" class="errores">
												Aduana Se Encuentra Registrada
											</div> 
										</td>
									<tr>
									</tr>
										<td>
											<label>Rut</label>
										</td>
										<td>
											<input type="text" id='rut_aduana' placeholder="Ingrese Rut Aduana" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-rut_aduana" style="display:none" class="errores">
												Debe Ingresar Rut Aduana
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Crear Aduana1&raquo;"  onClick='$(this).crear_aduana();'/>
											</div>
										</td>
									</tr>
									<!--tr>
										<td>
											<label>Direccion</label>
										</td>
										<td>
											<input type="text" id='Direccion' placeholder="Ingrese Direccion" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-Direccion" style="display:none" class="errores">
												Debe Ingresar Direccion
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Ciudad</label>
										</td>
										<td>
											<input type="text" id='Ciudad' placeholder="Ingrese Ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-Ciudad" style="display:none" class="errores">
												Debe Ingresar Ciudad
											</div> 
										</td>
									</tr>
									<tr>
										<td>
											<label>Fono</label>
										</td>
										<td>
											<input type="text" id='Fono' placeholder="Ingrese Fono" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-Fono" style="display:none" class="errores">
												Debe Ingresar Fono
											</div> 
										</td>
										
									</tr-->
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
 
