<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_usuario=$_POST["id_usuario"];
	$id_pagina=$_POST["id_pagina"];
	$funcion=$_POST["funcion"];
 
try{
		if ($funcion<>1)
		{				
			$sql="select * FROM	 permisos_usuarios	
			WHERE id_usuario=".$id_usuario." and id_pagina=".$id_pagina;
			$resultado1=mysql_query($sql,$conexion->link);
			$mensaje1=mysql_fetch_array($resultado1);

			if ($mensaje1[0]<>"")
			{				
				$sql1="UPDATE permisos_usuarios	 
				set	id_pagina='".$id_pagina."'
				WHERE id_usuario=".$id_usuario." and id_pagina=".$id_pagina;
				$resultado2=mysql_query($sql1,$conexion->link);

			}
			else
			{
				$sql="insert into  permisos_usuarios (id_usuario,id_pagina)
				values ($id_usuario,$id_pagina)";
				$resultado=mysql_query($sql,$conexion->link);

			}				
		}
		else
		{	
			$sql="DELETE FROM permisos_usuarios	
			WHERE id_usuario=".$id_usuario." and id_pagina=".$id_pagina;
			$resultado=mysql_query($sql,$conexion->link);			
		}
			$sql="select nombre_pagina,id_pagina from paginas";
			$resultado=mysql_query($sql,$conexion->link);
			
			while ($mensaje=mysql_fetch_array($resultado))
			{
				$sql1="select id_pagina from permisos_usuarios where id_pagina=".$mensaje[1]." and id_usuario=".$id_usuario;
				$resultado1=mysql_query($sql1,$conexion->link);
				$mensaje1=mysql_fetch_array($resultado1);
				 
				if ($mensaje1[0]<>"")
				{	
			 		$funcion=1; 
					echo "<tr>";
					echo "<td>".$mensaje[0]."</td>"; 
					echo "<td >"; 
					echo "<ul class='interruptor'>";   
					echo "<li class='primer_int '>";
					echo "<a href='#' onClick='$(this).ingresa_pagina(".$id_usuario.",".$mensaje[1].",".$funcion.");'>OFF</a></li>";
					echo "<li class='ultimo_int on'><a href='#' onClick='$(this).ingresa_pagina(".$id_usuario.",".$mensaje[1].");'>ON</a></li>";	
					echo "</ul></td>";
					echo "</tr>";					
				}
				else
				{	
					$funcion=1; 
					echo "<tr>";
					echo "<td>".$mensaje[0]."</td>"; 
					echo "<td >"; 
					echo "<ul class='interruptor'>";   
					echo "<li class='primer_int on '>";
					echo "<a href='#' onClick='$(this).ingresa_pagina(".$id_usuario.",".$mensaje[1].",".$funcion.");'>OFF</a></li>";
					echo "<li class='ultimo_int'><a href='#' onClick='$(this).ingresa_pagina(".$id_usuario.",".$mensaje[1].");'>ON</a></li>";	
					echo "</ul></td>";
					echo "</tr>";
		 		}

			}

	}
		catch (Exception $e)
	{  
	
		echo $e->getMessage();
	}	
				
?>