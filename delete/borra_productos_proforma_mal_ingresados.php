<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion==1)
	{
		$id_pedido_proforma=$_POST["id_pedido_proforma"];
                $id_usuario=$_POST["id_usuario"];
		try{
			$sql="DELETE FROM temporal_detalle_proforma	
				WHERE id_detalle_proforma=".$id_pedido_proforma." and id_usuario=".$id_usuario;
				$resultado=mysql_query($sql,$conexion->link);

				/*$sql1="DELETE FROM bodega_producto_terminado	
				WHERE id_bodega=".$id_bodega;
				$resultado1=mysql_query($sql1,$conexion->link);*/
				

			}
				catch (Exception $e)
			{  
			
				echo $e->getMessage();
			}
	}
        else if ($funcion==2)
	{
		$id_pedido_proforma=$_POST["id_pedido_proforma"];
                $numero_proforma=$_POST["numero_proforma"];
                //echo $id_pedido_proforma." - ".$numero_proforma;
		try{
			$sql2="DELETE FROM detalle_proforma	
				WHERE id_detalle_proforma=".$id_pedido_proforma." and numero_proforma=".$numero_proforma;
				$resultado2=mysql_query($sql2,$conexion->link);
				

		}catch (Exception $e)
		{  
                    echo $e->getMessage();
		}
	}
	/*else if ($funcion==2)
	{
		$id_detalle_nota_venta=$_POST["id_detalle_nota_venta"];
		try{
				$sql1="DELETE FROM detalle_nota_venta	
				WHERE id_detalle_nota_venta=".$id_detalle_nota_venta;
				$resultado1=mysql_query($sql1,$conexion->link);
				

			}
				catch (Exception $e)
			{  
			
				echo $e->getMessage();
			}

	} */

/*	include_once("../clases/conexion.php");
	$conexion= new conexion();

	$id_pedido_proforma=$_POST["id_pedido_proforma"];
 
try{
	 
		$sql="DELETE FROM detalle_proforma	
		WHERE id_detalle_proforma=".$id_pedido_proforma;

		$resultado=mysql_query($sql,$conexion->link);
		

	}
		catch (Exception $e)
	{  
	
		echo $e->getMessage();
	}*/	
				
?>