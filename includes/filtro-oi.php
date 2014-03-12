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


if($_GET['pro'] != ''){ $produto = "produto='".$_GET['pro']."'"; } 
else { 
$produto = "(produto='4' || produto='5' || produto='6')";
}
if(isset($_GET['pacvf'])){
	if($_GET['pacvf']){
		
		$pacvf = "&& velox_fixo_plano LIKE '%".$_GET['pacvf']."%'";
	}else{
		$pacvf="";
	}


}else{
$pacvf="";

}

if($_GET['pro']==6){
	if($_GET['s']=="CONECTADO"){
		
		$dataConFin = "data_conectada";
	}else{
	
		$dataConFin = "data_instalacao";
	}	
}else{
	if($_GET['pro']==4){
		if($_GET['s']=="CONECTADO"){
			
			$dataConFin = "data_conectada";
		}else{
		
			$dataConFin = "data_instalacao";
		}
	}else{
		$dataConFin = "data_instalacao";
	}
	
}

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}

if($_GET['s'] != ""){

if($_GET['g'] == '1'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%'  ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else if($_GET['g'] == '0'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else {	

$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");
	
$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

}

} else {
	
	
if($_GET['g'] == '1'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && gravacao != '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else if($_GET['g'] == '0'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && gravacao = '' && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%' ");
$quantreg = mysql_num_rows($quantVENDA);

} else {	

$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");
	
$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE ".$produto." && (msisdn LIKE '%".$_GET['b']."%' || num_ordem LIKE '%".$_GET['b']."%' || cod_autorizacao LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || os LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%') && plano LIKE '%".$_GET['t']."%'  $pacvf && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && $dataConFin LIKE '%".$datafinalizada."%' && data_marcada LIKE '%".$dataentrega."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);	
	
}
	
}




?>