<?
$conexao31 = mysql_connect("172.16.0.31","admin","v3nt0adm");


$conexao30 = mysql_connect("localhost","root","v3nt0adm");
$db30 = mysql_select_db("vento");

$con30 = "SELECT * FROM vendas_clarotv";
$res30 = mysql_query($con30,$conexao30);
while($lin30 = mysql_fetch_array($res30)){
	
$produto = $lin30['produto'];

switch($produto){
	
case 1: 

//CLIENTE
$tipoPessoa = $lin30['pessoa'];
$cpf = $lin30['cpf'];
$nome = $lin30['nome'];
$nomeMae = $lin30['nome_mae'];
$nascimento = $lin30['nascimento'],
$rg = $lin30['rg'];
$rgOrgExp = $lin30['org_exp'];
				  'rgDataExp'=>$lin30['dataExp'],				  
				  'profissao'=>$lin30['profissao'],
				  'estadoCivil'=>$lin30['estCiv'],
				  'email'=>$lin30['email'],
				  'telefone'=>$lin30['tel'],
				  'telComercial'=>$lin30['telCom'],
				  'telCelular'=>$lin30['telCel'],
				  'telAdicional'=>$lin30['telAdic'],


//CLARO TV
$operador = $lin30['operador'];
$monitor = $lin30['monitor'];
$auditor = $lin30['auditor'];
$tecnico = $lin30['tecnico'];
$gravacao = $lin30['gravacao'];
$obsGravacao = $lin30['obs_gravacao'];
$os = $lin30['os'];
$proposta = $lin30['proposta'];
$contrato = $lin30['contrato'];
$status = $lin30['status'];
$obs = $lin30['obs'];
$plano = $lin30['plano'];
$pontos = $lin30['pontos'];
$os2 = $lin30['os2'];
$os3 = $lin30['os3'];
$vencimento = $lin30['vencimento'];
$valor = $lin30['valor'];
$pagamento = $lin30['pagamento'];
$banco = $lin30['banco'];
$agencia = $lin30['agencia'];
$contaCorrente = $lin30['conta_corrente'];
$dataVendaSistema = $lin30['dataVenda'];
$dataVendaOperador = $lin30['dataVenda'];
$dataDesejada = $lin30['dataDesej'];
$tipoInstalacao = $lin30['tipoInst'];
$pagamentoInstalacao = $lin30['pagInst'];
$cep = $lin30['cep'];
$endereco = $lin30['endereco'];
$numero = $lin30['numEnd'];
$lote = $lin30['lote'];
$quadra = $lin30['quadra'];
$complemento = $lin30['complemento'];
$bairro = $lin30['bairro'];
$uf = $lin30['estado'];
$cidade = $lin30['cidade'];
$pontoReferencia = $lin30['pontRef'];

$db31 = mysql_select_db("vento_zend");
$insertTV = mysql_query("INSERT INTO vendasClaroTV ('') VALUES ('')",$conexao31);

break;	

case 2: break;
case 3: break;

default:break;	
	
	}
	
	
	
}


?>