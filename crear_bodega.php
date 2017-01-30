<!DOCTYPE html> 
<html lang="es"> 
<head>
	<title>Bodega Novafoods</title>
	<meta charset="utf-8" /> 
	<script src="js/jquery.js"></script>
	<script src="js/funcion_admin_altillos.js"></script>
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/funcion_combos.js"></script>
</head> 
<body>
<script>
function ValidaSoloNumeros() {
 if ((event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
function ValidaSoloNumeros2() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<div>
	<div  align="right"><a href="principal.php"><input type="button" value="Volver &raquo;"/></a>
	</div>
</div>	
<table id="num_vereda" >
	<tr>
        <td>
			<label>Vereda Numero</label>
            <select id="list_vereda">		 
            </select>
      	</td>
	</tr>
</table>
<table id="caract_vereda" style="display:none">
	<tr>
        <td id="filas">
           <label>Altura Vereda</label>
           <input type="text"  id="altura"  onkeypress="ValidaSoloNumeros()"  class="limpiar" placeholder="Altura"/>
           <div id="valida-alto" style="display:none" class="errores">
                Debe Ingresar Lugares
           </div>
		   <td>
		   <img width="30" height="30" style="cursor: -moz-zoom-in;" src="img/altura_altillo.jpg" onmouseover="this.width=345;this.height=150;" onmouseout="this.width=30;this.height=30;" /> 
		   </td>
       </td>
	</tr>
    <tr>
        <td>
            <div class="fright">
		        <input type="submit" onClick='$(this).ingresa_alto();' value="Crear&raquo;" />
			</div>
       </td>
   </tr>
</table>
<table  id="largo_vereda"  style="display:none">
	<tr>
        <td>
			<label>Lugar</label>
            <select id="list_lugar">		 
            </select>
            <div id="valida-cantidad" style="display:none" class="errores">
                Debe Ingresar Cantidad
            </div>
		</td>
	</tr>
    <tr>
		<td>
            <label>largo</label>
            <input type="text"  id="largo"  onkeypress="ValidaSoloNumeros()"  class="limpiar" placeholder="Largo de Altillo"/>
            <div id="valida-largo" style="display:none" class="errores">
                Debe Ingresar Largo de Bodega
            </div>
			<td>
		   <img width="30" height="30" style="cursor: -moz-zoom-in;" src="img/largo_altillo.jpg" onmouseover="this.width=345;this.height=150;" onmouseout="this.width=30;this.height=30;" /> 
		   </td>
        </td>
	</tr>
    <tr>
        <td>
            <div class="fright">
		         <input type="submit" onClick='$(this).ingresa_largo();' value="Crear&raquo;" />
			</div>
       </td>
	</tr>
</table>
<!--<table cols="10" align="center" width="100%" border="1" >
	<tbody>
		<tr bgcolor="#cacaca">
			<td colspan="1" align="center" width="68%" rowspan="3"><h1>Bodega</h1></td>
		</tr>
	<tbody>
</table>-->
<table border="1"  width="100%" id="tbl_altura_altillo">	
</table>
<!--<table cols="10" align="center" width="100%" border="1">
	<tbody>
		<tr id='tr_posicion' style="display:none">
			<td rowspan="3">
				<label>Ingreso de Caracteristicas a Veredas</label>
			</td>
		 	<td>
				<label>Desde</label>
			</td>
			 <td id='td_posicion_vereda'>
      		</td>
			 <td>
				<label>Hasta</label>
			</td>
			 <td id='td_posicion_vereda_2'>
      		</td>
			<td>
				<div class="fright">
					 <input type="submit" onClick='$(this).ingresa_posiciones();' value="Ingresar&raquo;" />
				</div>
		   </td>
	</tr>
	<tbody>
</table>
<table cols="10" align="center" width="100%" border="1">
	<tr id='tr_caracteristicas' style="display:none">
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
		<td>
			<label>Kilos</label>
		</td>
		<td>
			<input type="text" id='kilos' placeholder="Ingrese Kilos"  onkeypress="ValidaSoloNumeros2()"/> 
			<div id="valida-kilos" style="display:none" class="errores">
				Debe Ingresar Kilos
			</div> 
		</td>
		<td>
			<label>Altura</label>
		</td>
		<td>
			<input type="text" id='alturas' placeholder="Ingrese Altura"  onkeypress="ValidaSoloNumeros2()"/> 
			<div id="valida-alturas" style="display:none" class="errores">
				Debe Ingresar Altura
			</div> 
		</td>
		<td>
			<div class="fright">
				 <input type="submit" onClick='$(this).ingresa_caracteristicas();' value="Ingresar&raquo;"/>
			</div>
		</td>
	</tr>
</table>-->
</body>
</html>

