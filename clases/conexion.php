<?php
	class conexion{
    
		private $hostname;
		private $username;
		private $password;
		private $dbName;
		public $link;
        
		public function __construct(){

			$this->hostname="localhost";
			$this->username="root";
			$this->password="";
			$this->dbName="novafood";
        
			$this->link=mysql_connect($this->hostname,$this->username,$this->password) or DIE("No responde la base de datos");
			mysql_select_db($this->dbName,$this->link) or DIE("Tabla mala");
		}
	}   

?>