<?php
	$id_cliente=$_POST["id_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			canales.id_canal,	
			canales.canal
			from cliente
			inner join canales on canales.id_canal=cliente.canal
			where cliente.id_cliente=".$id_cliente;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);
                        //$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='canal_cli'>";
					//echo "<option selected value='' >Seleccione Cond. Pago.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";	
					echo "<div id='valida-canal' style='display:none' class='errores'>Debe Seleccionar Canal</div>";
                        /*
			if ($número_filas<>0)
			{
				while ($fila = mysql_fetch_array($ejecuta))
				{
					$sql1="select id_suc_cliente,suc_cliente from suc_clientes";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='suc_cli' >";
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
		 			$sql1="select id_suc_cliente,suc_cliente from suc_clientes";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='suc_cli'>";
					echo "<option selected value='' >Seleccione Sucursal.....</option>";			 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";	
					echo "<div id='valida-suc_cli' style='display:none' class='errores'>Debe Ingresar Sucursal</div>";
				 
			}*/
				
?>