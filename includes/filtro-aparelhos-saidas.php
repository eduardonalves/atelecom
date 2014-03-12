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

$query = "SELECT saidas.id_saida, userEstoq.nome AS estoquista, userParc.login, userParc.nome AS parceiro, DATE_FORMAT(saidas.data, '%d/%m/%Y &agrave;s %H:%i:%s') AS data
				   				   FROM saidas 
				                   INNER JOIN usuarios userEstoq ON (userEstoq.id=saidas.id_estoquista)
				                   INNER JOIN usuarios userParc ON (userParc.id=saidas.id_parceiro)
				                   WHERE 1=1
								   ";

if($_GET["est"]!="") { $query.= " && userEstoq.nome= \"" . $_GET["est"] . "\""; }
if($_GET["parc"]!="") { $query.= " && (userParc.nome= \"" . $_GET["parc"] . "\" || userParc.login= \"" . $_GET["parc"] . "\")"; }


if ($_GET["v"]!="")
{
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
	
} else {
	
	$dataInicio = "0000-00-00 00:00:00";
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
	
	$dataFinal .= " 23:59:59";
	
} else {
	
	$dataFinal = date("Y-m-d 23:59:59");
	
}

$query.= " && saidas.data BETWEEN '" . $dataInicio . "' AND '" . $dataFinal . "'";
$order = $_GET["o"];

if($order!="")
{
	
	$fOrder = str_replace("estoquista", "userEstoq.nome", $order);
	$fOrder = str_replace("parceiro", "userParc.nome", $fOrder);
	$fOrder = str_replace("data", "data", $fOrder);
	
	$query .= " ORDER BY " . $fOrder;
}

$conSaidas = $conexao->query($query . " LIMIT $inicial, $numreg");

$quantreg = mysql_num_rows($conexao->query($query));


?>
