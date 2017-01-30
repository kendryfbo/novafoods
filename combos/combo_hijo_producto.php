<?php
	$id_familia=$_POST["id_familia"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
		id_producto,	
		nombre_producto	
		from productos
		where id_familia=".$id_familia;
 	 	$ejecuta=mysql_query($sql1,$conexion->link);
			 
		//echo "<select id='list_producto_hijo'>";
                echo "<select id='list_producto_hijo' onClick='$(this).busca_umed_producto_hijo();' >";
                    echo "<option selected value='' >Seleccione Insumo/Materia Prima.....</option>";	
		while ($fila = mysql_fetch_array($ejecuta))
		{
			echo "<option id=".$fila[0]."  >".utf8_encode($fila[1])."</option>";
		}
		echo "</select>";	
		//echo"<input  id='umed' value='' />";
		echo "<div id='valida-pruducto_hijo' style='display:none' class='errores'>Debe Ingresar Materia Prima</div>"; 
		echo "<div id='valida-pruducto_hijo_r' style='display:none' class='errores'>Materia Prima Ya Se Encuentra Ingresada</div>"; 
				
?>