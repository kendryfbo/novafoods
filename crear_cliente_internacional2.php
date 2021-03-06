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
	<title>Clientes NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_listados.js"></script>
	<script src="js/jquery.Rut.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	$('#rut').Rut({
		on_error: function()
		{
			$("#rut").focus ();
			$('#valida-rut3').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut3').fadeOut('slow');},1000); 
			$("#rut").val ("");
		}
	}); 
});
function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
</script>
<body>
<table class="table" >
	<td height="100%">
		<div class="body">		 
			<div class="modulo widht_modulo_full">
				<div class="title"><p>Crear Cliente Nacional</p>
				</div>
				<div class="content">          
					<div>  
 						<div class="fright"><a href="listado_clientes.php"><input type="button" value="Volver &raquo;"/></a>
							</div>
						</div>
						<table class="tableform"> 
							<tr>
								<td>
									<label>Rut</label>
								</td>
								<td>											
									<input type="text" id="rut"  placeholder="Ingrese Rut"/>
									<div id="valida-rut" style="display:none"  class="errores">
										Debe Ingresar el Rut.
									</div> 
									<div id="valida-rut2" style="display:none" class="errores">
										Rut Se Encuentra Ingresado
									</div>
									<div id="valida-rut3" style="display:none" class="errores">
										Rut Incorrecto
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Nombre Cliente</label>
								</td>
								<td>
									<input type="text" id='nom_client' placeholder="Ingrese Nombre de Cliente"/>
									<div id="valida-cliente" style="display:none" class="errores">
										Debe Ingresar Cliente 
									</div>
									<div id="valida-cliente_R" style="display:none" class="errores">
										Cliente Existente
									</div>	
							 	</td>
							</tr>
							<tr>
    							<td>
									<label>Direccion</label>
								</td>
								<td>
									<input type="text" id='direccion' placeholder="Ingrese Direccion"/>
									<div id="valida-direccion" style="display:none" class="errores">
										Debe Ingresar Direccion 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Pais</label>
								</td>
								<td>
									<select id="list_pais"> 
									</select> 
									<div id="valida-pais" style="display:none" class="errores">
										Debe Ingresar Pais 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Email</label>
								</td>
								<td>
									<input type="text" id='email' placeholder="Ingrese Email"/>
									<div id="valida-mail" style="display:none" class="errores">
										Debe Ingresar Cargo 
									</div>
									<div id="valida-mail_2" style="display:none" class="errores">
										Debe Ingresar Email valido 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Telefono</label>
								</td>
								<td>
									<input type="text" id='fono' placeholder="Ingrese Telefono" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-telefono" style="display:none" class="errores">
										Debe Ingresar Telefono 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Contacto</label>
								</td>
								<td>
									<input type="text" id='contacto' placeholder="Ingrese Contacto"/>
									<div id="valida-contacto" style="display:none" class="errores">
										Debe Ingresar Contacto 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Idioma</label>
								</td>
								<td>
									<select id="list_idiomas"> 
									</select> 
									<div id="valida-idioma" style="display:none" class="errores">
										Debe Ingresar Idioma 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Credito Maximo</label>
								</td>
								<td>
									<input type="text" id='credito' placeholder="Ingrese Credito"/>
									<div id="valida-credito" style="display:none" class="errores">
										Debe Ingresar Credito 
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<div class="fright"><input onClick='$(this).crear_cliente_int();' type="submit" value="Crear&raquo;"/>
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
 