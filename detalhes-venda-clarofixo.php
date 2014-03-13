<?
if(!isset($_SESSION)){ session_start(); }
include "conexao.php";

include_once "lib/class.Usuarios.php";
include_once "lib/class.VentoAdmin.php";
include_once "lib/class.Venda.php";
include_once "lib/class.VendaStatus.php";

$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");

$USUARIO = mysql_fetch_array($conUSUARIO);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Detalhes Venda Claro Fixo</title>
<style type="text/css">
body{margin: 0 0 0 0; font-family:Arial, Helvetica, sans-serif;}

#topo{position:relative; background:url(img/topo-bg.png) repeat-x; top:0px; height:120px; width:100%;}
</style>
</head>

<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.mockjax.js"></script>
<script type="text/javascript" src="js/pekeUpload.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/custom.css" />

<script type="text/javascript" src="js/scpt-autocomplete-esns-aparelhos.js"></script>

<link rel="stylesheet" type="text/css" href="css/style-autocomplete.css" />

<script type="text/javascript">

	$(document).ready( function() {
	
	$("#tipoEntrega").bind('change', function() {
		
		tipo = $("#tipoEntrega").val();
		
		if(tipo=='PRONTA ENTREGA')
		{
			$('<option value="DINHEIRO">DINHEIRO</option>').appendTo("#pagamento");
		}else{
			$("#pagamento option[value='DINHEIRO']").remove();
		}
		
		
	});
	
});
	

</script>


<script type="text/javascript">

$(document).ready(function() {
	
	var tipo_doc = $("#tipo_documento option:selected").val();
	var time = '<?php $curTime = '-' . $_GET['id'] . "-" . time(); echo $curTime;?>';
	
	$("#tipo_documento").change( function() {

		tipo_doc = $("#tipo_documento option:selected").val();
		$("#file").newData('doc-' + tipo_doc + time);

	});

	$("#file").pekeUpload({invalidExtError:'Tipo de arquivo inv&aacute;lido', file:'arquivo', onSubmit:false, multi:false, data:'doc-' + tipo_doc + '<?php echo $curTime;?>', btnText:'Selecionar arquivo', venda_id:'<?php echo $_GET['id']; ?>', user_id:'<?php echo $USUARIO['id'];?>', allowedExtensions:"jpg|jpeg|gif|png|pdf", onFileSuccess: function(file,data){ location.reload(true); }});
	
});


</script>

<?
	include "lib/class.controleEstoque.php";

	$estoque = new controleEstoque($conexao);
	
	
// Verificar se está logado
if(!isset($_SESSION['usuario'])){ ?>
<script type="text/javascript">

window.location = 'index.php'

</script>	


<? } 
function verificaEsn()
{
	global $conexao;

	$statusVenda = strtolower($_POST["status"]);

	$esn = $_POST['esn'];
	$apid = $_POST['aparelho'];
	$monitor = $_POST['monitor'];
	
	
	if($esn=="" || $apid==0 || $monitor=="") { return false; }
	

		$query = "Select saidas.id_parceiro, saidas.data, saidas.id_saida, 
				itens.id_itenssaida, itens.id_saida, itens.id_aparelho, itens.qtde,
				esn.id_esnssaida, esn.id_saida, esn.esn, esn.status
				From saidas
				INNER JOIN itenssaida itens ON (itens.id_saida=saidas.id_saida && itens.id_aparelho='$apid')
				INNER JOIN ESNsSaida esn ON (esn.id_saida=itens.id_itenssaida && esn.status='Em Estoque' && esn.esn='$esn')
				WHERE saidas.id_parceiro='$monitor LIMIT 1'
				";	

	$esnCheck = $conexao->query($query);
	
	if (mysql_num_rows($esnCheck)<1)
	{
		return false;
	}
		
	return true;
	
	/*$statusAparelho = strtolower($aparelho["status"]);

	if($statusVenda=="finalizada" && $statusAparelho=="em estoque")
	{
		$varerros="";
		$query = "Update ESNsSaida set status='Vendido' WHERE esn = '$esn'";
		$conexao->query($query);
		
	}
	*/


}



$consulta = $conexao->query("SELECT * FROM vendas_clarotv WHERE id = '".$_GET['id']."'");
$linha = mysql_fetch_array($consulta);



if($_GET['e'] == '1' && $USUARIO['editar_dados'] == '1'){ $editar = '1';}




if($_GET['e'] == '1' && $USUARIO['editar_instalacao'] == '1'){ $editar_instalacao = '1';}


///////////////////////////////////


if(isset($_POST['nome'])){

$os = $_POST['os'];
$esn = $_POST['esn'];
$novoNumero = $_POST['novonumero'];

// Dados Pessoais
$nome = $_POST['nome'];
$nascimento = $_POST['nascd'].'/'.$_POST['nascm'].'/'.$_POST['nasca'];
$cpf = $_POST['icpf'];
$rg = $_POST['rg'];
$org_exp = $_POST['orgexp'];
$profissao = $_POST['profissao'];
$sexo = $_POST['sexo'];
$estado_civil = $_POST['estadocivil'];
$email = $_POST['email'];
$telefone = $_POST['itelefone'];
$tipo_tel1 = $_POST['tipotel1'];
$telefone2 = $_POST['itelefone2'];
$tipo_tel2 = $_POST['tipotel2'];
$telefone3 = $_POST['itelefone3'];
$tipo_tel3 = $_POST['tipotel3'];

// Endereço Instalação
$endereco = $_POST['endereco'];	
$numero = $_POST['numero'];	
$lote = $_POST['lote'];	
$quadra = $_POST['quadra'];	
$complemento = $_POST['complemento'];	
$bairro = $_POST['bairro'];	
$cidade = $_POST['cidade'];	
$uf = $_POST['uf'];
$cep = $_POST['icep'];
$ponto_referencia = $_POST['pontoref'];

// Dados da Venda
$operador = $_POST['operador'];
$monitor = $_POST['monitor'];
$tipoLinha = $_POST['tipolinha'];
$tipoAssinatura = $_POST['tipoassinatura'];
$tipoPlano = $_POST['tipoplano'];
$plano = $_POST['plano'];
$Plano = $_POST['valorplano'];
$aparelho = $_POST['aparelho'];
$valorAparelho = $_POST['valoraparelho'];
$pagamento = $_POST['pagamento'];
$tipoEntrega = $_POST['tipoEntrega'];
$id_pagseguro = $_POST['id_pagseguro'];
$data0 = explode('/',$_POST['idata']);
$data = $data0[2].$data0[1].$data0[0];
$plano = $_POST['plano'];
$vencimento = $_POST['vencimento'];
$banco_deposito = $_POST['banco_deposito'];
$agencia_deposito = $_POST['agencia_deposito'];
$contacorrente_deposito = $_POST['contacorrente_deposito'];
$numchip = $_POST['numchip'];

// Agendamento gravação


if($_POST['agendagravacao']){

$diaGravacao = explode('/',$_POST['agendagravacao']);

$agendGravacao = $diaGravacao[2].'-'.$diaGravacao[1].'-'.$diaGravacao[0].' '.$_POST['agendagravacaohora'].':'.$_POST['agendagravacaominutos'].':00';

} else {
	
$agendGravacao = $linha['agendagravacao'];
	
}

if($_POST['agendaentrega']){

$diaEntrega = explode('/',$_POST['agendaentrega']);

$agendEntrega = $diaEntrega[2].'-'.$diaEntrega[1].'-'.$diaEntrega[0].' '.$_POST['agendaentregahora'].':'.$_POST['agendaentregaminutos'].':00';

} else {
	
$agendEntrega = $linha['agendaentrega'];
	
}

// Dados da Instalação

$data_marcada0 = explode('/',$_POST['dataentrega']);
$data_entrega = $data_marcada0[2].$data_marcada0[1].$data_marcada0[0];

if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR' && $_POST['datainstalacao']!='')
{

	if($_POST['status'] == 'FINALIZADA')
	{

		$data_finalizada = explode('/',$_POST['datainstalacao']);
		$data_finalizada = $data_finalizada[2].$data_finalizada[1].$data_finalizada[0];  

	}else{

		$data_finalizada = '';

	}

}else{

	if($linha['data_instalacao'] == '' && $_POST['status'] == 'FINALIZADA')
	{

		$data_finalizada = date("Ymd");

	}else{

		$data_finalizada = '';

	}
}


/*  ########## antigo codigo atelecom 
 *if($editar == '1')
{

	if($USUARIO['tipo_usuario'] == 'ADMINISTRADOR')
	{
		if($_POST['status'] == 'FINALIZADA')
		{
			
			if($_POST['datainstalacao']!='')
			{
				$data_finalizada = explode('/', $_POST['datainstalacao']);
				$data_finalizada = $data_finalizada[2].$data_finalizada[1].$data_finalizada[0];

			}else{

				$data_finalizada = date("Ymd");

			}
		}
	}else{
	
			if( $_POST['status'] == 'FINALIZADA' )
			{

				if($linha['data_instalacao'] == '')
				{

					$data_finalizada = date("Ymd");

				}else{

					$data_finalizada = explode('/', $_POST['datainstalacao']);
					$data_finalizada = $data_finalizada[2].$data_finalizada[1].$data_finalizada[0];

				}

			}
	
	}

}

*/ #########################33


/*  ULTIMO ANTIGO
$data_marcada0 = explode('/',$_POST['dataentrega']);
$data_entrega = $data_marcada0[2].$data_marcada0[1].$data_marcada0[0];


if($linha['data_instalacao'] == '' && $_POST['status'] == 'FINALIZADA')
{

	$data_finalizada = date("Ymd");

} elseif($_POST['status'] != 'FINALIZADA'){

	$data_finalizada = '';	

}else{

	$data_finalizada = $linha['data_instalacao'];	

}
*/

/*
if($_POST['datainstalacao'] != '')
{  
	$data_finalizada = explode('/',$_POST['datainstalacao']);
	$data_finalizada = $data_finalizada[2].$data_finalizada[1].$data_finalizada[0];  

} else {

	if($linha['data_instalacao'] == '' && $_POST['status'] == 'FINALIZADA')
	{

		$data_finalizada = date("Ymd");

	} else if($_POST['status'] != 'FINALIZADA'){

		$data_finalizada = '';	

	}else{

		$data_finalizada = $linha['data_instalacao'];	

	}
}
*/

// Motivos
$motivo_restricao = $_POST['motivorestricao'];
$motivo_cancelamento = $_POST['motivocancelamento'];
$motivo_devolvido = $_POST['motivodevolvido'];
$pendencia = $_POST['pendencia'];
$dataLiberacao0 = explode('/',$_POST['dataliberacao']);
$dataLiberacao = $dataLiberacao0[2].$dataLiberacao0[1].$dataLiberacao0[0];

// Observações

if(strlen($_POST['obsgravacao']) > 3){
$obs1 = $_POST['obsgravacao'];	
	
$insertOBS1 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','3','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','1','".$obs1."')");
		
}

if(strlen($_POST['obsentrega']) > 3){
$obs2 = $_POST['obsentrega'];	
	
$insertOBS2 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','3','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','2','".$obs2."')");
		
}

if(strlen($_POST['obsfinalizada']) > 3){
$obs3 = $_POST['obsfinalizada'];	
	
$insertOBS3 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','3','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','3','".$obs3."')");
		
}





if($_POST['status'] == 'RECUPERADO'){

$obs_recuperacao = $_POST['obsrecuperacao'];

if($obs_recuperacao){
	
$usuario_recuperacao = $USUARIO['id'];	
$data_recuperacao = date('Y-m-d H:i:s');

	
} }

// Cartão

$titularCartao = $_POST['titularCartao'];

if(strstr($_POST['numcartao'],'XXXX-XXXX')){
$numCar = $linha['numCar'];

} else {

$numCar = base64_encode($_POST['numcartao']);

}


if(strstr($_POST['numcodseguranca'],'XX')){

$codSeg = $linha['codSeg'];

} else {
$codSeg = $_POST['numcodseguranca'];
}

$carVal = $_POST['mesval'].'/'.$_POST['anoval'];

$carBan= $_POST['carbandeira'];


$numParcelas = $_POST['numparcelas'];


/*if($_POST['status'] == ''){ $status = $linha['status'];} 


else if($_POST['status'] == 'ANEXAR DOCUMENTOS' && $linha['gravacao'] == "" || ($_POST['status'] == 'RECUPERADO' && $linha['gravacao'] == "" && $linha['os'] == "" && ($linha['cpf'] == "" || $linha['cpf'] == "000.000.000-00") )){  $status = 'ANEXAR DOCUMENTOS'; }


else if($_POST['status'] == 'ANEXAR DOCUMENTOS' && $linha['gravacao'] != "" || ($_POST['status'] == 'RECUPERADO' && $linha['gravacao'] != "" && $linha['os'] != ""  && ($linha['cpf'] != "" || $linha['cpf'] != "000.000.000-00") )){  $status = 'DOCUMENTOS ANEXADOS'; }


else if($_POST['status'] == 'RECUPERADO' && $linha['gravacao'] == "" && $linha['os'] == "" && ($linha['cpf'] != "" || $linha['cpf'] != "000.000.000-00") ){  $status = 'PRE-ANALISE'; }

else if($_POST['status'] == 'RECUPERADO' && $linha['gravacao'] != ""){ $status = 'DOCUMENTOS ANEXADOS'; }

else if($_POST['status'] == 'DOCUMENTOS ANEXADOS' && $linha['gravacao'] != "" && $linha['os'] == ""){  $status = 'PRE-ANALISE'; }

else { $status = $_POST['status']; }
*/
$status = $_POST['status'];

function validarCampos(&$campos, $excep)
{
	global $varerros;
			
	foreach($campos as $key=>$value)
	{
		if( ! in_array($key, $excep) )
		{
			if($_POST[$key]=='')
			{
				if( $varerros=='' )
				{
					$varerros = 'Campos obrigatórios não preenchidos ou Inválidos:\n\n';
					$varerros .= "$value";
							 
				}else{
					$varerros .= ", $value";
				}

			}
		}
	}
			
}


if($_POST['status'] == strtoupper('FINALIZADA') && ($_POST['agendaentrega'] == "00/00/0000" || $_POST['agendaentrega'] == ""))
{

	$dataAgenEntrega = date('d/m/Y', strtotime("+7 days"));
	
	$diaEntrega = explode('/',$dataAgenEntrega);

	$agendEntrega = $diaEntrega[2].'-'.$diaEntrega[1].'-'.$diaEntrega[0].' 09:00:00';

}
	$varerros = "";
	
	if( ($_POST['tipoEntrega'] == 'PRONTA ENTREGA' || $_POST['tipoEntrega'] == 'MOTOBOY INTERNO' || $_POST['tipoEntrega'] == 'MOTOBOY EXTERNO') && ( strtoupper($_POST['status'])=='FINALIZADA') )
	{
		if (! verificaEsn()  )
		{
				if( $varerros=='' )
				{
					$varerros = 'Campos obrigatórios não preenchidos ou Inválidos:\n\n';
					$varerros .= "ESN Inválida";
							 
				}else{
					$varerros .= ", ESN Inválida";
				}
		}
		
		if ( (! ctype_digit($_POST['aparelho'])) || ($_POST['aparelho']=="0") )
		{
			//$varerros = "Modelo de aparelho invalido";

				if( $varerros=='' )
				{
					$varerros = 'Campos obrigatórios não preenchidos ou Inválidos:\n\n';
					$varerros .= "Modelo de Aparelho Inválido";
							 
				}else{
					$varerros .= ", Modelo de Aparelho Inválido";
				}

		}
	}
	
	if( strtoupper($_POST['status'])=='FINALIZADA')
	{
		
		// ##################### Verifica campos em branco ######################
		$campos = array(

			"os" => "OS",
			"esn" => "ESN",
			"novonumero" => "Novo Número",
			"nome" => "Nome do Cliente",
			"nomemae" => "Nome da Mãe", 
			"nascd" => "Dia do Nascimento",
			"nascm" => "Mês do Nascimeno",
			"nasca" => "Ano do Nascimento",
			"icpf" => "CPF",
			"rg" => "RG",
			"orgexp" => "Orgão Expedidor do RG",
			"dataexp" => "Data Expedição do RG",
			"profissao" => "Profissão",
			"estadocivil" => "Estado Civil",
			"email" => "Email",
			"itelefone" => "Telefone",
			"tipotel1" => "Tipo de Telefone",
			"itelefone2" => "Telefone 2",
			"tipotel2" => "Tipo do telefone 2",
			"itelefone3" => "Telefone 3",
			"tipotel3" => "Tipo do Telefone 3",
			"endereco" => "Endereço",
			"numero" => "Número da Casa",
			"lote" => "Lote",
			"quadra" => "Quadra",
			"complemento" => "Complemento",
			"bairro" => "Bairro",
			"cidade" => "Cidade",
			"uf" => "Estado",
			"icep" => "CEP",
			"pontoref" => "Ponto de Referência",
			"monitor" => "Monitor",
			"operador" => "Operador",
			"tipolinha" => "Tipo da Linha",
			"tipoassinatura" => "Tipo de Assinatura",
			"tipoplano" => "Tipo de Plano",
			"plano" => "Plano",
			"valorplano" => "Valor do Plano",
			"aparelho" => "Modelo do Aparelho",
			"valoraparelho" => "Valor do Aparelho",
			"tipoEntrega" => "Tipo de Entrega",
			"pagamento" => "Forma de Pagamento",
			"idata" => "Data da Venda",
			"vencimento" => "Dia do Vencimento",
			"status" => "Status"

			);

		$camposInvalidos = array();
		
		//verificar documentos
		
		// *********** Faz as validacoes ************
		
	
		if($_POST['tipoEntrega']=='EMBRATEL')
		{
			$excep = array("lote", "quadra", "complemento", "os", "esn", "novonumero");
			validarCampos($campos, $excep);
			

		}elseif ($_POST['tipoEntrega']=='PRONTA ENTREGA') {
			
			$excep = array("lote", "quadra", "complemento");
			validarCampos($campos, $excep);
			
			
		}
		
		
		// ######################################################################
		
		
	}



		
function recarregarDadosForm()
{
	?>
	
	<script type="text/javascript">
	$(window).load( function() {

	<? foreach($_POST as $key=>$val)
	{
	?>
	$("[name='<?=$key;?>']").val("<?=$_POST[$key];?>");
	<?	
	}
	?>
	
	});
	</script>
	
	<?
}



//////////////////////
// Atualizar Dados //
////////////////////

/*
$conOS = $conexao->query("SELECT * FROM vendas_clarotv WHERE os = '".$os."'");
$Auxos = mysql_fetch_array($conOS);

if($linha['os']==""){
  if($Auxos){
	$varerros = "Erro: Preencha o numero da OS!";
  }
}else{
	if( $_POST['os'] != "" && ($Auxos['id'] != $linha['id']) ){
		$varerros = "Erro: Contrato existente!";
	}
}

$conESN = $conexao->query("SELECT * FROM vendas_clarotv WHERE esn = '".$esn."'");
$Auxesn = mysql_fetch_array($conESN);
if($linha['esn']==""){
  if($Auxesn){
	$varerros = "Erro: Preencha o numero ESN!";
  }
}else{
	if($_POST['esn'] != "" && ($Auxesn['id'] != $linha['id']) ){
		$varerros = "Erro: ESN existente!";
	}
}
* */
if($_POST['status']=='FINALIZADA' && $_POST['novonumero']==''){
	$varerros = "Erro: Novo número obrigatório para finalizar a venda!";
}

if( $_POST['status'] == 'DOCUMENTOS ENVIADOS' && $varerros=='' )
{

	$ultimo_envio_documentos = date('Y-m-d');
	
	if( $linha['historico_envio_documentos'] == '' )
	{
		
		if( $linha['ultimo_envio_documentos'] != '' )
		{
			$datasE = array($linha['ultimo_envio_documentos']);
			$historico_envio_documentos = json_encode($datasE);
		}else{
			
			$historico_envio_documentos = '';
		}

	}else{
		
		$datasE = json_decode($linha['historico_envio_documentos']);
		
		array_push($datasE, $linha['ultimo_envio_documentos']);
		
		$historico_envio_documentos = json_encode($datasE);
		
	}

	
}else{

	$ultimo_envio_documentos = $linha['ultimo_envio_documentos'];
	$historico_envio_documentos = $linha['historico_envio_documentos'];
	
}
if($varerros==''){

	$sucesso ="Sucesso: Dados atualizados!";
	$update = $conexao->query("UPDATE vendas_clarotv SET os = '".$os."', esn = '".$esn."', novoNumero = '".$novoNumero."', nome = '".$nome."', nascimento = '".$nascimento."', cpf = '".$cpf."', rg = '".$rg."', org_exp = '".$org_exp."', profissao = '".$profissao."', sexo = '".$sexo."', estado_civil = '".$estado_civil."', email = '".$email."', telefone = '".$telefone."', tipo_tel1 = '".$tipo_tel1."', telefone2 = '".$telefone2."', tipo_tel2 = '".$tipo_tel2."', telefone3 = '".$telefone3."', tipo_tel3 = '".$tipo_tel3."', endereco = '".$endereco."', numero = '".$numero."', lote = '".$lote."', quadra = '".$quadra."', complemento = '".$complemento."', bairro = '".$bairro."', cidade = '".$cidade."', uf = '".$uf."', cep = '".$cep."', ponto_referencia = '".$ponto_referencia."', operador = '".$operador."', monitor = '".$monitor."', tipoLinha = '".$tipoLinha."', tipoAssinatura = '".$tipoAssinatura."', tipoPlano = '".$tipoPlano."', plano = '".$plano."', valorPlano = '".$valorPlano."', aparelho = '".$aparelho."', valorAparelho = '".$valorAparelho."', pagamento = '".$pagamento."', tipoEntrega = '".$tipoEntrega."', id_pagseguro = '".$id_pagseguro."', banco_deposito = '".$banco_deposito."', agencia_deposito = '".$agencia_deposito."', contacorrente_deposito = '".$contacorrente_deposito."', status = '".$status."', data = '".$data."', vencimento = '".$vencimento."', agendGravacao = '".$agendGravacao."', agendEntrega = '".$agendEntrega."', motivo_restricao = '".$motivo_restricao."',motivo_cancelamento = '".$motivo_cancelamento."', motivo_devolvido = '".$motivo_devolvido."', pendencia = '".$pendencia."', dataLiberacao = '".$dataLiberacao."', obs_recuperacao = '".$obs_recuperacao."', usuario_recuperacao = '".$usuario_recuperacao."', data_recuperacao = '".$data_recuperacao."', data_marcada = '".$data_entrega."', data_instalacao = '".$data_finalizada."', ultimo_envio_documentos = '".$ultimo_envio_documentos."', historico_envio_documentos = '".$historico_envio_documentos."', titularCartao = '".$titularCartao."', numCar = '".$numCar."', codSeg = '".$codSeg."', carVal = '".$carVal."', carBan = '".$carBan."', numParcelas = '".$numParcelas."', numchip = '". $numchip ."' WHERE id = '".$_GET['id']."' ") or die('Ocorreu um Erro ao inserir os dados!');
	
	if($_POST['status'] == strtoupper('FINALIZADA') && ($_POST['agendaentrega'] == "00/00/0000" || $_POST['agendaentrega'] == "") ) //&& ($_POST['tipoEntrega'] == 'PRONTA ENTREGA' || $_POST['tipoEntrega'] == 'MOTOBOY INTERNO' || $_POST['tipoEntrega'] == 'MOTOBOY EXTERNO'))
	{
	$query = "Update ESNsSaida set status='Vendido' WHERE esn = '$esn' && status='Em Estoque'";
	$conexao->query($query);
	}

}






/////////////////
// Insert LOG //
///////////////

$data = date("Y-m-d H:i:s");

$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$_SESSION['usuario']."','Atualizou um dado no sistema (ID: ".$_GET['id'].").')");


