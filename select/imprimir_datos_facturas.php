<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
 	$funcion=trim($_GET["funcion"]);
	require_once("../fpdf/fpdf.php");

	if ($funcion==1)
	{ 
		$numero=trim($_GET["numero"]);
		class PDF extends FPDF
		{
			function Header()
			{
				$this->SetFont('Arial','B',15);
				$this->Cell(80);
				$this->Image('../img/logo_fac.png',30);
				$this->Cell(40,10,'Factura Nacional',0,0,'C');
				$this->Ln(20);
			}
			function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
				$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
			}
		}
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);

		$sql="select facturas.numero_factura,
		cliente_nacional.nombre_cliente,
		cliente_nacional.rut
		from facturas
		inner join cliente_nacional on cliente_nacional.id_cliente=facturas.id_cliente
		where numero_factura=".$numero;
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);

		$pdf->Cell(0,10,'Numero de Factura  :  '.$mensaje[0],0,1);
		$pdf->Cell(0,10,'Cliente  :  '.$mensaje[1],0,1);
		$pdf->Cell(0,10,'Rut Cliente  :  '.$mensaje[2],0,1);
	
		$sql1="select productos.nombre_producto,
		detalle_factura.precio,
		detalle_factura.cantidad,
		detalle_factura.total	
		from detalle_factura
		inner join productos on productos.id_producto=detalle_factura.id_producto
		where detalle_factura.factura=".$numero;

		$pdf->Cell(130,5,'Producto',1,0,'C');
		$pdf->Cell(17,5,'Precio',1,0,'C');
		$pdf->Cell(17,5,'Cantidad',1,0,'C');
		$pdf->Cell(17,5,'Total',1,1,'C');
	
		$resultado1=mysql_query($sql1,$conexion->link);
		while ($mensaje1=mysql_fetch_array($resultado1))
		{
			$pdf->Cell(130,5,$mensaje1[0],1,0,'C');
			$pdf->Cell(17,5,$mensaje1[1],1,0,'C');
			$pdf->Cell(17,5,$mensaje1[2],1,0,'C');
			$pdf->Cell(17,5,$mensaje1[3],1,1,'C');
		}
		$modo="I";     
		$pdf->Output('Factura_Nacional_'.$numero,$modo); 	 
	}
	else if ($funcion==2)
	{ 
		$numero=trim($_GET["numero"]);
		class PDF extends FPDF
		{
			function Header()
			{
				$this->SetFont('Arial','B',15);
				$this->Cell(80);
				$this->Image('../img/logo_fac.png',30);
				$this->Cell(40,10,'Nota Venta',0,0,'C');
				$this->Ln(20);
			}
			function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
				$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
			}
		}
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);

		$sql="select nota_venta.Numero_nota_venta,
		cliente_nacional.nombre_cliente,
		cliente_nacional.rut
		from nota_venta
		inner join cliente_nacional on cliente_nacional.id_cliente=nota_venta.id_cliente
		where numero_nota_venta=".$numero;
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);

		$pdf->Cell(0,10,'Numero de Nota de Venta  :  '.$mensaje[0],0,1);
		$pdf->Cell(0,10,'Cliente  :  '.$mensaje[1],0,1);
		$pdf->Cell(0,10,'Rut Cliente  :  '.$mensaje[2],0,1);
	
		$sql1="select productos.nombre_producto,
		detalle_nota_venta.precio,
		detalle_nota_venta.cantidad,
		detalle_nota_venta.total	
		from detalle_nota_venta
		inner join productos on productos.id_producto=detalle_nota_venta.id_producto
		where detalle_nota_venta.numero_nota_venta=".$numero;

		$pdf->Cell(130,5,'Producto',1,0,'C');
		$pdf->Cell(17,5,'Precio',1,0,'C');
		$pdf->Cell(17,5,'Cantidad',1,0,'C');
		$pdf->Cell(17,5,'Total',1,1,'C');
	
		$resultado1=mysql_query($sql1,$conexion->link);
		while ($mensaje1=mysql_fetch_array($resultado1))
		{
				$pdf->Cell(130,5,$mensaje1[0],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[1],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[2],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[3],1,1,'C');
		}
		$modo="I";     
		$pdf->Output('Nota_Venta_'.$numero,$modo); 	 
	}
	else if ($funcion==3)
	{ 
		$numero=trim($_GET["numero"]);
		class PDF extends FPDF
		{
			function Header()
			{
				$this->SetFont('Arial','B',15);
				$this->Cell(80);
				$this->Image('../img/logo_fac.png',30);
				$this->Cell(40,10,'Factura Internacional',0,0,'C');
				$this->Ln(20);
			}
			function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
				$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
			}
		}
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);

		$sql="select factura_internacional.numero_proforma,
		cliente_internacional.nombre_cliente,
		cliente_internacional.rut
		from factura_internacional
		inner join cliente_internacional on cliente_internacional.id_cliente=factura_internacional.id_cliente
		where numero_factura=".$numero;
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);

		$pdf->Cell(0,10,'Numero Factura  :  '.$mensaje[0],0,1);
		$pdf->Cell(0,10,'Cliente  :  '.$mensaje[1],0,1);
		$pdf->Cell(0,10,'Rut Cliente  :  '.$mensaje[2],0,1);
	
		$sql1="select productos.nombre_producto,
		detalle_factura_internacional.precio,
		detalle_factura_internacional.cantidad,
		detalle_factura_internacional.total	
		from detalle_factura_internacional
		inner join productos on productos.id_producto=detalle_factura_internacional.id_producto
		where detalle_factura_internacional.numero_factura=".$numero;

		$pdf->Cell(130,5,'Producto',1,0,'C');
		$pdf->Cell(17,5,'Precio',1,0,'C');
		$pdf->Cell(17,5,'Cantidad',1,0,'C');
		$pdf->Cell(17,5,'Total',1,1,'C');
	
		$resultado1=mysql_query($sql1,$conexion->link);
		while ($mensaje1=mysql_fetch_array($resultado1))
		{
				$pdf->Cell(130,5,$mensaje1[0],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[1],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[2],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[3],1,1,'C');
		}
		$modo="I";     
		$pdf->Output('Factura_internacional_'.$numero,$modo); 	 
	}
	else if ($funcion==4)
	{ 
		$numero=trim($_GET["numero"]);
		class PDF extends FPDF
		{
			function Header()
			{
				$this->SetFont('Arial','B',15);
				$this->Cell(80);
				$this->Image('../img/logo_fac.png',30);
				$this->Cell(40,10,'Proforma',0,0,'C');
				$this->Ln(20);
			}
			function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
				$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
			}
		}
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);

		$sql="select proforma.numero_proforma,
		cliente_nacional.nombre_cliente,
		cliente_nacional.rut
		from proforma
		inner join cliente_nacional on cliente_nacional.id_cliente=proforma.id_cliente
		where numero_proforma=".$numero;
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);

		$pdf->Cell(0,10,'Proforma Numero :  '.$mensaje[0],0,1);
		$pdf->Cell(0,10,'Cliente  :  '.$mensaje[1],0,1);
		$pdf->Cell(0,10,'Rut Cliente  :  '.$mensaje[2],0,1);
	
		$sql1="select productos.nombre_producto,
		detalle_proforma.precio,
		detalle_proforma.cantidad,
		detalle_proforma.total	
		from detalle_proforma
		inner join productos on productos.id_producto=detalle_proforma.id_producto
		where detalle_proforma.numero_proforma=".$numero;

		$pdf->Cell(130,5,'Producto',1,0,'C');
		$pdf->Cell(17,5,'Precio',1,0,'C');
		$pdf->Cell(17,5,'Cantidad',1,0,'C');
		$pdf->Cell(17,5,'Total',1,1,'C');
	
		$resultado1=mysql_query($sql1,$conexion->link);
		while ($mensaje1=mysql_fetch_array($resultado1))
		{
				$pdf->Cell(130,5,$mensaje1[0],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[1],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[2],1,0,'C');
				$pdf->Cell(17,5,$mensaje1[3],1,1,'C');
		}
		$modo="I";     
		$pdf->Output('Proforma_'.$numero,$modo); 	 
	}
	else if ($funcion==5)
	{ 
		$numero=trim($_GET["numero"]);
		class PDF extends FPDF
		{
			function Header()
			{
				$this->SetFont('Arial','B',15);
				$this->Cell(80);
				$this->Image('../img/logo_fac.png',30);
				$this->Cell(40,10,'Proforma',0,0,'C');
				$this->Ln(20);
			}
			function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
				$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
			}
		}
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);

		$sql="select nota_de_credito.numero_nota_credito,
		cliente_nacional.nombre_cliente,
		cliente_nacional.rut,
		nota_de_credito.numero_factura
		from nota_de_credito
		inner join cliente_nacional on cliente_nacional.id_cliente=nota_de_credito.id_cliente
		where numero_nota_credito=".$numero;
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);

		$pdf->Cell(0,10,'Nota de Credito Numero :  '.$mensaje[0],0,1);
		$pdf->Cell(0,10,'Cliente  :  '.$mensaje[1],0,1);
		$pdf->Cell(0,10,'Rut Cliente  :  '.$mensaje[2],0,1);
	
		$sql1="select productos.nombre_producto,
		detalle_nota_credito.precio,
		detalle_nota_credito.cantidad,
		detalle_nota_credito.total	
		from detalle_nota_credito
		inner join productos on productos.id_producto=detalle_nota_credito.id_producto
		where detalle_nota_credito.factura=".$mensaje[3];

		$pdf->Cell(130,5,'Producto',1,0,'C');
		$pdf->Cell(17,5,'Precio',1,0,'C');
		$pdf->Cell(17,5,'Cantidad',1,0,'C');
		$pdf->Cell(17,5,'Total',1,1,'C');
	
		$resultado1=mysql_query($sql1,$conexion->link);
		$numero_filas1 = mysql_num_rows($resultado1);
		if ($numero_filas1<>0)
		{
			while ($mensaje1=mysql_fetch_array($resultado1))
			{
					$pdf->Cell(130,5,$mensaje1[0],1,0,'C');
					$pdf->Cell(17,5,$mensaje1[1],1,0,'C');
					$pdf->Cell(17,5,$mensaje1[2],1,0,'C');
					$pdf->Cell(17,5,$mensaje1[3],1,1,'C');
			}
					$modo="I";     
					$pdf->Output('Nota_Credito_'.$numero,$modo); 
		}
		else
		{
			$pdf->Cell(39,5,'No Registra Productos',3,1,'C');		
			$modo="I";     
			$pdf->Output('Proforma_'.$numero,$modo); 
		}
	
	}
?>

 
		
 