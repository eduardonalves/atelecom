<?
/*
if($_GET['v']){

$datain = substr($_GET['v'],6,4).substr($_GET['v'],3,2).substr($_GET['v'],0,2);
	
} else { $datain = $v;}


if($_GET['i']){

$datafin = substr($_GET['i'],6,4).substr($_GET['i'],3,2).substr($_GET['i'],0,2);
	
} else { $datafin = $ano.$mes.'31';}



$s = explode('|',$_GET['s']);
$status = "";
foreach ($s as $key => $st){
$status .= ",'".$st."'";
}
$status = substr($status,1);


if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}//se o usuario for supervisor, seleciono todos os monitores de um supervisor
if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){ 	$idsupervisor = $USUARIO['id'];		$querymonitores = $conexao->query("SELECT * FROM usuarios WHERE supervisor = '$idsupervisor'");	$j=0;	while($row = mysql_fetch_assoc($querymonitores)){				if($j ==0){			$MONITORES = $MONITORES.'  monitor='.$row['id'].' ' ;			}else{			$MONITORES = $MONITORES.'||  monitor='.$row['id'];		}		$j= $j+1;	}		}
if($_GET['s'] != ""){

if($_GET['g'] == '1'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'  ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else if($_GET['g'] == '0'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else {	

$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");
	
$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

}

} else {
	
	
if($_GET['g'] == '1'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else if($_GET['g'] == '0'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ");
$quantreg = mysql_num_rows($quantVENDA);

}if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){	$conVENDA =	$conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && ($MONITORES) ORDER BY $ordem LIMIT $inicial, $numreg");	$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && ($MONITORES)");	$quantreg = mysql_num_rows($quantVENDA); }else {	

$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");
$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='3' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || novoNumero LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_instalacao LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);	
	
}
	
}

*/
/*
 * mc = Filtro por Marca
 * mod = Filtro por modelo
 * mqt = Filtro por quantidade em estoque menor que
 * pqt = Filtro por quantidade em estoque maior que
*/


//echo "Estoque total com parceiros: " . getEstoqueExterno();

//echo "Estoque total com parceiros: " . $estoque["quantidade"] . "<br><br>\n\n";
//echo print_r($estoque["dados"]);

$estoqueComParceiro = array();
$estoqueVendido =  array();
$estoqueDevolvido = array();

$parceiro = "";
$status = "";

if($_GET["parc"]!="") { $parceiro = $_GET["parc"]; }

if($_GET["status"]!="") { $status = $_GET["status"]; }


if ($_GET["v"]!="")
{
	unset($dataInicio);
	$iData = explode("/", $_GET["v"]);

	for($i=count($iData)-1; $i>=0; $i--)
	{
		
		if ( isset($dataInicio) )
		 { 
			 $dataInicio .= "-";
		 }
		$dataInicio .= $iData[$i];
		
	}
	
	$dataInicio .= " 00:00:00";
	
}

if ($_GET["i"]!="")
{
	$finalData = explode("/", $_GET["i"]);

	for($i=count($finalData)-1; $i>=0; $i--)
	{
		
		if ( isset($dataFinal) )
		 { 
			 $dataFinal .= "-";
		 }

		$dataFinal .= $finalData[$i];
		
	}
	
	$dataFinal .= " 00:00:00";
	
	
}

if(isset($_GET["id_aparelho"]))
{
	$idAparelho = $_GET["id_aparelho"];
}else{
	$idAparelho = "";
}


$estoque = getEstoqueExterno("$parceiro", "$status", "$dataInicio", "$dataFinal", "$idAparelho");

function getEstoqueExterno($parceiro="", $status="", $dataInicial="0000-00-00 00:00:00", $dataFinal="", $aparelho="")