?>




<script type="text/javascript">

<?
	if($varerros=='')
	{
	
	?>
	
	alert('<?php echo $sucesso; ?>');
	window.location = '?id=<?= $_GET['id'];?>';
	
	<?
	}else{
	?>
	
	alert('<?php echo $varerros; ?>');
	
	<?
	}
	?>

</script>

<?
recarregarDadosForm();
}


////////////////////////////////////
////// EXCLUIR GRAVAÇÃO ///////////
//////////////////////////////////



if(isset($_POST['excluirgravacao'])){
	
$excluirgravacao = $conexao->query("UPDATE vendas_clarotv SET auditor = '', gravacao = '' WHERE id = '".$_GET['id']."'");

/////////////////
// Insert LOG //
///////////////

$data = date("Y-m-d H:i:s");

$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$_SESSION['usuario']."','Excluiu uma gravação: [".$linha['gravacao']."] (ID: ".$_GET['id'].") .')");


	?>
	
<script type="text/javascript">

window.alert('Gravação excluída com sucesso!');

window.location = '?e=1&id=<?= $_GET['id'];?>'


</script>    	


<?	
}
?>

<script type="text/javascript">
	
	$(window).load(function(){

		checkAgendEntrega();
		
		$("#pagamento").change(
		
			function ()
			{
				checkAgendEntrega();
			}
		);
	});
	
	function verificapagamento(v){
		
		if (v == "DEPÓSITO"){


		document.getElementById('idbancodep').style.display = '';
		document.getElementById('pagseguroid').style.display = 'none';
		
	} else if (v == "PAGSEGURO"){
		
		document.getElementById('pagseguroid').style.display = '';
		document.getElementById('idbancodep').style.display = 'none';
			
		 } else { 
			 
			 document.getElementById('idbancodep').style.display = 'none';
			 
		 }
 
	}
	function checkAgendEntrega()
	{
				
				var b = $("#tipoEntrega").val();
				var c = $("#status").val();

				if ((b=="PRONTA ENTREGA" || b=="MOTOBOY INTERNO" || b=="MOTOBOY EXTERNO") && c.toLowerCase() == "finalizada")
				{
					$("#agendentregaarea").css("display", "table-row");
				}else{

					$("#agendentregaarea").css("display", "none");
					
				}
		
	}

 /*Cria uma função de nome mascara, onde o primeiro argumento passado é um dos
   objetos input O segundo é especificando o tipo de método no qual será tratado*/

    function mascara(o,f){


        v_obj=o;


        v_fun=f;















        setTimeout("execmascara()",1);















    }















    















    function execmascara(){















        /*Pegue o valor do objeto e atribua o resultado da função v_fun; cujo o conteúdo















        da mesma é a função que foi referida e que será utilizada para tratar dos dados*/















        v_obj.value=v_fun(v_obj.value);















    }















    















    function soNumeros(v){















        return v.replace(/\D/g,"");//Exclua tudo que não for numeral e retorne o valor















    }















    















    function telefone(v){















        //Remove tudo o que não é dígito















        v=v.replace(/\D/g,"");















        //Coloca parênteses em volta dos dois primeiros dígitos



        v=v.replace(/^(\d\d)(\d)/g,"($1) $2");



        //Coloca hífen entre o quarto e o quinto dígitos



        v=v.replace(/(\d{4})(\d)/,"$1-$2");















        //retorne o resultado















        return v;















    }















	































    function cpf(v){















        //Remove tudo o que não é dígito















        v=v.replace(/\D/g,"");















        //Coloca parênteses em volta dos dois primeiros dígitos















        v=v.replace(/^(\d{3})(\d)/g,"$1.$2");















        //Coloca hífen entre o quarto e o quinto dígitos















        v=v.replace(/(\d{3})(\d)/,"$1.$2");















        //retorne o resultado















		v=v.replace(/(\d{3})(\d)/,"$1-$2");















        return v;















    }















	















	















    function cep(v){
		        //Remove tudo o que não é dígito

       v=v.replace(/\D/g,"");

        //Coloca hífen entre o quarto e o quinto dígitos

        v=v.replace(/(\d{5})(\d)/,"$1-$2");

        //retorne o resultado

        return v;




    }	


    function num(v){
		        //Remove tudo o que não é dígito

       v=v.replace(/\D/g,"");

        //retorne o resultado

        return v;

    }	














	















    function data(v){















        //Remove tudo o que não é dígito















        v=v.replace(/\D/g,"");















        //Coloca parênteses em volta dos dois primeiros dígitos















        v=v.replace(/^(\d{2})(\d)/g,"$1/$2");















        //Coloca hífen entre o quarto e o quinto dígitos















        v=v.replace(/(\d{2})(\d)/,"$1/$2");















        return v;















    }	















	















    function cartaocredito(v){















        //Remove tudo o que não é dígito















        v=v.replace(/\D/g,"");















        //Coloca parênteses em volta dos dois primeiros dígitos















        v=v.replace(/^(\d{4})(\d)/g,"$1-$2");















        //Coloca hífen entre o quarto e o quinto dígitos















        v=v.replace(/(\d{4})(\d)/,"$1-$2");















        v=v.replace(/(\d{4})(\d)/,"$1-$2");































        return v;















    }	















	















	















//////////////////////////////////	















	















	















function verificaassinatura(v){































if(v == "Nova Linha" || v == "Reposição"){ $('#tipoplano').html('<option value=""></option><option value="Pré Pago">Pré Pago</option><option value="Pós Pago">Pós Pago</option>'); }















else if(v == "Portabilidade"){ $('#tipoplano').html('<option value=""></option><option value="Pós Pago">Pós Pago</option>'); }















else { $('#tipoplano').html('<option value=""></option>');}































verificatipoplano('');















verificaplano('');















verificaaparelho('');















}































