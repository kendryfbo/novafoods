<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$id_bodega=trim($_POST["id_bodega"]);
 
	
	try{	
		
			$sql="select 
			numero_orden_compra
			from calidad
			where id_bodega=".$id_bodega;
 		 	$ejecuta=mysql_query($sql,$conexion->link);
			while ($fila=mysql_fetch_array($ejecuta))
			{
		 
					$sql1="INSERT INTO bodega_central
							SELECT * FROM calidad where numero_orden_compra=".$fila[0]." and cantidad>0";
					$resultado1=mysql_query($sql1,$conexion->link);
		 
					echo $sql1;

					/*$sql2="delete from calidad where id_bodega=".$id_bodega;
					$resultado2=mysql_query($sql2,$conexion->link);*/
		
			}

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		