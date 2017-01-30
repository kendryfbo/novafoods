<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$fecha=date("y-m-d H:i:s");  
	$numero_orden=trim($_POST["numero_orden"]);

 
   try{	
		
		$sql2="select
				detalle_productos_orden_compra.id_pedido_orden_compra,
				productos.nombre_producto,
				detalle_productos_orden_compra.cantidad,
				detalle_productos_orden_compra.total
				from detalle_productos_orden_compra
				inner join productos on productos.id_producto=detalle_productos_orden_compra.id_producto	
				WHERE detalle_productos_orden_compra.numero_orden_compra =".$numero_orden;
				
		$resultado2=mysql_query($sql2,$conexion->link);
 		while ($mensaje2=mysql_fetch_array($resultado2))
		{	 					
				echo	"<tr id=".$mensaje2[0].">";
				echo	"<td>".utf8_encode($mensaje2[1])."</td>";
				echo	"<td>".$mensaje2[2]."</td>";
				echo	"<td>".$mensaje2[3]."</td>";
				echo	"</tr>";
		}
  		 
	}
	catch (Exception $e)
	{    
	 echo $e->getMessage();
	}


					
?>	