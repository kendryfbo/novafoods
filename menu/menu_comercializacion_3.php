<?php
	if(!isset($_SESSION)){ session_start(); } 
	$user=($_SESSION['usuario']);
	$id_usuario=($_SESSION['id_Usuario']); 
?>	
	<link type="text/css" href="css/menu.css" rel="stylesheet" />
	<script  src="js/menu.js"></script>
	<script src="js/jquery.js"></script>
	<script>
$(document).ready(function() {
 	var id_usuario = "<?php echo $id_usuario;?>";	  
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel30_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas30').append(data);		 
		}			
	});
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel31_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas31').append(data);		 
		}			
	});
	/*var stream="id_usuario="+id_usuario;
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
	});*/

 });
</script>
<div id="menu">
    <ul class="menu">
		<li>
			<a href="Principal.php" class="parent"><span>Inicio</span>
			</a>
		 
		</li>
		<li>
			<a href="#" class="parent"><span>Ordenes de Compra</span>
			</a>
			<div id="paginas30">
			</div>
		</li>
		<li>
			<a href="#"  ><span>Sin Aprobar Calidad</span>
			</a>
			<div id="paginas31">
			</div>
		</li>		
	</ul>
</div>
<div id="copyright" style="display:none;">Copyright &copy; 2012 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>
<br />
