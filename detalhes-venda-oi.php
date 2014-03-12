<? include "conexao.php";

session_start();

// Verificar se está logado

if(!isset($_SESSION['usuario'])){ ?>



<script type="text/javascript">

window.location = 'index.php'

</script>	

	

	

<? } 





$consulta = $conexao->query("SELECT * FROM vendas_clarotv WHERE id = '".$_GET['id']."'");

$linha = mysql_fetch_array($consulta);





$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");

$USUARIO = mysql_fetch_array($conUSUARIO);







if($_GET['e'] == '1' && $USUARIO['editar_dados'] == '1'){ $editar = '1';}



if($_GET['e'] == '1' && $USUARIO['editar_instalacao'] == '1'){ $editar_instalacao = '1';}

///////////////////////////////////







if(isset($_POST['nome'])){



$proposta = $_POST['proposta'];

$os = $_POST['os'];

$contrato = $_POST['contrato'];



$obs_gravacao = $_POST['obsgravacao'];



// Dados Pessoais

$nome = $_POST['nome'];

$nascimento = $_POST['nascd'].'/'.$_POST['nascm'].'/'.$_POST['nasca'];

$cpf = $_POST['icpf'];

$rg = $_POST['rg'];

$org_exp = $_POST['orgexp'];

$nome_mae = $_POST['nomemae'];


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





$data0 = explode('/',$_POST['idata']);

$data = $data0[2].$data0[1].$data0[0];



$plano = $_POST['plano'];

$pontos = $_POST['pontos'];

$os2 = $_POST['os2'];

$os3 = $_POST['os3'];



$vencimento = $_POST['vencimento'];

// Agendamento gravação


if($_POST['agendagravacao']){

$diaGravacao = explode('/',$_POST['agendagravacao']);

$agendGravacao = $diaGravacao[2].'-'.$diaGravacao[1].'-'.$diaGravacao[0].' '.$_POST['agendagravacaohora'].':'.$_POST['agendagravacaominutos'].':00';

} else {
	
$agendGravacao = $linha['agendagravacao'];
	
}

if($_POST['velox_fixo']){

$velox_fixo =$_POST['velox_fixo'];



} else {
	
$velox_fixo = $linha['velox_fixo'];
	
}

if($_POST['velox_fixo_plano']){

$velox_fixo_planos =$_POST['velox_fixo_plano'];



} else {
	
$velox_fixo_planos = $linha['velox_fixo_plano'];
	
}


// Agendamento Pendente


if($_POST['agendamentoPendente']){

$diaPendente = explode('/',$_POST['agendamentoPendente']);

$agendamentoPendente= $diaPendente[2].'-'.$diaPendente[1].'-'.$diaPendente[0].' '.$_POST['agendamentoPendenteHora'].':'.$_POST['agendamentoPendenteMinuto'].':00';
$ultimAgendPendente = $agendamentoPendente;

} else {
	if((isset($linha['agendamentoPendente'])) && ($linha['agendamentoPendente'] != "") && ($linha['agendamentoPendente']  != "0000-00-00 00:00:00")){	
		$agendamentoPendente = $linha['agendamentoPendente'];
	}
	if((isset($linha['ultimAgendPendente'])) && ($linha['ultimAgendPendente'] != "") && ($linha['ultimAgendPendente']  != "0000-00-00 00:00:00")){		
		$ultimAgendPendente = $linha['ultimAgendPendente'];
	}	
}
if($_POST['obsPendente']){
	$obsPendente =$_POST['obsPendente'];
}else{
	if((isset($linha['obsPendente'])) && ($linha['obsPendente'] != "")){
		$obsPendente = $linha['obsPendente'];
	}
}
//// reagendamento ////
if($_POST['reagendamentoPendente'] != ''){
	$reagendamentoPendenteminuto= $_POST['reagendamentoPendenteminuto'];
	$reagendamentoPendentehora = $_POST['reagendamentoPendentehora'];
	
	$reagendamento0pendente = explode('/',$_POST['reagendamentoPendente']);
	$reagendamentopendente = $reagendamento0pendente[2]."-".$reagendamento0pendente[1]."-".$reagendamento0pendente[0]." ".$reagendamentoPendentehora.":".$reagendamentoPendenteminuto.":00";
	$obsreagendamentopendente = $_POST['obsreagendamentoPendente'];
	
	$insert_reagendamentopendente = $conexao->query("INSERT INTO reagendamentoPendente(venda,produto,usuario,data,agendamento,obs) VALUES ('".$_GET['id']."','".$linha['produto']."','".$USUARIO['id']."','".date("Y-m-d H:i:s")."', '".$reagendamentopendente."','".$obsreagendamentopendente."')");


	$numerosReagendPendentes = ceil($linha['reagendamentoPendente']+1);
	$ultimAgendPendente = $reagendamentopendente;
	
} else {
	$numerosReagendPendentes = ceil($linha['reagendamentoPendente']);
	if((isset($linha['ultimAgendPendente'])) && ($linha['ultimAgendPendente'] != "") && ($linha['ultimAgendPendente']  != "0000-00-00 00:00:00")){		
		$ultimAgendPendente = $linha['ultimAgendPendente'];
	}
}


//// fim reagendamento ////
// Dados da Instalação

$data_marcada0 = explode('/',$_POST['datamarcada']);

$data_marcada = $data_marcada0[2].$data_marcada0[1].$data_marcada0[0];



$reagendamento01 = explode('/',$_POST['reagendamento1']);

$reagendamento1 = $reagendamento01[2].$reagendamento01[1].$reagendamento01[0];

$obs1 = $_POST['obs1'];



$pacotes_e_canais_adicionais = $_POST['pct1'].' | '.$_POST['pct2'].' | '.$_POST['pct3'].' | '.$_POST['pct4'].' | '.$_POST['pct5'].' | '.$_POST['pct6'].' | '.$_POST['pct7'];

$pacoteEscolha = $_POST ['pacoteEscolha'];

$eventosTemporada = $_POST ['eventosTemporada'];

$ofertasOitv = $_POST ['ofertasOitv'];

$oifixo = $_POST ['oifixo'];

$telOifixo = $_POST ['telOifixo'];

$obs = $_POST['obs'];


// Motivos
$motivo_cancelamento = $_POST['motivocancelamento'];

$motivo_pendente = $_POST['motivopendente'];

$motivo_devolvido= $_POST['motivo_devolvido'];

if(isset($_POST['datainstalacao'])){ 

	$data_finalizada = explode('/',$_POST['datainstalacao']);
	$data_finalizada = $data_finalizada[2].$data_finalizada[1].$data_finalizada[0];
	
} else {

	if(($linha['status'] != 'FINALIZADA' && $_POST['status'] == 'FINALIZADA')){
		
		$data_finalizada = date("Ymd");

	} else {
		
		$data_finalizada = $linha['data_instalacao'];	

	}
}
if(isset($_POST['dataconectada'])){ 

	$data_conectada = explode('/',$_POST['dataconectada']);
	$data_conectada = $data_conectada[2].$data_conectada[1].$data_conectada[0];
	
} else {
	$data_conectada = $linha['data_conectada'];	
}

if($_POST['obsPendente']){
	$obsPendente = $_POST['obsPendente'];
}else{
	$obsPendente=$linha['obsPendente'];
}


// Observações

if(strlen($_POST['obsgravacao']) > 3){
$obs1 = $_POST['obsgravacao'];	
	
$insertOBS1 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','".$linha['produto']."','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','1','".$obs1."')");
		
}

if(strlen($_POST['obsentrega']) > 3){
$obs2 = $_POST['obsentrega'];	
	
$insertOBS2 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','".$linha['produto']."','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','2','".$obs2."')");
		
}

if(strlen($_POST['obsfinalizada']) > 3){
$obs3 = $_POST['obsfinalizada'];	
	
$insertOBS3 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','".$linha['produto']."','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','3','".$obs3."')");
		
}



// Pagamento

$pagamento = $_POST['pagamento'];

$pagamento_instalacao = $_POST['pagamentoinstalacao'];



if($pagamento == 'DÉBITO'){ $valor = '80.00';



$banco = $_POST['banco'];

$agencia = $_POST['agencia'];

$conta_corrente = $_POST['contacorrente'];



} else{



$valor = str_replace(',','.',$_POST['valor']);

}



if($_POST['status'] != 'RECUPERADO'){ $gravacao = $linha['gravacao']; $auditorid = $linha['auditor'];}



if($_POST['status'] == ''){ $status = $linha['status'];} 

else if($_POST['status'] == 'GRAVAR' && $linha['gravacao'] == ""){  $status = 'GRAVAR'; }else if($_POST['status'] == 'GRAVAR' && $linha['gravacao'] != ""){  $status = 'GRAVAR'; }else if($_POST['status'] == 'RECUPERADO'){  $status = 'RECUPERADO'; 
$gravacao = ''; 
$auditorid = '';


$obs_recuperacao = $_POST['obsrecuperacao'];

if($obs_recuperacao){
	
$usuario_recuperacao = $USUARIO['id'];	
$data_recuperacao = date('Y-m-d H:i:s');

	
}

}

else if($_POST['status'] == 'APROVADO' && $linha['gravacao'] == ""){  $status = 'GRAVAR'; }

else { $status = $_POST['status']; }



////////////////////////

// Salvar Instalação //

//////////////////////

if($status == 'CONECTADO'){

	

$conINS = $conexao->query("SELECT * FROM instalacoes_clarotv WHERE contrato = '".$contrato."'");	

$INS = mysql_fetch_array($conINS);

	

	

if($INS == 0){	



$insert_instalacao = $conexao->query("INSERT INTO instalacoes_clarotv (data,contrato,tecnico_id,valor) VALUES ('".$data_instalacao."','".$contrato."','".$tecnico_id."','".$valor."') ");	



} else {

	

$update_instalacao = $conexao->query("UPDATE instalacoes_clarotv SET data='".$data_instalacao."', tecnico_id='".$tecnico_id."', valor='".$valor."' WHERE contrato = '".$contrato."'");		

	

}

	

}





//////////////////////

// Atualizar Dados //

////////////////////



$dadoscontrato1 = $conexao->query("SELECT (id) FROM vendas_clarotv  WHERE contrato = '".$contrato."'");	if(($POST['contrato'] != "" ) || ($POST['contrato'] != "PENDENTE") || ($linha['contrato'] != "")){	$contcontrato = $conexao->query("SELECT COUNT(id) FROM vendas_clarotv  WHERE contrato = '".$contrato."'");	}else{	$contcontrato =0;}$dadoscontr = mysql_fetch_array($dadoscontrato1);$contcontr = mysql_fetch_array($contcontrato);$dadosos1 = $conexao->query("SELECT (id) FROM vendas_clarotv  WHERE os = '".$os."'");	if(($POST['os'] != "" ) || ($POST['os'] != "PENDENTE") || ($linha['os'] != "")){	$cont_os = $conexao->query("SELECT COUNT(id) FROM vendas_clarotv  WHERE os = '".$os."'");	}$dadosos_1 = mysql_fetch_array($dadosos1);$cont_os_1 = mysql_fetch_array($cont_os);$errosvenda =0; if(($cont_os_1[0] == 1) && ($linha['os'] == "" )){		$errosvenda= 1;	$varerros = "Erro: Os já existente!";}if(($contcontr[0] == 1) && ($linha['contrato'] == "" )){		$errosvenda= 1;	$varerros = "Erro: Contrato já existente!";}if($_POST['status'] == 'FINALIZADA'){			if($linha['gravacao'] == ""){				$errosvenda= 1;		$varerros = "Erro: Faça o upload da gravação antes de finalizar a venda!";	}	if($linha['contrato'] == ""){				$errosvenda= 1;		$varerros = "Erro: Insira o nº do contrato antes de finalizar a venda!";	}	if($linha['os'] == ""){				$errosvenda= 1;		$varerros = "Erro: Insira o nº da OS antes de finalizar a venda!";	}}if(($errosvenda == 0) || ($USUARIO['tipo_usuario'] == "ADMINISTRADOR")){		$update = $conexao->query("UPDATE vendas_clarotv SET proposta = '".$proposta."', gravacao = '".$gravacao."', auditor = '".$auditorid."', os = '".$os."', contrato = '".$contrato."', nome = '".$nome."', nascimento = '".$nascimento."', cpf = '".$cpf."', rg = '".$rg."', org_exp = '".$org_exp."', nome_mae = '".$nome_mae."', profissao = '".$profissao."', sexo = '".$sexo."', estado_civil = '".$estado_civil."', email = '".$email."', telefone = '".$telefone."', tipo_tel1 = '".$tipo_tel1."', telefone2 = '".$telefone2."', tipo_tel2 = '".$tipo_tel2."', telefone3 = '".$telefone3."', tipo_tel3 = '".$tipo_tel3."', endereco = '".$endereco."', numero = '".$numero."', lote = '".$lote."', quadra = '".$quadra."', complemento = '".$complemento."', bairro = '".$bairro."', cidade = '".$cidade."', uf = '".$uf."', cep = '".$cep."', ponto_referencia = '".$ponto_referencia."', operador = '".$operador."', monitor = '".$monitor."', status = '".$status."', obs = '".$obs."', valor = '".$valor."', pagamento = '".$pagamento."', banco = '".$banco."', agencia = '".$agencia."', conta_corrente = '".$conta_corrente."', data = '".$data."', plano = '".$plano."', pacotes_e_canais_adicionais = '".$pacotes_e_canais_adicionais."', pacoteEscolha = '".$pacoteEscolha."', eventosTemporada = '".$eventosTemporada."', ofertasOitv = '".$ofertasOitv."', oifixo = '".$oifixo."', telOifixo = '".$telOifixo."', pontos = '".$pontos."', os2 = '".$os2."', os3 = '".$os3."', vencimento = '".$vencimento."', agendGravacao = '".$agendGravacao."', agendamentoPendente = '".$agendamentoPendente."', obsPendente = '".$obsPendente."', ultimAgendPendente ='".$ultimAgendPendente ."', numerosReagendPendentes = '".$numerosReagendPendentes."', data_marcada = '".$data_marcada."', obs1 = '".$obs1."', motivo_cancelamento = '".$motivo_cancelamento."', motivo_pendente = '".$motivo_pendente."', motivo_devolvido = '".$motivo_devolvido."' , obs_recuperacao = '".$obs_recuperacao."', usuario_recuperacao = '".$usuario_recuperacao."', data_recuperacao = '".$data_recuperacao."', data_instalacao = '".$data_finalizada."', data_conectada = '".$data_conectada."', velox_fixo = '".$velox_fixo."', velox_fixo_plano = '".$velox_fixo_plano."' WHERE id = '".$_GET['id']."' ") or die ('Ocorreu um Erro ao inserir os dados!');	if($update){		$varerros = "Sucesso: Dados atualizados!";	}else{				$varerros =	"Erro: Não foi possível atualizar a venda";	}}










/////////////////

// Insert LOG //

///////////////



$data = date("Y-m-d H:i:s");

$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$_SESSION['usuario']."','Atualizou um dado no sistema (ID: ".$_GET['id'].").')");



