<?php
	require_once("capa_dato.php");

	class negocio{
    
		private $dato;
		private $resultado; 
		private $fila;
       
		public function __construct(){

			$this->dato=new capa_datos();       
		}
		public function muestra_usuarios(){

			$this->user="";
			$this->resultado=$this->dato->muestra_usuarios();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->user=$this->user."<tr>";
				$this->user=$this->user."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";
				$this->user=$this->user."<td><a href='#' onClick='$(this).envia_actualizar_usuario();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->user=$this->user."<td><a href='#' onClick='$(this).elimina_usuarios();' title='Borrar Informacion' class='icon-borrar info-user'></a></td>";		  
 				$this->user=$this->user."</tr>";                          
	       }
			return $this->user;
		}
		public function muestra_aduanas(){

			$this->aduana="";
			$this->resultado=$this->dato->muestra_aduanas();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->aduana=$this->aduana."<tr>";
				$this->aduana=$this->aduana."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";
				$this->aduana=$this->aduana."<td><a href='#' onClick='$(this).actualiza_aduana();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->aduana=$this->aduana."<td><a href='#' onClick='$(this).elimina_aduana();' title='Borrar Informacion' class='icon-borrar info-user'></a></td>";		  
 				$this->aduana=$this->aduana."</tr>";                          
	       }
			return $this->aduana;
		}
                
                //suc_aduanas
                public function muestra_suc_aduanas(){

			$this->aduana="";
			$this->resultado=$this->dato->muestra_suc_aduanas();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->aduana=$this->aduana."<tr>";
				$this->aduana=$this->aduana."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";
				//$this->aduana=$this->aduana."<td><a href='#' onClick='$(this).actualiza_aduana();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->aduana=$this->aduana."<td><a href='#' onClick='$(this).elimina_suc_aduana();' title='Borrar Informacion' class='icon-borrar info-user'></a></td>";		  
 				$this->aduana=$this->aduana."</tr>";                          
	       }
			return $this->aduana;
		}
                
		public function muestra_marcas(){
		
			$this->marca="";
			$this->resultado=$this->dato->muestra_marcas();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->marca=$this->marca."<tr>";
				$this->marca=$this->marca."<td class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->marca=$this->marca."<td><a href='#' onClick='$(this).actualiza_marca();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->marca=$this->marca."<td><a href='#' onClick='$(this).eliminar_marca();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->marca=$this->marca."</tr>";
            }
			return $this->marca;
		}
		public function muestra_cond_pago(){
		
			$this->cond="";
			$this->resultado=$this->dato->muestra_cond_pago();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->cond=$this->cond."<tr>";
				$this->cond=$this->cond."<td class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->cond=$this->cond."<td><a href='#' onClick='$(this).actualiza_cond();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->cond=$this->cond."<td><a href='#' onClick='$(this).eliminar_cond();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->cond=$this->cond."</tr>";
                        }
			return $this->cond;
		}
                /*canal cliente*/
                public function muestra_canal_cliente(){
		
			$this->cond="";
			$this->resultado=$this->dato->muestra_canal_cliente();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->cond=$this->cond."<tr>";
				$this->cond=$this->cond."<td class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";
                                $this->cond=$this->cond."<td class='width88'  style='text-align:right' id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";
				//$this->cond=$this->cond."<td><a href='#' onClick='$(this).actualiza_cond();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->cond=$this->cond."<td><a href='#' onClick='$(this).eliminar_canal();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->cond=$this->cond."</tr>";
                        }
			return $this->cond;
		}
		public function muestra_familias($opcion){

			$this->familia="";
			$this->resultado=$this->dato->muestra_familias($opcion);
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->familia=$this->familia."<tr>";
				$this->familia=$this->familia."<td  class='width10' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";
				$this->familia=$this->familia."<td class='width78' >".$this->fila[2]."</td>";
				$this->familia=$this->familia."<td class='width10'><a href='#' onClick='$(this).actualiza_familia();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				/*$this->familia=$this->familia."<td><a href='#' onClick='$(this).eliminar_familia();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";*/
			    $this->familia=$this->familia."</tr>";
			}
				return $this->familia;
		}
		 public function muestra_formatos(){
       
			$this->formatos="";
			$this->resultado=$this->dato->muestra_formatos();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->formatos=$this->formatos."<tr>";
				$this->formatos=$this->formatos."<td class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->formatos=$this->formatos."<td><a href='#'  onClick='$(this).actualiza_formato();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->formatos=$this->formatos."<td><a href='#' onClick='$(this).eliminar_formato();' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
		        $this->formatos=$this->formatos."</tr>";
            }
				return $this->formatos;
		}
		public function muestra_umed(){
        
			$this->umed="";
			$this->resultado=$this->dato->muestra_umed();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->umed=$this->umed."<tr>";
				$this->umed=$this->umed."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->umed=$this->umed."<td class='width10' ><a href='#' onClick='$(this).actualiza_umed();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->umed=$this->umed."<td><a href='#' onClick='$(this).eliminar_umed();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->umed=$this->umed."</tr>";
			}
				return $this->umed;
		}
		public function muestra_sabores(){
        
			$this->sabor="";
			$this->resultado=$this->dato->muestra_sabores();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->sabor=$this->sabor."<tr>";
				$this->sabor=$this->sabor."<td  class='width40' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->sabor=$this->sabor."<td  class='width40'>".utf8_encode($this->fila[2])."</td>";
				$this->sabor=$this->sabor."<td class='width10' ><a href='#' onClick='$(this).actualiza_sabor();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->sabor=$this->sabor."<td><a href='#' onClick='$(this).eliminar_sabor();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->sabor=$this->sabor."</tr>";
			}
				return $this->sabor;
		}	
		public function muestra_subfamilias(){
        
			$this->sub_fam="";
			$this->resultado=$this->dato->muestra_subfamilias();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->sub_fam=$this->sub_fam."<tr>";
				$this->sub_fam=$this->sub_fam."<td  class='width40' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->sub_fam=$this->sub_fam."<td  class='width40'>".utf8_encode($this->fila[2])."</td>";
				$this->sub_fam=$this->sub_fam."<td class='width10'><a href='#' onClick='$(this).actualiza_subfamilia();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->sub_fam=$this->sub_fam."<td><a href='#' onClick='$(this).eliminar_subfamilia();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->sub_fam=$this->sub_fam."</tr>";
			}
				return $this->sub_fam;
		}
		public function muestra_colores(){
        
			$this->color="";
			$this->resultado=$this->dato->muestra_colores();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->color=$this->color."<tr>";
				$this->color=$this->color."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->color=$this->color."<td class='width10' ><a href='#' onClick='$(this).actualiza_color();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->color=$this->color."<td><a href='#' onClick='$(this).eliminar_color();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->color=$this->color."</tr>";
			}
				return $this->color;
		}
		public function muestra_bancos(){
        
			$this->color="";
			$this->resultado=$this->dato->muestra_bancos();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->color=$this->color."<tr>";
				$this->color=$this->color."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->color=$this->color."<td class='width10' ><a href='#' onClick='$(this).actualiza_banco();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->color=$this->color."<td><a href='#' onClick='$(this).eliminar_banco();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->color=$this->color."</tr>";
			}
				return $this->color;
		}
		public function muestra_vendedor(){
        
			$this->vendedor="";
			$this->resultado=$this->dato->muestra_vendedor();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->vendedor=$this->vendedor."<tr>";
				$this->vendedor=$this->vendedor."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";	
					$this->vendedor=$this->vendedor."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				$this->vendedor=$this->vendedor."<td class='width10' ><a href='#' onClick='$(this).actualiza_vendedor();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->vendedor=$this->vendedor."<td><a href='#' onClick='$(this).eliminar_vendedor();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->vendedor=$this->vendedor."</tr>";
			}
				return $this->vendedor;
		}
                public function muestra_proformas_por_autorizar(){
        
			$this->prof="";
			$this->resultado=$this->dato->muestra_proformas_por_autorizar();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prof=$this->prof."<tr>";
				$this->prof=$this->prof."<td  id='".$this->fila[0]."'>".$this->fila[0]."</td>";	
				$this->prof=$this->prof."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";	
				$this->prof=$this->prof."<td class='width10' ><a href='#' onClick='$(this).imprimir_proforma_para_autorizar(".$this->fila[0].");' title='Revisar Proforma' class='icon-editar info-tooltip'></a></td>";
				//$this->vendedor=$this->vendedor."<td><a href='#' onClick='$(this).eliminar_vendedor();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prof=$this->prof."</tr>";
			}
				return $this->prof;
		}
                
                public function muestra_nv_por_autorizar1(){
        
			$this->prof="";
			$this->resultado=$this->dato->muestra_nv_por_autorizar1();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prof=$this->prof."<tr>";
				$this->prof=$this->prof."<td  id='".$this->fila[0]."'>".$this->fila[0]."</td>";	
				$this->prof=$this->prof."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";	
                                $this->prof=$this->prof."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				$this->prof=$this->prof."<td class='width10' ><a href='#' onClick='$(this).imprimir_nota_venta1(".$this->fila[3].");' title='Revisar NV' class='icon-editar info-tooltip'></a></td>";
				//$this->vendedor=$this->vendedor."<td><a href='#' onClick='$(this).eliminar_vendedor();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prof=$this->prof."</tr>";
			}
				return $this->prof;
		}
                
                public function muestra_nv_por_autorizar2(){
        
			$this->prof="";
			$this->resultado=$this->dato->muestra_nv_por_autorizar2();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prof=$this->prof."<tr>";
				$this->prof=$this->prof."<td  id='".$this->fila[0]."'>".$this->fila[0]."</td>";	
				$this->prof=$this->prof."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";	
                                $this->prof=$this->prof."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				$this->prof=$this->prof."<td class='width10' ><a href='#' onClick='$(this).imprimir_nota_venta2(".$this->fila[3].");' title='Revisar NV' class='icon-editar info-tooltip'></a></td>";
				//$this->vendedor=$this->vendedor."<td><a href='#' onClick='$(this).eliminar_vendedor();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prof=$this->prof."</tr>";
			}
				return $this->prof;
		}
                /**/
                public function muestra_Oc_por_autorizar(){
        
			$this->prof="";
			$this->resultado=$this->dato->muestra_Oc_por_autorizar();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prof=$this->prof."<tr>";
				$this->prof=$this->prof."<td  id='".$this->fila[0]."'>".$this->fila[0]."</td>";	
				$this->prof=$this->prof."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";	
                                $this->prof=$this->prof."<td class='width10' ><a href='#' onClick='$(this).imprimir_oc2(".$this->fila[0].");' title='Revisar OC' class='icon-editar info-tooltip'></a></td>";
				//$this->vendedor=$this->vendedor."<td><a href='#' onClick='$(this).eliminar_vendedor();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prof=$this->prof."</tr>";
			}
				return $this->prof;
		}
                
		public function muestra_materiales(){

			$this->material="";
			$this->resultado=$this->dato->muestra_materiales();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->material=$this->material."<tr>";
				$this->material=$this->material."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->material=$this->material."<td class='width10' ><a href='#'onClick='$(this).actualiza_material();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->material=$this->material."<td class='width10'><a href='#' onClick='$(this).eliminar_material();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->material=$this->material."</tr>";
			}
				 return $this->material;
		}
		public function muestra_tallas(){

			$this->tallas="";
			$this->resultado=$this->dato->muestra_tallas();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->tallas=$this->tallas."<tr>";
				$this->tallas=$this->tallas."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->tallas=$this->tallas."<td class='width10'><a href='#'onClick='$(this).actualiza_talla();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->tallas=$this->tallas."<td class='width10'><a href='#' onClick='$(this).eliminar_talla();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->tallas=$this->tallas."</tr>";
			}
				 return $this->tallas;
		}
		public function muestra_generos(){

			$this->genero="";
			$this->resultado=$this->dato->muestra_generos();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->genero=$this->genero."<tr>";
				$this->genero=$this->genero."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->genero=$this->genero."<td class='width10'><a href='#'onClick='$(this).actualiza_genero();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->genero=$this->genero."<td class='width10'><a href='#' onClick='$(this).eliminar_genero();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->genero=$this->genero."</tr>";
			}
				 return $this->genero;
		}
		public function muestra_productos_mantencion(){

			$this->prod_mant="";
			$this->resultado=$this->dato->muestra_productos_mantencion();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_mant=$this->prod_mant."<tr>";
				$this->prod_mant=$this->prod_mant."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->prod_mant=$this->prod_mant."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_mantencion();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->prod_mant=$this->prod_mant."<td class='width10'><a href='#' onClick='$(this).eliminar_producto();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prod_mant=$this->prod_mant."</tr>";
			}
				 return $this->prod_mant;
		}
		public function muestra_productos_oficina(){

			$this->prod_mant="";
			$this->resultado=$this->dato->muestra_productos_oficina();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_mant=$this->prod_mant."<tr>";
				$this->prod_mant=$this->prod_mant."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->prod_mant=$this->prod_mant."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->prod_mant=$this->prod_mant."<td class='width10'><a href='#' onClick='$(this).eliminar_producto();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prod_mant=$this->prod_mant."</tr>";
			}
				 return $this->prod_mant;
		}
		public function muestra_productos_pop(){

			$this->prod_pop="";
			$this->resultado=$this->dato->muestra_productos_pop();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_pop=$this->prod_pop."<tr>";
				$this->prod_pop=$this->prod_pop."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->prod_pop=$this->prod_pop."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				/*$this->prod_pop=$this->prod_pop."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";*/
				$this->prod_pop=$this->prod_pop."<td class='width10'><a href='#' onClick='$(this).eliminar_producto();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prod_pop=$this->prod_pop."</tr>";
			}
				 return $this->prod_pop;
		}
		public function muestra_productos_externo(){

			$this->prod_ex="";
			$this->resultado=$this->dato->muestra_productos_externo();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_ex=$this->prod_ex."<tr>";
				$this->prod_ex=$this->prod_ex."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->prod_ex=$this->prod_ex."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				/*$this->prod_ex=$this->prod_ex."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";*/
				$this->prod_ex=$this->prod_ex."<td class='width10'><a href='#' onClick='$(this).eliminar_producto();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prod_ex=$this->prod_ex."</tr>";
			}
				 return $this->prod_ex;
		}
		public function muestra_productos_terminados(){

			$this->prod_ter="";
			$this->resultado=$this->dato->muestra_productos_terminados();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_ter=$this->prod_ter."<tr>";
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				/*$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";*/
				$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#' onClick='$(this).eliminar_producto();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prod_ter=$this->prod_ter."</tr>";
			}
				 return $this->prod_ter;
		}
                
                public function muestra_formulas_por_Autorizar(){

			$this->prod_ter="";
			$this->resultado=$this->dato->muestra_formulas_por_Autorizar();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_ter=$this->prod_ter."<tr>";
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				/*$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";*/
				$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#' onClick='$(this).Revisa_formula_por_autorizar();' id='borra_col' title='Ver Formula' class='icon-ver info-tooltip'></a></td>";
				$this->prod_ter=$this->prod_ter."</tr>";
			}
				 return $this->prod_ter;
		}
                
                public function muestra_formulas_Industrial(){

			$this->prod_ter="";
			$this->resultado=$this->dato->muestra_formulas_Industrial();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_ter=$this->prod_ter."<tr>";
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				/*$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";*/
				$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#' onClick='$(this).Revisa_formula_industrial();' id='borra_col' title='Ver Formula' class='icon-ver info-tooltip'></a></td>";
				$this->prod_ter=$this->prod_ter."</tr>";
			}
				 return $this->prod_ter;
		}
		public function muestra_materia_prima(){

			$this->prod_ter="";
			$this->resultado=$this->dato->muestra_materia_prima();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_ter=$this->prod_ter."<tr>";
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				/*$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";*/
				$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#' onClick='$(this).eliminar_producto();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prod_ter=$this->prod_ter."</tr>";
			}
				 return $this->prod_ter;
		}
                public function muestra_insumo(){

			$this->prod_ter="";
			$this->resultado=$this->dato->muestra_insumo();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_ter=$this->prod_ter."<tr>";
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				/*$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";*/
				$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#' onClick='$(this).eliminar_producto();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prod_ter=$this->prod_ter."</tr>";
			}
				 return $this->prod_ter;
		}
		public function muestra_premix(){

			$this->prod_ter="";
			$this->resultado=$this->dato->muestra_premix();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prod_ter=$this->prod_ter."<tr>";
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		
				$this->prod_ter=$this->prod_ter."<td id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";	
				/*$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#'onClick='$(this).actualiza_productos_oficina();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";*/
				$this->prod_ter=$this->prod_ter."<td class='width10'><a href='#' onClick='$(this).eliminar_producto();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prod_ter=$this->prod_ter."</tr>";
			}
				 return $this->prod_ter;
		}
		public function muestra_cliente_int()	{
      
			$this->cliente_int="";
			$this->resultado=$this->dato->muestra_cliente_int();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->cliente_int=$this->cliente_int."<tr>";
				$this->cliente_int=$this->cliente_int."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";
				$this->cliente_int=$this->cliente_int."<td class='width10' ><a href='#'  onClick='$(this).actualiza_cliente_inter(".$this->fila[0].");' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
                                //$this->cliente_int=$this->cliente_int."<td class='width10' ><a href='#'  onClick='$(this).actualiza_cliente_int(".$this->fila[0].");' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->cliente_int=$this->cliente_int."<td class='width88' ><a href='#' onClick='$(this).borra_cliente_int(".$this->fila[0].");' id='borra_col' title='Borrar Cliente' class='icon-borrar info-tooltip'></a></td>";
		        $this->cliente_int=$this->cliente_int."</tr>";
			}
				return $this->cliente_int;
		}
		public function muestra_cliente_nac(){
      
			$this->cliente_nac="";
			$this->resultado=$this->dato->muestra_cliente_nac();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->cliente_nac=$this->cliente_nac."<tr>";
				$this->cliente_nac=$this->cliente_nac."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";
				$this->cliente_nac=$this->cliente_nac."<td class='width10'><a href='#' onClick='$(this).actualiza_cliente_nac();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->cliente_nac=$this->cliente_nac."<td class='width88'><a href='#' onClick='$(this).borra_cliente_nac(".$this->fila[0].");' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
		        $this->cliente_nac=$this->cliente_nac."</tr>";
			}
				return $this->cliente_nac;
		}
                //Proveedor Nacional
                public function muestra_prov_nac(){
      
			$this->prov_nac="";
			$this->resultado=$this->dato->muestra_prov_nac();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prov_nac=$this->prov_nac."<tr>";
				$this->prov_nac=$this->prov_nac."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";
				$this->prov_nac=$this->prov_nac."<td class='width10'><a href='#' onClick='$(this).actualiza_proveedor();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->prov_nac=$this->prov_nac."<td class='width88'><a href='#' onClick='$(this).borra_proveedor(".$this->fila[0].");' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
		        $this->prov_nac=$this->prov_nac."</tr>";
			}
				return $this->prov_nac;
		}
                //Proveedor InterNacional
                public function muestra_prov_int(){
      
			$this->prov_nac="";
			$this->resultado=$this->dato->muestra_prov_int();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prov_nac=$this->prov_nac."<tr>";
				$this->prov_nac=$this->prov_nac."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[2])."</td>";
				$this->prov_nac=$this->prov_nac."<td class='width10'><a href='#' onClick='$(this).actualiza_proveedor_inertnacional();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->prov_nac=$this->prov_nac."<td class='width88'><a href='#' onClick='$(this).borra_proveedor(".$this->fila[0].");' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
		        $this->prov_nac=$this->prov_nac."</tr>";
			}
				return $this->prov_nac;
		}
		public function muestra_giros(){
        
			$this->giro="";
			$this->resultado=$this->dato->muestra_giros();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->giro=$this->giro."<tr>";
				$this->giro=$this->giro."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->giro=$this->giro."<td class='width10' ><a href='#' onClick='$(this).actualiza_giro();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->giro=$this->giro."<td><a href='#' onClick='$(this).eliminar_giro();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->giro=$this->giro."</tr>";
			}
				return $this->giro;
		}
		public function muestra_cargos(){
        
			$this->cargo="";
			$this->resultado=$this->dato->muestra_cargos();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->cargo=$this->cargo."<tr>";
				$this->cargo=$this->cargo."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->cargo=$this->cargo."<td class='width10' ><a href='#' onClick='$(this).actualiza_cargo();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->cargo=$this->cargo."<td><a href='#' onClick='$(this).eliminar_cargo();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->cargo=$this->cargo."</tr>";
			}
				return $this->cargo;
		}
		public function muestra_idioma(){
        
			$this->idioma="";
			$this->resultado=$this->dato->muestra_idioma();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->idioma=$this->idioma."<tr>";
				$this->idioma=$this->idioma."<td  class='width88' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->idioma=$this->idioma."<td class='width10' ><a href='#' onClick='$(this).actualiza_idioma();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->idioma=$this->idioma."<td><a href='#' onClick='$(this).eliminar_idioma();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->idioma=$this->idioma."</tr>";
			}
				return $this->idioma;
		}
		public function muestra_proveedor_nacional(){
        
			$this->prov="";
			$this->resultado=$this->dato->muestra_proveedor_nacional();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prov=$this->prov."<tr>";
				$this->prov=$this->prov."<td  class='width38' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
					$this->prov=$this->prov."<td  class='width88' >".utf8_encode($this->fila[2])."</td>";
				$this->prov=$this->prov."<td class='width10' ><a href='#' onClick='$(this).actualiza_proveedor_nacional();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->prov=$this->prov."<td><a href='#' onClick='$(this).eliminar_prov_nac();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prov=$this->prov."</tr>";
			}
				return $this->prov;
		}
		public function muestra_proveedor_internacional(){
        
			$this->prov="";
			$this->resultado=$this->dato->muestra_proveedor_internacional();
			while ($this->fila=mysql_fetch_array($this->resultado))
			{
				$this->prov=$this->prov."<tr>";
				$this->prov=$this->prov."<td  class='width38' id='".$this->fila[0]."'>".utf8_encode($this->fila[1])."</td>";		  
				$this->prov=$this->prov."<td class='width10' ><a href='#' onClick='$(this).actualiza_proveedor_inertnacional();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
				$this->prov=$this->prov."<td><a href='#' onClick='$(this).eliminar_proveedor_int();' id='borra_col' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
				$this->prov=$this->prov."</tr>";
			}
				return $this->prov;
		}
		

  }
?>