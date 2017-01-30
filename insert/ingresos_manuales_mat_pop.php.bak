<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{	
		$id_Usuario=trim($_POST["id_Usuario"]);
		try{
				$fecha=date("y-m-d H:i:s");
				$sql3="INSERT INTO ingreso_manual_material_pop (id_usuario,fecha)
				VALUES ('$id_Usuario','$fecha')";
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
		$num_ingreso=trim($_POST["num_ingreso"]);
		try{
				$sql3="INSERT INTO detalle_ingreso_manual_pop (id_ingreso,id_producto,cantidad)
				VALUES ('$num_ingreso','$id_producto','$cantidad')";
				$resultado=mysql_query($sql3,$conexion->link);
			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
		$sql1="select 
			detalle_ingreso_manual_pop.id_producto,
			productos.nombre_producto,
			detalle_ingreso_manual_pop.cantidad,
			detalle_ingreso_manual_pop.id_detalle_manual
			from detalle_ingreso_manual_pop			
			inner join productos on productos.id_producto=detalle_ingreso_manual_pop.id_producto
			where  detalle_ingreso_manual_pop.id_ingreso=".$num_ingreso;
	 	$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			while ($fila=mysql_fetch_array($ejecuta))
			{
				echo "<tr id='".$fila[3]."'>";
				echo "<td  class='width40'>".utf8_encode($fila[1])."</td>";
				echo "<td class='width15'>".$fila[2]."</td>"; 
				echo"<td class='width10'><a href='#' onClick='$(this).borrar_producto_pop_ingreso(".$fila[3].");' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
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
		$num_ingreso=trim($_POST["num_ingreso"]);
		$observacion=trim($_POST["observacion"]);
		try{
			$sql1="UPDATE ingreso_manual_material_pop	 
				set 		 
				observacion='".utf8_decode($observacion)."',
				ingresado='Si'
				where id_ingreso=".$num_ingreso;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Ingreso Espera de Aprobacion";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
?>