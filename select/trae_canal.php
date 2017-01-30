<?php
	$id_cliente=$_POST["id_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			cliente.canal,	
			canales.canal	
			from cliente
			inner join canales on canales.id_canal=cliente.canal
			where cliente.id_cliente=".$id_cliente;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);

			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select id_canal,canal from canales";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='canal_emp' >";
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
		 			$sql1="select id_canal,canal from canales";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='canal_emp'>";
					echo "<option selected value='0' >Seleccione Canal.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";	
					echo "<div id='valida-canal_emp' style='display:none' class='errores'>Debe Ingresar Canal</div>";
				 
			}
				
?>