<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$num_orden_compra=trim($_POST["num_orden_compra"]);
	
	try{						
		 	$sql1="select
				id_bodega,
				cantidad
				from calidad
				WHERE numero_orden_compra =".$num_orden_compra." and rechazada <>'si' and ingresada <>'si' ";
			$resultado1=mysql_query($sql1,$conexion->link);
			while ($fila1 = mysql_fetch_array($resultado1))
			{			
				if($fila1[1]==0)
				{
					$sql1="delete from calidad where id_bodega=".$fila1[0];
 					$resultado1=mysql_query($sql1,$conexion->link);
				}
				else
				{
					$sql="INSERT INTO bodega_pop
						SELECT id_bodega,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion
						FROM calidad where id_bodega=".$fila1[0];
					$resultado=mysql_query($sql,$conexion->link);
					
					$sql2="UPDATE calidad	 
					set 		 
					ingresada='si'
					where id_bodega=".$fila1[0];
					$resultado2=mysql_query($sql2,$conexion->link);
				}
			}

			/*$sql1="delete from calidad where numero_orden_compra=".$num_orden_compra;
 			$resultado1=mysql_query($sql1,$conexion->link); */
		 }
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		