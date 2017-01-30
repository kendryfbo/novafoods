<?php
	$id_canal=$_POST["id_canal"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select * from canales where id_canal=".$id_canal;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);			 
                        $sum=0;
			while($fila1 = mysql_fetch_array($ejecuta))
			{
                            $sum=$fila1[2];
                            /*$sum=$sum+$fila1[2];
                            if($fila1[0]==$id_canal){
                                break;
                            }*/                            
			}
                        echo $sum;
			
				
?>