function verificatipoplano(v){































if(v == "Pré Pago"){ $('#plano').html('<option value=""></option><option value="CONTROLE FIXO">Controle Fixo</option><option value="PRÉ FIXO 15">Pré Fixo 15</option>'); }




else if(v == "Pós Pago"){
	
	$('#plano').html('<option value=""></option><option value="FAV Local">FAV Local</option><option value="FAV Local com DDD">FAV Local com DDD</option><option value="FAV Local e DDD">FAV Local e DDD</option><option value="FAV Local e DDD com Móvel">FAV Local e DDD com Móvel</option>'); 
	$('#plano').append('<option value=""></option><option value="FAV Local + TV">FAV Local + TV</option><option value="FAV Local com DDD + TV">FAV Local com DDD + TV</option><option value="FAV Local e DDD + TV">FAV Local e DDD + TV</option><option value="FAV Local e DDD com Móvel + TV">FAV Local e DDD com Móvel + TV</option>'); 
	}















else { $('#plano').html('<option value=""></option>');}































verificaplano('');















verificaaparelho('');































}		



function verificaplanos(v){ 


if(v == "CONTROLE FIXO"){ document.getElementById('valorplano').value = '0'; }

else if(v == "PRÉ FIXO 15"){ document.getElementById('valorplano').value = '0';}

else if(v == "FAV Local"){ document.getElementById('valorplano').value = '19,90'; }

else if(v == "FAV Local com DDD"){ document.getElementById('valorplano').value = '29,90'; }

else if(v == "FAV Local e DDD"){ document.getElementById('valorplano').value = '39,90'; }

else if(v == "FAV Local e DDD com Móvel"){ document.getElementById('valorplano').value = '49,90'; }

else if(v == "FAV Local + TV"){ document.getElementById('valorplano').value = '19,90'; }

else if(v == "FAV Local com DDD + TV"){ document.getElementById('valorplano').value = '19,90'; }

else if(v == "FAV Local e DDD + TV"){ document.getElementById('valorplano').value = '29,90'; }

else if(v == "FAV Local e DDD com Móvel + TV"){ document.getElementById('valorplano').value = '39,90'; }

else { document.getElementById('valorplano').value = '';}


<?php

$optAparelhos = "<option value=\"\"></option>";

if ($linha['status'] == "APROVADO" || $linha['status'] == "DOCUMENTOS ANEXADOS" || $linha['status']=="ENVIAR DOCUMENTOS")
{
	
	$modelosAparelhos = $estoque->getModelosAparelhosEstoque($linha["monitor"]);

	foreach($modelosAparelhos as $id=>$aparelho)
	{

		$optAparelhos .= "<option id=\"" . $linha["monitor"] . "\" value=\"". $id . "\">". $aparelho ."\"</option>";
	}
}

?>

$('#aparelho').html('<?php echo $optAparelhos; ?>');


verificaaparelho('');







}


function verificaaparelho(v){



var tipoassinatura = document.getElementById('tipoassinatura').value;

<?php
$aparelhos = $estoque->getAparelhos();

?>

////////////// PORTABILIDADE ////////////////



if(tipoassinatura == 'Portabilidade'){

	
<?php

foreach($aparelhos as $key=>$value)
{
	if($key==0)
	{

?>
if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_portabilidade"]; ?>'; }

<?php

	}else{

?>

else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_portabilidade"]; ?>'; }

<?php
	}
}
?>



else{ document.getElementById('valoraparelho').value = ''; }	

	

	

	}

else if(tipoassinatura == 'Reposição'){

	
<?php

foreach($aparelhos as $key=>$value)
{
	if($key==0)
	{

?>
if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_reposicao"]; ?>'; }

<?php

	}else{

?>

else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_reposicao"]; ?>'; }

<?php
	}
}
?>



else{ document.getElementById('valoraparelho').value = ''; }	

	

	

	}

else if(tipoassinatura == 'Nova Linha'){

var plano = document.getElementById('plano').value;

////////////// PLANO PRÉ ////////////////

<?php

foreach($aparelhos as $key=>$value)
{
	if($key==0)
	{

?>

if(plano == 'PRÉ FIXO 15' || plano == 'CONTROLE FIXO'){ 



if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_pre"]; ?>'; }

<?php

	}else{

?>

else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_pre"]; ?>'; }

<?php 
	}
}
?>


else{ document.getElementById('valoraparelho').value = '';  }
                                             }

////////////// PLANO CONTROLE ////////////////



else if(plano == 'FAV Local'){ 

<?php

foreach($aparelhos as $key=>$value)
{
	if($key==0)
	{

?>

if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_controle"]; ?>'; }
<?php

	}else{
		
?>


else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_controle"]; ?>'; }

<?php 

	}
}
?>


else{ document.getElementById('valoraparelho').value = ''; }
	}

////////////// PLANO PÓS ////////////////



else if(plano == 'FAV Local com DDD' || plano == 'FAV Local e DDD' || plano == 'FAV Local e DDD com Móvel'){ 

<?php

foreach($aparelhos as $key=>$value)
{
	if($key==0)
	{

?>

if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_pos"]; ?>'; }

<?php
	}else{
		
	?>

else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_pos"]; ?>'; }

<?php
	}
}
?>


else{ document.getElementById('valoraparelho').value = ''; }

                                                    }



else{ document.getElementById('valoraparelho').value = ''; }



}



else{ document.getElementById('valoraparelho').value = ''; }



                            }





/////////////////////////////









function mostrar(id){ document.getElementById(id).style.display = '' }





function esconder(id){ document.getElementById(id).style.display = 'none' }







function checkstatus(v){


if(v == 'CANCELADO'){ document.getElementById('mcancel').style.display = '';
					  document.getElementById('mrest').style.display = 'none';
					  document.getElementById('mdevo').style.display = 'none';
					  document.getElementById('mpend').style.display = 'none';
					  document.getElementById('obsrecupe').style.display = 'none';
			        } 

else if(v == 'RESTRIÇÃO'){ document.getElementById('mcancel').style.display = 'none';
					  document.getElementById('mrest').style.display = '';
					  document.getElementById('mdevo').style.display = 'none';
					  document.getElementById('mpend').style.display = 'none';
					  document.getElementById('obsrecupe').style.display = 'none';
			             }
						 
else if(v == 'DEVOLVIDO'){ document.getElementById('mcancel').style.display = 'none';
					  document.getElementById('mrest').style.display = 'none';
					  document.getElementById('mdevo').style.display = '';
					  document.getElementById('mpend').style.display = 'none';
					  document.getElementById('obsrecupe').style.display = 'none';
			             }						 

else if(v == 'AGUARDAR DOCUMENTOS'){ document.getElementById('mcancel').style.display = 'none';
					 		   document.getElementById('mrest').style.display = 'none';
							   document.getElementById('mdevo').style.display = 'none';
					           document.getElementById('mpend').style.display = '';
							   document.getElementById('obsrecupe').style.display = 'none';
			                 }

else if(v == 'DOCUMENTOS RECUSADOS' || v == 'ANEXAR DOCUMENTOS'){ document.getElementById('mcancel').style.display = 'none';
					 		   document.getElementById('mrest').style.display = 'none';
							   document.getElementById('mdevo').style.display = 'none';
					           document.getElementById('mpend').style.display = '';
							   document.getElementById('obsrecupe').style.display = 'none';
			                 }

							 
else if(v == 'RECUPERADO'){ document.getElementById('mcancel').style.display = 'none';
							document.getElementById('mrest').style.display = 'none';
							document.getElementById('mdevo').style.display = 'none';
							document.getElementById('mpend').style.display = 'none';
							document.getElementById('obsrecupe').style.display = '';  } 							 


else{ document.getElementById('mcancel').style.display = 'none';  
document.getElementById('motivocancelamento').value = "";

document.getElementById('mrest').style.display = 'none'; 	
document.getElementById('motivorestricao').value = "";

document.getElementById('mdevo').style.display = 'none';
document.getElementById('motivodevolvido').value = "";

document.getElementById('mpend').style.display = 'none';
document.getElementById('pendencia').value = "";

document.getElementById('maguardlb').style.display = 'none';
document.getElementById('dataliberacao').value = "";

document.getElementById('obsrecupe').style.display = 'none';
document.getElementById('obsrecuperacao').innerHTML = "";

}

}


function checkpendencia(v){

if(v == 'Cartão Não Autorizado'){ document.getElementById('maguardlb').style.display = '';  }

else {

document.getElementById('maguardlb').style.display = 'none';
document.getElementById('dataliberacao').value = "";

}
}


function verificaplano(v){

if(v == "10GB"){ document.getElementById('valor').value = '159,92'; }

else if(v == "5GB"){ document.getElementById('valor').value = '95,92'; }















else if(v == "3GB"){ document.getElementById('valor').value = '71,92'; }















else if(v == "2GB"){ document.getElementById('valor').value = '63,92'; }















else { document.getElementById('valor').value = '';}





}




///////////////////////////////////
///////// CHECAR CONTRATOS////////
/////////////////////////////////



function checkpropostas(p){















	















	$('#loadpropostas').load('check-propostas.php?p='+p+'&o=<?= $linha['proposta']?>');















	















	















	}































function checkcontratos(c){















	















	$('#loadcontratos').load('check-contratos.php?c='+c+'&o=<?= $linha['contrato']?>');
	

	
	













	















	















	}	















	















	















function checkoperador(m,op){















	















	















	$('#loadoperadores').load('check-operadores.php?m=' + m + '&o=' + op);















	















	















	}	































	

	$("#os").live('focusout', function() {
		os = $(this).val();
		$('#loados').load('check-os.php?os='+os+'');
	});







///////////////////////////////////////////







/////////////// VALIDAÇÃO ////////////////	







/////////////////////////////////////////































function validar(){
	
	

cpf = $('input[name="icpf"]').val();
gravacao = '<?= $linha['gravacao'];?>';
tecnico = $('select[name="tecnico"]').val();
datainstalacao = $('input[name="datainstalacao"]').val();
os = $('input[name="os"]').val();
ostam = os.length;
//////////	

status = $('select[name="status"]').val();
erro = 0;


// :: verifica os :: //
if(ostam > 0 && ostam < 8){
	

alert("OS Inválida");


$('input[name="os"]').focus();


erro = erro+1;

stop();
	
	
	
}



// Se DOCUMENTOS ANEXADOS	

if(status == 'DOCUMENTOS ANEXADOS' || status == 'AGUARDAR DOCUMENTOS'){


if(cpf == '' || cpf == '000.000.000-00' || cpf == '111.111.111-11')



{



alert("CPF Inválido");


$('input[name="icpf"]').focus();


erro = erro+1;

stop();

}	



if(erro == 0)		

if(gravacao == '' && status == 'DOCUMENTOS ANEXADOS')

{

alert("Status não permitido sem documentação!");
erro = erro+1;

}}




// Se FINALIZADA	











if(status == 'FINALIZADA'){















if(cpf == '' || cpf == '000.000.000-00' || cpf == '111.111.111-11')















{















alert("CPF Inválido");















$('input[name="icpf"]').focus();















erro = erro+1;















}	















if(erro == 0){		















if(gravacao == '')















{















alert("Status não permitido sem gravação!");















erro = erro+1;















}}











}























// Se Nada estiver errado:















if(erro == 0){






document.forms.editar.submit();


			}































				}















// Fim function







	










function validadata(val,id){
	
tam = val.length;
datastr = val.split("/");
novadata = datastr[2]+datastr[1]+datastr[0];

var dt = new Date();
ano = dt.getFullYear();
if((dt.getMonth() + 1) < 10){ mes = '0'+ (dt.getMonth() + 1); } else { mes = (dt.getMonth() + 1);}
if((dt.getDate() + 1) < 10){ dia = '0'+ dt.getDate(); } else { dia = dt.getDate();}

hoje = ano + "" + mes + "" + dia;

if(tam < 10 || novadata < hoje){
	
 $(id).stop().animate({backgroundColor: '#ffcece', border:"1px solid #ABABAB", padding:'1px', color:'#9a0000'},2000);	
	
	} else if(tam < 1 || tam >= 10) {
		
 $(id).stop().animate({backgroundColor: '#a2ff4f', color:'#428c00'},800, function(){
 $(id).animate({backgroundColor: '#ffffff', color:'#000000'},1200);
	 
	 });	
		
		
	}
	
	
	}


//

function validaos(val,id){
	
	
tam = val.length;


if(tam < 8){
	
 $(id).stop().animate({backgroundColor: '#ffcece', border:"1px solid #ABABAB", padding:'1px', color:'#9a0000'},2000);	
	
	} else if(tam < 1 || tam >= 8) {
		
 $(id).stop().animate({backgroundColor: '#a2ff4f', color:'#428c00'},800, function(){
 $(id).animate({backgroundColor: '#ffffff', color:'#000000'},1200);
	 
	 });	
		
		
	}
	
	
	}

//

function excluir(){if(confirm("Tem certeza que deseja excluir esta gravação?")){
	
	document.forms.excluirgravacao.submit();
	
	} }

</script>















<body onLoad="checkoperador('<?= $linha['monitor'];?>','<?= $linha['operador'];?>');">




<form name="excluirgravacao" action="" method="post">

<input type="hidden" name="excluirgravacao" />

</form>










<div id="topo">







<img src="img/LOGO-VENTO-p.png" />







</div>















<table border="0" width="100%" style="font-size:14px;">















<form id="formEditar" name="editar" action="" method="post">















<tr align="center" style="color:#999; font-size:18px; font-weight:bold;\">







<td colspan="2"><? if($editar == '1'){?> Editar Venda <? } else { ?>Detalhes da Venda <? } ?> <hr size="1" color="#ccc" /></td>







</tr>





<? if($linha['protocolo']) {?>
<tr align="center" style="color:#999; font-size:16px;">

<td colspan="2"><b>Protocolo:</b>
<?= $linha['protocolo']; ?></td>
</tr>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>
<? } ?>

















<tr>







<td><b>OS:</b></td>







<td>







<? /* if( ($linha['os'] ==""  || ($USUARIO['tipo_usuario'] =='ADMINISTRADOR' || $USUARIO['tipo_usuario'] =='AUDITOR' || $USUARIO['id']==3129)) && $editar == '1' || $editar_instalacao == '1') { */?>

