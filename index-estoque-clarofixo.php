<?php

if (! isset($_GET["es"]) ) 
{ 
	
	if ($USUARIO["tipo_usuario"]=="MONITOR") {
		
		$_GET["es"] = "estoque-clarofixo";

	}elseif ($USUARIO["tipo_usuario"]=="SUPERVISOR") {

		$_GET["es"] = "estoque-unificado-clarofixo";

	}else{
	
	$_GET["es"] = "aparelhos-clarofixo";	
	
	}

}
	

include $_GET["es"] . ".php";

?>
