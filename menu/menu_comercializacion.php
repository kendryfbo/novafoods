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
	var stream="id_usuario="+id_usuario;
	//
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel29_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas29').append(data);		 
		}			
	});
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel32_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas32').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel33_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas33').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel34_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas34').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel35_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas35').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel36_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas36').append(data);		 
		}			
	});
 });
</script>
<nav id='menu'>
	<ul>
	   	<li><a href='principal.php'>Inicio</a>
		</li>
		<li><a href='#'>Mantenedor</a>
	      	<ul id='paginas29'>
	        </ul>
	   	</li>
		<li><a href='#'>Nacional</a>
	      	<ul id='paginas32'>
	        </ul>
	   	</li>
		<!--li><a href='#'>Informes</a>
                    <ul id='paginas35'>
                    </ul>
	   	</li-->
		<li><a href='#'>Exportaciones</a>
                    <ul id='paginas33'>
                    </ul>
	   	</li>
                
		<!--li><a href='#'>Mantencion</a>
                    <ul id='paginas36'>
                    </ul>
	   	</li>
		<li><a href='#'>Material POP</a>
                    <ul id='paginas34'>
                    </ul>
	   	</li-->
		<li><a href='Logout.php'>Cerrar Sesion</a>
		</li>
	</ul>
</nav>
</body>
</html>