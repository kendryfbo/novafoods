<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$id_usuario=trim($_POST["id_usuario"]);
 	$sql1="select
			paginas.direccion,
			paginas.nombre_pagina
			from permisos_usuarios
			inner join paginas on paginas.id_pagina=permisos_usuarios.id_pagina
			where permisos_usuarios.id_usuario=".$id_usuario." and nivel=40	order by permisos_usuarios.id_pagina asc";
 			$ejecuta=mysql_query($sql1,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))
			{
				 echo	"<li><a href=".$fila[0]."  ><span>".$fila[1]."</span></a></li>";
			}
?>	