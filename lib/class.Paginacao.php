
<?php


class Paginacao {
	
	private $numRegistroPorPagina_asInteger;
	private $numPaginaAtual_asInteger;
	private $numTotalPaginas_asInteger;
	private $numTotalRegistros_asInteger;
	
	private $selectOptions_asArray = array(15, 30, 40, 60);
	
	function __construct($totalRegistros_asInteger)
	{
		
		if(isset ($_GET["reg_pg"]))
		{ 
			$registrosPorPagina_asInteger = $_GET["reg_pg"]; 
		}else{
			
			$registrosPorPagina_asInteger = 30;
			
		}
		
		if($_GET["num_pag"]!="") 
		{ 
			$paginaAtual = $_GET["num_pag"]; 
		
		}else{
			
			$paginaAtual = 1;
		}
		
		$this->numTotalRegistros_asInteger = $totalRegistros_asInteger;
		$this->numRegistroPorPagina_asInteger = $registrosPorPagina_asInteger;
		$this->numPaginaAtual_asInteger = $paginaAtual;
		
		$this->mkCalculos();
		
		if($this->numTotalPaginas_asInteger<$this->numPaginaAtual_asInteger)
		{
			$this->numPaginaAtual_asInteger = $this->numTotalPaginas_asInteger;
		}
		//echo $totalRegistros_asInteger;
	}
	
	private function mkCalculos()
	{
		$this->numTotalPaginas_asInteger = ceil($this->numTotalRegistros_asInteger / $this->numRegistroPorPagina_asInteger);
	}

	public function getQuantRegistro()
	{
		return $this->numRegistroPorPagina_asInteger;
	}
	

	public function getNumeroPaginas()
	{
		return $this->numTotalPaginas_asInteger;
	}
	
	public function getPaginaAtual()
	{
		return $this->numPaginaAtual_asInteger;
	}
	
	public function getLimites()
	{
		if($registro ==0)
		{
			return "0,".$this->numRegistroPorPagina_asInteger;
		}
		$registro = ($this->numPaginaAtual_asInteger * $this->numRegistroPorPagina_asInteger) - $this->numRegistroPorPagina_asInteger;
				
		return $registro . "," . $this->numRegistroPorPagina_asInteger;
		//return "$minimo OFFSET " . $this->numRegistroPorPagina_asInteger;
	}
	
	public function getOpcoes()
	{
		return $this->selectOptions_asArray;
	}
	
	public function gravaPaginacao()
	{
		$url = str_replace(htmlentities("&num_pag=".$this->numPaginaAtual_asInteger), "", htmlentities($_SERVER["REQUEST_URI"]));
		
		if($this->numPaginaAtual_asInteger==1)
		{
			echo "<span class=\"navPaginacao navPaginacao-disabled\" style=\"border:none;\">Anterior</span>" . "\n";
		
		}else{

			$urlAtual = $url . "&num_pag=".( $this->numPaginaAtual_asInteger - 1 );
			urlencode($urlAtual);

			echo "<a class=\"link-paginacao\" href=\"" . $urlAtual . "\">";
			echo "<span class=\"navPaginacao\" style=\"border:none\">Anterior</span>" . "\n";
			echo "</a>";
			
		}		
		
		
		for($i=1; $i<=$this->getNumeroPaginas() && $i<=45; $i++)
		
			{
				$urlAtual = $url . "&num_pag=".($i);
				
				urlencode($urlAtual);
				$itemClasses = "itemPaginacao";

				if($this->numPaginaAtual_asInteger==$i)
				{
					$itemClasses .= " itemPaginacao-sel";
				}
				
				echo "<a class=\"link-paginacao\" href=\"" . $urlAtual . "\">";
				echo "<span class=\"" . $itemClasses . "\">$i</span>" . "\n";
				echo "</a>";
			}

		if($this->numPaginaAtual_asInteger==45 || $this->numPaginaAtual_asInteger==$this->numTotalPaginas_asInteger)
		{

			echo "<span class=\"navPaginacao navPaginacao-disabled\" style=\"border:none\">Pr&oacute;ximo</span>" . "\n";
		
		}else{

			$urlAtual = $url . "&num_pag=".( $this->numPaginaAtual_asInteger + 1 );
			urlencode($urlAtual);

			echo "<a class=\"link-paginacao\" href=\"" . $urlAtual . "\">";
			echo "<span class=\"navPaginacao\">Pr&oacute;ximo</span>" . "\n";
			echo "</a>";

		}	
		
	}
	
	
	
}

?>
