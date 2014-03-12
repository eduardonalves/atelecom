<?php

class planilhaQualidade extends Qualidade
{

	protected $tipoPlanilha_asInteger;
	protected $conexao;
	protected $totalRegistros_asInteger;
	
	private $saidaTexto;
	private $novaPlanilha_asArray;
	private $relatGeral_asArray = array();	



	function __construct(&$conexao, $tipoPlanilha_asInteger=0)
	{

		
		$this->saidaTexto = new Accents( Accents::UTF_8, Accents::ISO_8859_1 );		

		if( is_int($tipoPlanilha_asInteger) && array_key_exists($tipoPlanilha_asInteger, $this->tiposStatus_asArray) )
		{
		
		$this->tipoPlanilha_asInteger = $tipoPlanilha_asInteger;
		$this->conexao =& $conexao;
		
		}else{
			
			exit($this->saidaTexto->clear("Class:Qualidade__construct error: Tipo de planilha a ser importada não informado ou inválido."));
		}
		
		
	}// fnct Construct
	
	private function mkRelatorio($query_asString)
	{
		
		
		$this->relatGeral_asArray["relatProcessos"] = array();
		$this->relatGeral_asArray["relatStatus"] = array();
		
		while($item = mysql_fetch_array($query_asString))
		{
			$this->relatGeral_asArray["relatProcessos"][$item['status_processo']] += 1;
			$this->relatGeral_asArray["relatStatus"][$item['status_qualidade']] += 1;
		}
		/*
		$this->relatGeral_asArray["relatProcessos"] = array_count_values(array_map(function($item) {
			return $item['status_processo'];
			}, $query_asString));

		$this->relatGeral_asArray["relatStatus"] = array_count_values(array_map(function($item) {
			return $item['status_qualidade'];
			}, $query_asString));
			*/
			//print_r($this->relatGeral_asArray);

	} // fnct mkRelatorio
	
	public function getEstatisticas()
	{
		return $this->relatGeral_asArray;
	}
	
	public function setPlanilha(Array $novaPlanilha_asArray)
	{
		
		$this->novaPlanilha_asArray = $novaPlanilha_asArray;
		
	}// fnct setPlanilha
 

	public function getPlanilha($statusQualidade_asInteger="", $statusProcesso_asInteger="", $dataInicio_asDateTime="", $dataFinal_asDateTime="", $sqlOrder_asString="", $sqlLimit_asString="")
	{
		
		$this->relatGeral_asArray["total_registros"] = $this->getTotalRegistros($statusQualidade_asInteger, $statusProcesso_asInteger, $dataInicio_asDateTime, $dataFinal_asDateTime, $sqlOrder_asString, $sqlLimit_asString);
		
		if ($dataInicio_asDateTime=="") { $dataInicio_asDateTime = "0000/00/00 00:00:00"; }
		if ($dataFinal_asDateTime=="") { $dataFinal_asDateTime = date("Y-m-d H:i:s"); }

		if ($statusQualidade_asInteger!="") { $query .= " && status_qualidade='" . $statusQualidade_asInteger . "'"; }
		if ($statusProcesso_asInteger!="") { $query .= " &&  status_processo='" . $statusProcesso_asInteger . "'"; }

		if($statusQualidade_asInteger=="" || $statusQualidade_asInteger=="n")
		{
		
			for($icont=0; $icont<count($this->tiposStatus_asArray); $icont++)
			{
				if($icont==0)
				{
					$query .= " && ( (MONTH(data) BETWEEN '" . substr($dataInicio_asDateTime,5,2) . "' AND '" . substr($dataFinal_asDateTime,5,2) . "' && YEAR (data) BETWEEN '".substr($dataInicio_asDateTime,0,4)."' AND '".substr($dataFinal_asDateTime,0,4)."')";
				
				}else{
					
					$query .= " || (MONTH(data_status_qualidade_$icont) BETWEEN '" . substr($dataInicio_asDateTime,5,2) . "' AND '" . substr($dataFinal_asDateTime,5,2) . "' && YEAR (data_status_qualidade_$icont) BETWEEN '".substr($dataInicio_asDateTime,0,4)."' AND '".substr($dataFinal_asDateTime,0,4)."')";
					
				}
			}
		
		}elseif($statusQualidade_asInteger=="0")
		{
		
			$query .= " && ((MONTH(data) BETWEEN '" . substr($dataInicio_asDateTime,5,2) . "' AND '" . substr($dataFinal_asDateTime,5,2) . "' && YEAR (data) BETWEEN '".substr($dataInicio_asDateTime,0,4)."' AND '".substr($dataFinal_asDateTime,0,4)."')";
		
		}else{
			
			$query .= " && ((MONTH(data_status_qualidade_$statusQualidade_asInteger) BETWEEN '" . substr($dataInicio_asDateTime,5,2) . "' AND '" . substr($dataFinal_asDateTime,5,2) . "' && YEAR (data_status_qualidade_$statusQualidade_asInteger) BETWEEN '".substr($dataInicio_asDateTime,0,4)."' AND '".substr($dataFinal_asDateTime,0,4)."')";
		}
		
		
		$query .= ")";
		
		if($sqlOrder_asString=="") { $sqlOrder_asString = "order by status_qualidade, data_status_qualidade_4, data_status_qualidade_3, data_status_qualidade_2,data_status_qualidade_1 ,data_status_qualidade_5 DESC"; }
		
		if($sqlLimit_asString=="") { $sqlLimit_asString =  " 30"; }
		
		$query .= " " . $sqlOrder_asString;
		
		$query = "Select * from vendas_clarotv vendas where novoNumero!=''" . $query;
		
		if($sqlLimit_asString!="") { $query .= " LIMIT " . $sqlLimit_asString; }

		$data = $this->conexao->query($query);
		
		
		$return = array();
		
		while($itens = mysql_fetch_array($data))
		{
			array_push($return, $itens);
		}
		
		//$this->mkRelatorio($return);
		//print_r($return);
		return $return;
		
	}// fnct getPlanilha
	

