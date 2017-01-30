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
	<!--meta charset="ISO-8859-1" /-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
</head> 
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Sucursal de Aduana</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_sucursales_aduanas.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Aduana</label>
										</td>
										
										<td>
											<select id="list_aduanas"> 
											</select> 
											<div id="valida-list_aduanas" style="display:none" class="errores">
												Debe Seleccionar Aduana 
											</div>

											
										</td>
										<td>
											<label></label>
										</td>
									<tr>
									</tr>
										<td>
											<label>Direccion</label>
										</td>
										<td>
											<input type="text" id='dire' placeholder="Ingrese direccion" /> 
											<div id="valida-dire" style="display:none" class="errores">
												Debe Ingresar Dirección
											</div>

										</td>
									</tr>
									<tr>
										<td>
											<label>Región</label>
										</td>
										<td>
											<select id="list_reg" onClick='$(this).sel_reg();'> 
											</select> 
											<div id="valida-list_reg" style="display:none" class="errores">
												Debe Seleccionar Regi�n 
											</div> 
										</td>
									</tr>
									</tr>
										<td>
											<label>Provincia</label>
										</td>
										<td>
											<select id="list_prov"> 
											</select> 
											<div id="valida-list_prov" style="display:none" class="errores">
												Debe Seleccionar Provincia 
											</div>
										</td>
										
									</tr>
									</tr>
										<td>
											<label>Comuna</label>
										</td>
										<td>
											<select id="list_com"> 
											</select> 
											<div id="valida-list_com" style="display:none" class="errores">
												Debe Seleccionar Comuna 
											</div>
										</td>
										
									</tr>
									</tr>
										<td>
											<label>Fono</label>
										</td>
										<td>
											<input type="text" id='fono' placeholder="Ingrese Teléfono"/> 
											<div id="valida-fono" style="display:none" class="errores">
												Debe Ingresar Tel�fono
											</div> 
										</td>
										
									</tr>
									</tr>

										<td colspan="2">
											<div class="fright"><input type="submit" value="Crear Sucursal de Aduana&raquo;"  onClick='$(this).crear_suc_aduana();'/>
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
 
