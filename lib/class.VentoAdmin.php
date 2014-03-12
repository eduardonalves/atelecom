<?php

class VentoAdmin{

	protected $conexao;
	protected $Usuarios;
	
	public function __construct()
	{
		$this->conexao = new Connection(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$this->Usuarios = new Usuarios;

	}
	
}

?>