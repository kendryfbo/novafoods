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
                    $sql2="select formulas.version,productos.nombre_producto from productos 
                            inner join formulas on productos.id_producto=formulas.id_producto_padre
                            where productos.id_producto=".$numero_proforma;                    
                     $ejecuta2=mysql_query($sql2,$conexion->link);
                     while ($fila2 = mysql_fetch_array($ejecuta2))
                     {
                         $vers=$fila2[0];
                         $prod=$fila2[1];
                     }
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE formulas	 
				set 		 
				status='2',version='$version'
				where id_producto_padre=".$numero_proforma;
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Se Aprueba Formula de Producto ".$prod." por Gerencia!";
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
                    $sql2="select formulas.version,productos.nombre_producto from productos 
                            inner join formulas on productos.id_producto=formulas.id_producto_padre
                            where productos.id_producto=".$numero_proforma;                    
                     $ejecuta2=mysql_query($sql2,$conexion->link);
                     while ($fila2 = mysql_fetch_array($ejecuta2))
                     {
                         $vers=$fila2[0];
                         $prod=$fila2[1];
                     }
                    mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE formulas	 
				set 		 
				status='0',obs_rechazo='$observacion'
				where id_producto_padre=".$numero_proforma;
			$resultado=mysql_query($sql1,$conexion->link);
				
			echo "Se Rechaza Formula de Producto ".$prod." por Gerencia!";	
			//echo "Proforma Nº".$numero_proforma." Rechazada por Gerencia!";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
					
?>		