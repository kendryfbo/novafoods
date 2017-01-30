<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_banco=$_POST["id_banco"];
 	$banco=trim($_POST["banco"]);
	
	 try{
				$sql1="UPDATE bancos	 
				set 		 
				banco='".$banco."'
				where id_banco=".$id_banco;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Banco Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>	