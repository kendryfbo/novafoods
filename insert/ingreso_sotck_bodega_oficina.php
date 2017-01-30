<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$num_orden_compra=trim($_POST["num_orden_compra"]);
	$numero_documento=trim($_POST["numero_documento"]);
	$id_tipo_documento=trim($_POST["id_tipo_documento"]);
	$fecha=date("y-m-d H:i:s");
	$sql1="select id_producto,cantidad from  detalle_productos_orden_compra where numero_orden_compra=".$num_orden_compra;
 	$ejecuta=mysql_query($sql1,$conexion->link);
 
 	while ($fila=mysql_fetch_array($ejecuta))
	{	
		$sql="INSERT INTO bodega_oficina (id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra)
		value ('$fila[0]','$fila[1]','$numero_documento','$fecha','$id_tipo_documento','$num_orden_compra')";
		$resultado=mysql_query($sql,$conexion->link);

		$sql2="UPDATE detalle_productos_orden_compra	 
		set 		 
		id_estado_producto=10
		where numero_orden_compra=".$num_orden_compra;
		$resultado2=mysql_query($sql2,$conexion->link);

		$sql3="UPDATE orden_compra	 
		set 		 
		id_estado_orden_compra=7
		where numero_orden_compra=".$num_orden_compra;
		$resultado3=mysql_query($sql3,$conexion->link);
		
	}
 
?>