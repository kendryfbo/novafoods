<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_usuario=$_POST["id_usuario"];	
	
  try{	
			 	$sql1="select id_estado from usuarios
				where id_Usuario='".$id_usuario."'";
				$resultado=mysql_query($sql1,$conexion->link);
				$mensaje=mysql_fetch_array($resultado);
				
				if ($mensaje[0]=="1")
				{
					$sql1="UPDATE usuarios	 
					set 		 
					id_estado=2
					where id_Usuario=".$id_usuario;
					$resultado2=mysql_query($sql1,$conexion->link);
					echo "<td>El usuario Actualmente se encuentra Inactivo</td>"; 
					echo "<td >"; 
					echo	"<ul class='interruptor'>";   
					echo	"<li class='primer_int on'>";
					echo	"<a href='#'  onClick='$(this).cambio_estado(".$id_usuario.");'>OFF</a></li>";
					echo	"<li class='ultimo_int '><a href='#'  onClick='$(this).cambio_estado(".$id_usuario.");'>ON</a></li>";	
					echo   "</ul></td>";
				}
				else
				{
					$sql1="UPDATE usuarios	 
					set 		 
					id_estado=1
					where id_Usuario=".$id_usuario;
					$resultado2=mysql_query($sql1,$conexion->link);
					echo	"<td>El usuario Actualmente se encuentra Activo</td>"; 
					echo	"<td >"; 
					echo	"<ul class='interruptor'>";   
					echo	"<li class='primer_int'>";
					echo	"<a href='#' onClick='$(this).cambio_estado(".$id_usuario.");'>OFF</a></li>";
					echo	"<li class='ultimo_int on'><a href='#'  onClick='$(this).cambio_estado(".$id_usuario.");' >ON</a></li>";	
					echo   "</ul></td>";
				}
	}
		catch (Exception $e)
	{    
		 echo $e->getMessage();
	}


					
?>	