<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 


	
		$sql="select id_idioma from clientes_internacional";
		$resultado=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($resultado))
		{
				if ($fila[0]<>"")
				{
					$sql1="select id_idioma from idiomas
					where idioma='".$fila[0]."'";
					$resultado1=mysql_query($sql1,$conexion->link);
					while ($mensaje = mysql_fetch_array($resultado1))
					{
						$sql2="update clientes_internacional
								set id_idioma=".$mensaje[0]." where id_idioma='".$fila[0]."'";
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