<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$id_calidad=trim($_POST["id_calidad"]);
		
		$sql="select veredas.id_familia 
			from calidad
			inner join  productos on calidad.id_producto=productos.id_producto
			inner join  veredas on veredas.id_familia=productos.id_familia
			WHERE calidad.id_bodega=".$id_calidad. " AND veredas.id_estado_vereda=1";
		$resultado=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($resultado);
		if ($numero_filas<>0)
		{
			echo "Ok";
			
				
		}
		else
		{
			echo "Error";
		}
	}
	else if ($funcion==2)
	{
		$id_familia=trim($_POST["id_familia"]);
		$sql="select id_familia 
			from veredas
			WHERE id_familia=".$id_familia. " AND veredas.id_estado_vereda=1";
		$resultado=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($resultado);
		if ($numero_filas<>0)
		{
			echo "Ok";
			
				
		}
		else
		{
			echo "Error";
		}
	}
	else if ($funcion==3)
	{
		$id_familia=trim($_POST["id_familia"]);
		$sql="select id 
			from veredas
			WHERE id_familia=".$id_familia. " AND veredas.id_estado_vereda=1  order by id desc limit 1";
		$resultado=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($resultado))
		{
			$sql3="INSERT INTO detalle_veredas (id_vereda)
			VALUES ('$fila[0]')";
			$resultado3=mysql_query($sql3,$conexion->link);
			$valor=mysql_insert_id();
			echo $valor;
		}
	}
	 
?>		