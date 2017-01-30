<?php
	require_once("conexion.php");
	
	class capa_datos{
    
		private $sql;
		public $resultado;
		private $link;
		private $fila;
    
		public function __construct(){
        
			$conexion = new conexion();      
			$this->link=$conexion->link;        
		}
		public function muestra_usuarios(){
       
			$this->sql="select * from usuarios order by usuario asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_aduanas(){
       
			$this->sql="select * from aduanas  where habilitado='s' order by nombre_aduana asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                public function muestra_suc_aduanas(){
       
			$this->sql="select * from suc_aduanas   order by direccion asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                public function muestra_cond_pago(){
        
			$this->sql="select * from condiciones_pago where habilitado='s' order by Condicion asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                /*cANAL cLIENTE*/
                public function muestra_canal_cliente(){
        
			$this->sql="select * from canales where habilitado='s' order by canal asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                
		public function muestra_marcas(){
        
			$this->sql="select * from marcas where habilitado='s' order by marca asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		} 
		public function muestra_formatos(){
			
			$this->sql="select * from formatos  where habilitado='s' order by formato asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		} 
		public function muestra_umed(){
        
			$this->sql="select * from umed where habilitado='s' order by umed asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_vendedor(){
        
			$this->sql="select * from vendedores where habilitado='s' order by vendedor asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                public function muestra_proformas_por_autorizar(){
        
			$this->sql="select proforma.numero_proforma,cliente.nombre from proforma inner join cliente on proforma.id_cliente=cliente.id_cliente
                                 where 	status='1' order by proforma.numero_proforma asc";
                        //$this->sql="select * from vendedores where habilitado='s' order by vendedor asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                
                public function muestra_nv_por_autorizar1(){
        
			$this->sql="select nota_venta.numero_nota_venta,cliente.nombre,centro_venta.centro_venta,nota_venta.numero from nota_venta
                            inner join cliente on nota_venta.id_cliente=cliente.id_cliente
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                                 where 	nota_venta.estado='0' order by nota_venta.numero_nota_venta asc";
                        /*$this->sql="select proforma.numero_proforma,cliente.nombre from proforma inner join cliente on proforma.id_cliente=cliente.id_cliente
                                 where 	status='1' order by proforma.numero_proforma asc";*/
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                public function muestra_nv_por_autorizar2(){
        
			$this->sql="select nota_venta.numero_nota_venta,cliente.nombre,centro_venta.centro_venta,nota_venta.numero from nota_venta
                            inner join cliente on nota_venta.id_cliente=cliente.id_cliente
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                                 where 	nota_venta.estado='1' order by nota_venta.numero_nota_venta asc";
                        /*$this->sql="select proforma.numero_proforma,cliente.nombre from proforma inner join cliente on proforma.id_cliente=cliente.id_cliente
                                 where 	status='1' order by proforma.numero_proforma asc";*/
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                
                public function muestra_Oc_por_autorizar(){
        
			$this->sql="select orden_compra.numero_orden_compra,proveedor.nombre from orden_compra
                            inner join proveedor on orden_compra.id_proveedor=proveedor.id_proveedor
                                 where 	orden_compra.estado='0' order by orden_compra.numero_orden_compra asc";
                        /*$this->sql="select proforma.numero_proforma,cliente.nombre from proforma inner join cliente on proforma.id_cliente=cliente.id_cliente
                                 where 	status='1' order by proforma.numero_proforma asc";*/
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_sabores(){
        
			$this->sql="select * from sabores  where habilitado='s'  order by sabor_espanol asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}		
		public function muestra_subfamilias(){
        
			$this->sql="select sub_familias.id_subfamilia,familias.familia,sub_familias.sub_familia from sub_familias inner join familias on familias.id_familia=sub_familias.id_familia where sub_familias.habilitado='s' order by familias.familia asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_colores(){
        
			$this->sql="select * from colores where habilitado='s' order by color asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_bancos(){
        
			$this->sql="select * from bancos where habilitado='s' order by banco asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_materiales(){
        
			$this->sql="select * from materiales where habilitado='s' order by material asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_tallas(){
        
			$this->sql="select * from tallas where habilitado='s' order by talla asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_generos(){
        
			$this->sql="select * from Generos where habilitado='s' order by genero asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_productos_mantencion(){
        
			$this->sql="select id_producto,nombre_producto from productos where id_sector_producto=1 and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_productos_oficina(){
        
			$this->sql="select id_producto,nombre_producto from productos where id_sector_producto=2 and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_productos_pop(){
        
			$this->sql="select id_producto,codigo_producto,nombre_producto from productos where id_sector_producto=3  and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_productos_externo(){
        
			$this->sql="select id_producto,codigo_producto,nombre_producto from productos where id_sector_producto=5   and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_productos_terminados(){
        
			$this->sql="select id_producto,codigo_producto,nombre_producto from productos where id_sector_producto=4   and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
                public function muestra_formulas_por_Autorizar(){
        
			$this->sql="select productos.id_producto,formulas.version,productos.nombre_producto from productos 
                                 inner join formulas on productos.id_producto=formulas.id_producto_padre
                                 where formulas.status=1 group by formulas.id_producto_padre order by productos.nombre_producto asc";
                        //$this->sql="select id_producto,codigo_producto,nombre_producto from productos where id_sector_producto=4   and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
                public function muestra_formulas_Industrial(){
        
			$this->sql="select productos.id_producto,formulas.version,productos.nombre_producto from productos 
                                 inner join formulas on productos.id_producto=formulas.id_producto_padre
                                 where formulas.status=2 group by formulas.id_producto_padre order by productos.nombre_producto asc";
                        //$this->sql="select id_producto,codigo_producto,nombre_producto from productos where id_sector_producto=4   and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_materia_prima(){
        
			$this->sql="select id_producto,codigo_producto,nombre_producto from productos where id_sector_producto=7   and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
                public function muestra_insumo(){
        
			$this->sql="select id_producto,codigo_producto,nombre_producto from productos where id_sector_producto=8   and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
		public function muestra_premix(){
        
			$this->sql="select id_producto,codigo_producto,nombre_producto from productos where id_sector_producto=6  and habilitado='s' order by nombre_producto asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
	 	public function muestra_cliente_int(){
        
			$this->sql="select * from cliente  where tipo_cliente=1 order by nombre asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		/*
		public function muestra_cliente_int(){
        
			$this->sql="select * from cliente_internacional  where habilitado='s' order by nombre_cliente asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                public function muestra_cliente_nac(){
        
			$this->sql="select * from cliente_nacional  where habilitado='s' order by nombre_cliente asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		*/
		public function muestra_cliente_nac(){
        
			$this->sql="select * from cliente  where tipo_cliente=2 order by nombre asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                //Proveedor Nacional
                public function muestra_prov_nac(){
        
			$this->sql="select * from proveedor  where tipo=2 and habilitado='S' order by nombre asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
                //Proveedor InterNacional
                public function muestra_prov_int(){
        
			$this->sql="select * from proveedor  where tipo=1 and habilitado='S' order by nombre asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_giros(){
        
			$this->sql="select * from giros where habilitado='s' order by giro asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_cargos(){
        
			$this->sql="select * from cargos where habilitado='s' order by cargo asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_idioma(){
        
			$this->sql="select * from idiomas where habilitado='s' order by idioma asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_proveedor_nacional(){
        
			$this->sql="select id_proveedor,rut_proveedor,nombre_proveedor from proveedores_nacionales where habilitado='s' order by nombre_proveedor asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_proveedor_internacional(){
        
			$this->sql="select id_proveedor,nombre_proveedor from proveedores_internacionales where habilitado='s' order by nombre_proveedor asc";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;
		}
		public function muestra_ordenes_de_compra(){
        
			$this->sql="SELECT
					numero_orden_compra,
					DATE_FORMAT(fecha_orden_compra, '%d/%m/%y') as fecha
					FROM  orden_compra 
					WHERE id_estado_orden_compra='2'";
			$this->resultado=mysql_query($this->sql,$this->link);
			return $this->resultado;                
		}
}		  
?>