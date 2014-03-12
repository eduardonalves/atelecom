<?php

class Qualidade {

	protected $tiposStatus_asArray = array (

									0=>"N.A.",
									1=>"INTENÇÃO",
									2=>"VENDA CONFIRMADA",
									3=>"ATIVAÇÃO",
									4=>"COMISSIONAMENTO",
									5=>"ESTORNO"

									);

	protected $tiposStatus2_asArray = array (

									0=>"N.A.",
									1=>"INTENÇÕES",
									2=>"VENDAS CONFIRMADAS",
									3=>"ATIVAÇÕES",
									4=>"COMISSÕES",
									5=>"ESTORNOS"

									);
	
	protected $tiposStatusCampos = array(
									
									1=> array("G"=>"data_status_qualidade_1", "N"=>"novoNumero"),
									2=> array("G"=>"data_status_qualidade_2", "N"=>"novoNumero"),
									3=> array("G"=>"data_status_qualidade_3", "N"=>"novoNumero", "O"=>"status_processo"),
									4=> array("B"=>"data_status_qualidade_4", "J"=>"novoNumero"),
									5=> array("C"=>"data_status_qualidade_5", "K"=>"novoNumero")
									);
									
	protected $statusProcesso_asArray =  array (
									
									1=>"N.A.",
									2=>"XEROX OK"
									
									);
	
	
	// ############ FUNÇÕES PÚBLICAS ############
	
	public function teste()
	{
		echo "a";
	}
	
	public function getTiposPlanilhas($id_asInt="nao", $tp=1)
	{
		if($id_asInt=="nao")
		{
			if($tp==1)
			{

				return $this->tiposStatus_asArray;

			}else{

				return $this->tiposStatus2_asArray;

			}
		
		}else{

			if($tp==1)
			{

				return $this->tiposStatus_asArray[$id_asInt];

			}else{

				return $this->tiposStatus2_asArray[$id_asInt];

			}
			
		}
	}
	
	public function getCamposPlanilha($id_asInt="nao")
	{

		if($id_asInt=="nao")
		{
		return $this->tiposStatusCampos;
		
		}else{
		
		return $this->tiposStatusCampos[$id_asInt];
			
		}

	}

	public function getTiposProcessos($id_asInt="nao")
	{
		if($id_asInt=="nao" && isset($id_asInt))
		{
		return $this->statusProcesso_asArray;
		
		}else{
		
		return $this->statusProcesso_asArray[$id_asInt];
			
		}
	}
	

	// ############ FUNÇÕES PROTEGIDAS ############

	protected function listAnosDatasGravadas()
	{
		foreach($this->tiposStatus_asArray as $key=>$value)
		{
			if($key==0)
			{
				$campos = "data";
			}
			$campos = "";
		}

	}
	
	
	public function atualizaNumero($data_asArray)
	{
		$numero = $data_asArray["numero"];
		$status_qualidade = $data_asArray["tipo_planilha"];
		$data = substr($data_asArray["data-status"], 0, 10);
		
		$query = "Select * from vendas_clarotv WHERE novoNumero='$numero'";
		
		$consult = $this->conexao->query($query);
		
		if (mysql_num_rows($consult)<=0) { return 0; }
		
		while($linha = mysql_fetch_array($consult))
		{
			
			$returnVal = 1;

			$upQuery = "UPDATE vendas_clarotv SET novoNumero='$numero'";
			
			if($linha["status_qualidade"]<$status_qualidade)
			{
				$upQuery .= ", status_qualidade='$status_qualidade'"; 
				$returnVal = 0;
			}

			if($linha["data_status_qualidade_$status_qualidade"]!=$data)
			{
				$upQuery .= ", data_status_qualidade_$status_qualidade='$data'"; 
				//return $linha["id"]." : ". $upQuery;
				//echo $data;
				$returnVal = 0;
			}


			if(isset($data_asArray["status-processo"]) && $linha["status_processo"]!=$data_asArray["status-processo"])
			{
				$query .= ", status_processo=" . $data_asArray["status-processo"];
				$returnVal = 0;
			}
			
			$upQuery .= " WHERE id='".$linha["id"]."'";
			
			if($returnVal==0){
			$this->conexao->query($upQuery);
			$returnVal = mysql_affected_rows();
			}
		}
		
		//echo $upQuery;
		

		
		return $returnVal;
		
	}// fnct atualizarBD()


	protected function getUpdateLog()
	{
		
	}// fnct getUpdateLog()



	// ############ FUNÇÕES PRIVADAS ############
	
	
	private function setUpdateLog()
	{
		
	}// fnct setUpdateLog()

	public static function maskTel(&$numero)
	{
		$numLenght = strlen($numero);
		
		if ($numLenght == 10)
		{
			$return = "(" . substr($numero, 0, 2) . ") " . substr($numero, 2, 4) . "-" . substr($numero, 6, 4);
		
		}elseif  ($numLenght == 11)
		
		{
			$return = "(" . substr($numero, 0, 2) . ") " . substr($numero, 2, 5) . "-" . substr($numero, 7, 4);
		
		}else
		{
			return false;
		}
		
		$numero = $return;
	}
	
	public static function toFullData(&$shortData)
	{
		$numLenght = strlen($shortData);
		
		if ($numLenght!=8) { return false; }
		
		$return = substr($shortData, 0, 4) . "-" . substr($shortData, 4, 2) . "-" . substr($shortData, 6, 2) . " 00:00:00";
		$shortData = $return;
	}
	

	public static function toShortData(&$longData)
	{
		$numLenght = strlen($longData);
		
		if ($numLenght!=19) { return false; }
		
		$return = substr($longData, 0, 4) . substr($longData, 5, 2) . substr($longData, 8, 2);
		$longData = $return;
	}
} //Class Qualidade


?>
