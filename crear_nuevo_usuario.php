<?php
include_once("clases/conexion.php"); 
session_start();
if(!isset($_SESSION['usuario'])) 
{
  header('Location: index.php'); 
  exit();
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Usuarios NovaFoods</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_administrador_usuarios.js"></script>
	<script src="js/jquery.Rut.js" type="text/javascript"></script>
	<script src="js/funcion_combos.js" type="text/javascript"></script>
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
		}//,
	}); 
});
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
    		<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="content">
						<div>   
							<div class="fleft"><h1>Crear Usuario</h1>
							</div>
							<br>
							<div class="fright">
								<a class="fleft" href="listado_usuarios.php" ><input type="button" value="Volver &raquo;" />
								</a>
							</div>
						</div>
						<article class="module width_full">            
							<div class="module_content">
								<table class="tablesorter"> 
									<thead> 
										<tr> 
											<th>											 
											</th>
										</tr> 
									</thead>
									<tbody> 
										<tr id="estado"> 											
										</tr>	 
									</tbody> 
								</table>
							</div>
						</article>
						<div>   
							<div class="fleft">
								<h2>Crear Datos Basicos</h2>
							</div>
							<br>
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
									<label>Usuario</label>
								</td>
								<td>
									<input type="text" id="usuario"  placeholder="Ingrese Usuario" />
									<div id="valida-usuario" style="display:none" class="errores">
										Debe Ingresar el Usuario.
									</div> 
									<div id="valida-usuario2" style="display:none"  class="errores">
										Usuario Se Encuentra Ingresado
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<label>Nombre</label>
								</td>
								<td>											
									<input type="text" id="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();"  placeholder="Ingrese Nombre"/>
									<div id="valida-nombre" style="display:none" class="errores">
										Debe Ingresar el Nombre.
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Password</label>
								</td>
								<td>											
									<input type="Password" id="password"  placeholder="Ingrese Password"/>
									<div id="valida-Password" style="display:none" class="errores">
										Debe Ingresar el Password.
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Apellido</label>
								</td>
								<td>											
									<input type="text" id="apellido" placeholder="Ingrese Apellido"/>
									<div id="valida-Apellido" style="display:none" class="errores">
										Debe Ingresar el Apellido.
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Email</label>
								</td>
								<td>											
									<input type="text" id="Email"  placeholder="Ingrese Email"/>
									<div id="valida-Email" style="display:none" class="errores">
										Debe Ingresar el Email.
									</div> 
										<div id="valida-Email2" style="display:none" class="errores">
										Debe Ingresar un Email Correcto.
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Tipo de Usuario</label>
								</td>
								<td>
									<select id="list_tipo_usuario"  >
									</select>
									<div id="valida-tipo_usuario" style="display:none" class="errores">
										Debe Ingresar el Tipo de Usuario.
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Sector del Usuario</label>
								</td>
								<td>
									<select id="list_sector_usuario"  >
									</select>
									<div id="valida-sector_usuario" style="display:none" class="errores">
										Debe Ingresar el Sector del Usuario.
									</div> 
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class='fright'><input onClick='$(this).crear_usuario();' type='submit'  value='Crear Usuario&raquo;'>
									</div>
								</td>
							</tr>
 						</table>
					</div>
				</div>	
			</div>
		</td>
	</tr>
</table>	
						   