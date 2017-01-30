<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 


	
		$sql="select tipo,id_bodega,cantidad from bodega_central";
		$resultado=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($resultado))
		{
				if ($fila[0]<>"")
				{
					if($fila[0]=='E')
					{
						$cantidad=$fila[2]*-1;
						if (  $cantidad<0)
						{
							$sql2="update bodega_central
									set cantidad=".$cantidad." where id_bodega='".$fila[1]."'";
							$resultado2=mysql_query($sql2,$conexion->link);
						}
					}
					
				}
				else
				{
					echo "vacio";
				}

		
			
		}
 			
?>	