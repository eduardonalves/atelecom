<?php

require "../conexao.php";

$aparelho = $_GET["apid"];
$monitor = $_GET["monitor"];

		$query = "Select saidas.id_parceiro, saidas.data, saidas.id_saida, 
				itens.id_itenssaida, itens.id_saida, itens.id_aparelho, itens.qtde,
				esn.id_saida, esn.esn, esn.status
				From saidas
				INNER JOIN itenssaida itens ON (itens.id_saida=saidas.id_saida)
				INNER JOIN ESNsSaida esn ON (esn.id_saida=itens.id_itenssaida && esn.status='Em Estoque')
				WHERE saidas.id_parceiro='$monitor'
				";
				
		$esns_qry = $conexao->query($query);
		$esns = array();
		
		While($esn = mysql_fetch_array($esns_qry))
		{
			array_push($esns, $esn["esn"]);
		}
		
		echo json_encode($esns);
		

		
?>
