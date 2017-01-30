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
	$( "#list_vereda" ).change(function() {
		var vereda=$('#list_vereda').val();
		var stream="vereda="+vereda;
		$.ajax({
			type: "POST",
			url: "select/trae_vereda_segun_usuario.php",
			data:stream,
			success: function(data) {
				$("#tbl_detalle_posicion").html("");				
				$("#tbl_vereda").html("");
				$("#tbl_vereda").append(data);
			}
		});
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
<table  border="1"  width="100%" >
	<td>
		<label>Vereda</label>
	</td>
	<td>
		<select id="list_vereda">
		</select>
	</td>
</table>
<table  border="1"  width="100%" id="tbl_vereda">
</table>
<table  border="1"  width="100%" id="tbl_detalle_posicion">
</table>
</body>
</html>

