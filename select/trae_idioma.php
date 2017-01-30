<?php
	$id_cliente_int=$_POST["id_cliente_int"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			cliente_internacional.id_idioma,	
			idiomas.idioma	
			from cliente_internacional
			inner join idiomas on idiomas.id_idioma=cliente_internacional.id_idioma
			where cliente_internacional.id_cliente=".$id_cliente_int;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);
			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select * from idiomas";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='idiomas' >";
					echo "<option id=".$fila[0]." selected >".utf8_encode($fila[1])."</option>";
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";				 
				}
			}
			else
			{
		 			$sql1="select * from idiomas";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='idiomas'>";
					echo "<option selected value='0' >Seleccione idioma.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";	
					echo "<div id='valida-idiomas' style='display:none' class='errores'>Debe Ingresar Pais</div>";
				 
			}
				
?>