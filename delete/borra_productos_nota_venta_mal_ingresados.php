<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion==1)
	{
		$id_detalle_nota_venta=$_POST["id_detalle_nota_venta"];
		try{
			$sql="DELETE FROM temporal_detalle_nota_venta	
				WHERE id_detalle_nota_venta=".$id_detalle_nota_venta;
				$resultado=mysql_query($sql,$conexion->link);
                                
                                echo"Producto Eliminado Correctamente";

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

	}
        else if ($funcion==3)
	{
                //Temporal Nota Credito    
                $id_detalle_nc=$_POST["id_detalle_nc"];
		try{
			$sql="DELETE FROM temporal_detalle_nc	
				WHERE id_detalle_nc=".$id_detalle_nc;
				$resultado=mysql_query($sql,$conexion->link);
                                
                                echo"Producto Eliminado Correctamente";

				/*$sql1="DELETE FROM bodega_producto_terminado	
				WHERE id_bodega=".$id_bodega;
				$resultado1=mysql_query($sql1,$conexion->link);*/
				

		}
		catch (Exception $e)
		{  
			
                }	

	}
				
?>