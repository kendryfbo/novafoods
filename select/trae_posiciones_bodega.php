<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$numero_orden=$_POST["numero_orden"];
	

	$sql="SELECT productos.nombre_producto,detalle_productos_orden_compra.id_producto, SUM(temporal.cantidad),productos.id_familia
		FROM temporal 
		inner join detalle_productos_orden_compra on detalle_productos_orden_compra.id_pedido_orden_compra=temporal.id_pedido_orden_compra 
		inner join productos on productos.id_producto=detalle_productos_orden_compra.id_producto
		where temporal.numero_orden_compra=".$numero_orden." group by temporal.id_pedido_orden_compra ";
		$resultado=mysql_query($sql,$conexion->link);
 
		while ($fila = mysql_fetch_array($resultado))
		{
			$sql1="select kilos, posicion from altillos where id_familia=".$fila[3]." LIMIT 1";
			$resultado1=mysql_query($sql1,$conexion->link);
			while ($fila1 = mysql_fetch_array($resultado1))
			{
				
				$kilos_ingresados=$fila[3]-$fila1[1];

				echo $kilos_ingresados;
				
			/*	$sql1="UPDATE altillos 
				set 		 
				kilos_ingresados='".$cargo."'
				where altillos=".$fila1[1];
				$resultado2=mysql_query($sql1,$conexion->link);				
			
			
				
				echo $fila1[1];*/
			}
		}
 

					
?>		