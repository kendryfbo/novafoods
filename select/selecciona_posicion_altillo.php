<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$cantidad_pallet=trim($_POST["cantidad_pallet"]);
	$funcion=$_POST["funcion"];
	$id_calidad=trim($_POST["id_calidad"]);
	
	if ($funcion==1)
	{
			$sql="select productos.id_familia from calidad 
			inner join productos on productos.id_producto=calidad.id_producto
			WHERE id_bodega =".$id_calidad;
			$ejecuta=mysql_query($sql,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))
			{
				echo $fila[0];
			}
	}
	else
	{
 
		$id_familia=trim($_POST["id_familia"]);
 
		$sql="select productos.id_familia,productos.id_producto,calidad.cantidad,calidad.numero_orden_compra
		from calidad 
		inner join productos on productos.id_producto=calidad.id_producto
		WHERE id_bodega =".$id_calidad;
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$sql1="select posicion,id from veredas WHERE id_estado_vereda= 1 and id_familia=".$id_familia." ORDER BY  posicion ASC limit 1";
			$ejecuta1=mysql_query($sql1,$conexion->link);
			while ($fila1 = mysql_fetch_array($ejecuta1))
			{	
				$kilos=$fila[2]/$cantidad_pallet;
				$sql2="UPDATE veredas	 
				set 		 
				id_estado_vereda=2
				where id=".$fila1[1];
				$resultado2=mysql_query($sql2,$conexion->link);

				$sql3="INSERT INTO detalle_veredas (id_vereda,kilos,id_producto,numero_orden_compra)
					VALUES ('$fila1[1]','$kilos','$fila[1]','$fila[3]')";
				$resultado3=mysql_query($sql3,$conexion->link);
				$valor=mysql_insert_id();
						
				echo $valor;	
				
			}
		}
	}

?>