?>





<script type="text/javascript">




alert('<?php echo $varerros; ?>');
window.location = '?id=<?= $_GET['id'];?>'



</script>



<?

}

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Detalhes Venda Oi</title>



<style type="text/css">



body{margin: 0 0 0 0; font-family:Arial, Helvetica, sans-serif;}



#topo{position:relative; background:url(img/topo-bg.png) repeat-x; top:0px; height:120px; width:100%;}



</style>



</head>



<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>

<script type="text/javascript">



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

	

    function data(v){

        //Remove tudo o que não é dígito

        v=v.replace(/\D/g,"");

        //Coloca parênteses em volta dos dois primeiros dígitos

        v=v.replace(/^(\d{2})(\d)/g,"$1/$2");

        //Coloca hífen entre o quarto e o quinto dígitos

        v=v.replace(/(\d{2})(\d)/,"$1/$2");

        return v;

    }	

	

	

//////////////////////////////////	

	

function verificapagamento(v){

	

	if(v == "DÉBITO"){ 

	document.getElementById('valor').value = '80,00';

	document.getElementById('valor').disabled = true;

	document.getElementById('idbanco').style.display = '';

	document.getElementById('idpagamentoinstalacao').style.display = 'none';

	

	 } else { 

	 

	 document.getElementById('valor').disabled = false; 	

	 document.getElementById('idbanco').style.display = 'none';

     document.getElementById('idpagamentoinstalacao').style.display = '';



	 }

	

	}

		

	

	

	

