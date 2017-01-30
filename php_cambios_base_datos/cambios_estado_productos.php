<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 


	
		$sql="select tipo,id_bodega from bodega_central";
		$resultado=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($resultado))
		{
				if ($fila[0]<>"")
				{
					if($fila[0]=='E')
					{
					 
					 
							$sql2="update bodega_central
									set id_estado=1 where id_bodega='".$fila[1]."'";
							$resultado2=mysql_query($sql2,$conexion->link);
					 
					}
					if($fila[0]=='I')
					{
					 
					 
							$sql2="update bodega_central
									set id_estado=2 where id_bodega='".$fila[1]."'";
							$resultado2=mysql_query($sql2,$conexion->link);
					 
					}
					
					
				}
				else
				{
					echo "vacio";
				}

		
			
		}
 			
?>	