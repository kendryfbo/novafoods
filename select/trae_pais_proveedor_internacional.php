<?php
	$id_proveedor_internacional=$_POST["id_proveedor_internacional"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			proveedor.id_pais,	
			paises.pais	
			from proveedor
			inner join paises on paises.id_pais=proveedor.id_pais
			where proveedor.id_proveedor=".$id_proveedor_internacional;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);
			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select * from paises";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					//echo "<select id='lista_paises' >";
					echo "<option id=".$fila[0]." selected >".utf8_encode($fila[1])."</option>";
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
					//	echo "</select>";				 
				}
			}
			else
			{
		 			$sql1="select * from paises";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='lista_paises'>";
					//echo "<option selected value='' >Seleccione Pais.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
					//	echo "</select>";	
					//echo "<div id='valida-paises' style='display:none' class='errores'>Debe Ingresar Pais</div>";
				 
			}
				
?>