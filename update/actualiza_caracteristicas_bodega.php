<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_familia=$_POST["id_familia"];
 	/*$kilos=trim($_POST["kilos"]);
	$alturas=trim($_POST["alturas"]);
	$numero_vereda_final=trim($_POST["numero_vereda_final"]);*/
	$posicion=trim($_POST["posicion"]);
	$sector=trim($_POST["sector"]);
	
 	 //try{
	$sql2="select id_estado_vereda from veredas
		 where posicion='".$posicion."' and id_vereda=".$sector;
	$resultado2=mysql_query($sql2,$conexion->link);
	if ($mensaje2=mysql_fetch_array($resultado2));
	{
		if ($mensaje2[0]==2 || $mensaje2[0]==3)
		{
			echo 1;//echo "La Posicion ".$posicion. " Se Encuentra Ocupada";
		}
		else
		{
			$sql1="UPDATE veredas	 
			set 		 
			id_familia=".$id_familia.
			" where posicion='".$posicion."' and id_vereda=".$sector." and id_estado_vereda=1";
			$resultado2=mysql_query($sql1,$conexion->link);	
			if($resultado2)
			{
				echo 2;
			}
			else
			{
				echo 3;
			}
 		}		
	}
				 
		/*}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
 */
	
					
?>	