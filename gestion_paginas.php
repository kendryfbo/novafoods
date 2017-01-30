<?php
	include_once("clases/conexion.php"); 
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	}
	$usuario=($_SESSION['usuario']);
	$id_usuario=($_SESSION['id_Usuario']);  
	$id_usuario_modificar=trim($_GET["id_usuario_modificar"]);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Editar Usuarios</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_administrador_usuarios.js"></script>
	<script src="js/jquery.Rut.js" type="text/javascript"></script>
	<script src="js/funcion_combos.js" type="text/javascript"></script>
<script>
$(document).ready(function() {

	var id_usuario_modificar = "<?php echo $id_usuario_modificar; ?>";	  
	var stream="id_usuario_modificar="+id_usuario_modificar;
	$.ajax({
		type: "POST",
		url: "select/estado_usuario.php",
		data:stream,
		success: function(data) {					
			$('#estado').append(data);		 
		}			
	});
	$.getJSON("select/trae_usuario.php",{id_usuario_modificar:id_usuario_modificar},function(data){					

		for(i=0;i<data.length;i++)
		{
			$('#rut').val(data[i].rut);
			$('#usuario').val(data[i].usuario);
			$('#nombre').val(data[i].nombre);
			$('#password').val(data[i].clave);
			$('#apellido').val(data[i].apellido);
			$('#Email').val(data[i].email);
			$('#list_tipo_usuario').val(data[i].tipo_usuario);
			$('#list_sector_usuario').val(data[i].sector);
		}					 
	});  	
	var stream="id_usuario_modificar="+id_usuario_modificar;
	$.ajax({
		type: "POST",
		url: "select/trae_paginas_autorizar.php",
		data:stream,
		success: function(data) {					
			$('#paginas tbody').append(data);
		}			
	});
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
</script>
</head>
<body>
<table class="table">
	<tr>
		<td height="100%">
    		<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="content">
						<div>   
							<div class="fleft"><h1>Editar Datos</h1>
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
												Estado Actual
											</th>
											<th width="120">
												Acciones
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
								<h2>Editar Datos Basicos</h2>
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
									<input type="hidden" id="id_usuario" value="<?php echo $id_usuario?>"/>
									<input type="hidden" id="id_usuario_modificar" value="<?php echo $id_usuario_modificar?>"/>
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
									<select id="list_sector_usuario">
									</select>
									<div id="valida-sector_usuario" style="display:none" class="errores">
										Debe Ingresar el Sector del Usuario.
									</div> 
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class='fright'><input onClick='$(this).actualizar_usuario();' type='submit'  value='Actualiza Usuario&raquo;'>
								</td>
							</tr>

 						</table>
						<div>   
							<div class="fleft">
								<a name="permisos" id="permisos">
								</a>
								<h2>Editar Listado de Paginas Asignadas</h2>
							</div>
							<article class="module width_full">            
								<div class="module_content">
									<table class="tablesorter" id="paginas"> 
										<thead> 
											<tr> 
												<th>Permiso
												</th>
												<th width="120">Acciones
												</th> 
											</tr> 
										</thead>
										<tbody> 
										</tbody>
									</table>
								</div>	
							</article>	
						</div>
					</div>
				</div>	
			</div>
		</td>
	</tr>
</table>	
						   