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
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel3_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas3').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel4_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas4').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel5_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas5').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel6_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas6').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel7_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas7').append(data);		 
		}			
	});
 });
</script>
<nav id='menu'>
	<ul>
	   	<li><a href='principal.php'>Inicio</a>
		</li>	
		<li><a href='#'>Pedidos a Bodega</a>
	      	<ul id='paginas3'>
	        </ul>
	   	</li>
		<li><a href='#'>Recepcion Productos</a>
	      	<ul id='paginas5'>
	        </ul>
	   	</li>
		<li><a href='#'>Ingreso Bodega</a>
	      	<ul id='paginas4'>
	        </ul>
	   	</li>
		<li><a href='#'>Adm de Bodega</a>
	      	<ul id='paginas6'>
	        </ul>
	   	</li>
		<li><a href='#'>Produccion</a>
	      	<ul id='paginas7'>
	        </ul>
	   	</li>
		<li><a href='Logout.php'>Cerrar Sesion</a>
		</li>	
	</ul>
</nav>
</body>
</html>