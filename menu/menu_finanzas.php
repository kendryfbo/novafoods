<?php
	if(!isset($_SESSION)){ session_start(); } 
	$user=($_SESSION['usuario']);
	$id_usuario=($_SESSION['id_Usuario']); 
?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link type="text/css" href="css/style.css" rel="stylesheet" />
</head>
<body>
<script>
$(document).ready(function() {
 	var id_usuario = "<?php echo $id_usuario;?>";	  
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel40_finanzas_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas40').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel41_finanzas_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas41').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel42_finanzas_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas42').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel43_finanzas_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas43').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel44_finanzas_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas44').append(data);		 
		}			
	});
 });
</script>
<nav id='menu'>
	<ul>
	   	<li><a href='principal.php'>Inicio</a>
		</li>	
		<li><a href='#'>Proveedores</a>
	      	<ul id='paginas42'>
	        </ul>
	   	</li>
	   <li><a href='#'>Clientes</a>
	      	<ul id='paginas40'>
	        </ul>
	   	</li>
		<li><a href='#'>Informes</a>
	      	<ul id='paginas43'>
	        </ul>
	   	</li>
		<li><a href='#'>Autorizaciones</a>
	      	<ul id='paginas44'>
	        </ul>
	   	</li>
		<li><a href='#'>Sin Aprobar Calidad</a>
	      	<ul id='paginas41'>
	        </ul>
	   	</li>
			<li><a href='Logout.php'>Cerrar Sesion</a>
		</li>
	</ul>
</nav>
</body>
</html>