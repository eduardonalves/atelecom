<?php
date_default_timezone_set("Brazil/East");

class controleEstoque {
	
	private $conexao;
	
	function __construct(&$conexao)
	{
		$this->conexao =& $conexao;
	}
	
	public function getEntradas()
	{
		
	}
	
	public function getSaidas($order="", $id="", $estoquista="", $parceiro="", $dataInicio="0000-00-00 00:00:00", $dataFinal="")
	{

		$query = "Select saidas.id_saida, saidas.id_estoquista, saidas.id_parceiro, saidas.data,
				parceiros.id, parceiros.nome as parceiro, parceiros.login as parceiro_login,
				estoquistas.id, estoquistas.nome as estoquista, estoquistas.login as estoquista_login
				FROM saidas
				INNER JOIN usuarios parceiros ON (parceiros.id=saidas.id_parceiro)
				INNER JOIN usuarios estoquistas ON (estoquistas.id=saidas.id_estoquista)
				WHERE 1=1";
		
		if ($id != "")
		{
			$query .= " && id_saida = " . $id;
		}

		if ($estoquista != "")
		{
			$query .= " && id_estoquista = " . $estoquista;
		}

		if ($parceiro != "")
		{
			$query .= " && id_parceiro = " . $parceiro;
		}

		if ($dataFinal == "")
		{
			$dataFinal = date("Y-m-d H:i:s");
		}
		
		$query .= " && (data BETWEEN '" . $dataInicio . "' AND '" . $dataFinal . "')";
		
		if ( $order != "" )
		{
			$query.= " order by " . $order;
		}

		$sql_result = $this->conexao->query($query);
		
		$return = array();
		
		while ($linha = mysql_fetch_array($sql_result))
		{
			array_push($return, $linha);
		}
		
		return $return;
		
	}

	public function getItensDeEntrada()
	{
		
	}


	public function getItensDeSaida($id_saida, $id_aparelho="", $order="", $group="")
	{
		$query = "Select itens.id_itenssaida, itens.id_saida as id_saida_relacionado, itens.id_aparelho, itens.qtde,
				aparelhos.id_aparelho, aparelhos.marca, aparelhos.modelo, aparelhos.estoque,
				sum(itens.qtde) as quantidade_aparelhos
				FROM  itenssaida itens
				INNER JOIN aparelhos ON (aparelhos.id_aparelho=itens.id_aparelho)
				WHERE itens.id_saida=" . $id_saida;
		
		$query = "Select itens.id_itenssaida, itens.id_saida as id_saida_relacionado, itens.id_aparelho, itens.qtde,
				aparelhos.id_aparelho, aparelhos.marca, aparelhos.modelo, aparelhos.estoque
				
				FROM  itenssaida itens
				INNER JOIN aparelhos ON (aparelhos.id_aparelho=itens.id_aparelho)
				WHERE itens.id_saida=" . $id_saida;
		
		if ($id_aparelho != "")
		{
			$query .= " && itens.id_aparelho = " . $id_aparelho;
		}

		if ( $group != "" )
		{
			//$query.= " group by " . $group;
		}


		if ( $order != "" )
		{
			$query.= " order by " . $order;
		}

		$sql_result = $this->conexao->query($query);
		
		$return = array();
		
		while ($linha = mysql_fetch_array($sql_result))
		{
			array_push($return, $linha);
		}
		//print_r($return);
		return $return;

	}

	
	public function getParceirosComSaidas($dataInicio="0000-00-00 00:00:00", $dataFinal="", $supervisor="")
	{

		if ($dataFinal == "")
		{
			$dataFinal = date("Y-m-d H:i:s");
		}
		

		$query = "Select DISTINCT saidas.id_parceiro, parceiros.id, parceiros.nome, parceiros.login
				From saidas";
				
				if($supervisor!="")
				{
					$query .= " INNER JOIN usuarios parceiros ON (parceiros.id=saidas.id_parceiro && parceiros.supervisor=$supervisor && status='ATIVO')";
				
				}else{
					
					$query .= " INNER JOIN usuarios parceiros ON (parceiros.id=saidas.id_parceiro && status='ATIVO')";
				}
				
				$query .= " WHERE saidas.data BETWEEN '$dataInicio' AND '$dataFinal' 
				order by parceiros.nome";

		$sql_result = $this->conexao->query($query);
		
		$return = array();
		
		while ($linha = mysql_fetch_array($sql_result))
		{
			array_push($return, $linha);
		}
		
		return $return;
		
	}
	
