<?php
	if(!isset($_SESSION)){ session_start(); } 
	$user=($_SESSION['usuario']);
	$id_usuario=($_SESSION['id_Usuario']); 
?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
 	<script src="js/jquery.js"></script>
	<link type="text/css" href="css/style.css" rel="stylesheet" />
</head>
<body>
<script>
$(document).ready(function() {
 	var id_usuario = "<?php echo $id_usuario;?>";	  
	var id_usuario = "<?php echo $id_usuario;?>";	  
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel20_calidad_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas20').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nive22_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas22').append(data);
		
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel23_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas23').append(data);	
		}			
	});	
 });
</script>
<nav id='menu'>
	<ul>
	   	<li><a href='principal.php'>Inicio</a>
		</li>	
	   	<li><a href='#'>Aprobar Materias Primas</a>
	      	<ul id='paginas20'>
	        </ul>
	   	</li>
		<li><a href='#'>Aprobar Material Mantencion</a>
	      	<ul id='paginas22'>
	        </ul>
	   	</li>
		<li><a href='#'>Aprobar Material Oficina</a>
	      	<ul id='paginas23'>
	        </ul>
	   	</li>
		<li><a href='Logout.php'>Cerrar Sesion</a>
		</li>
	</ul>
</nav>
</body>
</html>