{
	global $conexao;
	global $inicial;
	global $numreg;
	
	$data = array();
	
	if ($dataFinal=="") { $dataFinal = date("Y-m-d H:i:s"); }
	
	$query = "Select esn.id_saida, esn.esn, esn.status, itens.id_itenssaida, itens.id_saida, itens.id_aparelho, itens.qtde,
						saidas.id_estoquista, saidas.id_parceiro, saidas.data, DATE_FORMAT(saidas.data, '%d/%m/%Y &agrave;s %H:%i:%s') AS data,
						parceiros.id, parceiros.nome AS parceiro, estoquista.id, estoquista.nome AS estoquista,
						aparelhos.id_aparelho, aparelhos.marca, aparelhos.modelo, aparelhos.estoque FROM ESNsSaida esn
						INNER JOIN itenssaida itens ON (itens.id_itenssaida=esn.id_saida)
						INNER JOIN saidas ON (saidas.id_parceiro!=0 && saidas.id_saida=itens.id_saida AND ( (saidas.data BETWEEN '$dataInicial' AND '$dataFinal') OR (saidas.data LIKE '%". substr($dataFinal,0,10) . "%') ))
						INNER JOIN usuarios parceiros ON (parceiros.id=saidas.id_parceiro)
						INNER JOIN usuarios estoquista ON (estoquista.id=saidas.id_estoquista)
						INNER JOIN aparelhos ON (aparelhos.id_aparelho=itens.id_aparelho)
						WHERE 1=1
						";

	if($status!="")
	{
		switch (strtolower($status))
		{
			
			case ("em estoque") :
			
			$query .= " && esn.status='" . $status . "'";
			break;
			
			case ("vendido") :

			$query .= " && esn.status='" . $status . "'";
			break;

			case ("devolvido") :

			$query .= " && esn.status='" . $status . "'";
			break;
			
			default:
			
			echo "Filtro de status inv&aacute;lido!";
			return false;
		}
	}

	if($parceiro!="")
	{
		$query .= " && (parceiros.nome='" . $parceiro . "' || parceiros.login='$parceiro')";

	}

	if($aparelho!="")
	{
		$query .= " && itens.id_aparelho='" . $aparelho . "'";

	}


	$order = $_GET["o"];

	if($order!="")
	{
		
		$fOrder = str_replace("parceiro", "parceiros.nome", $order);
		$fOrder = str_replace("estoquista", "estoquista.nome", $fOrder);
		$fOrder = str_replace("aparelho", "aparelhos.marca, aparelhos.modelo", $fOrder);
		$fOrder = str_replace("esn", "esn.esn", $fOrder);
		$fOrder = str_replace("status", "esn.status", $fOrder);
		$fOrder = str_replace("data", "data", $fOrder);
		
		$query .= " ORDER BY " . $fOrder;
	}

		
	$estoqueExterno = $conexao->query($query);

	$data["quantidade"] = mysql_num_rows($estoqueExterno);
	$data["dados"] = array();

	while ($saida = mysql_fetch_array($estoqueExterno))
	{
		//$estoque += $saida["qtde"];
		array_push($data["dados"], $saida);
	}

	array_filter($data["dados"], "status_filter");
	
	$data["dados"] = array();

	$estoqueExterno = $conexao->query($query . " LIMIT $inicial, $numreg");

	while ($saida = mysql_fetch_array($estoqueExterno))
	{
		//$estoque += $saida["qtde"];
		array_push($data["dados"], $saida);
	}

	return $data;
	
}	


/*if($_GET["mc"]!="") { $query.= " && marca= \"" . $_GET["mc"] . "\""; }
if($_GET["mod"]!="") { $query.= " && modelo= \"" . $_GET["mod"] . "\""; }
if($_GET["mqt"]!="") { $query.= " && estoque<= \"" . $_GET["mqt"] . "\""; }
if($_GET["pqt"]!="") { $query.= " && estoque>= \"" . $_GET["pqt"] . "\""; }
if($_GET["o"]!="") { $query.= " order by " . $_GET["o"];}
*/
function status_filter($a)
{
	global $estoqueComParceiro;
	global $estoqueVendido;
	global $estoqueDevolvido;

	switch(strtolower($a["status"])) {

	case "em estoque":
		
		array_push($estoqueComParceiro, $a);
		break;
	
	case "vendido":

		array_push($estoqueVendido, $a);
		break;

	case "devolvido":

		array_push($estoqueDevolvido, $a);
		break;

	}
	
	return true;
	

}

$quantreg = $estoque["quantidade"];

?>