	public function getUsuario($id)
	{
		$query = "Select * from usuarios where id=$id LIMIT 1";

		$sql_result = $this->conexao->query($query);
		
		$return = mysql_fetch_array($sql_result);
		
		return $return;

	}
	
	public function getQuantTotalParceiro($id_parceiro, $id_saida="", $dataInicio="0000-00-00 00:00:00", $dataFinal="")
	{

		if ($dataFinal == "")
		{
			$dataFinal = date("Y-m-d H:i:s");
		}
		

		$query = "Select saidas.id_parceiro, saidas.data, saidas.id_saida,
				itens.id_itenssaida, itens.id_saida, itens.id_aparelho, itens.qtde,
				sum(itens.qtde) as quantidade_total
				From saidas
				INNER JOIN itenssaida itens ON (itens.id_saida=saidas.id_saida)
				
				WHERE saidas.id_parceiro = $id_parceiro && (saidas.data BETWEEN '$dataInicio' AND '$dataFinal')";

		$sql_result = $this->conexao->query($query);
		
		if($id_saida!="")
		{
			$query .= "&& saidas.id_saida=" . $id_saida;
		}
		
		$return = array();
		
		while ($linha = mysql_fetch_array($sql_result))
		{
			array_push($return, $linha);
		}
		
		return $return;
			

	}

	public function getQuantTotalParceiroVendidos($id_parceiro="", $dataInicio="0000-00-00 00:00:00", $dataFinal="")
	{
		if ($dataFinal == "")
		{
			$dataFinal = date("Y-m-d H:i:s");
		}
		
		$query = "Select saidas.id_parceiro, saidas.data, saidas.id_saida,
				itens.id_itenssaida, itens.id_saida, itens.id_aparelho, itens.qtde
				
				From saidas
				INNER JOIN itenssaida itens ON (itens.id_saida=saidas.id_saida)
				
				WHERE saidas.id_parceiro!=0 && saidas.data BETWEEN '$dataInicio' AND '$dataFinal'";
		
		if($id_parceiro!="")
		{
			$query .= " &&  saidas.id_parceiro = $id_parceiro";
		}

		$sql_result = $this->conexao->query($query);
		
		$return = array();
		$quantidade = 0;
		
		while ($linha = mysql_fetch_array($sql_result))
		{
			$query = "Select count(esn.status) as qt from ESNsSaida AS esn
			WHERE esn.id_saida=". $linha["id_itenssaida"] . " && status='Vendido'";
			
			$sql_result2 = $this->conexao->query($query);
			
			$qt = mysql_fetch_array($sql_result2);
			
			$quantidade += $qt[0];
						
		}
		
		return $quantidade;
			

	}

	public function getQuantTotalParceiroEstoque($id_parceiro="", $dataInicio="0000-00-00 00:00:00", $dataFinal="")
	{
		if ($dataFinal == "")
		{
			$dataFinal = date("Y-m-d H:i:s");
		}
		
		$query = "Select saidas.id_parceiro, saidas.data, saidas.id_saida,
				itens.id_itenssaida, itens.id_saida, itens.id_aparelho, itens.qtde
				From saidas
				INNER JOIN itenssaida itens ON (itens.id_saida=saidas.id_saida)
				WHERE saidas.id_parceiro!=0 && saidas.data BETWEEN '$dataInicio' AND '$dataFinal'
				";

		if($id_parceiro!="")
		{
			$query .= " &&  saidas.id_parceiro = $id_parceiro";
		}
		
		$sql_result = $this->conexao->query($query);
		
		$return = array();
		$quantidade = 0;
		
		while ($linha = mysql_fetch_array($sql_result))
		{
			$query = "Select count(esn.status) as qt from ESNsSaida AS esn
			WHERE esn.id_saida=". $linha["id_itenssaida"] . " && status='Em Estoque'";
			
			$sql_result2 = $this->conexao->query($query);
			
			$qt = mysql_fetch_array($sql_result2);
			
			$quantidade += $qt[0];
						
		}
		
		return $quantidade;
			

	}

