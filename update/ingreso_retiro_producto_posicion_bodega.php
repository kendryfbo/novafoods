<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$numero_codigo_barra=trim($_POST["numero_codigo_barra"]);
	$funcion=$_POST["funcion"];

	if ($funcion==1)
	{
		$fecha = date("Y-m-d H:i:s");     		
		$sql="select detalle_veredas.id_vereda,detalle_veredas.cajas,detalle_veredas.id_produccion,produccion.id_producto,detalle_veredas.id
		from detalle_veredas
		inner join produccion on produccion.id_produccion=detalle_veredas.id_produccion
		where detalle_veredas.id=".$numero_codigo_barra;
		$resultado=mysql_query($sql,$conexion->link);
		$fila = mysql_fetch_array($resultado);
		
		$sql1="UPDATE veredas	 
		set 		 
		id_estado_vereda=3
		where id=".$fila[0];
		$resultado1=mysql_query($sql1,$conexion->link);

		$sql1="UPDATE detalle_veredas	 
		set 		 
		ingresado='si'
		where id=".$fila[4];
		$resultado1=mysql_query($sql1,$conexion->link);
			
		$sql3="INSERT INTO bodega_producto_terminado (cantidad,estado,id_producto,id_produccion,fecha_movimiento)
			VALUES ('$fila[1]','i','$fila[3]','$fila[2]','$fecha')";
		$resultado=mysql_query($sql3,$conexion->link);
		
	}
	else if  ($funcion==2)
	{
		
		$fecha = date("Y-m-d H:i:s"); 
		$cantidad_retirar=$_POST["cantidad_retirar"];
		$cantidad_retirar=($cantidad_retirar*-1);
		
		$sql="select detalle_veredas.id_produccion,produccion.id_producto,detalle_veredas.id
		from detalle_veredas
		inner join produccion on produccion.id_produccion=detalle_veredas.id_produccion
		where detalle_veredas.id=".$numero_codigo_barra." order by id DESC ";
		$resultado=mysql_query($sql,$conexion->link);
		$fila = mysql_fetch_array($resultado);

		$sql4="SELECT IFNULL((SELECT SUM( cantidad ) FROM bodega_producto_terminado	WHERE 										
			id_produccion=".$fila[0].") , 0) AS suma_bodega";
		$resultado4=mysql_query($sql4,$conexion->link);
		$mensaje4 = mysql_fetch_array ($resultado4);
		if ($mensaje4[0]==0)
		{
			echo "Error";
		}
		else
		{

			$sql3="INSERT INTO bodega_producto_terminado (cantidad,estado,id_producto,id_produccion,fecha_movimiento)
				VALUES ('$cantidad_retirar','e','$fila[1]','$fila[0]','$fecha')";
			$resultado=mysql_query($sql3,$conexion->link);
			echo "ok";
		}
		
	}
	else if  ($funcion==3)
	{
		$fecha = date("Y-m-d H:i:s");     		
		$sql="select id_vereda,kilos,id_producto,id,numero_orden_compra
		from detalle_veredas 
		where id=".$numero_codigo_barra;
		$resultado=mysql_query($sql,$conexion->link);
		$fila = mysql_fetch_array($resultado);
		
		$sql1="UPDATE veredas	 
		set 		 
		id_estado_vereda=3
		where id=".$fila[0];
		$resultado1=mysql_query($sql1,$conexion->link);

		$sql1="UPDATE detalle_veredas	 
		set 		 
		ingresado='si'
		where id=".$fila[3];
		$resultado1=mysql_query($sql1,$conexion->link);
			
		$sql3="INSERT INTO  bodega_producto_materia_prima(cantidad,estado,id_producto,id,fecha_movimiento,numero_orden_compra)
		VALUES ('$fila[1]','i','$fila[2]','$fila[3]','$fecha','$fila[4]')";
		$resultado=mysql_query($sql3,$conexion->link);

	 
	} 
?>	
	