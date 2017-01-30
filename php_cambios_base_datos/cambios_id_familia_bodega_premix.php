<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 


	
		$sql="select id_familia from bodega_premix";
		$resultado=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($resultado))
		{
				if ($fila[0]<>"")
				{
					$sql1="select id_familia from familias
					where familia='".$fila[0]."'";
					$resultado1=mysql_query($sql1,$conexion->link);
					while ($mensaje = mysql_fetch_array($resultado1))
					{
						$sql2="update bodega_premix
								set id_familia=".$mensaje[0]." where id_familia='".$fila[0]."'";
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