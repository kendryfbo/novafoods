<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 


	
		$sql="select id_sabor from productos";
		$resultado=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($resultado))
		{
				if ($fila[0]<>"")
				{
					$sql1="select id_sabor from sabores
					where sabor_espanol='".$fila[0]."'";
					$resultado1=mysql_query($sql1,$conexion->link);
					while ($mensaje = mysql_fetch_array($resultado1))
					{
						$sql2="update productos
								set id_sabor=".$mensaje[0]." where id_sabor='".$fila[0]."'";
						$resultado2=mysql_query($sql2,$conexion->link);
								//echo $sql1;
					}
				}
				else
				{
					echo "vacio";
				}

		
			
		}
 			
?>	