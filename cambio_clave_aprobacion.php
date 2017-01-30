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
	<title>Clave Novafoods</title>
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
					<div class="title"><p>Cambiar Clave de Aprobacion de Gerencia</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<table class="tableform">
									<tr>
										<td>
											<label>Clave Antigua</label>
										</td>
										<td>
											<input type="password" id='clave_antigua' placeholder="Ingrese Clave Antigua" onChange='$(this).comprobar_clave_antigua();'/> 
											<div id="valida-clave_vacia_antigua" style="display:none" class="errores">
												Debe Ingresar Clave
											</div>
											<div id="valida-clave_antigua_error" style="display:none" class="errores">
												Su Clave No Coincide Con la Antigua
											</div> 
										</td>
										<td>
											<label>Clave</label>
										</td>
										<input type="hidden" id='id_usuario' value="<?php echo $idUsuario?>"/> 

										<td>
											<input type="password" id='clave' placeholder="Ingrese Clave" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-clave" style="display:none" class="errores">
												Debe Ingresar Clave
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Ingresar Clave&raquo;" onClick='$(this).cambio_clave_aprobacion();'/>
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
 