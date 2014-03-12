<?php

class Usuarios {
	
	
	private $usuario;
	
	function __construct(){
		
		global $USUARIO;
		
		$this->usuario = $USUARIO;
				
	}
	
	public function __get($propriedade){
		
		return $this->usuario[$propriedade];
		
	}
	
}

?>
