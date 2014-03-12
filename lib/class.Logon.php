<?php

class Logon {
	
	private $conexao;
	private $maxLogons;
	private $tempo_expiracao;
	
	
	function __construct(&$conexao)
	{
		
		$this->conexao =& $conexao;
		$this->maxLogons = 5;
		$this->tempo_expiracao = 5;
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

	function __set($atributo, $valor){
		
		if( isset($this->$atributo) )
		{
			$this->$atributo = $valor;
			return true;
		}else
		{
			return false;
		}
		
	}

	private function limparLogsAntigos()
	{

		$dataAtual = date("Y-m-d H:i:s");
		
		$this->conexao->query('DELETE from logons where data_expiracao<\'' . $dataAtual . '\'');
		
		return true;
	}
	
	public function atualizarLogon($logonId=0, $login_usuario="", $nome_usuario="")
	{
		$this->limparLogsAntigos();
		
		$dataAtual = time();
		$dataExpiracao = date("Y-m-d H:i:s", strtotime('+'. $this->tempo_expiracao .' minutes', $dataAtual));

		$this->conexao->query('UPDATE logons SET login=\'' . $login_usuario . '\', nome=\'' . $nome_usuario . '\', data_expiracao=\'' . $dataExpiracao . '\' WHERE logon_id=\'' . $logonId .'\'');
		
		$updateStatus = mysql_affected_rows($this->conexao->connection);
		
		if ( $updateStatus > 0 )
		{
			return true;
			
		}else{
			$this->efetuarLogoff($logonId);
			
			header("Location: index.php");
			exit;
			
		}

	}
	
	public function efetuarLogon($login, $nome_usuario)
	{
		$this->limparLogsAntigos();
		
		$queryLogons = $this->conexao->query('Select count(*) as countLogados from logons');
		$countLogons = mysql_fetch_assoc($queryLogons);

		$logonsDisponiveis = $this->maxLogons - $countLogons['countLogados'];
		
		if ( $logonsDisponiveis > 0 ) 
		{
			// LOGIN PERMITIDO
			
			session_start();
			
			$dataAtual = time();
			$dataExpiracao = date("Y-m-d H:i:s", strtotime('+'. ($this->tempo_expiracao+1) .' minutes', $dataAtual));
			
			$sqlquery = "INSERT INTO logons (nome, login, data_expiracao) 
			VALUES('". $nome_usuario ."', '". $login  ."', '" . $dataExpiracao . "')";
			
			$this->conexao->query($sqlquery);
			
			$logonID = mysql_insert_id ($this->conexao->connection);
			
			if ( $logonID == 0 || $logonID === false )
			{
				//ERRO AO CRIAR LOGON
				include "lib/Logon.html/erro2.php";
				
			}else{
				
				//LOGON CRIADO COM SUCESSO
				session_start();
				$_SESSION['lgnid'] = $logonID;

			}
			
			
		}else{
			
			//LOGIN NAO PERMITIDO. LIMITE MÁXIMO DE USUARIOS ATINGIDO
			include "lib/Logon.html/erro.php";
			exit;
		
		}
	}
	
	public function efetuarLogoff($logonId)
	{
		
		$this->conexao->query('DELETE from logons WHERE logon_id=\'' . $logonId .'\'');

		session_start();
		session_destroy();

	}

	
}


?>
