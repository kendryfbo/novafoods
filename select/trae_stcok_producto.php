<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);

	if ($funcion==1)
	{
		$id_producto=trim($_POST["id_producto"]);	 
		$sql="SELECT IFNULL((SELECT SUM( bodega_producto_terminado.cantidad ) FROM bodega_producto_terminado WHERE bodega_producto_terminado.id_Producto ='".$id_producto."' and estado='i' ) , 0) AS suma_bod,
		IFNULL((SELECT SUM( bodega_producto_terminado.cantidad ) FROM bodega_producto_terminado	WHERE bodega_producto_terminado.id_Producto ='".$id_producto."' and estado='e') , 0) AS resta_bod,
		umed.umed
		FROM bodega_producto_terminado 
		inner join productos on bodega_producto_terminado.id_producto=productos.id_producto
		inner join umed on umed.id_umed=umed.id_umed
		group by productos.id_umed";				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		
		$sql1=" SELECT IFNULL((SELECT SUM( detalle_nota_venta.cantidad ) 
		FROM detalle_nota_venta WHERE detalle_nota_venta.id_Producto ='".$id_producto."' group by detalle_nota_venta.id_producto) , 0 ) ";
		$resultado1=mysql_query($sql1,$conexion->link);
		$mensaje1 = mysql_fetch_array($resultado1);		

		$sql2=" SELECT IFNULL((SELECT SUM( detalle_proforma.cantidad ) 
		FROM detalle_proforma WHERE detalle_proforma.id_Producto ='".$id_producto."' group by detalle_proforma.id_producto) , 0 ) ";
		$resultado2=mysql_query($sql2,$conexion->link);
		$mensaje2 = mysql_fetch_array($resultado2);		

		$cantidad=$mensaje[0]-$mensaje1[0]-$mensaje2[0];

		echo " Quedan  " .$cantidad. "	" .$mensaje[2]. " En Bodega " ;
		echo "<input type='hidden' id='stock_producto".$id_producto."' value='".$cantidad."'/>";
	}
	else if ($funcion==2)
	{
		$id_producto=trim($_POST["id_producto"]);
		$lista_precio=trim($_POST["lista_precio"]);
		$sql="Select precio from lista_precio_nacional where id_producto=" .$id_producto." and tipo_lista=".$lista_precio;				
                //$sql="Select precio from lista_precio_nacional where id_producto=" .$id_producto." and Numero_lista=".$lista_precio;				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);	
		if ($mensaje[0]=="")
		{
			echo "0";
		}
		else
		{
			echo $mensaje[0];
		}
	}
	else if ($funcion==3)
	{
		$id_producto=trim($_POST["id_producto"]);	 
		$sql="SELECT IFNULL((SELECT SUM( bodega_producto_terminado.cantidad ) FROM bodega_producto_terminado WHERE bodega_producto_terminado.id_Producto ='".$id_producto."' and estado='i' ) , 0) AS suma_bod,
		IFNULL((SELECT SUM( bodega_producto_terminado.cantidad ) FROM bodega_producto_terminado	WHERE bodega_producto_terminado.id_Producto ='".$id_producto."' and estado='e') , 0) AS resta_bod,
		umed.umed
		FROM bodega_producto_terminado 
		inner join productos on bodega_producto_terminado.id_producto=productos.id_producto
		inner join umed on umed.id_umed=umed.id_umed
		group by productos.id_umed";				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		
		$sql1=" SELECT IFNULL((SELECT SUM( detalle_nota_venta.cantidad ) 
		FROM detalle_nota_venta WHERE detalle_nota_venta.id_Producto ='".$id_producto."' group by detalle_nota_venta.id_producto) , 0 ) ";
		$resultado1=mysql_query($sql1,$conexion->link);
		$mensaje1 = mysql_fetch_array($resultado1);		

		$sql2=" SELECT IFNULL((SELECT SUM( detalle_proforma.cantidad ) 
		FROM detalle_proforma WHERE detalle_proforma.id_Producto ='".$id_producto."' group by detalle_proforma.id_producto) , 0 ) ";
		$resultado2=mysql_query($sql2,$conexion->link);
		$mensaje2 = mysql_fetch_array($resultado2);		

		$cantidad=$mensaje[0]-$mensaje1[0]-$mensaje2[0];
		echo $cantidad;
	}	
        else if ($funcion==4)
	{
		$id_producto=trim($_POST["id_producto"]);
		//$lista_precio=trim($_POST["lista_precio"]);
		$sql="Select marcas.ILA from productos inner join marcas on marcas.id_marca=productos.id_marca where productos.id_producto=" .$id_producto;				
                //$sql="Select precio from lista_precio_nacional where id_producto=" .$id_producto." and Numero_lista=".$lista_precio;				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);	
		if ($mensaje[0]=="")
		{
			echo "0";
		}
		else
		{
			echo $mensaje[0];
		}
	}
?>	