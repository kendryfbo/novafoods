<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_calidad=trim($_POST["id_calidad"]);
	$cantidad_pallet=trim($_POST["cantidad_pallet"]);
	
	
	$sql="select veredas.id_familia,COUNT(*) 
		from calidad
		inner join  productos on calidad.id_producto=productos.id_producto
		inner join  veredas on veredas.id_familia=productos.id_familia
		WHERE calidad.id_bodega=".$id_calidad. " AND veredas.id_estado_vereda=1 
		 group by veredas.id_familia ";
	$resultado=mysql_query($sql,$conexion->link);
	$mensaje=mysql_fetch_array($resultado);
	 
	if ($cantidad_pallet<=$mensaje[1] && $cantidad_pallet>0 )
	{
		echo "Ok";		
	}
	else
	{
		echo "Error";
	}
		 
	 
?>		