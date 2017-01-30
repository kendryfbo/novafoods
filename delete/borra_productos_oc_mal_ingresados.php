<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion==1)
	{
		$id_detalle_oc=$_POST["id_detalle_oc"];
                $id_usuario=$_POST["id_usuario"];
		try{
			$sql="DELETE FROM temporal_det_oc	
				WHERE id_tem=".$id_detalle_oc;
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
		$id_detalle=$_POST["id_detalle"];
		try{
				$sql1="DELETE FROM detalle_oc	
				WHERE id_detalle=".$id_detalle;
				$resultado1=mysql_query($sql1,$conexion->link);
				

			}
				catch (Exception $e)
			{  
			
				echo $e->getMessage();
			}

	}
        else if ($funcion==3)
	{
                
                $id_detalle=$_POST["id_detalle"];
                $numero_oc=$_POST["numero_oc"];
		try{
			$sql="DELETE FROM detalle_oc	
				WHERE id_detalle=".$id_detalle." and id_oc=".$numero_oc;
				$resultado=mysql_query($sql,$conexion->link);
                                
                                echo"Producto Eliminado Correctamente";

				/*$sql1="DELETE FROM bodega_producto_terminado	
				WHERE id_bodega=".$id_bodega;
				$resultado1=mysql_query($sql1,$conexion->link);*/
				

		}
		catch (Exception $e)
		{  
			echo"No elimino!";
                }	

	}
        /*else if ($funcion==3)
	{
                //Temporal Nota Credito    
                $id_detalle_nc=$_POST["id_detalle_nc"];
		try{
			$sql="DELETE FROM temporal_detalle_nc	
				WHERE id_detalle_nc=".$id_detalle_nc;
				$resultado=mysql_query($sql,$conexion->link);
                                
                                echo"Producto Eliminado Correctamente";

				
				

		}
		catch (Exception $e)
		{  
			
                }	

	}*/
				
?>