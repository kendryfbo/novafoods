<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();
	$numero_orden=$_GET["numero_orden"];


		$sql="select 
		DATE_FORMAT(fecha_orden_compra, '%d/%m/%y') as fecha,
		tipos_de_monedas.tipo_moneda,
		sector_productos.Sector_producto,
		orden_compra.descuento,
		id_tipo_proveedor,
		id_proveedor,
		exenta
		from orden_compra 
		inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=orden_compra.id_tipo_moneda
		inner join  sector_productos on sector_productos.id_sector_producto=orden_compra.id_area
		where numero_orden_compra=".$numero_orden;
		$ejecuta=mysql_query($sql,$conexion->link);
		$número_filas = mysql_num_rows($ejecuta);
	if ($número_filas<>0)
	{ 
		 
		while ($fila = mysql_fetch_array($ejecuta))
		{
			
			if($fila[4]=='1')
			{
	
				$sql1="select nombre_proveedor,condicion_de_pago from proveedores_nacionales 
						where id_proveedor=".$fila[5];
				$ejecuta1=mysql_query($sql1,$conexion->link);
				 
				if ($fila1 = mysql_fetch_array($ejecuta1))
				{
					$proveedor=$fila1[0];
					$cond_pago=$fila1[1];
				
				}
			}
			else 
			{
				$sql1="select nombre_proveedor,condicion_de_pago from proveedores_internacionales 
						where id_proveedor=".$fila[5];
				$ejecuta1=mysql_query($sql1,$conexion->link);
				 
				 
				if ($fila1 = mysql_fetch_array($ejecuta1))
				{
					$proveedor=$fila1[0];
					$cond_pago=$fila1[1];
				}

			}
				$salida[]=array("fecha"=>$fila[0],"moneda"=>$fila[1],"area"=>$fila[2],"descuento"=>$fila[3],"proveedor"=>$proveedor,
					"cond_pago"=>$cond_pago,"resultado"=>"ok","exenta"=>$fila[6]);
				echo json_encode($salida);
	}	}
	else
	{
		$salida[]=array("resultado"=>"Error");
			echo json_encode($salida);
	}

?>