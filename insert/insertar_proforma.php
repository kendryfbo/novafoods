<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	
	if ($funcion==1)
	{
		$id_usuario=trim($_POST["id_usuario"]);
		try{
				/*$sql3="INSERT INTO proforma	 (id_usuario)
				VALUES ('$id_usuario')";
				$resultado=mysql_query($sql3,$conexion->link);
				$valor=mysql_insert_id();*/
				$sql2="SELECT MAX(id_temporal_proforma	) FROM temporal_proforma";						
				$ejecuta2=mysql_query($sql2,$conexion->link);			
				$fila2 = mysql_fetch_array($ejecuta2);
				echo $fila2[0]+1;	
				echo $valor;
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$id_cliente_int=trim($_POST["id_cliente_int"]);
		$fecha_proforma=trim($_POST["fecha_proforma"]);
		$id_centro_venta=trim($_POST["id_centro_venta"]);
		$medio_transporte=trim($_POST["medio_transporte"]);
		$puerto_embarque=utf8_decode(trim($_POST["puerto_embarque"]));
		$puerto_destino=utf8_decode(trim($_POST["puerto_destino"]));
		$cond_pago=trim($_POST["cond_pago"]);
		$id_tipo_moneda=utf8_decode(trim($_POST["id_tipo_moneda"]));
		$clausula_venta=trim($_POST["clausula_venta"]);
		$descripcion=utf8_decode(trim($_POST["descripcion"]));
		$subtotal=trim($_POST["subtotal"]);
                $fob=trim($_POST["fob"]);
		$descuento=trim($_POST["descuento"]);
		$freight=trim($_POST["freight"]);
		$insurance=trim($_POST["insurance"]);
		$total=trim($_POST["total"]);
		$fecha_proforma2=date("Y-m-d",strtotime($fecha_proforma));
		$version=trim($_POST["version"]);
                $id_usuario=trim($_POST["id_usuario"]);
		try{
                        $numpro=0+1;
                        
			$sql5="SELECT max(numero_proforma) FROM proforma";
			$resultado5=mysql_query($sql5,$conexion->link);
			while ($fila5 = mysql_fetch_array($resultado5))
			{
					$numpro=$fila5[0]+1;
													
			}
                        //$resultado=mysql_query($sql5,$conexion->link);
                                
                        $sql="INSERT INTO proforma 
				(numero_proforma,
				id_cliente,
				fecha_proforma,
				id_centro_venta,
				medio_de_transporte,
				puerto_embarque,
				puerto_destino,
				ingresada,
				forma_pago,
				id_tipo_moneda,
				clausula_venta,
				total,
				descripcion_mercaderia,
				subtotal,
				freight,
				insurance,
				version,
				descuento,
                                id_usuario,
                                fob)
				VALUES ('$numpro','$id_cliente_int','$fecha_proforma2','$id_centro_venta','$medio_transporte','$puerto_embarque','$puerto_destino','Si','$cond_pago','$id_tipo_moneda','$clausula_venta','$total','$descripcion','$subtotal','$freight','$insurance','$version','$descuento','$id_usuario','$fob')";
				$resultado=mysql_query($sql,$conexion->link);

				$sql1="SELECT id_detalle_proforma,Cantidad,id_producto,Precio,total FROM temporal_detalle_proforma
				where id_usuario=".$id_usuario;
				$resultado1=mysql_query($sql1,$conexion->link);
				while ($fila1 = mysql_fetch_array($resultado1))
				{
					$sql4="INSERT INTO detalle_proforma (numero_proforma,Cantidad,id_producto,Precio,total)
					VALUES ('$numpro','$fila1[1]','$fila1[2]','$fila1[3]','$fila1[4]')";
					$resultado=mysql_query($sql4,$conexion->link);								
				}
                                $sql4="delete from  temporal_detalle_proforma where id_usuario=".$id_usuario;
					$resultado=mysql_query($sql4,$conexion->link);
                                        
				echo "Proforma Ingresada Numero ".$numpro;
                                //echo "Proforma Ingresada Numero ".$numero_proforma;
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==3)
	{
		try{
				$sql2="SELECT MAX(id_temporal_proforma) FROM temporal_proforma";						
				$ejecuta2=mysql_query($sql2,$conexion->link);			
				$fila2 = mysql_fetch_array($ejecuta2);
				echo $fila2[0]+1;
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==4)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="SELECT MAX(id_temporal_proforma) FROM temporal_proforma";						
		$ejecuta2=mysql_query($sql2,$conexion->link);			
		$fila2 = mysql_fetch_array($ejecuta2);
		$valor=$fila2[0]+1;
		if ($numero_proforma==$valor)
		{
			echo "1";
		}
		else if ($numero_proforma<$valor)
		{
			echo "3";
		}
		else if ($numero_proforma>$valor)
		{
			echo "2";
		}
	}
	else if ($funcion==5)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="select 
				cliente.nombre,
				DATE_FORMAT(proforma.fecha_proforma,'%d-%m-%Y') as fecha,
				centro_venta.centro_venta,
				proforma.version,
				proforma.medio_de_transporte,
				suc_aduanas.id_suc_aduanas,
				proforma.puerto_destino,
				proforma.forma_pago,
				proforma.descripcion_mercaderia,
				cliente.direccion,
				paises.pais,
				tipos_de_monedas.tipo_moneda,
				proforma.Subtotal,
				proforma.total,
				proforma.clausula_venta,
				proforma.descuento,
				proforma.insurance,
				proforma.freight,
                                proforma.fob,
                                suc_aduanas.id_aduana,
                                proforma.status,
                                aduanas.id_aduana,
                                aduanas.rut,
                                provincia_cl.str_descripcion,
                                suc_aduanas.fono
				from 
				proforma
				inner join cliente on cliente.id_cliente=proforma.id_cliente
				inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=proforma.id_tipo_moneda
				inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
				inner join paises on paises.id_pais=cliente.pais
                                inner join suc_aduanas on suc_aduanas.id_suc_aduanas=proforma.puerto_embarque
                                inner join aduanas on suc_aduanas.id_aduana=aduanas.id_aduana
                                inner join provincia_cl on suc_aduanas.provincia=provincia_cl.id_pr
				where proforma.numero_proforma=".$numero_proforma;	
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{		 
			$salida[]=array("valor"=>1);
		 	echo json_encode($salida);
		}
		else
		{
			while ($fila = mysql_fetch_array($ejecuta))
			{
				$salida[]=array("cliente"=>utf8_encode($fila[0]),"fecha_proforma"=>$fila[1],"centro_venta"=>$fila[2]
				,"version"=>$fila[3],"medio_de_transporte"=>utf8_encode($fila[4]),"puerto_embarque"=>utf8_encode($fila[5]),
					"puerto_destino"=>utf8_encode($fila[6]),"forma_pago"=>utf8_encode($fila[7]),"descripcion_mercaderia"=>$fila[8]
					,"direccion"=>$fila[9],"pais"=>$fila[10],"tipo_moneda"=>$fila[11],"sub_total"=>$fila[12],"total"=>$fila[13],
					"clausula_venta"=>$fila[14],"descuento"=>$fila[15],"insurance"=>$fila[16],"freight"=>$fila[17],"tot_fob"=>$fila[18],
                                        "aduana"=>$fila[19],"est"=>$fila[20],"agencia"=>$fila[21],"rut_agencia"=>$fila[22],"ciudad"=>$fila[23],"fono"=>$fila[24]); 
			}
			echo json_encode($salida);
		}
	}
	else if ($funcion==6)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					productos.codigo_producto,
					detalle_proforma.cantidad,
					detalle_proforma.precio,
					detalle_proforma.total,
					proforma.facturada
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[3]."</td>";
			/*echo	"<td>".$mensaje2[4]."</td>";
			echo	"<td>".number_format($mensaje2[5])."</td>";
			if ($mensaje2[6]<>'Si')
			{
				echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-borrar info-tooltip'></a></td>";
				echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_proforma_version(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
			}
			else
			{
				echo	"<td></td>";
			}	*/	
			echo "</tr>";	
		}
	}
	else if ($funcion==7)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);			
		$sql="INSERT INTO proforma_historico
			SELECT * FROM proforma where numero_proforma=".$numero_proforma;
		$ejecuta=mysql_query($sql,$conexion->link);

		$sql1="SELECT version FROM proforma where numero_proforma=".$numero_proforma;
		$ejecuta1=mysql_query($sql1,$conexion->link);
		$fila1=mysql_fetch_array($ejecuta1);
		$dato=$fila1[0]+1;

		$sql2="UPDATE proforma set version=".$dato." where numero_proforma=".$numero_proforma;
		$resultado2=mysql_query($sql2,$conexion->link);

		$sql3=" SELECT Cantidad,id_producto,Precio,total FROM detalle_proforma where numero_proforma=".$numero_proforma;
		$ejecuta3=mysql_query($sql3,$conexion->link);
		while ($fila3=mysql_fetch_array($ejecuta3))
		{	
			$sql4="SELECT version FROM proforma where numero_proforma=".$numero_proforma;
			$ejecuta4=mysql_query($sql4,$conexion->link);
			$fila4=mysql_fetch_array($ejecuta4);

			$sql5="INSERT INTO detalle_proforma_historica (numero_proforma,Cantidad,id_producto,Precio,total)
			VALUES
			('$numero_proforma','$fila3[0]','$fila3[1]','$fila3[2]','$fila3[3]')";
			$resultado5=mysql_query($sql5,$conexion->link);
			$valor=mysql_insert_id();
			$dato2=($fila4[0]-(1));

			$sql6="UPDATE detalle_proforma_historica	 
				set 		 
				version=".$dato2.
				" where id_detalle_proforma=".$valor;
			$resultado6=mysql_query($sql6,$conexion->link);			
		}
		echo $dato;
	}
	else if ($funcion==8)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					productos.codigo_producto,
					detalle_proforma.cantidad,
					detalle_proforma.total,
					detalle_proforma.precio,
					proforma.facturada
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[3]."</td>";
		}
	}
	else if ($funcion==9)
	{
		$id_aduana=trim($_POST["id_aduana"]);
		$sql="select
					rut,
					direccion,
					ciudad,
					fono
					from aduanas
					WHERE id_aduana=".$id_aduana;			
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$salida[]=array("rut"=>$fila[0],"direccion"=>utf8_encode($fila[1]),"ciudad"=>utf8_encode($fila[2]),"fono"=>$fila[3]);
		}
		echo json_encode($salida);
	}
	else if ($funcion==10)
	{
		$num_proforma=trim($_POST["num_proforma"]);
		$num_guia=trim($_POST["num_guia"]);
		$nave=trim($_POST["nave"]);
		$bk=trim($_POST["bk"]);
		$contenedor=trim($_POST["contenedor"]);	
		$sello=trim($_POST["sello"]);	
		$chofer=trim($_POST["chofer"]);
                $movil=trim($_POST["movil"]);
                $patente=trim($_POST["patente"]);
                $dus=trim($_POST["dus"]);
                $kn=trim($_POST["kn"]);
                $kb=trim($_POST["kb"]);
		$fecha=date("y-m-d H:i:s");
		

		$sql="INSERT INTO guias_despachos (numero_guia_despacho,nave,bk,contenedor,sello,chofer,movil,patente,dus,kn,kb,numero_proforma,fecha)
			VALUES
			('$num_guia','$nave','$bk','$contenedor','$sello','$chofer','$movil','$patente','$dus','$kn','$kb','$num_proforma','$fecha')";
		$resultado=mysql_query($sql,$conexion->link);
		$guia=mysql_insert_id();
		$sql1="UPDATE proforma	 
			set 		 
			despachada='Si',aceptada='Si' where numero_proforma=".$num_proforma;
		$resultado1=mysql_query($sql1,$conexion->link);	

		echo "Guia de Despacho Ingresada Numero ".$num_guia;
	}
	else if ($funcion==11)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="SELECT numero_proforma FROM guias_despachos where numero_proforma=".$numero_proforma;						
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
                    
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==12)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="select guias_despachos.numero_guia_despacho,
				cliente.nombre,
                                aduanas.id_aduana,
                                suc_aduanas.id_suc_aduanas,
                                aduanas.rut,
                                cliente.direccion,
                                suc_aduanas.fono,
                                guias_despachos.nave,
                                guias_despachos.bk,
                                guias_despachos.contenedor,
                                guias_despachos.sello,
                                guias_despachos.chofer,
                                guias_despachos.movil,
                                guias_despachos.patente,
                                guias_despachos.dus,
                                guias_despachos.kn,
                                guias_despachos.kb,
                                provincia_cl.str_descripcion,
                                guias_despachos.fecha
				from guias_despachos
				inner join proforma on proforma.numero_proforma=guias_despachos.numero_proforma
                                inner join cliente on proforma.id_cliente=cliente.id_cliente
                                inner join suc_aduanas on proforma.puerto_embarque=suc_aduanas.id_suc_aduanas
                                inner join aduanas on aduanas.id_aduana=suc_aduanas.id_aduana
                                inner join provincia_cl on provincia_cl.id_pr=suc_aduanas.provincia
				where guias_despachos.numero_proforma=".$numero_proforma;	
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{		 
			$salida[]=array("valor"=>1);
		 	echo json_encode($salida);
		}
		else
		{
			while ($fila = mysql_fetch_array($ejecuta))
			{
				$salida[]=array("numero_guia_despacho"=>$fila[0],"cliente"=>utf8_encode($fila[1]),
                                    "nombre_aduana"=>utf8_encode($fila[2]),"nombre_suc_aduana"=>utf8_encode($fila[3]),"rut"=>utf8_encode($fila[4]),
                                    "direccion"=>utf8_encode($fila[5]),"fono"=>utf8_encode($fila[6]),"nave"=>utf8_encode($fila[7]),
                                    "bk"=>utf8_encode($fila[8]),"contenedor"=>utf8_encode($fila[9]),"sello"=>utf8_encode($fila[10]),
                                    "chofer"=>utf8_encode($fila[11]),"movil"=>utf8_encode($fila[12]),"patente"=>utf8_encode($fila[13]),
                                    "dus"=>utf8_encode($fila[14]),"kn"=>utf8_encode($fila[15]),"kb"=>utf8_encode($fila[16]),
                                    "ciudad"=>utf8_encode($fila[17]),"fecha"=>utf8_encode($fila[18]));
                                
			}
			echo json_encode($salida);
		}
	}
	else if ($funcion==13)
	{
		$num_guia=trim($_POST["num_guia"]);
		//$id_guia=trim($_POST["id_guia"]);		
		$sql="SELECT numero_guia_despacho FROM guias_despachos where numero_guia_despacho=".$num_guia;				
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==14)
	{
		$num_guia=trim($_POST["num_guia"]);
		$nave=trim($_POST["nave"]);
		$bk=trim($_POST["bk"]);
		$contenedor=trim($_POST["contenedor"]);
		$sello=trim($_POST["sello"]);	
		$chofer=trim($_POST["chofer"]);	
		$movil=trim($_POST["movil"]);	
		$patente=trim($_POST["patente"]);
                $dus=trim($_POST["dus"]);
                $kn=trim($_POST["kn"]);
                $kb=trim($_POST["kb"]);
                $fecha=date("y-m-d H:i:s");
		$sql="UPDATE guias_despachos	 
					set 		 
					nave='".$nave."',
                                        bk='".$bk."',
					contenedor='".$contenedor."',
                                        sello='".$sello."',
                                        chofer='".$chofer."',
					movil='".$movil."',
					patente='".utf8_decode($patente)."',
                                        dus='".$dus."',
                                        kn='".$kn."',
                                        kb='".$kb."',
					fecha='".$fecha."'
					where numero_guia_despacho=".$num_guia;
		$resultado=mysql_query($sql,$conexion->link);
                //echo $sql;
		echo "Guia de Despacho Modificada Nº".$num_guia;
	}
	else if ($funcion==15)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					productos.codigo_producto,
					detalle_proforma.cantidad,
					detalle_proforma.precio,
					detalle_proforma.total,
					proforma.facturada,
                                        proforma.status
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			$pre=number_format($mensaje2[4], 2, '.', '');
                        $tot=number_format($mensaje2[5], 2, '.', '');
                        echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[3]."</td>";//can
			echo	"<td style='text-align:right'>".$pre."</td>";//pre
			echo	"<td style='text-align:right'>".$tot."</td>";//tot
			if ($mensaje2[6]<>'Si')
			{
                            if($mensaje2[7]==0){
				echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-borrar info-tooltip'></a></td>";
				//echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).cambio_proforma_version_modifca(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
                            }
			}
			else
			{
				echo	"<td></td>";
			}		
			echo "</tr>";	
		}
	}
	else if ($funcion==16)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$id_cliente_int=trim($_POST["id_cliente_int"]);
		$fecha_proforma=trim($_POST["fecha_proforma"]);
		$id_centro_venta=trim($_POST["id_centro_venta"]);
		$medio_transporte=trim($_POST["medio_transporte"]);
		$puerto_embarque=utf8_decode(trim($_POST["puerto_embarque"]));
		$puerto_destino=utf8_decode(trim($_POST["puerto_destino"]));
		$cond_pago=trim($_POST["cond_pago"]);
		$id_tipo_moneda=utf8_decode(trim($_POST["id_tipo_moneda"]));
		$clausula_venta=trim($_POST["clausula_venta"]);
		$descripcion=utf8_decode(trim($_POST["descripcion"]));
		$subtotal=trim($_POST["subtotal"]);
		$descuento=trim($_POST["descuento"]);
		$freight=trim($_POST["freight"]);
		$insurance=trim($_POST["insurance"]);
		$total=trim($_POST["total"]);
		$fecha_proforma2=date("Y-m-d",strtotime($fecha_proforma));
		$version=trim($_POST["version"]);
		try{

			$sql1="UPDATE proforma	 
					set 		 
					id_cliente='".$id_cliente_int."',
					fecha_proforma='".$fecha_proforma2."',
					id_centro_venta='".$id_centro_venta."',
					medio_de_transporte='".$medio_transporte."',
					puerto_embarque='".utf8_decode($puerto_embarque)."',
					puerto_destino='".utf8_decode($puerto_destino)."',
					ingresada='Si',
					forma_pago='".utf8_decode($cond_pago)."',
					id_tipo_moneda='".$id_tipo_moneda."',
					clausula_venta='".$clausula_venta."',
					total='".$total."',
					descripcion_mercaderia='".utf8_decode($descripcion)."',
					subtotal='".$subtotal."',
					freight='".$freight."',
					insurance='".$insurance."',
					version='".$version."',
					descuento='".$descuento."'
					where numero_proforma=".$numero_proforma;
				$resultado2=mysql_query($sql1,$conexion->link);	 
			
				
				echo "Proforma Actualizada Numero ".$numero_proforma;
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==17)
	{
		$numero_guia=trim($_POST["numero_guia"]);
		$sql="SELECT numero_guia_despacho FROM guias_despachos where numero_guia_despacho=".$numero_guia;				
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==18)
	{
		$numero_guia=trim($_POST["numero_guia"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					detalle_proforma.cantidad,
					productos.nombre_producto,
					formatos.formato,
					productos.Peso_Bruto,
					productos.Volumen,
					productos.peso_neto,
					cliente.nombre,
					factura_internacional.numero_factura,
					guias_despachos.contenedor
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					inner join formatos on formatos.id_formato=productos.id_formato	
					inner join guias_despachos on guias_despachos.numero_proforma=proforma.numero_proforma
					inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
					inner join cliente on cliente.id_cliente=proforma.id_cliente
					WHERE guias_despachos.numero_guia_despacho=".$numero_guia;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{		
			$peso_bruto=$mensaje2[1]*$mensaje2[4];
			$peso_neto=$mensaje2[1]*$mensaje2[6];
			$volumen=$mensaje2[1]*$mensaje2[5];
                        
                        $peso_bruto=number_format($peso_bruto, 2, '.', ',');
                        $peso_neto=number_format($peso_neto, 2, '.', ',');
                        $volumen=number_format($volumen, 2, '.', ',');
                        
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td style='text-align:right'>".$mensaje2[1]."</td>";
			echo	"<td>".utf8_encode($mensaje2[2])."</td>";
			echo	"<td>".$mensaje2[3]."</td>";
			echo	"<td style='text-align:right'>".$peso_bruto."</td>";
			echo	"<td style='text-align:right'>".$peso_neto."</td>";
			echo	"<td style='text-align:right'>".$volumen."</td>";
			echo	"<input type='hidden' id='cliente_nom' value=".$mensaje2[7].">";
			echo	"<input type='hidden' id='factura_num' value=".$mensaje2[8].">";
			echo	"<input type='hidden' id='contenedor_num' value=".$mensaje2[9].">";
		echo "</tr>";	
		}		
	}
	else if ($funcion==19)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="SELECT facturada FROM proforma where numero_proforma=".$numero_proforma;				
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			$numero_proforma=trim($_POST["numero_proforma"]);
			$sql2="SELECT rechazada FROM proforma where numero_proforma=".$numero_proforma;				
			$ejecuta2=mysql_query($sql2,$conexion->link);	
			$fila2 = mysql_fetch_array($ejecuta2);
			if ($fila2[0]<>"")
			{
				echo "3";
			}
			else
			{
				echo "2";
			}
		}		
	}
	else if ($funcion==20)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="SELECT ingresada FROM proforma where numero_proforma=".$numero_proforma;				
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			echo "2";
		}		
	}
	else if ($funcion==21)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					productos.codigo_producto,
					detalle_proforma.cantidad,
					detalle_proforma.precio,
					detalle_proforma.total,
					proforma.facturada
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[3]."</td>";
			echo	"<td>".$mensaje2[4]."</td>";
			echo	"<td>".number_format($mensaje2[5])."</td>";
			echo	"<td></td>";
			echo "</tr>";	
		}
	}
        else if ($funcion==22)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="SELECT numero_proforma FROM proforma where status='2'and numero_proforma=".$numero_proforma;						
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
                    
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
?>	