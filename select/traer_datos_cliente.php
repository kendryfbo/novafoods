	<?php
	$id_cliente_internacional=$_POST["id_cliente_internacional"];
	if ($id_cliente_internacional<>0)
	{
		$funcion=$_POST["funcion"];
		include_once("../clases/conexion.php");
		$conexion= new conexion();  
		if ($funcion==1)
		{
			$sql1="select direccion cargo from cliente where id_cliente=".$id_cliente_internacional;				
			//$sql1="select direccion cargo from cliente_internacional where id_cliente=".$id_cliente_internacional;				
			$ejecuta1=mysql_query($sql1,$conexion->link);
			if ($fila1 = mysql_fetch_array($ejecuta1))
			{		
				echo "<textarea name='textarea' readonly rows='3' cols='40'>".utf8_encode($fila1[0])."</textarea>";
			}
		}
		else
		{
			$sql2="select pais from cliente where id_cliente=".$id_cliente_internacional;				
			//$sql2="select id_pais from cliente_internacional where id_cliente=".$id_cliente_internacional;				
			$ejecuta2=mysql_query($sql2,$conexion->link);
			if ($fila2 = mysql_fetch_array($ejecuta2))
			{
				if($fila2[0]<>0)
				{
					$sql3="select paises.pais from cliente inner join paises on paises.id_pais=cliente.pais
					where cliente.tipo_cliente=1 and cliente.id_cliente=".$id_cliente_internacional;				
					$ejecuta3=mysql_query($sql3,$conexion->link);
					if ($fila3 = mysql_fetch_array($ejecuta3))
					{
						echo "<input type='text' id='Pais'  readonly placeholder='Pais' value='".utf8_encode($fila3[0])."'/>";
					}
					
					/*$sql3="select paises.pais from cliente_internacional inner join paises on paises.id_pais=cliente_internacional.id_pais
					where cliente_internacional.id_cliente=".$id_cliente_internacional;				*/
				}
				else
				{
					echo "<input type='text' id='Pais'  readonly value='No Registra Pais'/>";
				}
			}
		}
	}
	
?>