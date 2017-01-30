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
		var id_usuario = "<?php echo $id_usuario;?>";	  
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel10_gerencia_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas10').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel12_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas12').append(data);		 
		}			
	});
        var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel45_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas45').append(data);		 
		}			
	});
        /*
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel11_gerencia_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas11').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel13_gerencia_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas13').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel14_gerencia_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas14').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel15_gerencia_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas15').append(data);		 
		}			
	});*/
 });
</script>
<nav id='menu'>
	<ul>
	   	<li><a href='principal.php'>Inicio</a>
		</li>
		<li><a href='#'>Mantencion</a>
	      	<ul id='paginas12'>
	        </ul>
	   	</li>
                <li><a href='#'>Movimientos</a>
	      	<ul id='paginas45'>
	        </ul>
	   	</li>
		<!--li><a href='#'>Exportaciones</a>
	      	<ul id='paginas11'>
	        </ul>
	   	</li>
		<li><a href='#'>Nacionales</a>
	      	<ul id='paginas13'>
	        </ul>
	   	</li>	
		<li><a href='#'>Produccion</a>
	      	<ul id='paginas14'>
	        </ul>
	   	</li>	
		<li><a href='#'>Graficos</a>
	      	<ul id='paginas15'>
	        </ul>
	   	</li>
	   	<li><a href='#'>Especiales</a>
	      	<ul id='paginas10'>
	        </ul>
	   	</li-->	
		<li><a href='Logout.php'>Cerrar Sesion</a>
		</li>
	</ul>
</nav>
</body>
</html>