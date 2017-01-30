<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{	
		$id_Usuario=trim($_POST["id_Usuario"]);
		try{
				$sql3="INSERT INTO egresos (id_usuario)
				VALUES ('$id_Usuario')";
				$resultado=mysql_query($sql3,$conexion->link);
				$valor=mysql_insert_id();
				echo $valor;		 
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
		$num_egreso=trim($_POST["num_egreso"]);
		try{
				$sql3="INSERT INTO detalle_productos_egreso (id_egreso,	id_producto,cantidad)
				VALUES ('$num_egreso','$id_producto','$cantidad')";
				$resultado=mysql_query($sql3,$conexion->link);
			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
		$sql1="select 
			detalle_productos_egreso.id_producto,
			productos.nombre_producto,
			detalle_productos_egreso.cantidad,
			detalle_productos_egreso.id_detalle_egreso
			from detalle_productos_egreso			
			inner join productos on productos.id_producto=detalle_productos_egreso.id_producto
			where  detalle_productos_egreso.id_egreso=".$num_egreso;
	 	$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			while ($fila=mysql_fetch_array($ejecuta))
			{
				echo "<tr id='".$fila[3]."'>";
				echo "<td  class='width40'>".utf8_encode($fila[1])."</td>";
				echo "<td class='width15'>".$fila[2]."</td>"; 
				echo"<td class='width10'><a href='#' onClick='$(this).borrar_producto_pop_egreso(".$fila[3].");' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				echo "</tr>";
			}
		}
		else 
		{
			echo "No Exiten Productos Para Ingresar";
		}
	 }
	else if ($funcion==3)
	{
		$num_egreso=trim($_POST["num_egreso"]);
		$fecha=trim($_POST["fecha"]);
		$observacion=trim($_POST["observacion"]);
		$id_area=trim($_POST["id_area"]);
 
		try{
			$sql1="UPDATE egresos	 
				set 		 
				fecha='".$fecha."',
				observacion='".utf8_decode($observacion)."',
				ingresado='Si',
				pedido_interno='Si',
				id_area=".$id_area.
				" where id_egreso=".$num_egreso;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Egreso Ingresado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==4)
	{
		$id_egreso=trim($_POST["id_egreso"]);
		try{
			$sql1="UPDATE egresos	 
				set 		 				 
				aceptado_gerencia='Si'
				where id_egreso=".$id_egreso;
			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Egreso Aceptado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==5)
	{
		$fecha=date("y-m-d H:i:s");
		$id_detalle_egreso=trim($_POST["id_detalle_egreso"]);
		$cantidad=trim($_POST["cantidad"]);
		$sql1="select 
			id_producto,
			id_egreso
			from detalle_productos_egreso
			where  id_detalle_egreso=".$id_detalle_egreso;
	 	$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila=mysql_fetch_array($ejecuta))
		{	
			if ($cantidad=="")
			{
				$cantidad=0;
			}
			else
			{
				$cantidad=$cantidad*-1;
			}
			$sql3="INSERT INTO bodega_pop (id_producto,cantidad,numero_documento,fecha_movimiento)
				VALUES ('$fila[0]','$cantidad','$fila[1]','$fecha')";
			$resultado=mysql_query($sql3,$conexion->link);
			$sql="UPDATE egresos	 
				set 		 				 
				sacado_stock='Si'
				where id_egreso=".$fila[1];
			$resultado=mysql_query($sql,$conexion->link);
		}		
	}
	else if ($funcion==6)
	{
		$id_detalle_egreso=trim($_POST["id_detalle_egreso"]);
		$cantidad=trim($_POST["cantidad"]);
		$sql1="select 
			id_producto,
			cantidad
			from detalle_productos_egreso
			where  id_detalle_egreso=".$id_detalle_egreso;
	 	$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{	
			if ($cantidad>$fila[1])
			{
				echo "1";
			}
		}		
	}
	else if ($funcion==7)
	{	
		$id_Usuario=trim($_POST["id_Usuario"]);
		try{
				$sql3="INSERT INTO egresos (id_usuario)
				VALUES ('$id_Usuario')";
				$resultado=mysql_query($sql3,$conexion->link);
				$valor=mysql_insert_id();
				echo $valor;		 
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==8)
	{	
		$num_egreso=trim($_POST["num_egreso"]);
		$fecha=trim($_POST["fecha"]);
		$numero_proforma=trim($_POST["numero_proforma"]);
		try{
			$sql1="UPDATE egresos	 
				set 		 
				fecha='".$fecha."',
				numero_proforma='".$numero_proforma."',
				ingresado='Si',
				cliente_internacional='Si'
				 where id_egreso=".$num_egreso;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Egreso Ingresado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==9)
	{	
		$num_egreso=trim($_POST["num_egreso"]);
		$fecha=trim($_POST["fecha"]);
		try{
			$sql1="UPDATE egresos	 
				set 		 
				fecha='".$fecha."',
				ingresado='Si',
				cliente_nacional='Si'
				 where id_egreso=".$num_egreso;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Egreso Ingresado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==10)
	{	
		$num_egreso=trim($_POST["num_egreso"]);
 
		try{
			$sql1="UPDATE egresos	 
				set 		 
				rechazado_gerencia='Si'
				 where id_egreso=".$num_egreso;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Egreso Rechazado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}


?>	