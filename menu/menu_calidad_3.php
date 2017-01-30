<?php
	 
include('mobile.php'); 
$detect = new Mobile_Detect();
if($detect->isMobile() || $detect->isTablet()) { 
@header("Location: m-index.php"); 
}
 

	if(!isset($_SESSION)){ session_start(); } 
	$user=($_SESSION['usuario']);
	$id_usuario=($_SESSION['id_Usuario']); 
?>	
	<link type="text/css" href="css/menu.css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
	<script  src="js/menu.js"></script>
	<script src="js/jquery.js"></script>
	<script>
$(document).ready(function() {
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
		url: "menu/trae_pagina_nivel21_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas21').append(data);		 
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
	var stream="id_usuario="+id_usuario;
	$.ajax({
		type: "POST",
		url: "menu/trae_pagina_nivel24_menu.php",
		data:stream,
		success: function(data) {					
			$('#paginas24').append(data);		 
		}			
	});
 });
</script>
<div id="menu">
    <ul class="menu">
		<li>
			<a href="principal.php" class="parent"><span>Inicio</span>
			</a>
        </li>
	    <li>
			<a href="#" class="parent"><span>Aprobar Materias Primas</span>
			</a>
			<div id="paginas20">
 			</div>
		</li>			
		<li>
			<a href="#" class="parent"><span>Aprobar Material POP</span>
			</a>
			<div id="paginas21">
			</div>
		</li>
		 <li>
			<a href="#" class="parent"><span>Aprobar Material Mantencion</span>
			</a>
			<div id="paginas22">
			</div>
		</li>
			 <li>
			<a href="#" class="parent"><span>Aprobar Material Oficina</span>
			</a>
			<div id="paginas23">
			</div>
		</li>
		<li>
			<a href="#" class="parent"><span>Crear Formulas</span>
			</a>
			<div id="paginas24">
			</div>
		</li>
		<li>
			<a href="Logout.php" class="parent"><span>Cerrar Sesion</span>
			</a>
        </li>	
	</ul>
</div>
<div id="copyright" style="display:none;">Copyright &copy; 2012 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>
<br />