	public function getQuantTotalParceiroDevolvido($id_parceiro="", $dataInicio="0000-00-00 00:00:00", $dataFinal="")
	{
		if ($dataFinal == "")
		{
			$dataFinal = date("Y-m-d H:i:s");
		}
		
		$query = "Select saidas.id_parceiro, saidas.data, saidas.id_saida,
				itens.id_itenssaida, itens.id_saida, itens.id_aparelho, itens.qtde
				From saidas
				INNER JOIN itenssaida itens ON (itens.id_saida=saidas.id_saida)
				WHERE saidas.id_parceiro!=0 && saidas.data BETWEEN '$dataInicio' AND '$dataFinal'
				";

		if($id_parceiro!="")
		{
			$query .= " &&  saidas.id_parceiro = $id_parceiro";
		}
		
		$sql_result = $this->conexao->query($query);
		
		$return = array();
		$quantidade = 0;
		
		while ($linha = mysql_fetch_array($sql_result))
		{
			$query = "Select count(esn.status) as qt from ESNsSaida AS esn
			WHERE esn.id_saida=". $linha["id_itenssaida"] . " && status='Devolvido'";
			
			$sql_result2 = $this->conexao->query($query);
			
			$qt = mysql_fetch_array($sql_result2);
			
			$quantidade += $qt[0];
						
		}
		
		return $quantidade;
			

	}


	public function getAparelhos()
	{
		$query = "Select * from aparelhos";
		
		$return = array();
		$rAparelhos = $this->conexao->query($query);
		while($aparelho = mysql_fetch_array( $rAparelhos))
		{
			
			array_push($return, $aparelho);
			
		}
		
		return $return;
	}	

	public function getAparelho($id)
	{
		$id = (int) $id;
		if (is_int($id))
		{
		$query = "Select * from aparelhos where id_aparelho=$id LIMIT 1";
		
		$aparelho = mysql_fetch_array($this->conexao->query($query));
		
		return $aparelho;
		}else{
			return false;
		}
	}
	
	public function getModelosAparelhosEstoque($id_parceiro, $dataInicio="0000-00-00 00:00:00", $dataFinal="")
	{
		if ($dataFinal == "")
		{
			$dataFinal = date("Y-m-d H:i:s",  strtotime("+1 days"));
		}
		
		$query = "Select saidas.id_parceiro, saidas.data, saidas.id_saida, 
				aparelhos.id_aparelho, aparelhos.marca, aparelhos.modelo,
				itens.id_itenssaida, itens.id_saida, itens.id_aparelho, itens.qtde,
				esn.id_saida, esn.esn, esn.status
				From saidas
				INNER JOIN itenssaida itens ON (itens.id_saida=saidas.id_saida)
				INNER JOIN ESNsSaida esn ON (esn.id_saida=itens.id_itenssaida && esn.status='Em Estoque')
				INNER JOIN aparelhos ON (itens.id_aparelho=aparelhos.id_aparelho)
				WHERE saidas.id_parceiro!=0 && saidas.data BETWEEN '$dataInicio' AND '$dataFinal'
				";

		if($id_parceiro!="")
		{
			$query .= " &&  saidas.id_parceiro = $id_parceiro";
		}
		
		$sql_result = $this->conexao->query($query);
		
		$return = array();
		$quantidade = 0;
		
		while ($linha = mysql_fetch_array($sql_result))
		{
			
			
			if (! in_array($linha["marca"] . " - " . $linha["modelo"], $return) )
			{
				
				$return[$linha["id_aparelho"]] = $linha["marca"] . " - " . $linha["modelo"];
			
			}
			
		}
		
		return $return;
		
	}

	public function getESNsDeEntrada()
	{
		
	}


	public function getESNsDeSaida($filtroEsns=array())
	{
		
		$query = "Select esn.*, itens.*, saidas.*, estoquista.*, parceiro.*, aparelhos.*,
				parceiro.nome as parceiro, estoquista.nome as estoquista
				FROM ESNsSaida esn
				INNER JOIN itenssaida itens ON (esn.id_saida=itens.id_itenssaida)
				INNER JOIN aparelhos ON (itens.id_aparelho=aparelhos.id_aparelho)
				INNER JOIN saidas ON (itens.id_saida=saidas.id_saida)
				INNER JOIN usuarios parceiro ON (parceiro.id=saidas.id_parceiro)
				INNER JOIN usuarios estoquista ON (estoquista.id=saidas.id_estoquista)
				WHERE esn.esn!=''";
		
		foreach($filtroEsns as $k=>$esn)
		{
			if ($k==0) { 
				
				$query .= " && ("; 
				$query .= " esn.esn='".$esn."'";
				
				}else{
				
				$query .= " || esn.esn='".$esn."'";
				
				}
			
			
		}

		$query .= ")";
		$esns = $this->conexao->query($query);
		
		return $esns;
		
	}



}

?>