	public function getTotalRegistros($statusQualidade_asInteger="", $statusProcesso_asInteger="", $dataInicio_asDateTime="", $dataFinal_asDateTime="", $sqlOrder_asString="", $sqlLimit_asString="")
	{
		
				
		if ($dataInicio_asDateTime=="") { $dataInicio_asDateTime = "0000/00/00 00:00:00"; }
		if ($dataFinal_asDateTime=="") { $dataFinal_asDateTime = date("Y-m-d H:i:s"); }

		if ($statusQualidade_asInteger!="") { $query .= " && status_qualidade='" . $statusQualidade_asInteger . "'"; }
		if ($statusProcesso_asInteger!="") { $query .= " &&  status_processo='" . $statusProcesso_asInteger . "'"; }

		if($statusQualidade_asInteger=="" || $statusQualidade_asInteger=="n")
		{
		
			for($icont=0; $icont<count($this->tiposStatus_asArray); $icont++)
			{
				if($icont==0)
				{
					$query .= " && ( (MONTH(data) BETWEEN '" . substr($dataInicio_asDateTime,5,2) . "' AND '" . substr($dataFinal_asDateTime,5,2) . "' && YEAR (data) BETWEEN '".substr($dataInicio_asDateTime,0,4)."' AND '".substr($dataFinal_asDateTime,0,4)."')";
				
				}else{
					
					$query .= " || (MONTH(data_status_qualidade_$icont) BETWEEN '" . substr($dataInicio_asDateTime,5,2) . "' AND '" . substr($dataFinal_asDateTime,5,2) . "' && YEAR (data_status_qualidade_$icont) BETWEEN '".substr($dataInicio_asDateTime,0,4)."' AND '".substr($dataFinal_asDateTime,0,4)."')";
					
				}
			}
		
		}elseif($statusQualidade_asInteger=="0")
		{
		
			$query .= " && ((MONTH(data) BETWEEN '" . substr($dataInicio_asDateTime,5,2) . "' AND '" . substr($dataFinal_asDateTime,5,2) . "' && YEAR (data) BETWEEN '".substr($dataInicio_asDateTime,0,4)."' AND '".substr($dataFinal_asDateTime,0,4)."')";
		
		}else{
			$query .= " && ((MONTH(data_status_qualidade_$statusQualidade_asInteger) BETWEEN '" . substr($dataInicio_asDateTime,5,2) . "' AND '" . substr($dataFinal_asDateTime,5,2) . "' && YEAR (data_status_qualidade_$statusQualidade_asInteger) BETWEEN '".substr($dataInicio_asDateTime,0,4)."' AND '".substr($dataFinal_asDateTime,0,4)."')";
		}
		
		$query .= ")";
		
		if($sqlOrder_asString=="") { $sqlOrder_asString = " order by status_qualidade, data_status_qualidade_4, data_status_qualidade_3, data_status_qualidade_2,data_status_qualidade_1 ,data_status_qualidade_5 DESC"; }
		
		if($sqlLimit_asString=="") { $sqlLimit_asString = "LIMIT 1000"; }
		
		//$query .= " " . $sqlOrder_asString;
		
		$queryCont = "Select COUNT(id) from vendas_clarotv where novoNumero!=''" . $query;
		$queryCont2 = "Select * from vendas_clarotv where novoNumero!=''" . $query;
		
		$dataCont = mysql_fetch_array($this->conexao->query($queryCont));
		
		$dataCont2 = $this->conexao->query($queryCont2);
		
		$this->mkRelatorio($dataCont2);
		
		$this->totalRegistros_asInteger = $dataCont[0];
		
		return $this->totalRegistros_asInteger;
		
	}// fnct getTotalRegistros

	
}

?>