/////////////////////////////





function mostrar(id){ document.getElementById(id).style.display = '' }



function esconder(id){ document.getElementById(id).style.display = 'none' }



function checkstatus(v){

	

if(v == 'CANCELADO'){ document.getElementById('').style.display = ''; 
					  document.getElementById('obsrecupe').style.display = 'none';
					  document.getElementById('obsrecuperacao').value = "";}



else if(v == 'RECUPERADO'){ document.getElementById('mcancel').style.display = 'none';
							document.getElementById('motivocancelamento').value = "";
							document.getElementById('obsrecupe').style.display = '';  } 

else{ document.getElementById('mcancel').style.display = 'none';  
document.getElementById('motivocancelamento').value = "";

document.getElementById('obsrecupe').style.display = 'none';
document.getElementById('obsrecuperacao').value = "";

}

	

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

	

	

///////////////////////////////////////////

/////////////// VALIDAÇÃO ////////////////	

/////////////////////////////////////////



function validar(){

	

cpf = $('input[name="icpf"]').val();

gravacao = '<?= $linha['gravacao'];?>';

tecnico = $('select[name="tecnico"]').val();

datainstalacao = $('input[name="datainstalacao"]').val();

agendamento = $('input[name="datamarcada"]').val();




//////////	

status = $('select[name="status"]').val();

erro = 0;



// Se Aprovado	

if(status == 'APROVADO'){

	

	

if(cpf == '' || cpf == '000.000.000-00' || cpf == '111.111.111-11')

{



alert("CPF Inválido");

$('input[name="icpf"]').focus();

erro = erro+1;



}}






// Se INSTALAR	if(status == 'INSTALAR'){	if(cpf == '' || cpf == '000.000.000-00' || cpf == '111.111.111-11'){alert("CPF Inválido");$('input[name="icpf"]').focus();erro = erro+1;stop();}	if(erro == 0)		if(gravacao == ''){alert("Status não permitido sem gravação!");erro = erro+1;}}// Se Finalizada	if(status == 'FINALIZADA'){contrato = '<?= $linha['contrato'];?>';	if(cpf == '' || cpf == '000.000.000-00' || cpf == '111.111.111-11'){alert("CPF Inválido");$('input[name="icpf"]').focus();erro = erro+1;stop();}	if(erro == 0)		if(gravacao == ''){alert("Status não permitido sem gravação!");erro = erro+1;}else if(contrato == ''){alert("Status não permitido sem nº de contrato!");erro = erro+1;}}




// Se CONECTADO	

if(status == 'CONECTADO'){

	

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



if(erro == 0){

if(tecnico == ''){



alert("Favor selecionar o técnico que fez a instalação!");

$('input[select="tecnico"]').focus();

erro = erro+1;	

	

}}



if(erro == 0){

if(datainstalacao == ''){



alert("Favor informar a data da instalação!");

$('input[name="datainstalacao"]').focus();

erro = erro+1;	

	

}}





}





// Se Nada estiver errado:

if(erro == 0){

	

document.forms.editar.submit();



			}



				}

// Fim function


$('select#selectStatus').live('change', function(){
	valStatus= '<?echo $linha['status'];?>';
	selectVal = $(this).val();
	if(selectVal == "PENDENTE"){
		$("#mcpendente").show();
	}else{
		$("#mcpendente").hide();
	}
});
//ativar e desativar planos velox fixo
$('.velox_fixo').live('click', function(){
	valorPlano=$(this).val();
	if(valorPlano == "SIM"){
		$('.velox_fixo_plano').show();
	}else{
		$('.velox_fixo_plano').hide();
	}
});
$('select#selectStatus').live('change', function(){
	valStatus= '<?echo $linha['status'];?>';
	selectVal = $(this).val();
	
	if(selectVal == "DEVOLVIDO"){
		$("#mcdevolvido").show();
	}else{
		$("#mcdevolvido").hide();
	}
});

</script>



<body onLoad="checkoperador('<?= $linha['monitor'];?>','<?= $linha['operador'];?>');">



<div id="topo">

<img src="img/LOGO-VENTO-p.png" />

</div>



<table border="0" width="100%" style="font-size:14px;">



<form name="editar" action="" method="post">



<tr align="center" style="color:#999; font-size:18px; font-weight:bold;\">

<td colspan="2"><? if($editar == '1'){?> Editar Venda <? } else { ?>Detalhes da Venda <? } ?> <hr size="1" color="#ccc" /></td>

</tr>





<tr>

<td><b>Nº Contrato:</b></td>

<td>

<? if((($editar == '1') && ($linha['contrato'] == "") || ($editar == '1') && ($linha['contrato'] == "PENDENTE")) || ($USUARIO['tipo_usuario'] == 'ADMINISTRADOR')){?>



<input type="text" name="contrato" size="40" maxlength="10" value="<?= $linha['contrato']; ?>" onKeyUp="checkcontratos(this.value)" onChange="checkcontratos(this.value)" /><span id="loadcontratos" style="font-size:12px; font-weight: normal; position: absolute; margin-left: 5px; margin-top: -10px;"></span>

<? } else { ?><? echo $linha['contrato']; ?>
<input type="hidden" name="contrato" size="40" value="<?= $linha['contrato']; ?>"  />



</td>



<? } ?>

</tr>



<tr>

<td><b>O.S.:</b></td>

<td>

<? if((($editar == '1') && ($linha['os'] == "")) || ($USUARIO['tipo_usuario'] == 'ADMINISTRADOR')){?>

<input type="text" name="os" size="40" maxlength="12" value="<?= $linha['os']; ?>" />

<? } else { ?>



<? echo $linha['os']; ?>

<input type="hidden"  name="os" size="40" value="<?= $linha['os']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr>

<td><b>Cliente:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="nome" size="40" value="<?= $linha['nome']; ?>" />

<? } else { ?>



<?= ucwords($linha['nome']); ?>

<input type="hidden" name="nome" size="40" value="<?= $linha['nome']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>Nascimento:</b></td>

<td>

<? 

$linhanascimento = explode('/',$linha['nascimento']);	



if($editar == '1') {

	

	

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

<? if($editar == '1') {?>

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

<? if($editar == '1') {?>

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

<? if($editar == '1') {?>

<input type="text" name="orgexp" size="40" value="<?= $linha['org_exp']; ?>" />

<? } else { ?>



<?= $linha['org_exp']; ?>

<input type="hidden" name="orgexp" size="40"  value="<?= $linha['org_exp']; ?>" />



</td>



<? } ?>

</td>

</tr>

<tr>

<td><b>Nome da Mãe:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="nomemae" size="40" value="<?= $linha['nome_mae']; ?>" />

<? } else { ?>



<?= ucwords($linha['nome_mae']); ?>

<input type="hidden" name="nomemae" size="40" value="<?= $linha['nome_mae']; ?>" />



</td>



<? } ?>

</td>

</tr>


<tr>

<td><b>Profissão:</b></td>

<td>

<? if($editar == '1') {?>

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

<? if($editar == '1') {?>

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

<? if($editar == '1') {?>

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

<? if($editar == '1') {?>

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

<? if($editar == '1') {?>

<input type="text" name="itelefone" size="20" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $linha['telefone']; ?>" />

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



<? if($linha['telefone2'] != '' || $editar == '1' ){?>

<tr>

<td><b>Telefone2:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="itelefone2" size="20" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $linha['telefone2']; ?>" />



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







<? if($linha['telefone3'] != '' || $editar == '1' ){?>

<tr>

<td><b>Telefone3:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="itelefone3" size="20" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $linha['telefone3']; ?>" />



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



<? if($editar == '1') {?>

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



<? if($editar == '1') {?>

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



<? if($editar == '1') {?>

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



<? if($editar == '1') {

	

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



<? if($editar == '1') {?>

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

<td><? if($editar == '1') {?>

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

<? if($editar == '1') {?>

<select type="text" id="monitor" name="monitor" onChange="checkoperador(this.value,'<?= $linha['operador'];?>')">

<option value=""></option>

<? 



$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE grupo LIKE '%0004%' && tipo_usuario = 'MONITOR' ORDER BY nome ASC");

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

$conOPERADORES1 = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$linha['operador']."' ORDER BY nome ASC");

$OPERADORES1 = mysql_fetch_array($conOPERADORES1);	



if($editar == '1') {

	



?>

<!--

<div id="loadoperadores" style="position:relative"></div> 

-->

<select type="text" id="operador" name="operador">

<option value="<?= $linha['operador']; ?>"><?= $OPERADORES1['nome'];?></option>

<option value="<?= $linha['operador']; ?>"></option>

<? 



$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE grupo LIKE '%0004%' && status != 'DESLIGADO' ORDER BY nome ASC");

while($OPERADORES = mysql_fetch_array($conOPERADORES)){



?>



<option value="<?= $OPERADORES['operador_id'];?>" <? if($linha['operador'] == $OPERADORES['operador_id']){?> selected="selected" <? } ?>>

<?= $OPERADORES['nome'];?>

</option>



<? } ?>



</select>

<? } else {

		

	?>



<?= $OPERADORES1['nome']; ?>

<input type="hidden" name="operador" value="<?= $linha['operador']; ?>" />



<? } ?>



</td>

</tr>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<tr>

<td><b>Data da Venda:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="idata" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>" />

<? } else { ?>



<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>



<input type="hidden" name="idata" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>" />



<? } ?>

</td>
</tr>


<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr>

<td><b>Gravação:</b></td>

<td>

<? if($linha['gravacao'] == '' && $USUARIO['inserir_gravacao'] == '1'){?>



<img src="img/record.png" width="20" align="absmiddle" style="cursor:pointer" title="Inserir Gravação" onClick="window.location = 'http://172.16.0.30/vento-adm/upload-gravacao-simples-oi.php?id=<?= $linha['id'];?>&u=<?= $USUARIO['id'];?>'" /> <span style="font-size:13px;">Inserir Gravação </span>



<? } else if($linha['gravacao'] != '') {?>



<img src="img/play-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Ouvir Gravação" onClick="javascript:window.location = 'http://172.16.0.30/audio/clarotv/orig/<?= $linha['gravacao'];?>'" /> <span style="font-size:13px;">Ouvir Gravação </span>



<? } ?>

</td>

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



<? if($USUARIO['inserir_gravacao'] == '1' || $USUARIO['tipo_usuario'] == 'LOGISTICA' || $USUARIO['tipo_usuario'] == 'MONITOR' || $USUARIO['tipo_usuario'] == 'COMERCIAL'){?>


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

<? } ?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


<? include "includes/agendamento-gravacao.php";?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<? include "includes/agendamento-gravacaopendente.php";?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>
<?

$conReagendamentos = $conexao->query("SELECT *,
												DATE_FORMAT( reagendamentoPendente.data, '%d/%m/%Y às %H:%i:%s') AS dataevento,
												DATE_FORMAT( reagendamentoPendente.agendamento, '%d/%m/%Y às %H:%i:%s') AS dataagendamento,
												usuarios.nome AS nomeusuario
												FROM  reagendamentoPendente 
												INNER JOIN usuarios 
												ON usuarios.id =  reagendamentoPendente.usuario
												WHERE  reagendamentoPendente.venda = '".$_GET['id']."'
												ORDER BY  reagendamentoPendente.id ASC
												
												");
$qntReagendamentos = mysql_num_rows($conReagendamentos);
$i = 0;												
while($Reagendamentos = mysql_fetch_array($conReagendamentos)){

$i++;
?>

<tr <? if($i < $qntReagendamentos){?> style="color:#CCC" <? } ?>>
<td><b>Reagendamento<?= $i;?>:</b></td>
<td><?= $Reagendamentos['dataagendamento'];?></td>
</tr>

<tr <? if($i < $qntReagendamentos){?> style="color:#CCC" <? } ?>>
<td><b>Obs.:</b></td>
<td>
<span style=" <? if($i < $qntReagendamentos){?>color:#CCC; <? } else { ?>color:#787878; <? } ?>font-size:11px;">
<b><?= $Reagendamentos['nomeusuario'];?></b> - <?= $Reagendamentos['dataevento'];?>
</span><br />
<?= $Reagendamentos['obs'];?>

</td>
</tr>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<? } ?>


<? if(($linha['data_marcada'] != '' && ($editar == '1')) || (($linha['agendamentoPendente'] != "0000-00-00 00:00:00" && $linha['agendamentoPendente'] != "") && ($editar == '1'))){?>

<tr id="re1">

<td><b>Reagendamento:</b></td>

<td>


<input type="text" name="reagendamentoPendente" id="reagendamentoPendente" size="20" onKeyUp="validadata(this.value,reagendamentoPendente)" onKeyPress="mascara(this,data)" maxlength="10"  /> às

<select name="reagendamentoPendentehora">
<? for($h=8;$h<22;$h++){?>
	<option value="<? echo $h;?>"><?echo $h;?></option>
<?}?>
</select>:
<select name="reagendamentoPendenteminuto">
<? for($m = 00;$m<60;$m=$m+5){?>
	<option value="<? echo $m;?>"><?echo $m;?></option>
<?}?>
</select>
</td>

</tr>


<tr id="ob1">

<td><b>Obs. Reagend.:</b></td>

<td>

<textarea name="obsreagendamentoPendente" rows="3" cols="30"></textarea>

</td>

</tr>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


<? } ?>






<tr>

<td><b>Data Finalizada:</b></td>

<td>

<? if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){ ?>

<input type="text" name="datainstalacao" placeholder="ex:(dd/mm/aaaa)" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_instalacao'] != ''){ echo substr($linha['data_instalacao'],6,2)."/".substr($linha['data_instalacao'],4,2)."/".substr($linha['data_instalacao'],0,4); } ?>" />

<? } else {?>

<? if($linha['data_instalacao'] != ''){ echo substr($linha['data_instalacao'],6,2)."/".substr($linha['data_instalacao'],4,2)."/".substr($linha['data_instalacao'],0,4); } ?>

<? } ?>

</td>

</tr>


<tr>
<tr ><td colspan="2"><hr size="1" color="#ccc" /></td></tr>
<td  ><b>Data Conectada:</b></td>

<td>

<? if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){ ?>

<input type="text" name="dataconectada" placeholder="ex:(dd/mm/aaaa)" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_conectada'] != ''){ echo substr($linha['data_conectada'],6,2)."/".substr($linha['data_conectada'],4,2)."/".substr($linha['data_conectada'],0,4); } ?>" />

<? } else if(($editar == '1' && $USUARIO['tipo_usuario'] == 'AUDITOR') && ($linha['data_conectada'] == '' || $linha['data_conectada'] == 'PENDENTE')){?>

<input type="text" name="dataconectada"  placeholder="ex:(dd/mm/aaaa)" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_conectada'] != ''){ echo substr($linha['data_conectada'],6,2)."/".substr($linha['data_conectada'],4,2)."/".substr($linha['data_conectada'],0,4); } ?>" />

<?}else {?>

<? if($linha['data_conectada'] != ''){ echo substr($linha['data_conectada'],6,2)."/".substr($linha['data_conectada'],4,2)."/".substr($linha['data_conectada'],0,4); } ?>

<? } ?>

</td>

</tr>
<? if($linha['produto']=="6"){?>
<tr ><td colspan="2"><hr size="1" color="#ccc" /></td></tr>
<tr>

<td><b>Pacote Velox + Fixo:</b></td>

<td>

<? if($editar == '1' && ($USUARIO['tipo_usuario'] == 'ADMINISTRADOR' || $USUARIO['tipo_usuario'] == 'AUDITOR')){ ?>

<input type="radio" name="velox_fixo" value="SIM" class="velox_fixo" <?if(isset($linha['velox_fixo']) && $linha['velox_fixo'] =="SIM"){echo "checked";}?>> Sim<br>
<input type="radio" name="velox_fixo" value="NÃO" class="velox_fixo" <?if(isset($linha['velox_fixo']) && $linha['velox_fixo'] =="NÃO"){echo "checked";}?>>Não<br>

<? } else {?>

<? if($linha['velox_fixo'] != ''){ echo $linha['velox_fixo']; } ?>

<? } ?>

</td>

</tr>
<?}?>

<? if($linha['produto']=="6"){?>
<tr  class="velox_fixo_plano"<?if($linha['velox_fixo'] == 'NÃO' || $linha['velox_fixo_plano'] == ''){?>style="display:none"<?}?>><td colspan="2"><hr size="1" color="#ccc" /></td></tr>
<tr class="velox_fixo_plano" <?if($linha['velox_fixO'] == 'NÃO' || $linha['velox_fixo_plano'] == ''){?>style="display:none"<?}?>>

<td><b>Plano Fixo:</b></td>

<td>

<? if($editar == '1' && ($USUARIO['tipo_usuario'] == 'ADMINISTRADOR' || $USUARIO['tipo_usuario'] == 'AUDITOR')){ ?>

<input type="radio" name="velox_fixo_plano" value="Fale a vontade 39,90" <?if(isset($linha['velox_fixo_plano']) && $linha['velox_fixo_plano'] =="Fale a vontade 39,90"){echo "checked";}?>> Fale a vontade 39,90 <br><span style="font-style: italic; font-size: 11px; margin-left: 19px; margin-top: 10px;">(identificador de chamadas, faz chamadas a cobrar, e só fazer recarga para fazer ddd)</span><br><br>
<input type="radio" name="velox_fixo_plano" value="Fixo local ilimitado 28,90"<?if(isset($linha['velox_fixo_plano']) && $linha['velox_fixo_plano'] =="Fixo local ilimitado 28,90"){echo "checked";}?>>Fixo local ilimitado 28,90<br> <span style="font-style: italic; font-size: 11px; margin-left: 19px;  margin-top: 10px;">(Ligações ilimitadas para fixo local)</span><br><br>
<input type="radio" name="velox_fixo_plano" value="Ilimitado fim de semana 29,90"<?if(isset($linha['velox_fixo_plano']) && $linha['velox_fixo_plano'] =="Ilimitado fim de semana 29,90"){echo "checked";}?>>Ilimitado fim de semana 29,90<br> <span style="font-style: italic; font-size: 11px; margin-left: 19px; margin-top: 10px;">(Preços reduzidos de chamada para celular e ddd no fim de semana)</span><br><br>
<? } else {?>

<? if($linha['velox_fixo_plano'] != ''){ echo $linha['velox_fixo_plano']; } ?>

<? } ?>

</td>

</tr>
<?}?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<? 

switch($linha['produto']){

case(4): $includeDetalhes = 'detalhes-venda-oi-tv.php'; break;

case(5): $includeDetalhes = 'detalhes-venda-oi-fixo.php'; break;

case(6): $includeDetalhes = 'detalhes-venda-oi-velox.php'; break;

}

include "includes/oi/".$includeDetalhes;?>

<? if($linha['status'] == 'DEVOLVIDO' || $_GET['e'] == '1'){?>

<tr id="mcdevolvido" <? if($linha['status'] != 'DEVOLVIDO'){ ?> style="display:none" <? } ?>>

	<td><b>Motivo Devolução:</b></td>

	<td>
		
		<? if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR') { ?>
		<select name="motivo_devolvido" id="motivodevolvido">

			<option value=""></option>
				<option value="Sem Porta/Link" <? if($linha['motivo_devolvido'] == 'BOV: Sem Porta/Link'){?>selected="selected"<? } ?>>BOV: Sem Porta/Link</option>
				<option value="Sem Velocidade" <? if($linha['motivo_devolvido'] == 'BOV: Sem Velocidade'){?>selected="selected"<? } ?>>BOV: Sem Velocidade</option>
				<option value="Sem Infra Cliente" <? if($linha['motivo_devolvido'] == 'BOV: Sem Infra Cliente'){?>selected="selected"<? } ?>>BOV: Sem Infra Cliente</option>
				<option value="Desistência na Auditoria" <? if($linha['motivo_devolvido'] == 'Desistência na Auditoria'){?>selected="selected"<? } ?>>Desistência na Auditoria</option>
				<option value="Divergência de informação" <? if($linha['motivo_devolvido'] == 'Divergência de informação'){?>selected="selected"<? } ?>>Divergência de informação</option>
				<option value="Venda perdida para concorrência" <? if($linha['motivo_devolvido'] == 'Venda perdida para concorrência'){?>selected="selected"<? } ?>>Venda perdida para concorrência</option>
		</select>
	
	
		<?}else if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'AUDITOR' ){ ?>
			
		<select name="motivo_devolvido" id="motivodevolvido">
			<option value=""></option>
			<option value="Sem Porta/Link" <? if($linha['motivo_devolvido'] == 'BOV: Sem Porta/Link'){?>selected="selected"<? } ?>>BOV: Sem Porta/Link</option>
			<option value="Sem Velocidade" <? if($linha['motivo_devolvido'] == 'BOV: Sem Velocidade'){?>selected="selected"<? } ?>>BOV: Sem Velocidade</option>
			<option value="Sem Infra Cliente" <? if($linha['motivo_devolvido'] == 'BOV: Sem Infra Cliente'){?>selected="selected"<? } ?>>BOV: Sem Infra Cliente</option>
			<option value="Desistência na Auditoria" <? if($linha['motivo_devolvido'] == 'Desistência na Auditoria'){?>selected="selected"<? } ?>>Desistência na Auditoria</option>
			<option value="Divergência de informação" <? if($linha['motivo_devolvido'] == 'Divergência de informação'){?>selected="selected"<? } ?>>Divergência de informação</option>
			<option value="Venda perdida para concorrência" <? if($linha['motivo_devolvido'] == 'Venda perdida para concorrência'){?>selected="selected"<? } ?>>Venda perdida para concorrência</option>
			
		</select>
		
		<? } else {?>
		
		<?= $linha['motivo_devolvido']; ?>
		
		<? } ?>

	</td>

</tr>

<? } ?>


<? if($linha['status'] == 'CANCELADO' || $_GET['e'] == '1'){?>

<tr id="mcancel" <? if($linha['status'] != 'CANCELADO'){ ?> style="display:none" <? } ?>>

	<td><b>Motivo:</b></td>

	<td>
		<? if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR' && $linha['produto']== 4) { ?>
		<select name="motivocancelamento" id="motivocancelamento">

			<option value=""></option>
			<option value="Inviabilidade Técnica" <? if($linha['motivo_cancelamento'] == 'Inviabilidade Técnica'){?>selected="selected"<? } ?>>Inviabilidade Técnica</option>
			<option value="BOV: Cliente não solicitou" <? if($linha['motivo_cancelamento'] == 'BOV: Cliente não solicitou'){?>selected="selected"<? } ?>>BOV: Cliente não solicitou</option>
			<option value="BOV: Dificuldade Financeira" <? if($linha['motivo_cancelamento'] == 'BOV: Dificuldade Financeira'){?>selected="selected"<? } ?>>BOV: Dificuldade Financeira</option>
			<option value="Desistência na Auditoria" <? if($linha['motivo_cancelamento'] == 'Desistência na Auditoria'){?>selected="selected"<? } ?>>Desistência na Auditoria</option>
			<option value="Divergência de informação" <? if($linha['motivo_cancelamento'] == 'Divergência de informação'){?>selected="selected"<? } ?>>Divergência de informação</option>
			<option value="Venda perdida para concorrência" <? if($linha['motivo_cancelamento'] == 'Venda perdida para concorrência'){?>selected="selected"<? } ?>>Venda perdida para concorrência</option>
		</select>
		<?} else if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR' && $linha['produto']== 6) { ?>
			<select name="motivocancelamento" id="motivocancelamento">
				<option value=""></option>
				<option value="BOV: Sem Porta/Link" <? if($linha['motivo_cancelamento'] == 'BOV: Sem Porta/Link'){?>selected="selected"<? } ?>>BOV: Sem Porta/Link</option>
				<option value="BOV: Sem Velocidade" <? if($linha['motivo_cancelamento'] == 'BOV: Sem Velocidade'){?>selected="selected"<? } ?>>BOV: Sem Velocidade</option>
				<option value="BOV: Sem Infra Cliente" <? if($linha['motivo_cancelamento'] == 'BOV: Sem Infra Cliente'){?>selected="selected"<? } ?>>BOV: Sem Infra Cliente</option>
				<option value="Desistência na Auditoria" <? if($linha['motivo_cancelamento'] == 'Desistência na Auditoria'){?>selected="selected"<? } ?>>Desistência na Auditoria</option>
				<option value="Divergência de informação" <? if($linha['motivo_cancelamento'] == 'Divergência de informação'){?>selected="selected"<? } ?>>Divergência de informação</option>
				<option value="Venda perdida para concorrência" <? if($linha['motivo_cancelamento'] == 'Venda perdida para concorrência'){?>selected="selected"<? } ?>>Venda perdida para concorrência</option>
			</select>
		<?} else if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'MONITOR') { ?>

		<select name="motivocancelamento" id="motivocancelamento">

			<option value=""></option>
			<option value="Inviabilidade Técnica" <? if($linha['motivo_cancelamento'] == 'Inviabilidade Técnica'){?>selected="selected"<? } ?>>Inviabilidade Técnica</option>
			<option value="Falta de Dinheiro" <? if($linha['motivo_cancelamento'] == 'Falta de Dinheiro'){?>selected="selected"<? } ?>>Falta de Dinheiro</option>
			<option value="Venda Perdida para a Concorrência" <? if($linha['motivo_cancelamento'] == 'Venda Perdida para a Concorrência'){?>selected="selected"<? } ?>>Venda Perdida para a Concorrência</option>
			<option value="Desistência do Cliente" <? if($linha['motivo_cancelamento'] == 'Desistência do Cliente'){?>selected="selected"<? } ?>>Desistência do Cliente</option>
			<option value="Endereço Não Encontrado" <? if($linha['motivo_cancelamento'] == 'Endereço Não Encontrado'){?>selected="selected"<? } ?>>Endereço Não Encontrado</option>
			<option value="Área de Risco" <? if($linha['motivo_cancelamento'] == 'Área de Risco'){?>selected="selected"<? } ?>>Área de Risco</option>
			<option value="Cancelado no VSALES" <? if($linha['motivo_cancelamento'] == 'Cancelado no VSALES'){?>selected="selected"<? } ?>>Cancelado no VSALES</option>
			<option value="Número Inválido" <? if($linha['motivo_cancelamento'] == 'Número Inválido'){?>selected="selected"<? } ?>>Número Inválido</option>

		</select>
		<?} else if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'AUDITORIA' && $linha['produto']== 4 ){ ?>
			<select name="motivocancelamento" id="motivocancelamento">
				<option value=""></option>
				<option value="BOV: Cliente não solicitou" <? if($linha['motivo_cancelamento'] == 'BOV: Cliente não solicitou'){?>selected="selected"<? } ?>>BOV: Cliente não solicitou</option>
				<option value="BOV: Dificuldade Financeira" <? if($linha['motivo_cancelamento'] == 'BOV: Dificuldade Financeira'){?>selected="selected"<? } ?>>BOV: Dificuldade Financeira</option>
				<option value="Desistência na Auditoria" <? if($linha['motivo_cancelamento'] == 'Desistência na Auditoria'){?>selected="selected"<? } ?>>Desistência na Auditoria</option>
				<option value="Divergência de informação" <? if($linha['motivo_cancelamento'] == 'Divergência de informação'){?>selected="selected"<? } ?>>Divergência de informação</option>
				<option value="Venda perdida para concorrência" <? if($linha['motivo_cancelamento'] == 'Venda perdida para concorrência'){?>selected="selected"<? } ?>>Venda perdida para concorrência</option>

			</select>
		<? } else if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'AUDITORIA' && $linha['produto']== 6 ){?>
			<select name="motivocancelamento" id="motivocancelamento">
				<option value=""></option>
				<option value="BOV: Sem Porta/Link" <? if($linha['motivo_cancelamento'] == 'BOV: Sem Porta/Link'){?>selected="selected"<? } ?>>BOV: Sem Porta/Link</option>
				<option value="BOV: Sem Velocidade" <? if($linha['motivo_cancelamento'] == 'BOV: Sem Velocidade'){?>selected="selected"<? } ?>>BOV: Sem Velocidade</option>
				<option value="BOV: Sem Infra Cliente" <? if($linha['motivo_cancelamento'] == 'BOV: Sem Infra Cliente'){?>selected="selected"<? } ?>>BOV: Sem Infra Cliente</option>
				<option value="Desistência na Auditoria" <? if($linha['motivo_cancelamento'] == 'Desistência na Auditoria'){?>selected="selected"<? } ?>>Desistência na Auditoria</option>
				<option value="Divergência de informação" <? if($linha['motivo_cancelamento'] == 'Divergência de informação'){?>selected="selected"<? } ?>>Divergência de informação</option>
				<option value="Venda perdida para concorrência" <? if($linha['motivo_cancelamento'] == 'Venda perdida para concorrência'){?>selected="selected"<? } ?>>Venda perdida para concorrência</option>
			</select>
		<? } else {?>
		
		<?= $linha['motivo_cancelamento']; ?>

		<? } ?>

	</td>

</tr>

<? } ?>
<? if($linha['status'] == 'PENDENTE' || $_GET['e'] == '1'){?>

<tr id="mcpendente" <? if($linha['status'] != 'PENDENTE'){ ?> style="display:none" <? } ?>>

	<td><b>Motivo:</b></td>

	<td>
		<? if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR'  && $linha['produto']== 4 ) { ?>
		<select name="motivopendente" id="motivopendente">

				<option value=""></option>
				<option value="Cliente com débito" <? if($linha['motivo_pendente'] == 'Cliente com débito'){?>selected="selected"<? } ?>>Cliente com débito</option>
				<option value="ID gerado" <? if($linha['motivo_pendente'] == 'ID gerado'){?>selected="selected"<? } ?>>ID gerado</option>
				<option value="Já tem pedido em aberto" <? if($linha['motivo_pendente'] == 'Já tem pedido em aberto'){?>selected="selected"<? } ?>>Já tem pedido em aberto</option>
				<option value="Parcelamento ativo" <? if($linha['motivo_pendente'] == 'Parcelamento ativo'){?>selected="selected"<? } ?>>Parcelamento ativo</option>
				<option value="Já esta vinculado ao serviço ADSL" <? if($linha['motivo_pendente'] == 'Já esta vinculado ao serviço ADSL'){?>selected="selected"<? } ?>>Já esta vinculado ao serviço ADSL</option>
		</select>
		<?} else if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR'  && $linha['produto']== 6 ) { ?>
			<select name="motivopendente" id="motivopendente">

				<option value=""></option>
				<option value="Cliente com débito" <? if($linha['motivo_pendente'] == 'Cliente com débito'){?>selected="selected"<? } ?>>Cliente com débito</option>
				<option value="ID gerado" <? if($linha['motivo_pendente'] == 'ID gerado'){?>selected="selected"<? } ?>>ID gerado</option>
				<option value="Já tem pedido em aberto" <? if($linha['motivo_pendente'] == 'Já tem pedido em aberto'){?>selected="selected"<? } ?>>Já tem pedido em aberto</option>
				<option value="Parcelamento ativo" <? if($linha['motivo_pendente'] == 'Parcelamento ativo'){?>selected="selected"<? } ?>>Parcelamento ativo</option>
				<option value="Já esta vinculado ao serviço ADSL" <? if($linha['motivo_pendente'] == 'Já esta vinculado ao serviço ADSL'){?>selected="selected"<? } ?>>Já esta vinculado ao serviço ADSL</option>
			</select>
		
		<?} else if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'AUDITORIA' && $linha['produto']== 4 ){ ?>
			<select name="motivopendente" id="motivopendente">
				<option value=""></option>
				<option value="BOV: Cliente não solicitou" <? if($linha['motivo_pendente'] == 'BOV: Cliente não solicitou'){?>selected="selected"<? } ?>>BOV: Cliente não solicitou</option>
				<option value="BOV: Dificuldade Financeira" <? if($linha['motivo_pendente'] == 'BOV: Dificuldade Financeira'){?>selected="selected"<? } ?>>BOV: Dificuldade Financeira</option>
				<option value="Desistência na Auditoria" <? if($linha['motivo_pendente'] == 'Desistência na Auditoria'){?>selected="selected"<? } ?>>Desistência na Auditoria</option>
				<option value="Divergência de informação" <? if($linha['motivo_pendente'] == 'Divergência de informação'){?>selected="selected"<? } ?>>Divergência de informação</option>
				<option value="Venda perdida para concorrência" <? if($linha['motivo_pendente'] == 'Venda perdida para concorrência'){?>selected="selected"<? } ?>>Venda perdida para concorrência</option>

			</select>
		<? } else if($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'AUDITORIA' && $linha['produto']== 6 ){?>
			<select name="motivopendente" id="motivopendente">
				<option value=""></option>
				<option value="BOV: Sem Porta/Link" <? if($linha['motivo_pendente'] == 'BOV: Sem Porta/Link'){?>selected="selected"<? } ?>>BOV: Sem Porta/Link</option>
				<option value="BOV: Sem Velocidade" <? if($linha['motivo_pendente'] == 'BOV: Sem Velocidade'){?>selected="selected"<? } ?>>BOV: Sem Velocidade</option>
				<option value="BOV: Sem Infra Cliente" <? if($linha['motivo_pendente'] == 'BOV: Sem Infra Cliente'){?>selected="selected"<? } ?>>BOV: Sem Infra Cliente</option>
				<option value="Desistência na Auditoria" <? if($linha['motivo_pendente'] == 'Desistência na Auditoria'){?>selected="selected"<? } ?>>Desistência na Auditoria</option>
				<option value="Divergência de informação" <? if($linha['motivo_pendente'] == 'Divergência de informação'){?>selected="selected"<? } ?>>Divergência de informação</option>
				<option value="Venda perdida para concorrência" <? if($linha['motivo_pendente'] == 'Venda perdida para concorrência'){?>selected="selected"<? } ?>>Venda perdida para concorrência</option>
			</select>
		<? } else {?>
		
		<?= $linha['motivo_pendente']; ?>

		<? } ?>

	</td>

</tr>

<? } ?>

</td>

</tr>







<? if(($linha['obs_recuperacao'] != '' || $editar_instalacao == '1' || $editar == '1') || (($USUARIO['tipo_usuario'] == "MONITOR") && ($linha['status'] == "DEVOLVIDO" || $linha['status'] == "SEM CONTATO") )){?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<tr id="obsrecupe" <? if($linha['obs_recuperacao'] == ''){ ?> style="display:none" <? } ?>>

<td><b>Obs. Recuperação:</b></td>

<td>

<? if((($editar_instalacao == '1' || $editar == '1') && $linha['obs_recuperacao'] == '') || (($USUARIO['tipo_usuario'] == "MONITOR") && ($linha['status'] == "DEVOLVIDO" || $linha['status'] == "SEM CONTATO") )) { ?>

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




</form>

</table>

<br />

<br />



<? if($editar == '1' || $editar_instalacao == '1' || ($_GET['e'] == '1' && ($USUARIO['tipo_usuario'] == 'LOGISTICA' || $USUARIO['tipo_usuario'] == 'MONITOR'))) {?>



<center>

<img src="img/salvar.png" height="25" onClick="javascript:validar();" style="cursor:pointer" />



<img src="img/cancelar.png" height="25" onClick="window.location = '?id=<?= $_GET['id'];?>'" style="cursor:pointer" />

</center>



<? } else {?>

<center>

<? if($USUARIO['editar_dados'] == 1 || $USUARIO['editar_instalacao'] == 1 || ($USUARIO['tipo_usuario'] == 'LOGISTICA' || $USUARIO['tipo_usuario'] == 'MONITOR') ){?>

<img src="img/editar.png" height="25" onClick="window.location = '?id=<?= $_GET['id'];?>&e=1'" style="cursor:pointer" /> 

<? } ?>



<img src="img/imprimir.png" height="25" onClick="javascript:print();" style="cursor:pointer" />

</center>

<? } ?>

</body>
</html>