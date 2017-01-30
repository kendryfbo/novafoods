<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$numero_orden=$_POST["numero_orden"];
 
	try{
			$sql1="select id_pedido_orden_compra from detalle_productos_orden_compra 		 
					where numero_orden_compra=".$numero_orden."group by id_pedido_orden_compra";
			$resultado=mysql_query($sql1,$conexion->link);
			while ($mensaje=mysql_fetch_array($resultado))
			{	 					
				
				echo $mensaje[0];
			}
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		