<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
        $numero_nv=trim($_POST["numero_nv"]);
        $sql5="SELECT numero_nota_venta FROM nota_venta where numero=".$numero_nv;
			$resultado5=mysql_query($sql5,$conexion->link);
			while ($fila5 = mysql_fetch_array($resultado5))
			{
					$numero_nota_venta=$fila5[0];
													
			}
	if ($funcion==1)
	{
		$numero_nv=trim($_POST["numero_nv"]);
		try{	
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE nota_venta	 
				set 		 
				estado='2'
				where numero=".$numero_nv;
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Nota de Venta Nº".$numero_nota_venta." Actualizada por Finanzas!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		$numero_nv=trim($_POST["numero_nv"]);
                $version=trim($_POST["version"]);
                $version=$version+1;
		try{	
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE nota_venta	 
				set 		 
				estado='2',version='$version'
				where numero=".$numero_nv;
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Nota de Venta Nº".$numero_nota_venta." Actualizada por Gerencia!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==3)
	{
		$numero_nv=trim($_POST["numero_nv"]);
                $observacion=trim($_POST["observacion"]);
		try{	
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE nota_venta	 
				set 		 
				estado='0',obs_rechazo='$observacion'
				where numero=".$numero_nv;
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Nota de Venta Nº".$numero_nota_venta." Rechazada por Finanzas!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
					
?>		