<? if( ($USUARIO['tipo_usuario'] =='ADMINISTRADOR' || ($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO') && ($editar == '1' || $editar_instalacao == '1') ) ) {?>





<input type="text" name="os" id="os" size="40" onKeyPress="mascara(this,num);validaos(this.value,os);" onKeyUp="validaos(this.value,os);" onChange="mascara(this,num);validaos(this.value,os);" maxlength="8" value="<?= $linha['os']; ?>"  style="float:left;" />

<span id="loados" style="font-size:12px; float:left; position: absolute; margin-left: 15px;  margin-top: -8px;"></span>





<? } else { ?>















<?= $linha['os']; ?>







<input type="hidden" name="os" size="40" value="<?= $linha['os']; ?>" />















</td>















<? } ?>







</tr>























<tr>







<td><b>ESN:</b></td>







<td>







<? if( 
		(($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) &&
		($editar == '1' || $editar_instalacao == '1')
		)
		
		{?>







<span id="loadcontratos" style="font-size:12px;"></span>







<input id="autocomplete-ajax" type="text" name="esn" size="40" maxlength="14" value="<?= $linha['esn']; ?>" onKeyUp="checkcontratos(this.value)" onChange="checkcontratos(this.value)" />







<? } else { ?>















<?= $linha['esn']; ?>







<input type="hidden" name="esn" size="40" value="<?= $linha['esn']; ?>" />















</td>















<? } ?>







</tr>















<tr>







<td><b>Novo Número:</b></td>







<td>







<? if 	(( ($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO'))
		&& ($editar == '1' || $editar_instalacao == '1') ){?>







<span id="loadcontratos" style="font-size:12px;"></span>







<input type="text" name="novonumero" size="40" maxlength="15" onKeyPress="mascara(this,telefone)" onChange="mascara(this,telefone)" value="<?= $linha['novoNumero']; ?>" />







<? } else { ?>















<?= $linha['novoNumero']; ?>







<input type="hidden" name="novonumero" size="40" value="<?= $linha['novoNumero']; ?>" />















</td>















<? } ?>






<?php /* ################ CAMPO NUMERO DO CHIP ########################
</tr>
<tr>

<td><b>Número do Chip:</b></td>
<td>
<? if($editar == '1' || $editar_instalacao == '1') {?>
<input type="text" name="numchip" size="40" maxlength="15"  value="<?= $linha['numchip']; ?>" />
<? } else { ?>
<?= $linha['numchip']; ?>
<input type="hidden" name="numchip" size="40" value="<?= $linha['numchip']; ?>" />
</td>

<? } ?>
</tr>

*/ ###################################################################3?>












<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>















<tr>







<td><b>Cliente:</b></td>







<td>







<? if (	(($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="nome" size="40" value="<?= $linha['nome']; ?>" />







<? } else { ?>















<?= ucwords($linha['nome']); ?>







<input type="hidden" name="nome" size="40" value="<?= $linha['nome']; ?>" />















</td>















<? } ?>







</td>







</tr>















<tr>







<td><b>Nome da Mãe:</b></td>







<td>







<? if (	(($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="nomemae" size="40" value="<?= $linha['nome_mae']; ?>" />







<? } else { ?>















<?= ucwords($linha['nome_mae']); ?>







<input type="hidden" name="nomemae" size="40" value="<?= $linha['nome_mae']; ?>" />















</td>















<? } ?>







</td>







</tr>















<tr>



<td><b>Nascimento:</b></td>







<td>







<? 







$linhanascimento = explode('/',$linha['nascimento']);	















if ((($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
	($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){







	







	







?>







<select name="nascd" id="nascd">







<option value=""></option>







<? $d = 1; while($d <= 31){ $dn = $d++;?>







<option value="<?= sprintf("%02d", $dn); ?>" <? if($linhanascimento[0] == sprintf("%02d", $dn)){?> selected="selected"<? } ?>> <?= sprintf("%02d", $dn); ?></option>







<? } ?>







</select>















<select name="nascm" id="nascm">







<option value=""></option>







<? $m = 1; while($m <= 12){ $mn = $m++;?>







<option value="<?= sprintf("%02d", $mn); ?>"  <? if($linhanascimento[1] == sprintf("%02d", $mn)){?> selected="selected"<? } ?>> <?= sprintf("%02d", $mn); ?></option>







<? } ?>







</select>















<select name="nasca" id="nasca">







<option value=""></option>







<? $a = date('Y'); while($a > 1900){ $an = $a--;?>







<option value="<?= $an; ?>" <? if($linhanascimento[2] == $an){?> selected="selected"<? } ?>> <?= $an; ?></option>





<? } ?>







</select>







<? } else { ?>















<?= ucwords($linha['nascimento']); ?>







<input type="hidden" name="nascd" value="<?= $linhanascimento[0]; ?>" />







<input type="hidden" name="nascm" value="<?= $linhanascimento[1]; ?>" />







<input type="hidden" name="nasca" value="<?= $linhanascimento[2]; ?>" />















</td>















<? } ?>







</td>







</tr>















<tr>







<td><b>CPF/CNPJ:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="icpf" size="40" onKeyPress="mascara(this,cpf)" maxlength="14" value="<?= $linha['cpf']; ?>" />







<? } else { ?>















<?= $linha['cpf']; ?>







<input type="hidden" name="icpf" size="40" onKeyPress="mascara(this,cpf)" maxlength="14" value="<?= $linha['cpf']; ?>" />















</td>















<? } ?>







</td>







</tr>























<tr>







<td><b>RG:</b></td>







<td>







<? if ((($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1')) {?>







<input type="text" name="rg" size="40" value="<?= $linha['rg']; ?>" />







<? } else { ?>















<?= $linha['rg']; ?>







<input type="hidden" name="rg" size="40" value="<?= $linha['rg']; ?>" />















</td>















<? } ?>







</td>







</tr>















<tr>







<td><b>Org. Exp.:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="orgexp" size="40" value="<?= $linha['org_exp']; ?>" />







<? } else { ?>















<?= $linha['org_exp']; ?>







<input type="hidden" name="orgexp" size="40"  value="<?= $linha['org_exp']; ?>" />















</td>















<? } ?>







</td>







</tr>























<tr>







<td><b>Data Exp.:</b></td>







<td>















<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="dataexp" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_exp'] != ''){ echo substr($linha['data_exp'],6,2)."/".substr($linha['data_exp'],4,2)."/".substr($linha['data_exp'],0,4); } ?>" />







<? } else { ?>















<? if($linha['data_exp'] != ''){ echo substr($linha['data_exp'],6,2)."/".substr($linha['data_exp'],4,2)."/".substr($linha['data_exp'],0,4);} ?>















<input type="hidden" name="dataexp" value="<? if($linha['data_exp'] != ''){ echo substr($linha['data_exp'],6,2)."/".substr($linha['data_exp'],4,2)."/".substr($linha['data_exp'],0,4); } ?>" />















<? } ?>







</td>







</tr>















<tr>







<td><b>Profissão:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="profissao" size="40" value="<?= $linha['profissao']; ?>" />







<? } else { ?>















<?= $linha['profissao']; ?>







<input type="hidden" name="profissao" size="40" value="<?= $linha['profissao']; ?>" />















</td>















<? } ?>







</td>







</tr>























<tr>







<td><b>Sexo:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="radio" name="sexo" id="sexo1" <? if($linha['sexo'] == 'Masculino'){?> checked="checked" <? } ?> value="Masculino" /> Masculino 







<input type="radio" name="sexo" id="sexo2" <? if($linha['sexo'] == 'Feminino'){?> checked="checked" <? } ?> value="Feminino" /> Feminino







<? } else { ?>















<?= $linha['sexo']; ?>







<input type="hidden" name="sexo" size="40" value="<?= $linha['sexo']; ?>" />















</td>















<? } ?>







</td>







</tr>















<tr>







<td><b>Estado Civil:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<select name="estadocivil" id="estadocivil" >







<option value="Solteiro" <? if($linha['estado_civil'] == 'Solteiro'){?> selected="selected" <? } ?>>Solteiro</option>







<option value="Casado" <? if($linha['estado_civil'] == 'Casado'){?> selected="selected" <? } ?>>Casado</option>







<option value="Desquitado" <? if($linha['estado_civil'] == 'Desquitado'){?> selected="selected" <? } ?>>Desquitado</option>







<option value="Separado" <? if($linha['estado_civil'] == 'Separado'){?> selected="selected" <? } ?>>Separado</option>







<option value="Divorciado" <? if($linha['estado_civil'] == 'Divorciado'){?> selected="selected" <? } ?>>Divorciado</option> 







<option value="Viúvo" <? if($linha['estado_civil'] == 'Viúvo'){?> selected="selected" <? } ?>>Viúvo</option> 







</select>







<? } else { ?>















<?= $linha['estado_civil']; ?>







<input type="hidden" name="estadocivil" size="40" maxlength="14" value="<?= $linha['estado_civil']; ?>" />















</td>















<? } ?>







</td>







</tr>















<tr>







<td><b>Email:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="email" size="40" value="<?= $linha['email']; ?>" />







<? } else { ?>















<?= strtolower($linha['email']); ?>







<input type="hidden" name="email" size="40" value="<?= $linha['email']; ?>" />















</td>















<? } ?>







</td>







</tr>















<tr>







<td><b>Telefone:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="itelefone" size="20" onKeyPress="mascara(this,telefone)" maxlength="15" value="<?= $linha['telefone']; ?>" />







<select name="tipotel1">







<option value=""></option>







<option value="Residencial" <? if($linha['tipo_tel1'] == 'Residencial'){?> selected="selected" <? } ?>>Residencial</option> 







<option value="Celular" <? if($linha['tipo_tel1'] == 'Celular'){?> selected="selected" <? } ?>>Celular</option>







<option value="Comercial" <? if($linha['tipo_tel1'] == 'Comercial'){?> selected="selected" <? } ?>>Comercial</option>







</select>







<? } else { ?>















<?= $linha['telefone'].' <span style="color:#343434; font-size: 12px;">('.$linha['tipo_tel1'].')</span>'; ?>







<input type="hidden" name="itelefone" value="<?= $linha['telefone']; ?>" />







<input type="hidden" name="tipotel1" value="<?= $linha['tipo_tel1']?>" />







</td>















<? } ?>







</td>







</tr>















<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1' ) ){?>







<tr>







<td><b>Telefone2:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="itelefone2" size="20" onKeyPress="mascara(this,telefone)" maxlength="15" value="<?= $linha['telefone2']; ?>" />















<select name="tipotel2">







<option value=""></option>







<option value="Residencial" <? if($linha['tipo_tel2'] == 'Residencial'){?> selected="selected" <? } ?>>Residencial</option> 







<option value="Celular" <? if($linha['tipo_tel2'] == 'Celular'){?> selected="selected" <? } ?>>Celular</option>







<option value="Comercial" <? if($linha['tipo_tel2'] == 'Comercial'){?> selected="selected" <? } ?>>Comercial</option>







</select>







<? } else { ?>















<?= $linha['telefone2'].' <span style="color:#343434; font-size: 12px;">('.$linha['tipo_tel2'].')</span>'; ?>







<input type="hidden" name="itelefone2" value="<?= $linha['telefone2']; ?>" />







<input type="hidden" name="tipotel2" value="<?= $linha['tipo_tel2']?>" />















</td>







<? } ?>







</td>







</tr>







<? } ?>































<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1' ) ){?>







<tr>







<td><b>Telefone3:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" name="itelefone3" size="20" onKeyPress="mascara(this,telefone)" maxlength="15" value="<?= $linha['telefone3']; ?>" />















<select name="tipotel3">







<option value=""></option>







<option value="Residencial" <? if($linha['tipo_tel3'] == 'Residencial'){?> selected="selected" <? } ?>>Residencial</option> 







<option value="Celular" <? if($linha['tipo_tel3'] == 'Celular'){?> selected="selected" <? } ?>>Celular</option>







<option value="Comercial" <? if($linha['tipo_tel3'] == 'Comercial'){?> selected="selected" <? } ?>>Comercial</option>







</select>







<? } else { ?>















<?= $linha['telefone3'].' <span style="color:#343434; font-size: 12px;">('.$linha['tipo_tel3'].')</span>'; ?>







<input type="hidden" name="itelefone3" value="<?= $linha['telefone3']; ?>" />







<input type="hidden" name="tipotel3" value="<?= $linha['tipo_tel3']?>" />























</td>















<? } ?>







</td>







</tr>







<? } ?>















<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>























<tr>







<td><b>Endereço:</b></td>







<td>















<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" size="27" name="endereco" value="<?= $linha['endereco']; ?>" /> Nº: <input type="text" size="5" name="numero" value="<?= $linha['numero']; ?>" /> <br /> Lote: <input type="text" size="5" name="lote" value="<?= $linha['lote']; ?>" /> Quadra: <input type="text" size="5" name="quadra" value="<?= $linha['quadra']; ?>" />







<? } else { ?>















<? echo ucwords($linha['endereco']); if($linha['numero']){echo ', '.$linha['numero'];} if($linha['lote']){echo ' - Lote: '.$linha['lote'];} if($linha['quadra']){echo ' - Quadra: '.$linha['quadra'];} ?>







<input type="hidden" size="40" name="endereco" value="<?= $linha['endereco']; ?>" />







<input type="hidden" size="40" name="numero" value="<?= $linha['numero']; ?>" />







<input type="hidden" size="40" name="lote" value="<?= $linha['lote']; ?>" />







<input type="hidden" size="40" name="quadra" value="<?= $linha['quadra']; ?>" />















</td>















<? } ?>







</td>







</tr>















<tr>







<td><b>Complemento:</b></td>







<td>















<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" size="40" name="complemento" value="<?= $linha['complemento']; ?>" />







<? } else { ?>















<?= ucwords($linha['complemento']); ?>







<input type="hidden" size="40" name="complemento" value="<?= $linha['complemento']; ?>" />















</td>















<? } ?>







</td>







</tr>























<tr>







<td><b>Bairro:</b></td>







<td>















<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" size="40" name="bairro" value="<?= $linha['bairro']; ?>" />







<? } else { ?>















<?= ucwords($linha['bairro']); ?>







<input type="hidden" size="40" name="bairro" value="<?= $linha['bairro']; ?>" />















</td>















<? } ?>







</td>







</tr>























<tr>







<td><b>Cidade:</b></td>







<td>















