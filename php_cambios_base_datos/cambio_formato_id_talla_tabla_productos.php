<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 


	
		$sql="select id_talla from productos";
		$resultado=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($resultado))
		{
				if ($fila[0]<>"")
				{
					$sql1="select id_talla from tallas
					where talla='".$fila[0]."'";
					$resultado1=mysql_query($sql1,$conexion->link);
					while ($mensaje = mysql_fetch_array($resultado1))
					{
						$sql2="update productos
								set id_talla=".$mensaje[0]." where id_talla='".$fila[0]."'";
						$resultado2=mysql_query($sql2,$conexion->link);
						//		echo $sql1;
					}
					//echo $fila[0];
				}
				else
				{
					echo "vacio";
				}

		
			
		}
 			
?>	