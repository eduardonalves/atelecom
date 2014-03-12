<?

//produto

$produto = '1';

// Gravação

if($_GET['g'] == '1'){

$gravacao = "&& vendas_clarotv.gravacao != ''";

} else if($_GET['g'] == '0'){

$gravacao = "&& vendas_clarotv.gravacao = ''";

}


//status
$s = explode('|',$_GET['s']);
$status = "";
foreach ($s as $key => $st){
$status .= ",'".$st."'";
}
$status = substr($status,1);

if($_GET['s'] == "REAGENDADA") { $constatus =  "&& vendas_clarotv.reagendamentos > 0"; }

else if($_GET['s'] != ""){ $constatus =  "&& vendas_clarotv.status IN (".$status.")";   }



// data venda inicial
if($_GET['v']){

$datain = substr($_GET['v'],6,4).substr($_GET['v'],3,2).substr($_GET['v'],0,2);
	
} else { $datain = $v;}

// data venda final
if($_GET['ate']){

$datafin = substr($_GET['ate'],6,4).substr($_GET['ate'],3,2).substr($_GET['ate'],0,2);
	
} else { $datafin = $ano.$mes.'31';}


// verificar se usuario é monitor

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}

$MONITORES = "vendas_clarotv.monitor LIKE '%".$loginMONITOR."%'";

if($USUARIO['tipo_usuario'] == 'SUPERVISOR')
	{ 	
		$MONITORES = "";
		
		$idsupervisor = $USUARIO['id'];
		$querymonitores = $conexao->query("SELECT * FROM usuarios WHERE supervisor = '$idsupervisor'");
		
		$j=0;
		
		while($row = mysql_fetch_assoc($querymonitores))
		{
			if($j ==0)
			{
				$MONITORES = $MONITORES.'  monitor='.$row['id'].' ' ;
			
			}else{
				
				$MONITORES = $MONITORES.'||  monitor='.$row['id'];
			
			}
		
		$j= $j+1;
		
		}
		if($MONITORES=="") { $MONITORES = "1=2"; }
	}

// agendamento



if($in=='')
{
	$in = "%'";

}else{
	$in .= "%' && (vendas_clarotv.status='APROVADO' || vendas_clarotv.status='INSTALAR' || vendas_clarotv.status='GRAVAR' || vendas_clarotv.status='CONECTADO')";
}

$agendamento = "IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
							FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada) LIKE '%".$in." &&";

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* 
$conVENDA = $conexao->query("SELECT *,
							vendas_clarotv.data AS data,
							vendas_clarotv.id AS id,
							
							IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
							FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) AS data_marcada,	
							vendas_clarotv.data_marcada AS agendamento
							 FROM vendas_clarotv					 
							 WHERE 		
							 vendas_clarotv.produto='".$produto."'
							 ".$gravacao." && 
							 (vendas_clarotv.contrato LIKE '%".$_GET['b']."%' || 
							 	vendas_clarotv.proposta LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.nome LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cpf LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cep LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cep LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.plano LIKE '%".$_GET['b']."%') && 
							 vendas_clarotv.tipo_instalacao LIKE '%".$_GET['t']."%' && 
							 vendas_clarotv.pagamento LIKE '%".$_GET['f']."%' 
							 ".$constatus." && 
							 (vendas_clarotv.data >= '".$datain."' && vendas_clarotv.data <= '".$datafin."') && 
							 ".$agendamento."
							 vendas_clarotv.data_instalacao LIKE '%".$di."%' && 
							 vendas_clarotv.tipoVenda LIKE '%".$_GET['tpv']."%'  && 
							 vendas_clarotv.tipoVenda LIKE '%".$_GET['tpv']."%' && 
							 vendas_clarotv.monitor LIKE '%".$loginMONITOR."%'  
							 							 
							 ORDER BY $ordem 
							 LIMIT $inicial, $numreg
							 
							 
							 ");


							 
							 
$quantVENDA = $conexao->query("SELECT *,
							vendas_clarotv.data AS data,
							vendas_clarotv.id AS id,
							
							IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
							FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) AS data_marcada

							 FROM vendas_clarotv					 
							 WHERE 		
							 vendas_clarotv.produto='".$produto."'
							 ".$gravacao." && 
							 (vendas_clarotv.contrato LIKE '%".$_GET['b']."%' || 
							 	vendas_clarotv.proposta LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.nome LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cpf LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cep LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cep LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.plano LIKE '%".$_GET['b']."%') && 
							 vendas_clarotv.tipo_instalacao LIKE '%".$_GET['t']."%' && 
							 vendas_clarotv.pagamento LIKE '%".$_GET['f']."%' ".$constatus." && 
							 (vendas_clarotv.data >= '".$datain."' && vendas_clarotv.data <= '".$datafin."') && 
							 ".$agendamento."
							 vendas_clarotv.data_instalacao LIKE '%".$di."%' && 
							 vendas_clarotv.tipoVenda LIKE '%".$_GET['tpv']."%'  && 
							 vendas_clarotv.tipoVenda LIKE '%".$_GET['tpv']."%' && 
							 vendas_clarotv.monitor LIKE '%".$loginMONITOR."%'  
							 							 
							 ORDER BY $ordem 
						
							 ");
