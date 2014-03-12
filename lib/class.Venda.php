<?php

class Venda extends VentoAdmin {
	
	private $Venda;

	public $Status;
	
	function __construct($vendaId=''){
		
		parent::__construct();
		
		$vendaId = (int) $vendaId;
		
		if( $vendaId != '' && is_int($vendaId) )
		{
			
			$this->loadVenda($vendaId);
			
		}else{
			
			$this->loadNovaVenda();

		}
		
		$this->Status = new VendaStatus($this);
		
	}
	
	private function loadNovaVenda()
	{
		$vendasFields = $this->conexao->query('Show columns from vendas_clarotv');

		$novaVenda = array();

		while( $field = mysql_fetch_assoc($vendasFields) )
		{
			$novaVenda[$field['Field']] = "new";
		}
		
		$this->Venda = (object) $novaVenda;
		return $this->Venda;
	}
	
	private function loadVenda($vendaId) {
	
		$sqlResult = $this->conexao->query('Select * from vendas_clarotv where id=' . $vendaId . ' limit 1');
		if( mysql_num_rows($sqlResult) > 0 )
		{
			$this->Venda = mysql_fetch_object($sqlResult);

		}else{
			
			$this->Venda = NULL;
		}
		
		return $this->Venda;
	
	}
	
	public function getVenda($vendaId) {
		
		if( $vendaId != '' && is_int($vendaId) )
		{
			
			return $this->loadVenda($vendaId);
			
		}else{
			
			trigger_error("Impossível carregar venda. Id não informado ou inválido.", E_USER_ERROR);
			return false;
		}

		
	}

	public function novaVenda(Produtos &$produto) {
		
		/* FAZER AQUI O TRATAMENTO PARA NOVAS VENDAS
   		   AINDA SERÁ IMPLEMENTADO.
		*/
		
	}

	public function __get($propriedade){
		
		if( property_exists($this, $propriedade) || property_exists(parent, $propriedade) ){
			
			return $this->$propriedade;
			
		}else{

			if( gettype($this->Venda) == 'object' )
			{
				if ( property_exists($this->Venda, $propriedade) ){
					
					return $this->Venda->$propriedade;
	
				}else{
					
					trigger_error("Propriedade não definida na venda: " . $propriedade, E_USER_ERROR);
					return false;
					
				}

			}else{
				
				return false;
			}
		

		}
		
		
	}
	

}


?>
