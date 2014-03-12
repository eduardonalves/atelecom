<?

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


if($USUARIO['tipo_usuario'] == 'MONITOR' )
{ 
	$loginMONITOR = $USUARIO['id'];
}else{
	
	if(strstr(strtolower($USUARIO['login']), 'internet'))
	{
		$loginMONITOR = "%' && operador='2387' || monitor LIKE '%3179";
	}
}

if($_GET['s'] != ""){

if($_GET['g'] == '1'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%')  ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%')");
$quantreg = mysql_num_rows($quantVENDA);

} else if($_GET['g'] == '0'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%') ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%')");
$quantreg = mysql_num_rows($quantVENDA);

} else {	

$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%') ORDER BY $ordem LIMIT $inicial, $numreg");
	
$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%')");
$quantreg = mysql_num_rows($quantVENDA);

}

} else {
	
	
if($_GET['g'] == '1'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%') ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%')");
$quantreg = mysql_num_rows($quantVENDA);

} else if($_GET['g'] == '0'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%') ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%') ");
$quantreg = mysql_num_rows($quantVENDA);

} else {	

$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%') ORDER BY $ordem LIMIT $inicial, $numreg");
	
$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='2' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && data_autorizacao LIKE '%".$dataautorizacao."%' && tipoVenda LIKE '%".$_GET['tpv']."%' && (monitor LIKE '%".$loginMONITOR."%')");
$quantreg = mysql_num_rows($quantVENDA);	
	
}
	
}




?>