*/						 

$conVENDA = $conexao->query("SELECT *,
							vendas_clarotv.data AS data,
							vendas_clarotv.id AS id,
							
							IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
							FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) AS data_marcada,	
							vendas_clarotv.data_marcada AS agendamento
							 FROM vendas_clarotv					 
							 WHERE 		
							 vendas_clarotv.produto='".$produto."'
							 ".$gravacao." && 
							 (vendas_clarotv.contrato LIKE '%".$_GET['b']."%' || 
							 	vendas_clarotv.proposta LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.nome LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cpf LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cep LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cep LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.plano LIKE '%".$_GET['b']."%') && 
							 vendas_clarotv.tipo_instalacao LIKE '%".$_GET['t']."%' && 
							 vendas_clarotv.pagamento LIKE '%".$_GET['f']."%' 
							 ".$constatus." && 
							 (vendas_clarotv.data >= '".$datain."' && vendas_clarotv.data <= '".$datafin."') && 
							 ".$agendamento."
							 vendas_clarotv.data_instalacao LIKE '%".$di."%' && 
							 vendas_clarotv.tipoVenda LIKE '%".$_GET['tpv']."%'  && 
							 vendas_clarotv.tipoVenda LIKE '%".$_GET['tpv']."%' && 
							 (".$MONITORES.")
							 							 
							 ORDER BY $ordem 
							 LIMIT $inicial, $numreg
							 
							 
							 ");


							 
							 
$quantVENDA = $conexao->query("SELECT *,
							vendas_clarotv.data AS data,
							vendas_clarotv.id AS id,
							
							IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
							FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) AS data_marcada

							 FROM vendas_clarotv					 
							 WHERE 		
							 vendas_clarotv.produto='".$produto."'
							 ".$gravacao." && 
							 (vendas_clarotv.contrato LIKE '%".$_GET['b']."%' || 
							 	vendas_clarotv.proposta LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.nome LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cpf LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cep LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.cep LIKE '%".$_GET['b']."%' || 
								vendas_clarotv.plano LIKE '%".$_GET['b']."%') && 
							 vendas_clarotv.tipo_instalacao LIKE '%".$_GET['t']."%' && 
							 vendas_clarotv.pagamento LIKE '%".$_GET['f']."%' ".$constatus." && 
							 (vendas_clarotv.data >= '".$datain."' && vendas_clarotv.data <= '".$datafin."') && 
							 ".$agendamento."
							 vendas_clarotv.data_instalacao LIKE '%".$di."%' && 
							 vendas_clarotv.tipoVenda LIKE '%".$_GET['tpv']."%'  && 
							 vendas_clarotv.tipoVenda LIKE '%".$_GET['tpv']."%' && 
							 (".$MONITORES.")
							 							 
							 ORDER BY $ordem 
						
							 ");
//$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao != '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%' && tipoVenda LIKE '%".$_GET['tpv']."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");

$quantreg = mysql_num_rows($quantVENDA);






/*


if($_GET['s'] != ""){

if($_GET['g'] == '1'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao != '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%' && tipoVenda LIKE '%".$_GET['tpv']."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'  ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao != '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%' && tipoVenda LIKE '%".$_GET['tpv']."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else if($_GET['g'] == '0'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao = '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao = '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else {	

$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.")  && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");
	
$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && status IN (".$status.") && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

}

} else {
	
	
if($_GET['g'] == '1'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao != '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao != '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);

} else if($_GET['g'] == '0'){
$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao = '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");

$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && gravacao = '' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ");
$quantreg = mysql_num_rows($quantVENDA);

} else {	

$conVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%'  && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%' ORDER BY $ordem LIMIT $inicial, $numreg");
	
$quantVENDA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto='1' && (contrato LIKE '%".$_GET['b']."%' || proposta LIKE '%".$_GET['b']."%' || nome LIKE '%".$_GET['b']."%' || cpf LIKE '%".$_GET['b']."%' || cep LIKE '%".$_GET['b']."%' || plano LIKE '%".$_GET['b']."%') && tipo_instalacao LIKE '%".$_GET['t']."%' && pagamento LIKE '%".$_GET['f']."%' && (data >= '".$datain."' && data <= '".$datafin."') && ((data_marcada LIKE '%".$in."%' && reagendamento1 = '') || reagendamento1 LIKE '%".$in."%') && data_instalacao LIKE '%".$di."%'  && tipoVenda LIKE '%".$_GET['tpv']."%' && monitor LIKE '%".$loginMONITOR."%'");
$quantreg = mysql_num_rows($quantVENDA);	
	
}
	
}

*/


?>