<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){







	







$uf = $linha['uf'];	







?>















<input type="text" size="26" name="cidade" value="<?= $linha['cidade']; ?>" /> - <select name="uf">







<option value="AC" <? if($uf == 'AC'){ echo 'selected="selected"'; } ?>>AC</option>  







<option value="AL" <? if($uf == 'AL'){ echo 'selected="selected"'; } ?>>AL</option>  







<option value="AM" <? if($uf == 'AM'){ echo 'selected="selected"'; } ?>>AM</option>  







<option value="AP" <? if($uf == 'AP'){ echo 'selected="selected"'; } ?>>AP</option>  







<option value="BA" <? if($uf == 'BA'){ echo 'selected="selected"'; } ?>>BA</option>  







<option value="CE" <? if($uf == 'CE'){ echo 'selected="selected"'; } ?>>CE</option>  







<option value="DF" <? if($uf == 'DF'){ echo 'selected="selected"'; } ?>>DF</option>  







<option value="ES" <? if($uf == 'ES'){ echo 'selected="selected"'; } ?>>ES</option>  







<option value="GO" <? if($uf == 'GO'){ echo 'selected="selected"'; } ?>>GO</option>  







<option value="MA" <? if($uf == 'MA'){ echo 'selected="selected"'; } ?>>MA</option>  







<option value="MG" <? if($uf == 'MG'){ echo 'selected="selected"'; } ?>>MG</option>  







<option value="MS" <? if($uf == 'MS'){ echo 'selected="selected"'; } ?>>MS</option>  







<option value="MT" <? if($uf == 'MT'){ echo 'selected="selected"'; } ?>>MT</option>  







<option value="PA" <? if($uf == 'PA'){ echo 'selected="selected"'; } ?>>PA</option>  







<option value="PB" <? if($uf == 'PB'){ echo 'selected="selected"'; } ?>>PB</option>  







<option value="PE" <? if($uf == 'PE'){ echo 'selected="selected"'; } ?>>PE</option>  







<option value="PI" <? if($uf == 'PI'){ echo 'selected="selected"'; } ?>>PI</option>  







<option value="PR" <? if($uf == 'PR'){ echo 'selected="selected"'; } ?>>PR</option>  







<option value="RJ" <? if($uf == 'RJ' || $uf == ''){ echo 'selected="selected"'; } ?>>RJ</option>  







<option value="RN" <? if($uf == 'RN'){ echo 'selected="selected"'; } ?>>RN</option>  







<option value="RO" <? if($uf == 'RO'){ echo 'selected="selected"'; } ?>>RO</option>  







<option value="RR" <? if($uf == 'RR'){ echo 'selected="selected"'; } ?>>RR</option>  







<option value="RS" <? if($uf == 'RS'){ echo 'selected="selected"'; } ?>>RS</option>  







<option value="SC" <? if($uf == 'SC'){ echo 'selected="selected"'; } ?>>SC</option>  







<option value="SE" <? if($uf == 'SE'){ echo 'selected="selected"'; } ?>>SE</option>  







<option value="SP" <? if($uf == 'SP'){ echo 'selected="selected"'; } ?>>SP</option>  







<option value="TO" <? if($uf == 'TO'){ echo 'selected="selected"'; } ?>>TO</option> 







</select>







<? } else { ?>























<?= ucwords($linha['cidade'].' - '.$linha['uf']); ?>







<input type="hidden" size="26" name="cidade" value="<?= $linha['cidade']; ?>" />







<input type="hidden" size="26" name="uf" value="<?= $linha['uf']; ?>" />















</td>















<? } ?>







</td>







</tr>























<tr>







<td><b>CEP:</b></td>







<td>















<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<input type="text" size="40" name="icep" onKeyPress="mascara(this,cep)" maxlength="9" value="<?= $linha['cep']; ?>" />







<? } else { ?>















<?= $linha['cep']; ?>







<input type="hidden" size="40" name="icep" onKeyPress="mascara(this,cep)" maxlength="9" value="<?= $linha['cep']; ?>" />















</td>















<? } ?>







</td>







</tr>























<tr>







<td><b>Ponto Ref.:</b></td>







<td><? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<textarea name="pontoref" rows="3" cols="30"><?= $linha['ponto_referencia']; ?></textarea>







<? } else { ?>















<?= $linha['ponto_referencia']; ?>







<input type="hidden" name="pontoref" value="<?= $linha['ponto_referencia']; ?>" />























<? } ?></td>






</tr>















<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>















<tr align="left">







<td><b>Monitor:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>







<select type="text" id="monitor" name="monitor" onChange="checkoperador(this.value,'<?= $linha['operador'];?>')">







<option value=""></option>







<? 















$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE grupo LIKE '%0003%' && tipo_usuario = 'MONITOR' ORDER BY nome ASC");







while($MONITORES = mysql_fetch_array($conMONITORES)){















?>







<option value="<?= $MONITORES['id'];?>" <? if($linha['monitor'] == $MONITORES['id']){?> selected="selected" <? } ?>><?= $MONITORES['nome'];?></option>







<? } ?>















</select> 















<? } else {















$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE id = '".$linha['monitor']."' ORDER BY nome ASC");







$MONITORES = mysql_fetch_array($conMONITORES);	







	?>















<?= $MONITORES['nome']; ?>







<input type="hidden" name="monitor" value="<?= $linha['monitor']; ?>" />















<? } ?>















</td>







</tr>























<tr align="left">







<td><b>Operador:</b></td>







<td>







<?







$conOPERADORES1 = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$linha['operador']."'");







$OPERADORES1 = mysql_fetch_array($conOPERADORES1);	















if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {
		















?>







<!--







<div id="loadoperadores" style="position:relative"></div> 







-->







<select type="text" id="operador" name="operador">







<option value="<?= $linha['operador']; ?>"><?= $OPERADORES1['nome'];?></option>







<option value="<?= $linha['operador']; ?>"></option>







<? 















$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE grupo LIKE '%0003%' && status != 'DESLIGADO' ORDER BY nome ASC");







while($OPERADORES = mysql_fetch_array($conOPERADORES)){















?>















<option value="<?= $OPERADORES['operador_id'];?>" <? if($linha['operador'] == $OPERADORES['operador_id']){?> selected="selected" <? } ?>>







<?= $OPERADORES['nome'];?>







</option>















<? } ?>















</select>







<? } else { ?>















<?= $OPERADORES1['nome']; ?>







<input type="hidden" name="operador" value="<?= $linha['operador']; ?>" />















<? } ?>















</td>







</tr>















<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>







<tr>

<td><b>Tipo Linha:</b></td>

<td>

<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<select name="tipolinha" id="tipolinha">

<option value=""></option>

<option value="Residencial" <? if($linha['tipoLinha'] == 'Residencial'){?>selected="selected"<? } ?>>Residencial</option>

<option value="Comercial" <? if($linha['tipoLinha'] == 'Comercial'){?>selected="selected"<? } ?>>Comercial</option>

</select>



<? } else { ?>



<?= $linha['tipoLinha']; ?>



<input type="hidden" name="tipolinha" value="<?= $linha['tipoLinha']; ?>" />



<? } ?>

</td>

</tr>







<tr>

<td><b>Tipo Assinatura:</b></td>

<td>



<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>

<select name="tipoassinatura" id="tipoassinatura" onChange="verificaassinatura(this.value);">

<option value=""></option>

<option value="Nova Linha" <? if($linha['tipoAssinatura'] == 'Nova Linha'){?>selected="selected"<? } ?>>Nova Linha</option>

<option value="Portabilidade" <? if($linha['tipoAssinatura'] == 'Portabilidade'){?>selected="selected"<? } ?>>Portabilidade</option>

<option value="Reposição" <? if($linha['tipoAssinatura'] == 'Reposição'){?>selected="selected"<? } ?>>Reposição</option>

</select>



<? } else { ?>



<?= $linha['tipoAssinatura']; ?>



<input type="hidden" name="tipoassinatura" value="<?= $linha['tipoAssinatura']; ?>" />


<? } ?>

</td>

</tr>





<tr>

<td><b>Tipo Plano:</b></td>

<td>

<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<select name="tipoplano" id="tipoplano" onChange="verificatipoplano(this.value);">

<option value="<?= $linha['tipoPlano']; ?>"><?= $linha['tipoPlano']; ?></option>

</select>

<? } else { ?>

<?= $linha['tipoPlano']; ?>

<input type="hidden" name="tipoplano" value="<?= $linha['tipoPlano']; ?>" />

<? } ?>

</td>

</tr>





<tr align="left">

<td><b>Plano:</b></td>

<td>

<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<select name="plano" id="plano" onChange="verificaplanos(this.value);">

<option value="<?= $linha['plano']; ?>"><?= $linha['plano']; ?></option>

</select>

<? } else { ?>

<?= $linha['plano']; ?>

<input type="hidden" name="plano" value="<?= $linha['plano']; ?>" />

<? } ?>

</td>

</tr>



<tr align="left">

<td><b>Valor Plano:</b></td>

<td> <? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>
		<span style="font-size:12px; color:#999; font-style:italic">R$</span> <input type="text" id="valorplano" name="valorplano" readonly size="8" maxlength="10"  value="<?= $linha['valorPlano']; ?>" />



<? } else { ?>

<?= $linha['valorPlano']; ?>

<input type="hidden" name="valorplano" value="<?= $linha['valorPlano']; ?>" />

<? } ?>

</td>

</tr>





<tr align="left">

<td><b>Aparelho:</b></td>

<td>

<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<select name="aparelho" id="aparelho" onChange="verificaaparelho(this.value);">

<?php



if ($linha['status'] != "FINALIZADA")
{
	
	$modelosAparelhos = $estoque->getModelosAparelhosEstoque($linha["monitor"]);
	?>
	
	<option id="19" value="0">N&atilde;o Selecionado</option>
	
	
	<?
	$achouAparelho = false;
	
	foreach($modelosAparelhos as $id=>$aparelho)
	{


		$sel = "";
		if ($id==$linha['aparelho']) { $sel = "selected=\"selected\""; $achouAparelho = true; }

		?>
		<option id="<?=$linha["monitor"];?>" value="<?= $id; ?>" <?=$sel?>><?= $aparelho; ?></option>
		<?


	}
	
		if(ctype_digit($linha["aparelho"]) && $linha['aparelho']!="0" && $achouAparelho==false)
		{
			$apInfo = $estoque->getAparelho($linha['aparelho']);
			?>
			<option id="<?=$linha["monitor"];?>" value="<?= $linha['aparelho']; ?>" selected="selected"><? echo $apInfo["marca"] . " - " . $apInfo["modelo"]; ?></option>
			<?
		}elseif(((!ctype_digit($linha["aparelho"])) || ($linha['aparelho']=="0")) && $achouAparelho==false){
			?>
			<option id="<?=$linha["monitor"];?>" value="<?= $linha['aparelho']; ?>" selected="selected"><? echo $linha["aparelho"]; ?></option>
			<?


		}


}elseif ($linha['aparelho'] != "" && $linha['aparelho'] != "0" && $linha['status'] == "FINALIZADA")

{
	$modelosAparelhos = $estoque->getModelosAparelhosEstoque($linha["monitor"]);
	
	$achouAparelho = false;
	
	foreach($modelosAparelhos as $id=>$aparelho)
	{


		$sel = "";
		if ($id==$linha['aparelho']) { $sel = "selected=\"selected\""; $achouAparelho = true; }

		?>
		<option id="<?=$linha["monitor"];?>" value="<?= $id; ?>" <?=$sel?>><?= $aparelho; ?></option>
		<?


	}
	
		if(ctype_digit($linha["aparelho"]) && $linha['aparelho']!="0" && $achouAparelho==false)
		{
			$apInfo = $estoque->getAparelho($linha['aparelho']);
			?>
			<option id="<?=$linha["monitor"];?>" value="<?= $linha['aparelho']; ?>" selected="selected"><? echo $apInfo["marca"] . " - " . $apInfo["modelo"]; ?></option>
			<?
		}elseif(((!ctype_digit($linha["aparelho"])) || ($linha['aparelho']=="0")) && $achouAparelho==false){
			?>
			<option id="<?=$linha["monitor"];?>" value="<?= $linha['aparelho']; ?>" selected="selected"><? echo $linha["aparelho"]; ?></option>
			<?


		}

}
	?>

</select>

<? } else { 

	if(ctype_digit($linha['aparelho']) && $linha['aparelho']!="0")
	{

	$apInfo = $estoque->getAparelho($linha['aparelho']);
	
	echo $apInfo["marca"] . " - " . $apInfo["modelo"]; 
	
	}else{
	
	echo $linha['aparelho'];
	
	}
	
	?>

<input type="hidden" name="aparelho" value="<?= $linha['aparelho']; ?>" />

<? } ?>

</td>

</tr>


<tr align="left">

<td><b>Valor Aparelho:</b></td>

<td> <? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?> <span style="font-size:12px; color:#999; font-style:italic">R$</span> <input type="text" id="valoraparelho" name="valoraparelho" readonly size="8" maxlength="10" value="<?= $linha['valorAparelho']; ?>" />

<? } else { ?>

<?= $linha['valorAparelho']; ?>

<input type="hidden" name="valorAparelho" value="<?= $linha['valorAparelho']; ?>" />

<? } ?>

</td>

</tr>

<tr>
<td><b>Tipo de Entrega:</b></td>
<td>
<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<select name="tipoEntrega" id="tipoEntrega">

<option value="PRONTA ENTREGA" <? if($linha['tipoEntrega'] == 'PRONTA ENTREGA'){?>selected="selected"<? } ?>>PRONTA ENTREGA</option>
<?php
if(! ($USUARIO["tipo_usuario"]=="MONITOR" && $USUARIO["acesso_usuario"]=="EXTERNO") )
{
?>
<option value="EMBRATEL" <? if($linha['tipoEntrega'] == 'EMBRATEL'){?>selected="selected"<? } ?>>EMBRATEL</option>

<!-- 
<option value="MOTOBOY INTERNO" <?// if($linha['tipoEntrega'] == 'MOTOBOY INTERNO'){?>selected="selected"<?// } ?>>MOTOBOY INTERNO</option>

<option value="MOTOBOY EXTERNO" <?// if($linha['tipoEntrega'] == 'MOTOBOY EXTERNO'){?>selected="selected"<?// } ?>>MOTOBOY EXTERNO</option>
-->

<?php } ?>



</select>

<? } else { ?>
<?= $linha['tipoEntrega']; ?>
<input type="hidden" name="tipoEntrega" value="<?= $linha['tipoEntrega']; ?>" />
<? } ?>
</td>
</tr>


<tr align="left">

<td><b>Pagamento:</b></td>

<td>

<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<select name="pagamento" id="pagamento" onChange="verificapagamento(this.value);">

<?php

if(! ($USUARIO["tipo_usuario"]=="MONITOR" && $USUARIO["acesso_usuario"]=="EXTERNO") )
{
	
?>
<option value="BOLETO" <? if($linha['pagamento'] == 'BOLETO'){?>selected="selected"<? } ?>>BOLETO</option>

<option value="CARTÃO DE CRÉDITO" <? if($linha['pagamento'] == 'CARTÃO DE CRÉDITO'){?>selected="selected"<? } ?>>CARTÃO DE CRÉDITO</option>

<!--
<option value="DEPÓSITO" <?// if($linha['pagamento'] == 'DEPÓSITO'){?>selected="selected"<?// } ?>>DEPÓSITO</option>

<option value="GRÁTIS" <?// if($linha['pagamento'] == 'GRÁTIS'){?>selected="selected"<?// } ?>>GRÁTIS</option>

<option value="PAGSEGURO" <?// if($linha['pagamento'] == 'PAGSEGURO'){?>selected="selected"<?// } ?>>PAGSEGURO</option>
 -->

<?php

}

?>

<?php if($linha['tipoEntrega']=='PRONTA ENTREGA') { ?>
<option value="DINHEIRO" <? if($linha['pagamento'] == 'DINHEIRO'){?>selected="selected"<? } ?>>DINHEIRO</option>
<? } ?>

<? if($linha['pagamento'] == 'PRONTA ENTREGA'){?><option value="PRONTA ENTREGA" selected="selected">PRONTA ENTREGA</option><? } ?>


</select>


<? } else { ?>


<?= $linha['pagamento']; ?>

<input type="hidden" id="pagamento" name="pagamento" value="<?= $linha['pagamento']; ?>" />

<? } ?>

</td>

</tr>

