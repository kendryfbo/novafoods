<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion==1)
	{
		$id_usuario=trim($_POST["id_usuario"]);
		try{
				$sql2="SELECT MAX(id_temporal_orden_compra) FROM temporal_orden_compra";						
				$ejecuta2=mysql_query($sql2,$conexion->link);			
				$fila2 = mysql_fetch_array($ejecuta2);
				echo $fila2[0]+1;	
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		$id_producto=trim($_POST["id_producto"]);
		$cantidad=trim($_POST["cantidad"]);
		$precio=trim($_POST["precio"]);
		$numero_orden_compra=trim($_POST["numero_orden_compra"]);
	   try{	
			$total=$cantidad*$precio;
			$sql3="INSERT INTO temporal_detalle_productos_orden_compra (cantidad,total,id_producto,numero_orden_compra,valor_unitario,cantidad_faltante,id_estado_producto)
			VALUES ('$cantidad','$total','$id_producto','$numero_orden_compra','$precio','$cantidad',9)";
			$resultado=mysql_query($sql3,$conexion->link);								
			$id_pedido_orden_compra=mysql_insert_id();
			$sql2="select
					temporal_detalle_productos_orden_compra.id_pedido_orden_compra,
					productos.nombre_producto,
					temporal_detalle_productos_orden_compra.cantidad,
					temporal_detalle_productos_orden_compra.total,
					temporal_detalle_productos_orden_compra.valor_unitario,
					productos.codigo_producto
					from temporal_detalle_productos_orden_compra
					inner join productos on productos.id_producto=temporal_detalle_productos_orden_compra.id_producto	
					WHERE temporal_detalle_productos_orden_compra.id_pedido_orden_compra =".$id_pedido_orden_compra;
			$resultado2=mysql_query($sql2,$conexion->link);
			$mensaje2=mysql_fetch_array($resultado2);
										
				echo	"<tr id=".$mensaje2[0].">";
				echo	"<td>".$mensaje2[5]."</td>";
				echo	"<td>".utf8_encode($mensaje2[1])."</td>";
				echo	"<td>".$mensaje2[2]."</td>";
				echo	"<td>".$mensaje2[4]."</td>";
				echo	"<td>".$mensaje2[3]."</td>";
				echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle(".$mensaje2[0].",".$numero_orden_compra.");'class='icon-borrar info-tooltip'></a></td>";
				echo "</tr>";			 
		}
		catch (Exception $e)
		{    
		 echo $e->getMessage();
		}
	}
	else if ($funcion==3)
	{
		$numero_orden_compra=trim($_POST["numero_orden_compra"]);		
		$sql="SELECT MAX(numero_orden_compra) FROM orden_compra";						
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($numero_orden_compra>$fila[0]+1)
		{
			echo "1";
		}
		else if ($numero_orden_compra<$fila[0]+1)
		{
			echo "2";
		}
		else if ($numero_orden_compra==$fila[0]+1)
		{
			echo "3";
		}
	}
	else if ($funcion==4)
	{
		$sql="SELECT MAX(id_temporal_orden_compra) FROM temporal_orden_compra";					
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		echo $fila[0]+1;
	}
	else if ($funcion==5)
	{
	 	$numero_orden_compra=$_POST["numero_orden_compra"];
		$sql="select 
		DATE_FORMAT(fecha_orden_compra, '%Y-%m-%d') as fecha,
		tipos_de_monedas.tipo_moneda,
		sector_productos.Sector_producto,
		orden_compra.descuento,
		id_tipo_proveedor,
		id_proveedor,
		exenta
		from orden_compra 
		inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=orden_compra.id_tipo_moneda
		inner join  sector_productos on sector_productos.id_sector_producto=orden_compra.id_area
		where numero_orden_compra=".$numero_orden_compra;
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{ 
			while ($fila = mysql_fetch_array($ejecuta))
			{
				if($fila[4]=='1')
				{
					$sql1="select nombre_proveedor,condicion_de_pago,rut_proveedor,Contacto from proveedores_nacionales 
						where id_proveedor=".$fila[5];
					$ejecuta1=mysql_query($sql1,$conexion->link);
				 	if ($fila1 = mysql_fetch_array($ejecuta1))
					{
						$proveedor=$fila1[0];
						$cond_pago=$fila1[1];
						$tipo_prov="Nacional";
						$Contacto=$fila1[3];
						if ($fila1[2]=="")
						{ 
							$rut=" No Registra Rut ";
						}
						else
						{
							$rut=$fila1[2];
						}			
					}
				}
				else 
				{
					$sql1="select nombre_proveedor,condicion_de_pago,contacto from proveedores_internacionales 
							where id_proveedor=".$fila[5];
					$ejecuta1=mysql_query($sql1,$conexion->link);
					if ($fila1 = mysql_fetch_array($ejecuta1))
					{
						$proveedor=$fila1[0];
						$cond_pago=$fila1[1];
						$tipo_prov="Internacional";
						$Contacto=$fila1[3];
						if ($fila1[2]=="")
						{
							$rut=" No Registra Rut ";
						}
						else
						{
							$rut=$fila1[2];
						}						
					}
				}
				$salida[]=array("fecha"=>$fila[0],"moneda"=>$fila[1],"area"=>$fila[2],"descuento"=>$fila[3],"proveedor"=>$proveedor,
					"cond_pago"=>$cond_pago,"resultado"=>"ok","exenta"=>$fila[6],"id_prov"=>$fila[5],"tipo_prov"=>$tipo_prov,"rut"=>$rut,
					"Contacto"=>$Contacto);
				echo json_encode($salida);
			}
		}
		else
		{
			$salida[]=array("resultado"=>"Error");
			echo json_encode($salida);
		}
	}
?>