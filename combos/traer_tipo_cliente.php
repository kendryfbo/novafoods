<?php
	$id_tipo_cliente=$_POST["id_tipo_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  

	switch ($id_tipo_cliente)
	{
		case 1:
				$sql1="select id_cliente,nombre_cliente from cliente_nacional order by nombre_cliente asc";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='cliente_nacional' >";
					 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";
			break;
		case 2:
					$sql1="select id_cliente,nombre_cliente from cliente_internacional  order by nombre_cliente asc";				
					$ejecuta1=mysql_query($sql1,$conexion->link);
					echo "<select id='cliente_internacional' >";
					 
					while ($fila1 = mysql_fetch_array($ejecuta1))
					{
						echo "<option id=".$fila1[0]."  >".utf8_encode($fila1[1])."</option>";
					}
						echo "</select>";
			break;
		default:
       
	}
	
?>