<tr id="idbancodep" <? if($linha['pagamento'] != 'DEPÓSITO'){?> style="display:none" <? } ?>>

<td><b>Banco:</b></td>



<td>

<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>



<input type="text" id="banco_deposito" name="banco_deposito" size="20" value="<?= $linha['banco_deposito'];?>" /> <b>AG:</b> <input type="text" name="agencia_deposito" id="agencia_deposito" size="5" value="<?= $linha['agencia_deposito'];?>" /> <b>CC:</b> <input type="text" name="contacorrente_deposito" id="contacorrente_deposito" size="7" value="<?= $linha['contacorrente_deposito'];?>" />



<? } else {?>



<?= $linha['banco_deposito'].' <b>AG:</b> '.$linha['agencia_deposito'].' <b>CC:</b> '.$linha['contacorrente_deposito'];?>

<input type="hidden" size="40" name="banco_deposito" value="<?= $linha['banco_deposito']; ?>" />

<input type="hidden" size="40" name="agencia_deposito" value="<?= $linha['agencia_deposito']; ?>" />

<input type="hidden" size="40" name="contacorrente_deposito" value="<?= $linha['contacorrente_deposito']; ?>" />





<? } ?>

 </td>

</tr>



<tr id="pagseguroid" <? if($linha['pagamento'] != 'PAGSEGURO'){?> style="display:none" <? } ?>>
<td><b>Indentificação Pagseguro:</b></td>
<td>
<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<input type="text" name="id_pagseguro" size="40" value="<?= $linha['id_pagseguro']; ?>" />
<? } else { ?>
<?= $linha['id_pagseguro']; ?>
<input type="hidden" name="id_pagseguro" value="<?= $linha['id_pagseguro']; ?>" />
<? } ?>
</td>
</tr>


<tr>

<td>
	
	<? include "includes/agendamento-entrega.php";?>

</td>

</tr>




<tr>
<td><b>Data da Venda:</b></td>
<td>
<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<input type="text" name="idata" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>" />
<? } else { ?>
<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>
<input type="hidden" name="idata" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>" />
<? } ?>
</td>
</tr>





<tr>







<td><b>Vencimento:</b></td>







<td>







<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>















<input type="text" name="vencimento" size="4" value="<?=$linha['vencimento'];?>" /> 















<? } else { ?>















<?= $linha['vencimento']; ?>







<input type="hidden" name="vencimento" size="4" value="<?=$linha['vencimento'];?>" /> 























<? } ?>















</td>







</tr>















<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<? if($linha['pagamento'] == 'CARTÃO DE CRÉDITO'){ ?>


<tr>

<td><b>Nome do Titular:</b></td>
<td>

<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ){?>

<input type="text" name="titularCartao" size="30" value="<?=$linha['titularCartao'];?>" /> <span style="font-size:12px; color:#999; font-style:italic">(Nome impresso no cartão)</span>

<? } else {

if($linha['numCar']){ echo $linha['titularCartao']; } ?>

<input type="hidden" name="titularCartao" size="50" value="<?=$linha['titularCartao'];?>" /> 

<? } ?>

</td>
</tr>



<tr>
<td><b>Cartão Crédito:</b></td>
<td>
<? 

if( $linha['status'] == 'DOCUMENTOS ANEXADOS'){

$numDecoCartao = base64_decode($linha['numCar']);
} else {

if($linha['numCar'] != ''){		
$numDecoCartao = 'XXXX-XXXX-XXXX-'.substr(base64_decode($linha['numCar']),15,4);
} else{ $numDecoCartao = "";}

}

if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<input type="text" name="numcartao" size="50" onKeyPress="mascara(this,cartaocredito)" onChange="mascara(this,cartaocredito)" maxlength="19" value="<?=$numDecoCartao;?>" /> 

<? } else { 

if($linha['numCar']){ echo 'XXXX-XXXX-XXXX-'.substr(base64_decode($linha['numCar']),15,4); } ?>
<input type="hidden" name="numcartao" size="50" value="<?=$linha['numCar'];?>" /> 

<? } ?>
</td>
</tr>


<tr>
<td><b>Cód. Segurança:</b></td>
<td>
<? 
if( $linha['status'] == 'DOCUMENTOS ANEXADOS'){
$numDecoCodSeg = $linha['codSeg'];
} else {

if($linha['codSeg'] != ''){	

$numDecoCodSeg = 'XX'.substr($linha['codSeg'],2,1);

} else { $numDecoCodSeg = "";}

}

if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<input type="text" name="numcodseguranca" size="50" onKeyPress="mascara(this,cartaocredito)" onChange="mascara(this,cartaocredito)" maxlength="3" value="<?=$numDecoCodSeg;?>" /> 

<? } else { 

if($linha['numCar']){ echo 'XX'.substr($linha['codSeg'],2,1); } ?>
<input type="hidden" name="numcodseguranca" size="50" value="<?=$linha['codSeg'];?>" /> 
<? } ?>
</td>
</tr>

<tr>
<td><b>Validade:</b></td>
<td>

<? 
$ValidadeCartao = explode('/',$linha['carVal']);

if($editar == '1') {?>
<select name="mesval">
<option value=""></option>
<? for($i=1;$i<=12;$i++){ ?>
<option value="<?= sprintf("%02d",$i);?>" <? if($i == $ValidadeCartao[0]){?> selected="selected" <? } ?>><?= sprintf("%02d",$i);?></option>
<? } ?>
</select>

<select name="anoval">
<option value=""></option>
<? for($i=date('Y');$i<=(date('Y')+15);$i++){ ?>
<option value="<?= sprintf("%02d",$i);?>" <? if($i == $ValidadeCartao[1]){?> selected="selected" <? } ?>><?= sprintf("%02d",$i);?></option>
<? } ?>
</select>

<? } else { 

if($linha['numCar']){ echo $linha['carVal']; } ?>

<input type="hidden" name="numcartao" size="50" value="<?=$linha['carVal'];?>" /> 

<? } ?>

</td>
</tr>


<tr>

<td><b>Bandeira:</b></td>
<td>

<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<select name="carbandeira">
<option value=""></option>
<option value="Visa" <? if($linha['carBan'] == 'Visa'){?> selected="selected" <? } ?>>Visa</option>
<option value="MasterCard" <? if($linha['carBan'] == 'MasterCard'){?> selected="selected" <? } ?>>MasterCard</option>
</select>

<? } else {

if($linha['numCar']){ echo $linha['carBan']; } ?>

<input type="hidden" name="carbandeira" size="50" value="<?=$linha['carBan'];?>" /> 

<? } ?>

</td>
</tr>


<tr>
<td><b>Parcelas:</b></td>
<td>

<? 

if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1') ) {?>

<select name="numparcelas">
<option value=""></option>
<option value="8" <? if($linha['numParcelas'] == '8'){?> selected="selected" <? } ?>>8</option>
<option value="11" <? if($linha['numParcelas'] == '11'){?> selected="selected" <? } ?>>11</option>
<option value="20" <? if($linha['numParcelas'] == '20'){?> selected="selected" <? } ?>>20</option>
<option value="25" <? if($linha['numParcelas'] == '25'){?> selected="selected" <? } ?>>25</option>
</select>


<? } else { 

if($linha['numCar']){ echo $linha['numParcelas']; } ?>

<input type="hidden" name="numparcelas" size="50" value="<?=$linha['numParcelas'];?>" /> 

<? } ?>

</td>
</tr>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<? } ?>

<?php /* // ########################## INICIO CODIGO ORIGINAL GRAVACOES #########################
<?

$conGravacaoRetirada = $conexao->query("SELECT *, 
												usuarios.nome AS nome,
												DATE_FORMAT(log_sistema.data, '%d/%m/%Y às %H:%i:%s') AS dataevento
												FROM log_sistema 
												INNER JOIN usuarios
												ON usuarios.id = log_sistema.usuario
												WHERE  
												log_sistema.evento LIKE '%Excluiu uma gravação%' && 
												log_sistema.evento LIKE '%(ID: ".$_GET['id'].")%' 
												ORDER BY log_sistema.id ASC
										");
										
while($GravacaoRetirada = mysql_fetch_array($conGravacaoRetirada)){										

$gravacaoRE = explode('[',$GravacaoRetirada['evento']);
$gravacaoRE = explode(']',$gravacaoRE[1]);
$gravacaoRE = $gravacaoRE[0];

?>

<tr>
<td><b>Gravação retirada:</b></td>
<td>
<img src="img/play-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Ouvir Gravação" onClick="javascript:window.location = 'http://172.16.0.30/audio/clarofixo/orig/<?= $gravacaoRE;?>'" /> <span style="font-size:13px;">Ouvir Gravação </span>
<br />
<span style="color:#787878; font-size:11px;">
<b>Retirada por:</b> <?= $GravacaoRetirada['nome'];?>&nbsp;
em <?= $GravacaoRetirada['dataevento'];?>
</span>
</td>
</tr>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<? } ?>

<tr>

<td><b>Gravação:</b></td>

<td>

<? if($linha['gravacao'] == '' && $USUARIO['inserir_gravacao'] == '1'){?>
<img src="img/record.png" width="20" align="absmiddle" style="cursor:pointer" title="Inserir Gravação" onClick="window.location = 'upload-gravacao-simples-clarofixo.php?id=<?= $linha['id'];?>&u=<?= $USUARIO['id'];?>'" /> <span style="font-size:13px;">Inserir Gravação </span>

<? } else if($linha['gravacao'] != '') {?>

<img src="img/play-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Ouvir Gravação" onClick="javascript:window.location = 'http://172.16.0.30/audio/clarofixo/orig/<?= $linha['gravacao'];?>'" /> <span style="font-size:13px;">Ouvir Gravação </span>
&nbsp; &nbsp; &nbsp;


<? if($editar == 1){?>
<img src="img/delete-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Excluir Gravação" onClick="javascript:excluir();" /> <span style="font-size:13px;">Excluir Gravação </span>
<? } ?>

<? } ?>
</td>

</tr>




 // ########################## FIM CODIGO ORIGINAL GRAVACOES ######################### */ ?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>
<tr>

<td valign="top"><b>Documento:</b></td>

<?php

	if($linha['gravacao'] == '' && $USUARIO['inserir_gravacao'] == '1' && $editar==1 || 1==1)
	{
	?>	
	
		<td style="font-size:12px;">
			<?php
			
			$documentos = array();
			
			if( substr($linha['gravacao'], 0,1) != '[' )
			{
				if( $linha['gravacao'] != '' )
				{
					$documentos = (string) $linha['gravacao'];
				}
			
			}else{
				
				$documentos = json_decode($linha['gravacao'], true);
			}
			
			?>
			
			<?php
			
			if( gettype($documentos) == 'array')
			{
				foreach($documentos as $documento)
				{
			?>

				<?php

				if( strstr($documento, 'ident') )
				{
				
					echo "Identidade: ";
				
				}elseif( strstr($documento, 'cpf') ){
					
					echo "CPF: ";
					
				}else{
					
					echo "Comprovante: ";
				}
				
				$t1 = explode(".", $documento);
				$t2 = explode("-", $t1[0]);
				
				$time = $t2[count($t2)-1];
				?>
				<a href="#" onclick="Popup=window.open('upload/documentos/<?php echo $documento; ?>','Popup-doc','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,left=430,top=30');"> <?php echo $documento; ?></a> ( Em: <?php echo date("d/m/Y", $time);?> )<br><br>
			<?php
				}
			}else{
				?>
				<a href="#" onclick="Popup=window.open('upload/documentos/<?php echo $linha['gravacao']; ?>','Popup-doc','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,left=430,top=30');"> <?php echo $linha['gravacao']; ?></a><br><br>
			<?php
			}
			?>
			<select id="tipo_documento" name="tipo_documento">
				<option value="cpf">CPF</option>
				<option value="ident">Identidade</option>
				<option value="comp_res">Comprovante de Residência</option>
			</select>
			<input id="file" type="file" name="arquivo" style="border-left: 1px solid #CCCCCC; padding-left:3px;display:block; float:left; clear:both;" />
		</td>
	
	<?php	
	}elseif ( ($linha['gravacao'] != '') ) {
		
	?>	

		<td>
			<a href="#" onclick="Popup=window.open('upload/documentos/<?php echo $linha['gravacao']; ?>','Popup-doc','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,left=430,top=30');"> <?php echo $linha['gravacao']; ?></a>
		</td>
		
	<?php
	}

?>



</tr>

<tr>

<td><b>Auditor:</b></td>

<td>

<? 

$conAUDITOR = $conexao->query("SELECT * FROM usuarios WHERE id='".$linha['auditor']."'");
$AUDITOR = mysql_fetch_array($conAUDITOR);

echo $AUDITOR['nome'];

?></td>

</tr>

<tr><td colspan="2"><hr size="1" style="border-bottom: 1px dashed #EDEDED;" color="#FFF" /></td></tr>

<?php 

if( $linha['ultimo_envio_documentos']!='' && $linha['ultimo_envio_documentos']!='0000-00-00' )
{

?>
	<input type="hidden" name="ultimo_envio_documentos" value="<?=$linha['ultimo_envio_documentos'];?>" />
	
	<tr>
	
	<?php 
		if( $linha['historico_envio_documentos'] == '' )
		{
			
			$labelDocumentos = 'Doc. enviados:';
			
		}else{
			
			$labelDocumentos = 'Últ. envio doc. :';
		}
	?>

	<td><b><?php echo $labelDocumentos; ?></b></td>
	
	<td> <?php echo date("d/m/Y", strtotime( $linha['ultimo_envio_documentos'] ) ); ?> </td>
	</tr>

<?php 

}
?>

<?php 

if( $linha['historico_envio_documentos']!='' )
{
?>
	<input type="hidden" name="historico_envio_documentos" value="<?=$linha['historico_envio_documentos'];?>" />
	
	<tr>

	<td></td>
	
	<td style="font-size:12px;">
		<br />
		<?php
		
			$datasEnvios = json_decode ( $linha['historico_envio_documentos'] );
			
			$labelHistorico = "Primeiro envio: ";
			
			foreach($datasEnvios as $dataEnvio)
			{
				
				echo $labelHistorico . date("d/m/Y", strtotime($dataEnvio)), "<br>";
				$labelHistorico = 'Reenviado em: ';
			}
		
		?>

	</td>
	</tr>

<?php 

}
?>

<? 
$tipoOBS = '1';
include "includes/observacoes.php";
?>


<? if($linha['obs_gravacao']){?>
<tr><td colspan="2"><hr size="1" style="border-bottom: 1px dashed #EDEDED;" color="#FFF" /></td></tr>		

<tr>
<td><b>Obs.:</b></td>
<td>

<?= $linha['obs_gravacao'];?>
</td>
</tr>

<? } ?>

<?php /* ################ AGENDAMENTO DE GRAVACAO DESABILITADO ########

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


<? include "includes/agendamento-gravacao.php";?>

*/ ########################################################################

?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>















<tr>







<td><b>Data Entrega:</b></td>







