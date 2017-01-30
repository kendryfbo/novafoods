<?php
include_once("clases/conexion.php"); 
session_start();
if(!isset($_SESSION['usuario'])) 
{
  header('Location: index.php'); 
  exit();
}
?>
<!DOCTYPE html> 
<html lang="es"> 
<head>
	<title>Bodega Novafoods</title>
	<meta charset="utf-8" /> 
	<script src="js/jquery.js"></script>
	<script src="js/funcion_admin_altillos.js"></script>
	<script src="js/funcion_combos.js"></script>
</head> 
<body>
<script>
$(document).ready(function() {
	var stream="";
	$.ajax({
		type: "POST",
		url: "select/trae_vereda.php",
		data:stream,
		success: function(data) {
			$("#tbl_altura_altillo").html("");
			$("#tbl_altura_altillo").append(data);
		}
	});

});	
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<div>
	<div  align="right"><a href="principal.php"><input type="button" value="Volver &raquo;"/></a>
	</div>
</div>
<table  border="1"  width="100%" id="tbl_altura_altillo">
</table>
<br>
<br>
<table cols="10" align="center" width="100%" border="1"  id="tbl_detalle_altillo" class="tableform">
	<!--<td>
		<label>Kilos</label>
	</td>
	<td>
		<input type="text" id='kilos' placeholder="Kilos" onkeypress="ValidaSoloNumeros()"/> 
		<div id="valida-kilos" style="display:none" class="errores">
			Debe Ingresar Kilos
		</div> 
	</td>
	<td>
		<label>Altura</label>
	</td>
	<td>
		<input type="text" id='altura' placeholder="Altura" onkeypress="ValidaSoloNumeros()"/> 
		<div id="valida-altura" style="display:none" class="errores">
			Debe Ingresar Altura
		</div> 
	</td>-->
	<td>
		<label>Familia</label>
	</td>
	<td>
		<select id="list_familia">
		</select>
		<div id="valida-familia" style="display:none" class="errores">
			Debe Ingresar Familia
		</div> 
	</td>
	<td colspan="2">
		<div class="fright"><input type="submit" value="Ingresar&raquo;" id='ingreso_caracteristicas'/>
		</div>
	</td>
</table>
</body>
</html>

