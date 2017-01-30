<?php	
	$funcion=trim($_POST["funcion"]);
	include_once("../clases/conexion.php");
	$conexion= new conexion();

	if ($funcion==1)
	{
		$id_marca=trim($_POST["id_marca"]);
		$sql="select
		id_formato
		from productos
		where id_marca=".$id_marca." group by id_formato";
		$ejecuta=mysql_query($sql,$conexion->link);
		echo "<select onchange='$(this).selecciona_formato();' id='list_formato'>";
		echo "<option id='' selected>Seleccione Formato.....</option>";
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$sql1="select
			formato
			from formatos
			where id_formato=".$fila[0];
			$ejecuta1=mysql_query($sql1,$conexion->link);
			while ($fila1 = mysql_fetch_array($ejecuta1))
			{
				echo "<option id=".$fila[0].">".utf8_encode($fila1[0])."</option>";
			}
		}
		echo "</select>"; 	
	}
	else if ($funcion==2)
	{
		$id_formato=trim($_POST["id_formato"]);
		$id_marca=trim($_POST["id_marca"]);
		$sql2="select
		id_sabor
		from productos
		where id_formato=".$id_formato." and id_marca=".$id_marca." group by id_sabor";
		$ejecuta2=mysql_query($sql2,$conexion->link);
		echo "<select onchange='$(this).selecciona_sabor();' id='list_sabores'>";
		echo "<option id='' selected>Seleccione Sabor.....</option>";
		while ($fila2 = mysql_fetch_array($ejecuta2))
		{
			$sql3="select
			sabor_espanol
			from sabores
			where id_sabor=".$fila2[0];
			$ejecuta3=mysql_query($sql3,$conexion->link);
			
			while ($fila3 = mysql_fetch_array($ejecuta3))
			{
				echo "<option id=".$fila2[0].">".utf8_encode($fila3[0])."</option>";
			}
		}
		echo "</select>"; 	
	}
	else if ($funcion==3)
	{
		$id_formato=trim($_POST["id_formato"]);
		$id_sabor=trim($_POST["id_sabor"]);		
		$id_marca=trim($_POST["id_marca"]);
		$sql2="select
		codigo_producto
		from productos
		where id_formato=".$id_formato." and id_marca=".$id_marca." and id_sabor=".$id_sabor;
		$ejecuta2=mysql_query($sql2,$conexion->link);
	 	while ($fila2 = mysql_fetch_array($ejecuta2))
		{ 
			echo $fila2[0];
		}
	 
	}
	else if ($funcion==4)
	{
		$id_formato=trim($_POST["id_formato"]);
		$id_sabor=trim($_POST["id_sabor"]);		
		$id_marca=trim($_POST["id_marca"]);
		$sql2="select
		nombre_producto
		from productos
		where id_formato=".$id_formato." and id_marca=".$id_marca." and id_sabor=".$id_sabor;
		$ejecuta2=mysql_query($sql2,$conexion->link);
	 	while ($fila2 = mysql_fetch_array($ejecuta2))
		{ 
			echo $fila2[0];
		}
	 
	}	
	else if ($funcion==5)
	{
		$id_formato=trim($_POST["id_formato"]);
		$id_sabor=trim($_POST["id_sabor"]);		
		$id_marca=trim($_POST["id_marca"]);
		$sql2="select
		id_producto
		from productos
		where id_formato=".$id_formato." and id_marca=".$id_marca." and id_sabor=".$id_sabor;
		$ejecuta2=mysql_query($sql2,$conexion->link);
	 	while ($fila2 = mysql_fetch_array($ejecuta2))
		{ 
			echo $fila2[0];
		}
	 
	}	
?>	