<td>















<? if ( (($USUARIO['tipo_usuario'] =='ADMINISTRADOR') ||
		($USUARIO['tipo_usuario'] =='AUDITOR' && $linha['status'] == 'PRE-ANALISE') || ($USUARIO['tipo_usuario'] == 'MONITORBO' &&
$linha['status'] != 'PRE-ANALISE' && $linha['status'] != 'RESTRIÇÃO' && $linha['status'] != 'SEM COBERTURA' && $linha['status'] != 'REDIRECIONADO')) && ($editar == '1' || $editar_instalacao == '1') ) {?>







<input type="text" name="dataentrega" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_marcada'] != ''){ echo substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4); } ?>" />







<? } else { ?>















<? if($linha['data_marcada'] != ''){ echo substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4);} ?>















<input type="hidden" name="dataentrega" value="<? if($linha['data_marcada'] != ''){ echo substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4); } ?>" />















<? } ?>







</td>







</tr>

<? 
$tipoOBS = '2';
include "includes/observacoes.php";
?>


<? if($linha['obs1']){ ?>
<tr><td colspan="2"><hr size="1" style="border-bottom: 1px dashed #EDEDED;" color="#FFF" /></td></tr>		

<tr>
<td><b>Obs.:</b></td>
<td>
<?= $linha['obs1']; ?>
</td>
</tr>
<? } ?>




<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


<tr>
<td><b>Data Finalizada:</b></td>
<td>

<? if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){ ?>

<input type="text" name="datainstalacao" placeholder="ex:(dd/mm/aaaa)" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_instalacao'] != ''){ echo substr($linha['data_instalacao'],6,2)."/".substr($linha['data_instalacao'],4,2)."/".substr($linha['data_instalacao'],0,4); } ?>" />

<? } else {?>

<? echo substr($linha['data_instalacao'],6,2)."/".substr($linha['data_instalacao'],4,2)."/".substr($linha['data_instalacao'],0,4); ?>
<input type="hidden" name="datainstalacao" value="<? if($linha['data_instalacao'] != ''){ echo substr($linha['data_instalacao'],6,2)."/".substr($linha['data_instalacao'],4,2)."/".substr($linha['data_instalacao'],0,4); } ?>" />

<? } ?>


</td>
</tr>


<? 
$tipoOBS = '3';
include "includes/observacoes.php";
?>

<? if($linha['obs']){ ?>
<tr><td colspan="2"><hr size="1" style="border-bottom: 1px dashed #EDEDED;" color="#FFF" /></td></tr>		

<tr>
<td><b>Obs.:</b></td>
<td>
<?= $linha['obs']; ?>
</td>

</tr>
<? } ?>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


<tr>
<td><b>Status:</b></td>
<td>
<?php /*
<? if ($linha['status']=='FINALIZADA') {?>

<select id="status" name="status" onChange="checkstatus(this.value)">
<option value="FINALIZADA" <? if($linha['status'] == 'FINALIZADA'){?>selected="selected"<? } ?>>Finalizada</option>

</select>

<?} elseif($editar == '1' && ($USUARIO['tipo_usuario'] == 'ADMINISTRADOR' || ($USUARIO['id'] == '2' || $USUARIO['id'] == '3140'))){?>  


<select id="status" name="status" onChange="checkstatus(this.value)">
<option value="AUTORIZADA" <? if($linha['status'] == 'AUTORIZADA'){?>selected="selected"<? } ?>>Autorizada</option>
<option value="ATIVADO" <? if($linha['status'] == 'ATIVADO'){?>selected="selected"<? } ?>>Ativado</option>
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
<option value="PRE-ANALISE" <? if($linha['status'] == 'PRE-ANALISE'){?>selected="selected"<? } ?>>Pré-Análise</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>
<option value="AGUARDAR DOCUMENTOS" <? if($linha['status'] == 'AGUARDAR DOCUMENTOS'){?>selected="selected"<? } ?>>Aguardar Documentos</option>
<option value="FINALIZADA" <? if($linha['status'] == 'FINALIZADA'){?>selected="selected"<? } ?>>Finalizada</option>
<option value="ANEXAR DOCUMENTOS" <? if($linha['status'] == 'ANEXAR DOCUMENTOS'){?>selected="selected"<? } ?>>Anexar Documentos</option>
<option value="REDIRECIONADO" <? if($linha['status'] == 'REDIRECIONADO'){?>selected="selected"<? } ?>>Redirecionado</option>
<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<option value="SEM COBERTURA" <? if($linha['status'] == 'SEM COBERTURA'){?>selected="selected"<? } ?>>Sem Cobertura</option>
<option value="DOCUMENTOS ANEXADOS" <? if($linha['status'] == 'DOCUMENTOS ANEXADOS'){?>selected="selected"<? } ?>>Documentos Anexados</option>
<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
<option value="APROVADO" <? if($linha['status'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="ENTREGAR" <? if($linha['status'] == 'ENTREGAR'){?>selected="selected"<? } ?>>Entregar</option>
<option value="ENVIAR DOCUMENTOS" <? if($linha['status'] == 'ENVIAR DOCUMENTOS'){?>selected="selected"<? } ?>>Enviar Documentos</option>

</select>

<? } else {?>
<!-- // EXCESSAO PARA SUPER USUARIO DE INTERNET -->
<?php

	if($editar == '1' && $USUARIO['id']==3227 )
	{
?>

<select id="status" name="status" onChange="checkstatus(this.value)">
<option value="AUTORIZADA" <? if($linha['status'] == 'AUTORIZADA'){?>selected="selected"<? } ?>>Autorizada</option>
<option value="ATIVADO" <? if($linha['status'] == 'ATIVADO'){?>selected="selected"<? } ?>>Ativado</option>
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
<option value="PRE-ANALISE" <? if($linha['status'] == 'PRE-ANALISE'){?>selected="selected"<? } ?>>Pré-Análise</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>
<option value="AGUARDAR DOCUMENTOS" <? if($linha['status'] == 'AGUARDAR DOCUMENTOS'){?>selected="selected"<? } ?>>Aguardar Documentos</option>
<option value="ANEXAR DOCUMENTOS" <? if($linha['status'] == 'ANEXAR DOCUMENTOS'){?>selected="selected"<? } ?>>Anexar Documentos</option>
<option value="REDIRECIONADO" <? if($linha['status'] == 'REDIRECIONADO'){?>selected="selected"<? } ?>>Redirecionado</option>
<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<option value="SEM COBERTURA" <? if($linha['status'] == 'SEM COBERTURA'){?>selected="selected"<? } ?>>Sem Cobertura</option>
<option value="DOCUMENTOS ANEXADOS" <? if($linha['status'] == 'DOCUMENTOS ANEXADOS'){?>selected="selected"<? } ?>>Documentos Anexados</option>
<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
<option value="ENVIAR DOCUMENTOS" <? if($linha['status'] == 'ENVIAR DOCUMENTOS'){?>selected="selected"<? } ?>>Enviar Documentos</option>

</select>
<script>

	$(window).load(function () {
		$("[name='status']").trigger("change");

	});

</script>

<?} elseif(($editar == '1' || $USUARIO['id']==3179) && $linha['status'] == 'PRE-ANALISE') { ?>

<?php 
if ($USUARIO['id']==3179)

{?>
<select name="status" onChange="checkstatus(this.value)">
<option value="PRE-ANALISE" <? if($linha['status'] == 'PRE-ANALISE'){?>selected="selected"<? } ?>>Pré-Análise</option>
<option value="SEM COBERTURA" <? if($linha['status'] == 'SEM COBERTURA'){?>selected="selected"<? } ?>>Sem Cobertura</option>
</select>

<?php }else{ ?>
<select name="status" onChange="checkstatus(this.value)">
<option value="PRE-ANALISE" <? if($linha['status'] == 'PRE-ANALISE'){?>selected="selected"<? } ?>>Pré-Análise</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="SEM COBERTURA" <? if($linha['status'] == 'SEM COBERTURA'){?>selected="selected"<? } ?>>Sem Cobertura</option>
<option value="ANEXAR DOCUMENTOS" <? if($linha['status'] == 'ANEXAR DOCUMENTOS'){?>selected="selected"<? } ?>>Anexar Documentos</option>
<option value="REDIRECIONADO" <? if($linha['status'] == 'REDIRECIONADO'){?>selected="selected"<? } ?>>Redirecionado</option>
<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<?php
	if($USUARIO['id']==3129)
	{
	?>
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>

<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
	<?php
	}
	?>
</select>
<?php } ?>
<? } else if(($editar == '1') && $linha['status'] == 'ANEXAR DOCUMENTOS') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="ANEXAR DOCUMENTOS" <? if($linha['status'] == 'ANEXAR DOCUMENTOS'){?>selected="selected"<? } ?>>Anexar Documentos</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="DOCUMENTOS ANEXADOS" <? if($linha['status'] == 'DOCUMENTOS ANEXADOS'){?>selected="selected"<? } ?>>Documentos Anexados</option>
<option value="AGUARDAR DOCUMENTOS" <? if($linha['status'] == 'AGUARDAR DOCUMENTOS'){?>selected="selected"<? } ?>>Aguardar Documentos</option>
<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
</select>

<? } else if(($_GET['e'] == '1') && $linha['status'] == 'DEVOLVIDO' && ($USUARIO['tipo_usuario'] == 'SUPERVISOR' || $USUARIO['tipo_usuario'] == 'MONITOR' || $USUARIO['tipo_usuario'] == 'ADMINISTRADOR')) { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>
<option value="AGUARDAR DOCUMENTOS" <? if($linha['status'] == 'AGUARDAR DOCUMENTOS'){?>selected="selected"<? } ?>>Aguardar Documentos</option>
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
</select>

<? } else if(($_GET['e'] == '1') && $linha['status'] == 'AGUARDAR DOCUMENTOS') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="AGUARDAR DOCUMENTOS" <? if($linha['status'] == 'AGUARDAR DOCUMENTOS'){?>selected="selected"<? } ?>>Aguardar Documentos</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="DOCUMENTOS ANEXADOS" <? if($linha['status'] == 'DOCUMENTOS ANEXADOS'){?>selected="selected"<? } ?>>Documentos Anexados</option>
<option value="FINALIZADA" <? if($linha['status'] == 'FINALIZADA'){?>selected="selected"<? } ?>>Finalizada</option>

</select>

<? } else if(($_GET['e'] == '1') && $linha['status'] == 'REDIRECIONADO' && ($USUARIO['tipo_usuario'] == 'MONITOR' || $USUARIO['tipo_usuario'] == 'ADMINISTRADOR')) { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="REDIRECIONADO" <? if($linha['status'] == 'REDIRECIONADO'){?>selected="selected"<? } ?>>Redirecionado</option>
<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
</select>

<? } else if(($editar == '1') && $linha['status'] == 'DOCUMENTOS ANEXADOS') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="DOCUMENTOS ANEXADOS" <? if($linha['status'] == 'DOCUMENTOS ANEXADOS'){?>selected="selected"<? } ?>>Documentos Anexados</option>
<option value="REDIRECIONADO" <? if($linha['status'] == 'REDIRECIONADO'){?>selected="selected"<? } ?>>Redirecionado</option>
<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<option value="APROVADO" <? if($linha['status'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="SEM COBERTURA" <? if($linha['status'] == 'SEM COBERTURA'){?>selected="selected"<? } ?>>Sem Cobertura</option>
<option value="AGUARDAR DOCUMENTOS" <? if($linha['status'] == 'AGUARDAR DOCUMENTOS'){?>selected="selected"<? } ?>>Aguardar Documentos</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>

	<?php
	
	if( $USUARIO['tipo_usuario'] == 'ADMINISTRADOR' || $USUARIO['tipo_usuario'] == 'AUDITOR' || $USUARIO['tipo_usuario'] == 'MONITORBO' )
	{
		?>
		
		<option value="ENTREGAR" <? if($linha['status'] == 'ENTREGAR'){?>selected="selected"<? } ?>>Entregar</option>
		
		<?php
	}
	
	?>
	
</select>

<? } else if(($editar == '1') && $linha['status'] == 'SEM COBERTURA') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="SEM COBERTURA" <? if($linha['status'] == 'SEM COBERTURA'){?>selected="selected"<? } ?>>Sem Cobertura</option>
<option value="COM COBERTURA" <? if($linha['status'] == 'COM COBERTURA'){?>selected="selected"<? } ?>>Com Cobertura</option>
</select>

<? } else if(($editar == '1') && $linha['status'] == 'APROVADO') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="APROVADO" <? if($linha['status'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="ENVIAR DOCUMENTOS" <? if($linha['status'] == 'ENVIAR DOCUMENTOS'){?>selected="selected"<? } ?>>Enviar Documentos</option>

	<?php
	
	if( $USUARIO['tipo_usuario'] == 'ADMINISTRADOR' || $USUARIO['tipo_usuario'] == 'AUDITOR' || $USUARIO['tipo_usuario'] == 'MONITORBO' )
	{
		?>
		
		<option value="ENTREGAR" <? if($linha['status'] == 'ENTREGAR'){?>selected="selected"<? } ?>>Entregar</option>
		
		<?php
	}
	
	?>

</select>

<? } else if(($editar == '1' || $editar_instalacao == '1') && $linha['status'] == 'ENVIAR DOCUMENTOS') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="ENVIAR DOCUMENTOS" <? if($linha['status'] == 'ENVIAR DOCUMENTOS'){?>selected="selected"<? } ?>>Enviar Documentos</option>
<option value="FINALIZADA" <? if($linha['status'] == 'FINALIZADA'){?>selected="selected"<? } ?>>Finalizada</option>
</select>

<? } else if(($editar == '1') && $linha['status'] == 'RESTRIÇÃO') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<option value="AUTORIZADA" <? if($linha['status'] == 'AUTORIZADA'){?>selected="selected"<? } ?>>Autorizada</option>
</select>

<? } else if(($editar == '1') && $linha['status'] == 'AUTORIZADA') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="AUTORIZADA" <? if($linha['status'] == 'AUTORIZADA'){?>selected="selected"<? } ?>>Autorizada</option>
<option value="ATIVADO" <? if($linha['status'] == 'ATIVADO'){?>selected="selected"<? } ?>>Ativado</option>
</select>

<? } else if(($editar == '1') && $linha['status'] == 'SEM CONTATO') { ?>

<select name="status" onChange="checkstatus(this.value)">
<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
<option value="ANEXAR DOCUMENTOS" <? if($linha['status'] == 'ANEXAR DOCUMENTOS'){?>selected="selected"<? } ?>>Anexar Documentos</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="DOCUMENTOS ANEXADOS" <? if($linha['status'] == 'DOCUMENTOS ANEXADOS'){?>selected="selected"<? } ?>>Documentos Anexados</option>
</select>

<? } else { ?>

<?= $linha['status']; ?>
<input type="hidden" name="status" value="<?= $linha['status']; ?>" />

</td>

<? }} ?>
*/ ?>

<?php 

