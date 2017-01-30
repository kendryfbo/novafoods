<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$clave=trim($_POST["clave"]);
		try{	
                    if($clave=="COMEX"){
                        echo"1";
                    }else{  
                        echo"0";
                    }		
			//echo "Proforma Nº".$numero_proforma." Actualizada por Comex!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
                
		try{	
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE proforma	 
				set 		 
				status='2'
				where numero_proforma=".$numero_proforma;
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Proforma Nº".$numero_proforma." Actualizada por Comex!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	
					
?>		