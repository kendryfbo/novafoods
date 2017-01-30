<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 


	
		$sql="select marca from productos";
		$resultado=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($resultado))
		{
				$sql1="select id_marca from marcas
				where marca='".$fila[0]."'";
				$resultado1=mysql_query($sql1,$conexion->link);
				while ($mensaje = mysql_fetch_array($resultado1))
				{
					$sql2="update productos
							set marca=".$mensaje[0]." where marca='".$fila[0]."'";
					$resultado2=mysql_query($sql2,$conexion->link);	
					//		echo $sql1;
				}


		
			
		}
 			
?>	