if ($editar == '1') {
?>
	<select id="status" name="status" onChange="checkstatus(this.value)">

<?php 
	
	$venda = new Venda( $linha['id'] );
	
	foreach( $venda->Status->getFluxo() as $key=>$value)
	{
		echo '<option value="' . $key . '">' . $value . '</option>';
	}
	

?>

	</select>	

<?php 
}else{
	
?>
<?= $linha['status']; ?>
<input type="hidden" name="status" value="<?= $linha['status']; ?>" />
<?php } ?>
</td>
</tr>



<? if($linha['status'] == 'CANCELADO' || $_GET['e'] == '1'){?>
<!-- MOTIVO CANCELAMENTO -->

<tr id="mcancel" <? if($linha['status'] != 'CANCELADO'){ ?> style="display:none" <? } ?>>
<td><b>Motivo:</b></td>
<td>
<!-- // EXCESSAO PARA SUPER USUARIO DE INTERNET -->
<? if($_GET['e'] == '1' && ($USUARIO['id']==3227 || $USUARIO['tipo_usuario'] == 'MONITOR' || $USUARIO['tipo_usuario'] == 'ADMINISTRADOR')) { ?>

<select name="motivocancelamento" id="motivocancelamento">

<option value=""></option>

<option value="Inviabilidade Técnica" <? if($linha['motivo_cancelamento'] == 'Inviabilidade Técnica'){?>selected="selected"<? } ?>>Inviabilidade Técnica</option>

<option value="Falta de Dinheiro" <? if($linha['motivo_cancelamento'] == 'Falta de Dinheiro'){?>selected="selected"<? } ?>>Falta de Dinheiro</option>

<option value="Venda Perdida para a Concorrência" <? if($linha['motivo_cancelamento'] == 'Venda Perdida para a Concorrência'){?>selected="selected"<? } ?>>Venda Perdida para a Concorrência</option>

<option value="Desistência do Cliente" <? if($linha['motivo_cancelamento'] == 'Desistência do Cliente'){?>selected="selected"<? } ?>>Desistência do Cliente</option>

<option value="Endereço Não Encontrado" <? if($linha['motivo_cancelamento'] == 'Endereço Não Encontrado'){?>selected="selected"<? } ?>>Endereço Não Encontrado</option>

<option value="Área de Risco" <? if($linha['motivo_cancelamento'] == 'Área de Risco'){?>selected="selected"<? } ?>>Área de Risco</option>

<option value="Cancelado no VSALES" <? if($linha['motivo_cancelamento'] == 'Cancelado no VSALES'){?>selected="selected"<? } ?>>Cancelado no VSALES

</option>
<option value="Número Inválido" <? if($linha['motivo_cancelamento'] == 'Número Inválido'){?>selected="selected"<? } ?>>Número Inválido</option>

</select>

<? } else {?>

<?= $linha['motivo_cancelamento']; ?>

<? } ?>
</td>
</tr>
<? } ?>



<? if($linha['status'] == 'RESTRIÇÃO' || $_GET['e'] == '1'){?>
<!-- MOTIVO RESTRIÇÃO -->

<tr id="mrest" <? if($linha['status'] != 'RESTRIÇÃO'){ ?> style="display:none" <? } ?>>

<td><b>Motivo:</b></td>
<td>
<? if($editar == '1') { ?>
<select name="motivorestricao" id="motivorestricao">
<option value=""></option>
<option value="Politicas Embratel" <? if($linha['motivo_restricao'] == 'Politicas Embratel'){?>selected="selected"<? } ?>>Politicas Embratel</option>
<option value="Cartão Inválido" <? if($linha['motivo_restricao'] == 'Cartão Inválido'){?>selected="selected"<? } ?>>Cartão Inválido</option>
<option value="Cartão Não Autorizou" <? if($linha['motivo_restricao'] == 'Cartão Não Autorizou'){?>selected="selected"<? } ?>>Cartão Não Autorizou</option>
<option value="Limite de Linhas" <? if($linha['motivo_restricao'] == 'Limite de Linhas'){?>selected="selected"<? } ?>>Limite de Linhas</option>


</select>

<? } else {?>

<?= $linha['motivo_restricao']; ?>

<? } ?>

</td>
</tr>

<? } ?>


<? if($linha['status'] == 'DEVOLVIDO' || $_GET['e'] == '1'){?>
<!-- MOTIVO DEVOLVIDO -->

<tr id="mdevo" <? if($linha['status'] != 'DEVOLVIDO'){ ?> style="display:none" <? } ?>>

<td><b>Motivo:</b></td>
<td>
<? if($editar == '1') { ?>
<select name="motivodevolvido" id="motivodevolvido">
<option value=""></option>

<option value="Desistência do Cliente" <? if($linha['motivo_devolvido'] == 'Desistência do Cliente'){?>selected="selected"<? } ?>>Desistência do Cliente</option>
<option value="Falta de Documentos" <? if($linha['motivo_devolvido'] == 'Falta de Documentos'){?>selected="selected"<? } ?>>Falta de Documentos</option>
<?php /* <option value="Cartão Não Autorizado" <? if($linha['motivo_devolvido'] == 'Cartão Não Autorizado'){?>selected="selected"<? } ?>>Cartão Não Autorizado</option>
<option value="Cartão Inválido" <? if($linha['motivo_devolvido'] == 'Cartão Inválido'){?>selected="selected"<? } ?>>Cartão Inválido</option>
<option value="Divergência de Informação" <? if($linha['motivo_devolvido'] == 'Divergência de Informação'){?>selected="selected"<? } ?>>Divergência de Informação</option>
*/ ?>

</select>

<? } else {?>

<input type="hidden" name="motivodevolvido" value="<?= $linha['motivo_devolvido']; ?>" />
<?= $linha['motivo_devolvido']; ?>

<? } ?>

</td>
</tr>

<? } ?>



<? if( ($linha['status'] == 'AGUARDAR DOCUMENTOS' || $linha['status'] == 'DOCUMENTOS RECUSADOS' || $linha['status'] == 'ANEXAR DOCUMENTOS' || $_GET['e'] == '1') && $USUARIO['tipo_usuario']=='MONITORBO'){?>
<!-- PENDENCIA -->

<tr id="mpend" <? if( $linha['status'] != 'AGUARDAR DOCUMENTOS' && $linha['status'] != 'ANEXAR DOCUMENTOS' && $linha['status'] != 'DOCUMENTOS RECUSADOS'){ ?> style="display:none" <? } ?>>

<td><b>Documentos:</b></td>
<td>
<? if($editar == '1') { ?>
<select name="pendencia" id="pendencia" onChange="checkpendencia(this.value)">
<option value=""></option>
<option value="Comprovante de Residência" <? if($linha['pendencia'] == 'Comprovante de Residência'){?>selected="selected"<? } ?>>Comprovante de Residência</option>
<option value="CPF" <? if($linha['pendencia'] == 'CPF'){?>selected="selected"<? } ?>>CPF</option>
<option value="Identidade" <? if($linha['pendencia'] == 'Identidade'){?>selected="selected"<? } ?>>Identidade</option>
<option value="Comprovante de Residência e CPF" <? if($linha['pendencia'] == 'Comprovante de Residência e CPF'){?>selected="selected"<? } ?>>Comprovante de Residência e CPF</option>
<option value="Comprovante de Residência e Identidade" <? if($linha['pendencia'] == 'Comprovante de Residência e Identidade'){?>selected="selected"<? } ?>>Comprovante de Residência e Identidade</option>
<option value="CPF e Identidade" <? if($linha['pendencia'] == 'CPF e Identidade'){?>selected="selected"<? } ?>>CPF e Identidade</option>
<option value="Comprovante de Residência, CPF e Identidade" <? if($linha['pendencia'] == 'Comprovante de Residência, CPF e Identidade'){?>selected="selected"<? } ?>>Comprovante de Residência, CPF e Identidade</option>



</select>

<? } else {?>

<input type="hidden" name="pendencia" value="<?= $linha['pendencia']; ?>" />
<?= $linha['pendencia']; ?>

<? } ?>

</td>
</tr>

<? } ?>



<? if($linha['pendencia'] == 'Cartão Não Autorizado' || $_GET['e'] == '1'){?>
<!-- DATA LIBERAÇÃO -->

<tr id="maguardlb" <? if($linha['pendencia'] != 'Cartão Não Autorizado'){ ?> style="display:none" <? } ?>>

<td><b>Data Liberação:</b></td>
<td>
<? if($editar == '1') { ?>
<input type="text" name="dataliberacao" id="dataliberacao" placeholder="ex:(dd/mm/aaaa)" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['dataLiberacao']){ echo substr($linha['dataLiberacao'],6,2)."/".substr($linha['dataLiberacao'],4,2)."/".substr($linha['dataLiberacao'],0,4);} ?>" />

<? } else {?>

<input type="hidden" name="dataliberacao" value="<?= substr($linha['dataLiberacao'],6,2)."/".substr($linha['dataLiberacao'],4,2)."/".substr($linha['dataLiberacao'],0,4); ?>" />
<?= substr($linha['dataLiberacao'],6,2)."/".substr($linha['dataLiberacao'],4,2)."/".substr($linha['dataLiberacao'],0,4); ?>

<? } ?>

</td>
</tr>

<? } ?>



<? if($linha['obs_recuperacao'] != '' || $_GET['e'] == '1'){?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<tr id="obsrecupe" <? if($linha['obs_recuperacao'] == ''){ ?> style="display:none" <? } ?>>

<td><b>Obs. Recuperação:</b></td>

<td>

<? if(($_GET['e'] == '1') && $linha['obs_recuperacao'] == '') { ?>

<textarea name="obsrecuperacao" id="obsrecuperacao" rows="3" cols="30"></textarea>

<? } else {?>


<?= $linha['obs_recuperacao']; ?> <br />

<? 

$conVendaRecuperada = $conexao->query("SELECT nome FROM usuarios WHERE id = '".$linha['usuario_recuperacao']."'");
$usuarioRecuperada = mysql_fetch_array($conVendaRecuperada);

$dataRecuperada = substr($linha['data_recuperacao'],8,2).'/'.substr($linha['data_recuperacao'],5,2).'/'.substr($linha['data_recuperacao'],0,4).' às '.substr($linha['data_recuperacao'],11);

?>

<span style="color:#787878; font-size:11px;">
<b>Recuperada por:</b> <?= $usuarioRecuperada['nome'];?>&nbsp;
em <?= $dataRecuperada;?>
</span>



<? } ?>

</td>

</tr>

<? } ?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


<!-- MODULO QUALIDADE DESABILITADO
<tr>

<td><b>STATUS PORTAL:</b></td>

</tr>

<tr><td>&nbsp;</td></tr>

<?php

include_once "lib/class.Qualidade.php";
include_once "lib/class.planilhaQualidade.php";
include_once "lib/class.Accents.php";

$planilhas = new planilhaQualidade($conexao);
$saidaTexto = new Accents( Accents::UTF_8, Accents::ISO_8859_1 );

?>
<tr>
	<td><b>Status Portal:</b></td>
	<td><?php //echo $saidaTexto->clear($planilhas->getTiposPlanilhas($linha["status_qualidade"])); ?></td>
</tr>

<tr>
	<td><b>Status Xerox:</b></td>
	<td><?php //echo $saidaTexto->clear($planilhas->getTiposProcessos($linha["status_processo"])); ?></td>
</tr>

<tr><td>&nbsp;</td></tr>

<?php
/*
for($i=1; $i<=$linha["status_qualidade"]; $i++)
{
	
	if($i==1) {
		
		if( $linha["data_status_qualidade_1"]!="0000-00-00") 
		{ 
			echo "<tr><td><b>Data inten&ccedil;&atilde;o: </b></td><td>" . date("d/m/Y", strtotime($linha["data_status_qualidade_1"])) . "</td></tr>"; 
		}else{
			echo "<tr><td><b>Data inten&ccedil;&atilde;o: </b></td><td>-</td></tr>"; 
		}
	}

	if($i==2) {
		
		if( $linha["data_status_qualidade_2"]!="0000-00-00") 
		{ 
			echo "<tr><td><b>Data confirma&ccedil;&atilde;o: </b></td><td>" . date("d/m/Y", strtotime($linha["data_status_qualidade_2"])) . "</td></tr>";
		}else{
			echo "<tr><td><b>Data inten&ccedil;&atilde;o: </b></td><td>-</td></tr>"; 
		}
	}

	if($i==3) {
		
		if( $linha["data_status_qualidade_3"]!="0000-00-00") 
		{ 
			echo "<tr><td><b>Data ativa&ccedil;&atilde;o: </b></td><td>" . date("d/m/Y", strtotime($linha["data_status_qualidade_3"])) . "</td></tr>";
		}else{
			echo "<tr><td><b>Data inten&ccedil;&atilde;o: </b></td><td>-</td></tr>"; 
		}
	}
	
	if($i==4) {
		
		if( $linha["data_status_qualidade_4"]!="0000-00-00") 
		{ 
			echo "<tr><td><b>M&ecirc;s comissionamento: </b></td><td>" . date("m/Y", strtotime($linha["data_status_qualidade_4"])) . "</td></tr>";
		}else{
			echo "<tr><td><b>Data inten&ccedil;&atilde;o: </b></td><td>-</td></tr>"; 
		}
	}

	if($i==5) {
		
		if( $linha["data_status_qualidade_5"]!="0000-00-00") 
		{ 
			echo "<tr><td><b>M&ecirc;s cancelamento: </b></td><td>" . date("m/Y", strtotime($linha["data_status_qualidade_5"])) . "</td></tr>";
		}else{
			echo "<tr><td><b>Data inten&ccedil;&atilde;o: </b></td><td>-</td></tr>"; 
		}
	}


}
*/
?>
 FIM  MODULO QUALIDADE DESABILITADO-->
</form>

</table>

<br />
<br />

<? if( ($USUARIO['id']== 3179 && $_GET['e']==1) || $editar == '1' || $editar_instalacao == '1' || ($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'LOGISTICA') || ($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'MONITOR' && $linha['status'] == 'DEVOLVIDO')) {?>

<center>

<img src="img/salvar.png" height="25" onClick="javascript:validar();" style="cursor:pointer" />

<img src="img/cancelar.png" height="25" onClick="window.location = '?id=<?= $_GET['id'];?>'" style="cursor:pointer" />

</center>

<? } else {?>

<center>

<? if($USUARIO['editar_dados'] == 1 || $USUARIO['editar_instalacao'] == 1 || ($USUARIO['tipo_usuario'] == 'LOGISTICA') || ($USUARIO['tipo_usuario'] == 'MONITOR' && $linha['status'] == 'DEVOLVIDO') ){?>


<img src="img/editar.png" height="25" onClick="window.location = '?id=<?= $_GET['id'];?>&e=1'" style="cursor:pointer" /> 

<? } ?>

<img src="img/imprimir.png" height="25" onClick="javascript:print();" style="cursor:pointer" />

</center>

<? } ?>


</body>

</html>
