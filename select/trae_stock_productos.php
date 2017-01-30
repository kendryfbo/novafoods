<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
 	$id_producto=trim($_POST["id_producto"]);
	$funcion=trim($_POST["funcion"]);
 
	if ($funcion==1)
	{
		$sql="SELECT IFNULL((SELECT SUM( bodega_central.cantidad ) FROM bodega_central	WHERE bodega_central.id_Producto ='".$id_producto."' and												bodega_central.id_estado=2	 ) , 0) AS suma_bod,
			IFNULL((SELECT SUM( bodega_central.cantidad ) FROM bodega_central	WHERE bodega_central.id_Producto ='".$id_producto."' and											bodega_central.id_estado=1 ) , 0) AS resta_bod,
			umed.umed
			FROM bodega_central 
			inner join productos on productos.id_producto=bodega_central.id_producto
			inner join umed on umed.id_umed=productos.id_umed
			group by productos.id_umed";
			
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		$cantidad=$mensaje[0]+$mensaje[1];
			
		echo  $cantidad." ".$mensaje[2]." En Bodega" ;
	}
	else if ($funcion==2)
	{
		$sql="SELECT IFNULL((SELECT SUM( bodega_pop.cantidad ) FROM bodega_pop	WHERE bodega_pop.id_Producto ='".$id_producto."') , 0) AS suma_bod,
			umed.umed
			FROM bodega_pop 
			inner join productos on productos.id_producto=bodega_pop.id_producto
			inner join umed on umed.id_umed=productos.id_umed
			group by productos.id_umed";			
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);		
		echo  $mensaje[0]." ".$mensaje[1]." En Bodega" ;
		echo "<input type='hidden' id='inpt_stock' value=".$mensaje[0].">";
	}
 			
?>	