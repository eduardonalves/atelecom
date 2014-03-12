<?php

include_once "conexao.php";

class PassaporteDeAcesso {
	
	
	private $passaporte;
	private $conexao;
	private $quantidades = array(
							
							"disponiveis" => 0,
							"utilizados" => 0,
							"total" => 0
							
							);	
	
	function __construct(&$conexao)
	{
		
		$this->conexao =& $conexao;
		
		$this->getCountPassaportes();
		
		if ( isset($_COOKIE["vem-ckid"]) )
		{

			$this->passaporte = true;
		}else{
			
			$this->passaporte = false;
		}
	
	}
	
	function __get($atributo){
		
		if( isset($this->$atributo) )
		{
			return $this->$atributo;
		}else
		{
			return false;
		}
		
	}
	
	public function validarMaquina()
	{
		
		if( ! ($this->passaporte === true) )
		{
			
			$this->renderView();
			exit();
		}
	}
	
	private function validarCKID($ckid)
	{
		$passaporteQuery = $this->conexao->query('Select count(*) from passaportes where ckid=\'' . $ckid . '\' && disponivel=\'1\'');
		$passaporte = mysql_fetch_assoc($passaporteQuery);
		
		if($passaporte['count(*)']==1)
		{
			
			$passUpdateQuery = "UPDATE passaportes SET disponivel='0' where ckid='" . $ckid . "'";
			
			$this->conexao->query($passUpdateQuery);
			
			if(mysql_affected_rows($this->conexao->connection)==1)
			{			
				setcookie("vem-ckid", $ckid);
				header("Location: index.php");

				return true;

			}
			
			return false;
			
			

			
		}
		
	}
	
	private function getCountPassaportes()
	{
		
		$ckCount = array();

		$ckCountQuery = $this->conexao->query("Select count(*) as quantidade, disponivel from passaportes where disponivel='1'");
		$ckCount = mysql_fetch_array($ckCountQuery);
		
		$this->quantidades['disponiveis'] = $ckCount['quantidade'];
		
		$ckCountQuery = $this->conexao->query("Select count(*) as quantidade, disponivel from passaportes where disponivel='0'");
		$ckCount = mysql_fetch_array($ckCountQuery);
		
		$this->quantidades['utilizados'] = $ckCount['quantidade'];

		$this->quantidades['total'] = $this->quantidades['disponiveis'] + $this->quantidades['utilizados'];
		
		if( $this->quantidades['disponiveis'] == NULL ) { $this->quantidades['disponiveis'] = 0; }
		if( $this->quantidades['utilizados'] == NULL ) { $this->quantidades['utilizados'] = 0; }
		if( $this->quantidades['total'] == NULL ) { $this->quantidades['total'] = 0; }
		
		return $ckCount;
		
	}
	
	private function renderView()
	{

		if( isset($_POST['passaction']) )
		{
			if ( $_POST['passaction'] == 'add' )
			{
				if( ! ( $this->validarCKID($_POST['ckid']) ) )
				{
					include "lib/PassaporteDeAcesso.html/erro.php";
				}
				
			}

		
		}else{
			
			include "lib/PassaporteDeAcesso.html/index.php";
			
		}

	}
	
}

?>
