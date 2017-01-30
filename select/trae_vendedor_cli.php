<?php
	$id_cliente=$_POST["id_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			cliente.vendedor,	
			vendedores.vendedor	
			from cliente
			inner join vendedores on vendedores.id_vendedor=cliente.vendedor
			where cliente.id_cliente=".$id_cliente;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);

			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select id_vendedor,vendedor from vendedores";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='vendedor_emp' >";
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
		 			$sql1="select id_vendedor,vendedor from vendedores";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='vendedor_emp'>";
					echo "<option selected value='0' >Seleccione Vendedor.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";	
					echo "<div id='valida-vendedor_emp' style='display:none' class='errores'>Debe Ingresar Vendedor</div>";
				 
			}
				
?>