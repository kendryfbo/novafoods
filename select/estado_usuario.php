<?php
	 include_once("../clases/conexion.php");
	$conexion=new conexion();
	$id_usuario_modificar=trim($_POST["id_usuario_modificar"]);

	$sql="select id_estado from usuarios  where id_Usuario=".$id_usuario_modificar;
	$ejecuta=mysql_query($sql,$conexion->link);
	$mensaje=mysql_fetch_array($ejecuta);
	
	if ($mensaje[0]==="1")
	{
		echo	"<td>El usuario Actualmente se encuentra Activo</td>"; 
		echo	"<td >"; 
		echo	"<ul class='interruptor'>";   
		echo	"<li class='primer_int'>";
		echo	"<a href='#' onClick='$(this).cambio_estado(".$id_usuario_modificar.");'>OFF</a></li>";
		echo	"<li class='ultimo_int on'><a href='#'  onClick='$(this).cambio_estado(".$id_usuario_modificar.");'>ON</a></li>";	
		echo	"</ul></td>";
	}
	else
	{	
		echo	"<td>El usuario Actualmente se encuentra Inactivo</td>"; 
		echo	"<td >"; 
		echo	"<ul class='interruptor'>";   
		echo	"<li class='primer_int on'>";
		echo	"<a href='#'  onClick='$(this).cambio_estado(".$id_usuario_modificar.");'>OFF</a></li>";
		echo	"<li class='ultimo_int '><a href='#'  onClick='$(this).cambio_estado(".$id_usuario_modificar.");'>ON</a></li>";	
		echo	"</ul></td>";
		
	}
?>