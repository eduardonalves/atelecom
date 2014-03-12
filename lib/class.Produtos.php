<?php

class Produtos extends VentoAdmin{
	
	private $produtos = array(
					
						3 => array(
								
								'nome' => 'Claro Fixo',
								'codigo' => '0003'
								)
					);

	
	private $produtoId;
	
	public function __construct($produtoId=0) {
		
		parent::__construct();
		
		$this->produtoId = (int) $produtoId;
		$this->loadProdutos();

	}
	
	private function loadProdutos() {

		$this->produtos = json_decode( json_encode($this->produtos) );

	}
	
	public function __get($propriedade) {
	
		if( property_exists($this, $propriedade) || property_exists(parent, $propriedade)  )
		{
			return $this->$propriedade;
		}

		if( $this->produtoId != 0 )
		{
			if( property_exists($this->produtos->{$this->produtoId}, $propriedade) )
			{
				return $this->produtos->{$this->produtoId}->$propriedade;
			}

		}else{
		
			trigger_error('Produto não definido. Atribua uma valor a $Produtos->produtoId para definir um produto.', E_USER_ERROR);
			
		}
		
	}
	
	public function __set($propriedade, $valor) {

		if( property_exists($this, $propriedade) )
		{

			if( gettype($this->$propriedade) == 'object' )
			{
				trigger_error("Não é possível sobreescrever o objeto " . $propriedade . ".", E_USER_WARNING);

			}else{
			
				$this->$propriedade = $valor;
			}

		}elseif( property_exists($this->produtos->{$this->produtoId}, $propriedade ) ) {
		
			trigger_error("Impossível atribuir valor. A propriedade " . $propriedade . " é somente leitura.", E_USER_WARNING);

		}else{
		
			trigger_error("Impossível atribuir valor. A propriedade " . $propriedade . " não existe.", E_USER_WARNING);
	
		}
		
	}
	
	public function getProdutos() {
	
		return $this->produtos;
		
	}

	
}

?>