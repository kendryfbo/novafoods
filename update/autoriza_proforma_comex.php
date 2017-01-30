<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		try{	
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE proforma	 
				set 		 
				status='1'
				where numero_proforma=".$numero_proforma;
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Proforma Nº".$numero_proforma." Actualizada por Comex!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
                $version=trim($_POST["version"]);
                $version=$version+1;
		try{	
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE proforma	 
				set 		 
				status='2',version='$version'
				where numero_proforma=".$numero_proforma;
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Proforma Nº".$numero_proforma." Actualizada por Gerencia!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==3)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
                $observacion=trim($_POST["observacion"]);
		try{	
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE proforma	 
				set 		 
				status='0',obs_rechazo='$observacion'
				where numero_proforma=".$numero_proforma;
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Proforma Nº".$numero_proforma." Rechazada por Gerencia!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
					
?>		