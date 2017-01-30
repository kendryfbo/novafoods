<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$numero_codigo_barra=trim($_POST["numero_codigo_barra"]);
	$funcion=$_POST["funcion"];
	$cantidad_retirar=$_POST["cantidad_retirar"];
	$fecha = date("Y-m-d H:i:s"); 
	if ($funcion==1)
	{
		$sql="select detalle_veredas.id_produccion,produccion.id_producto,detalle_veredas.id,detalle_veredas.id_vereda
		from detalle_veredas
		inner join produccion on produccion.id_produccion=detalle_veredas.id_produccion
		where detalle_veredas.id=".$numero_codigo_barra." order by id DESC ";
		$resultado=mysql_query($sql,$conexion->link);
		$fila = mysql_fetch_array($resultado);

		$sql4="SELECT IFNULL((SELECT SUM( cantidad ) FROM bodega_producto_terminado	WHERE 										
			id_produccion=".$fila[0].") , 0) AS suma_bodega";
		$resultado4=mysql_query($sql4,$conexion->link);
		$mensaje4 = mysql_fetch_array ($resultado4);
		if ($cantidad_retirar>$mensaje4[0])
		{
			echo "1";
		}
		else if ($cantidad_retirar==$mensaje4[0])
		{
			$cantidad_retirar=($cantidad_retirar*-1);

			$sql1="UPDATE detalle_veredas	 
				set 		 
				retirado='si'
				where id_produccion=".$fila[0];
			$resultado1=mysql_query($sql1,$conexion->link);

			$sql3="INSERT INTO bodega_producto_terminado (cantidad,estado,id_producto,id_produccion,fecha_movimiento)
				VALUES ('$cantidad_retirar','e','$fila[1]','$fila[0]','$fecha')";
			$resultado3=mysql_query($sql3,$conexion->link);

			$sql6="UPDATE veredas	 
				set 		 
				id_estado_vereda=1
				where id=".$fila[3];
			$resultado6=mysql_query($sql6,$conexion->link);


			echo "2";
		}
		else if ($cantidad_retirar<$mensaje4[0])
		{
			$cantidad_retirar=($cantidad_retirar*-1);

			$sql3="INSERT INTO bodega_producto_terminado (cantidad,estado,id_producto,id_produccion,fecha_movimiento)
				VALUES ('$cantidad_retirar','e','$fila[1]','$fila[0]','$fecha')";
			$resultado3=mysql_query($sql3,$conexion->link);

			echo "3";
		}
	}
	else if ($funcion==2)
	{
		$sql="select numero_orden_compra,id_producto,id_vereda,id
		from detalle_veredas
		where detalle_veredas.id=".$numero_codigo_barra." order by id DESC ";
		$resultado=mysql_query($sql,$conexion->link);
		$fila = mysql_fetch_array($resultado);
		
		$sql4="SELECT IFNULL((SELECT SUM(cantidad)FROM bodega_producto_materia_prima
		WHERE id=".$fila[3].") , 0) AS suma_bodega";
		$resultado4=mysql_query($sql4,$conexion->link);
		$mensaje4 = mysql_fetch_array ($resultado4);
		if ($cantidad_retirar>$mensaje4[0])
		{
			echo "1";
		}
		else if ($cantidad_retirar==$mensaje4[0])
		{
			$cantidad_retirar=($cantidad_retirar*-1);

			$sql1="UPDATE detalle_veredas	 
				set 		 
				retirado='si'
				where id=".$fila[3];
			$resultado1=mysql_query($sql1,$conexion->link);

			$sql3="INSERT INTO  bodega_producto_materia_prima(cantidad,estado,id_producto,id,fecha_movimiento,numero_orden_compra)
			VALUES ('$cantidad_retirar','e','$fila[2]','$fila[3]','$fecha','$fila[0]')";
			$resultado3=mysql_query($sql3,$conexion->link);

			$sql6="UPDATE veredas	 
				set 		 
				id_estado_vereda=1
				where id=".$fila[2];
			$resultado6=mysql_query($sql6,$conexion->link);
			echo "2";
		}
		else if ($cantidad_retirar<$mensaje4[0])
		{
			$cantidad_retirar=($cantidad_retirar*-1);
			$sql3="INSERT INTO  bodega_producto_materia_prima(cantidad,estado,id_producto,id,fecha_movimiento,numero_orden_compra)
			VALUES ('$cantidad_retirar','e','$fila[2]','$fila[3]','$fecha','$fila[0]')";
			$resultado3=mysql_query($sql3,$conexion->link);

			echo "3";
		}
	}


?>