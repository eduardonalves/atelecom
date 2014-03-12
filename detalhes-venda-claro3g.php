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







///////////////////////////////////







if(isset($_POST['nome'])){



if($_POST['status'] == "PRE-APROVADO" && ($linha['cpf'] != "" || $linha['cpf'] != "000.000.000-00")) {

$proposta = time();

}

else { $proposta = $linha['proposta'];}



$msisdn = $_POST['msisdn'];

$cod_autorizacao = $_POST['codautorizacao'];

$num_ordem = $_POST['numordem'];



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


// Dados da Instalação



//$data_instalacao0 = explode('/',$_POST['datainstalacao']);

//$data_ativacao = $data_instalacao0[2].$data_instalacao0[1].$data_instalacao0[0];


if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR' && $_POST['datainstalacao']!='')
{

	if($_POST['status'] == 'ATIVADO')
	{

		$data_ativacao = $_POST['datainstalacao'];

	}else{

		$data_ativacao = '';

	}

}else{

	if($linha['data_instalacao'] == '' && $_POST['status'] == 'ATIVADO')
	{

		$data_ativacao = date("Ymd");

	}else{

		$data_ativacao = '';

	}
}



if(isset($_POST['dataautorizacao'])){ $data_autorizacao = explode('/',$_POST['dataautorizacao']);
									  $data_autorizacao = $data_autorizacao[2].$data_autorizacao[1].$data_autorizacao[0];  } else {
										  
if($linha['status'] != 'AUTORIZADA' && $_POST['status'] == 'AUTORIZADA'){

$data_autorizacao = date("Ymd");
} else {
	
$data_autorizacao = $linha['data_autorizacao'];	
	
}}


$obs = $_POST['obs'];


// Motivos
$motivo_restricao = $_POST['motivorestricao'];

$motivo_cancelamento = $_POST['motivocancelamento'];


// Observações

if(strlen($_POST['obsgravacao']) > 3){
$obs1 = $_POST['obsgravacao'];	
	
$insertOBS1 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','2','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','1','".$obs1."')");
		
}

if(strlen($_POST['obsentrega']) > 3){
$obs2 = $_POST['obsentrega'];	
	
$insertOBS2 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','2','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','2','".$obs2."')");
		
}

if(strlen($_POST['obsfinalizada']) > 3){
$obs3 = $_POST['obsfinalizada'];	
	
$insertOBS3 = $conexao->query("INSERT INTO observacoes (id_venda,id_produto,id_usuario,data,tipo,observacao) VALUES ('".$_GET['id']."','2','".$USUARIO['id']."','".date("Y-m-d H:i:s")."','3','".$obs3."')");
		
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









if($_POST['status'] == ''){ $status = $linha['status'];} 



else if($_POST['status'] == 'PRE-APROVADO' && $linha['gravacao'] == "" || ($_POST['status'] == 'RECUPERADO' && $linha['gravacao'] == "" && $linha['proposta'] == "" && ($linha['cpf'] == "" || $linha['cpf'] == "000.000.000-00") )){  $status = 'GRAVAR'; }



else if($_POST['status'] == 'PRE-APROVADO' && $linha['gravacao'] != "" || ($_POST['status'] == 'RECUPERADO' && $linha['gravacao'] != "" && $linha['proposta'] != ""  && ($linha['cpf'] != "" || $linha['cpf'] != "000.000.000-00") )){  $status = 'GRAVADO'; }



else if($_POST['status'] == 'RECUPERADO' && $linha['proposta'] == "" && ($linha['cpf'] != "" || $linha['cpf'] != "000.000.000-00") ){  $status = 'PRE-ANALISE'; }



else if($_POST['status'] == 'RECUPERADO' && $linha['proposta'] != ""){  $status = 'GRAVAR'; }



else { $status = $_POST['status']; }



//////////////////////

// Atualizar Dados //

////////////////////



if($status == 'GRAVAR'){

	

$update1 = $conexao->query("UPDATE vendas_clarotv SET gravacao = '' WHERE id = '".$_GET['id']."'");	

}





$update = $conexao->query("UPDATE vendas_clarotv SET proposta = '".$proposta."', msisdn = '".$msisdn."', cod_autorizacao = '".$cod_autorizacao."', num_ordem = '".$num_ordem."', nome = '".$nome."', nascimento = '".$nascimento."', cpf = '".$cpf."', rg = '".$rg."', org_exp = '".$org_exp."', nome_mae = '".$nome_mae."', profissao = '".$profissao."', sexo = '".$sexo."', estado_civil = '".$estado_civil."', email = '".$email."', telefone = '".$telefone."', tipo_tel1 = '".$tipo_tel1."', telefone2 = '".$telefone2."', tipo_tel2 = '".$tipo_tel2."', telefone3 = '".$telefone3."', tipo_tel3 = '".$tipo_tel3."', endereco = '".$endereco."', numero = '".$numero."', lote = '".$lote."', quadra = '".$quadra."', complemento = '".$complemento."', bairro = '".$bairro."', cidade = '".$cidade."', uf = '".$uf."', cep = '".$cep."', ponto_referencia = '".$ponto_referencia."', operador = '".$operador."', monitor = '".$monitor."', status = '".$status."', valor = '".$valor."', pagamento = '".$pagamento."', banco = '".$banco."', agencia = '".$agencia."', conta_corrente = '".$conta_corrente."', data = '".$data."', plano = '".$plano."', vencimento = '".$vencimento."', agendGravacao = '".$agendGravacao."', motivo_restricao = '".$motivo_restricao."',motivo_cancelamento = '".$motivo_cancelamento."', data_instalacao = '".$data_ativacao."', data_autorizacao = '".$data_autorizacao."' WHERE id = '".$_GET['id']."' ") or die('Ocorreu um Erro ao inserir os dados!');











/////////////////

// Insert LOG //

///////////////



$data = date("Y-m-d H:i:s");

$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$_SESSION['usuario']."','Atualizou um dado no sistema (ID: ".$_GET['id'].").')");



?>





<script type="text/javascript">



window.alert('Dados atualizados com sucesso!');

window.location = '?id=<?= $_GET['id'];?>'



</script>



<?

}

////////////////////////////////////
////// EXCLUIR GRAVAÇÃO ///////////
//////////////////////////////////



if(isset($_POST['excluirgravacao'])){
	
$excluirgravacao = $conexao->query("UPDATE vendas_clarotv SET auditor = '', gravacao = '', status = 'GRAVAR' WHERE id = '".$_GET['id']."'");

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





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Detalhes Venda Claro 3G</title>



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

	document.getElementById('idbanco').style.display = '';

	

	 } else { 

	 

	 document.getElementById('idbanco').style.display = 'none';



	 }

	

	}

		

	

	

	

/////////////////////////////





function mostrar(id){ document.getElementById(id).style.display = '' }



function esconder(id){ document.getElementById(id).style.display = 'none' }



function checkstatus(v){

	

if(v == 'CANCELADO'){ document.getElementById('mcancel').style.display = ''; } 



else if(v == 'RESTRIÇÃO'){ document.getElementById('mrest').style.display = ''; } 

else{ document.getElementById('mcancel').style.display = 'none';  

document.getElementById('motivocancelamento').value = "";





document.getElementById('mrest').style.display = 'none'; }	

document.getElementById('motivorestricao').value = "";

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

	

	

	

///////////////////////////////////////////

/////////////// VALIDAÇÃO ////////////////	

/////////////////////////////////////////



function validar(){

	

cpf = $('input[name="icpf"]').val();

gravacao = '<?= $linha['gravacao'];?>';

dataautorizacao = $('input[name="dataautorizacao"]').val();


//////////	

status = $('select[name="status"]').val();

erro = 0;



// Se GRAVADO	

if(status == 'GRAVADO'){

	

if(cpf == '' || cpf == '000.000.000-00' || cpf == '111.111.111-11')

{



alert("CPF Inválido");

$('input[name="icpf"]').focus();

erro = erro+1;

stop();

}	



if(erro == 0)		

if(gravacao == '')

{



alert("Status não permitido sem gravação!");

erro = erro+1;



}}





// Se AUTORIZADA	

if(status == 'AUTORIZADA'){

	

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



<form name="editar" action="" method="post">



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

<td><b>Proposta:</b></td>

<td>



<?= $linha['proposta']; ?>



</td>

</tr>



<tr>

<td><b>MSISDN:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="msisdn" size="40" maxlength="10" value="<?= $linha['msisdn']; ?>" />

<? } else { ?>



<?= $linha['msisdn']; ?>

<input type="hidden" name="msisdn" size="40" value="<?= $linha['msisdn']; ?>" />



</td>



<? } ?>

</tr>





<tr>

<td><b>Cód. Autorização:</b></td>

<td>

<? if($editar == '1') {?>

<span id="loadcontratos" style="font-size:12px;"></span>

<input type="text" name="codautorizacao" size="40" maxlength="10" value="<?= $linha['cod_autorizacao']; ?>" onKeyUp="checkcontratos(this.value)" onChange="checkcontratos(this.value)" />

<? } else { ?>



<?= $linha['cod_autorizacao']; ?>

<input type="hidden" name="codautorizacao" size="40" value="<?= $linha['cod_autorizacao']; ?>" />



</td>



<? } ?>

</tr>



<tr>

<td><b>Número Ordem:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="numordem" size="40" maxlength="12" value="<?= $linha['num_ordem']; ?>" />

<? } else { ?>



<?= $linha['num_ordem']; ?>

<input type="hidden" name="numordem" size="40" value="<?= $linha['num_ordem']; ?>" />



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

<td><b>Data Exp.:</b></td>

<td>



<? if($editar == '1') {?>

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

<option value="DBM" <? if($linha['tipo_tel1'] == 'DBM'){?> selected="selected" <? } ?>>DBM</option> 

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



$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE grupo LIKE '%0002%' && tipo_usuario = 'MONITOR' ORDER BY nome ASC");

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



if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR') {
?>

<!--

<div id="loadoperadores" style="position:relative"></div> 

-->

<select type="text" id="operador" name="operador">

<option value="<?= $linha['operador']; ?>"><?= $OPERADORES1['nome'];?></option>

<option value="<?= $linha['operador']; ?>"></option>

<? 



$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE grupo LIKE '%0002%' && status != 'DESLIGADO' ORDER BY nome ASC");

while($OPERADORES = mysql_fetch_array($conOPERADORES)){



?>



<option value="<?= $OPERADORES['operador_id'];?>" <? if($linha['operador'] == $OPERADORES['operador_id']){?> selected="selected" <? } ?>>

<?= $OPERADORES['nome'];?>

</option>



<? } ?>



</select>

<? } else {



$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$linha['operador']."' ORDER BY nome ASC");

$OPERADORES = mysql_fetch_array($conOPERADORES);	

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



<tr>

<td><b>Plano:</b></td>

<td>

<? if($editar == '1') {?>



<select name="plano" id="plano" onChange="verificaplano(this.value)">

<option value="10GB" <? if($linha['plano'] == '10GB'){ ?> selected="selected" <? }?>>10GB</option>

<option value="5GB" <? if($linha['plano'] == '5GB'){ ?> selected="selected" <? }?>>5GB</option>

<option value="3GB" <? if($linha['plano'] == '3GB'){ ?> selected="selected" <? }?>>3GB</option>

<option value="2GB" <? if($linha['plano'] == '2GB'){ ?> selected="selected" <? }?>>2GB</option>



</select>





<? } else { ?>



<?= $linha['plano']; ?>



<input type="hidden" name="plano" value="<?= $linha['plano']; ?>" />



<? } ?>



</td>

</tr>





<tr>

<td><b>Vencimento:</b></td>

<td>

<? if($editar == '1') {?>



<input type="text" name="vencimento" size="4" value="<?=$linha['vencimento'];?>" /> 



<? } else { ?>



<?= $linha['vencimento']; ?>

<input type="hidden" name="vencimento" size="4" value="<?=$linha['vencimento'];?>" /> 





<? } ?>



</td>

</tr>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


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
<img src="img/play-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Ouvir Gravação" onClick="javascript:window.location = 'http://172.16.0.30/audio/claro3g/orig/<?= $gravacaoRE;?>'" /> <span style="font-size:13px;">Ouvir Gravação </span>
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



<img src="img/record.png" width="20" align="absmiddle" style="cursor:pointer" title="Inserir Gravação" onClick="window.location = 'upload-gravacao-simples-claro3g.php?id=<?= $linha['id'];?>&u=<?= $USUARIO['id'];?>'" /> <span style="font-size:13px;">Inserir Gravação </span>



<? } else if($linha['gravacao'] != '') {?>



<img src="img/play-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Ouvir Gravação" onClick="javascript:window.location = 'http://172.16.0.30/audio/claro3g/orig/<?= $linha['gravacao'];?>'" /> <span style="font-size:13px;">Ouvir Gravação </span>
&nbsp; &nbsp; &nbsp;


<? if($editar == 1){?>
<img src="img/delete-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Excluir Gravação" onClick="javascript:excluir();" /> <span style="font-size:13px;">Excluir Gravação </span>
<? } ?>

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
<? }} ?>


<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


<? include "includes/agendamento-gravacao.php";?>


<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr>

<td><b>Data Autorização:</b></td>

<td>

<? if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){ ?>

<input type="text" name="dataautorizacao" placeholder="ex:(dd/mm/aaaa)" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_autorizacao'] != ''){ echo substr($linha['data_autorizacao'],6,2)."/".substr($linha['data_autorizacao'],4,2)."/".substr($linha['data_autorizacao'],0,4); } ?>" />

<? } else {?>

<? echo substr($linha['data_autorizacao'],6,2)."/".substr($linha['data_autorizacao'],4,2)."/".substr($linha['data_autorizacao'],0,4); ?>

<? } ?>

</td>

</tr>



<tr>

<td><b>Data Ativação:</b></td>

<td>



<? if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR') {?>

<input type="text" name="datainstalacao" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_instalacao'] != ''){ echo substr($linha['data_instalacao'],6,2)."/".substr($linha['data_instalacao'],4,2)."/".substr($linha['data_instalacao'],0,4); } ?>" />

<? } else { ?>



<? if($linha['data_instalacao'] != ''){ echo substr($linha['data_instalacao'],6,2)."/".substr($linha['data_instalacao'],4,2)."/".substr($linha['data_instalacao'],0,4);} ?>



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

<td><b>Valor:</b></td>

<td>

<? if($editar == '1') {?>

R$ <input type="text" name="valor" id="valor" readonly size="30" value="<?= str_replace('.',',',$linha['valor']); ?>" />

<? } else { ?>



R$ <?= str_replace('.',',',$linha['valor']); ?>

<input type="hidden" name="valor" id="valor" value="<?= str_replace('.',',',$linha['valor']); ?>" />



</td>



<? } ?>



</td>

</tr>



<tr>

<td><b>Forma de Pagamento:</b></td>

<td>



<? if($editar == '1') {?>



<select name="pagamento"  onchange="verificapagamento(this.value);">

<option value="BOLETO" <? if($linha['pagamento'] == 'BOLETO'){?>selected="selected"<? } ?>>Boleto</option>

<option value="DÉBITO" <? if($linha['pagamento'] == 'DÉBITO'){?>selected="selected"<? } ?>>Débito</option>

</select>

<? } else { ?>



<?= $linha['pagamento']; ?>



<input type="hidden" value="<?= $linha['pagamento'];?>" name="pagamento" />

</td>



<? } ?>



</td>

</tr>





<tr id="idbanco" <? if($linha['pagamento'] == 'BOLETO'){?> style="display:none" <? } ?>>

<td><b>Banco:</b></td>



<td>

<? if($editar == '1') {?>



<input type="text" id="banco" name="banco" size="20" value="<?= $linha['banco'];?>" /> <b>AG:</b> <input type="text" name="agencia" id="agencia" size="5" value="<?= $linha['agencia'];?>" /> <b>CC:</b> <input type="text" name="contacorrente" id="contacorrente" size="7" value="<?= $linha['conta_corrente'];?>" />



<? } else {?>



<?= $linha['banco'].' <b>AG:</b> '.$linha['agencia'].' <b>CC:</b> '.$linha['conta_corrente'];?>

<input type="hidden" size="40" name="banco" value="<?= $linha['banco']; ?>" />

<input type="hidden" size="40" name="agencia" value="<?= $linha['agencia']; ?>" />

<input type="hidden" size="40" name="contacorrente" value="<?= $linha['conta_corrente']; ?>" />





<? } ?>

 </td>

</tr>





<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr>

<td><b>Status:</b></td>

<td>



<? if(($editar == '1') && ($USUARIO['tipo_usuario'] == 'ADMINISTRADOR' || $USUARIO['id'] == '2' || $USUARIO['id']==3227)) { ?>



<select name="status" onChange="checkstatus(this.value)">

<option value="PRE-ANALISE" <? if($linha['status'] == 'PRE-ANALISE'){?>selected="selected"<? } ?>>Pré-Análise</option>

<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>

<option value="PRE-APROVADO" <? if($linha['status'] == 'PRE-APROVADO'){?>selected="selected"<? } ?>>Pré-Aprovado</option>

<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>

<option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>

<option value="GRAVADO" <? if($linha['status'] == 'GRAVADO'){?>selected="selected"<? } ?>>Gravado</option>

<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>

<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>

<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>

<option value="AUTORIZADA" <? if($linha['status'] == 'AUTORIZADA'){?>selected="selected"<? } ?>>Autorizada</option>

<option value="PÓS VENDAS" <? if($linha['status'] == 'PÓS VENDAS'){?>selected="selected"<? } ?>>Pós Vendas</option>

<option value="ATIVADO" <? if($linha['status'] == 'ATIVADO'){?>selected="selected"<? } ?>>Ativado</option>



</select>
<? } else {?>
<!-- // EXCESSAO PARA SUPER USUARIO DE INTERNET -->
<?php

	if($editar == '1' && $USUARIO['id']==3227 && ($linha['status'] == 'DEVOLVIDO' || $linha['status'] == 'SEM CONTATO' || $linha['status'] == 'RESTRIÇÃO') )
	{
?>

<select id="status" name="status" onChange="checkstatus(this.value)">
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>
</select>
<script>

	$(window).load(function () {
		$("[name='status']").trigger("change");

	});

</script>


<? } else if(($editar == '1') && $linha['status'] == 'PRE-ANALISE') { ?>



<select name="status" onChange="checkstatus(this.value)">

<option value="PRE-ANALISE" <? if($linha['status'] == 'PRE-ANALISE'){?>selected="selected"<? } ?>>Pré-Análise</option>

<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>

<option value="PRE-APROVADO" <? if($linha['status'] == 'PRE-APROVADO'){?>selected="selected"<? } ?>>Pré-Aprovado</option>

<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>

</select>





<? } else if(($editar == '1') && $linha['status'] == 'GRAVAR') { ?>



<select name="status" onChange="checkstatus(this.value)">

<option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>

<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>

<option value="GRAVADO" <? if($linha['status'] == 'GRAVADO'){?>selected="selected"<? } ?>>Gravado</option>

<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>

</select>





<? } else if(($_GET['e'] == '1') && $linha['status'] == 'DEVOLVIDO' && ($USUARIO['tipo_usuario'] == 'MONITOR' || $USUARIO['tipo_usuario'] == 'ADMINISTRADOR')) { ?>



<select name="status" onChange="checkstatus(this.value)">

<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>

<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>

<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>

</select>



<? } else if(($editar == '1') && $linha['status'] == 'GRAVADO') { ?>



<select name="status" onChange="checkstatus(this.value)">

<option value="GRAVADO" <? if($linha['status'] == 'GRAVADO'){?>selected="selected"<? } ?>>Gravado</option>

<option value="AUTORIZADA" <? if($linha['status'] == 'AUTORIZADA'){?>selected="selected"<? } ?>>Autorizada</option>

<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>

<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>

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



<? } else if(($editar == '1') && $linha['status'] == 'PÓS VENDAS') { ?>



<select name="status" onChange="checkstatus(this.value)">

<option value="PÓS VENDAS" <? if($linha['status'] == 'PÓS VENDAS'){?>selected="selected"<? } ?>>Pós Vendas</option>

<option value="ATIVADO" <? if($linha['status'] == 'ATIVADO'){?>selected="selected"<? } ?>>Ativado</option>

<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>



</select>



<? } else { ?>



<?= $linha['status']; ?>



<input type="hidden" name="status" value="<?= $linha['status']; ?>" />



</td>



<? }} ?>



</td>

</tr>





<? if($linha['status'] == 'CANCELADO' || $_GET['e'] == '1'){?>

<tr id="mcancel" <? if($linha['status'] != 'CANCELADO'){ ?> style="display:none" <? } ?>>

<td><b>Motivo:</b></td>

<td>

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

<tr id="mrest" <? if($linha['status'] != 'RESTRIÇÃO'){ ?> style="display:none" <? } ?>>

<td><b>Motivo:</b></td>

<td>

<? if($editar == '1') { ?>

<select name="motivorestricao" id="motivorestricao">

<option value=""></option>

<option value="SPC" <? if($linha['motivo_restricao'] == 'SPC'){?>selected="selected"<? } ?>>SPC</option>

<option value="SERASA" <? if($linha['motivo_restricao'] == 'SERASA'){?>selected="selected"<? } ?>>SERASA</option>

<option value="1052" <? if($linha['motivo_restricao'] == '1052'){?>selected="selected"<? } ?>>1052</option>

<option value="Politicas Internas" <? if($linha['motivo_restricao'] == 'Politicas Internas'){?>selected="selected"<? } ?>>Politicas Internas</option>

<option value="Politicas de Segurança" <? if($linha['motivo_restricao'] == 'Politicas de Segurança'){?>selected="selected"<? } ?>>Politicas de Segurança</option>

<option value="Consultas Excedidas" <? if($linha['motivo_restricao'] == 'Consultas Excedidas'){?>selected="selected"<? } ?>>Consultas Excedidas</option>

<option value="Fraude" <? if($linha['motivo_restricao'] == 'Fraude'){?>selected="selected"<? } ?>>Fraude</option>

<option value="Limite Excedido" <? if($linha['motivo_restricao'] == 'Limite Excedido'){?>selected="selected"<? } ?>>Limite Excedido</option>

<option value="Regularizar CPF" <? if($linha['motivo_restricao'] == 'Regularizar CPF'){?>selected="selected"<? } ?>>Regularizar CPF</option>



</select>

<? } else {?>



<?= $linha['motivo_restricao']; ?>



<? } ?>

</td>

</tr>

<? } ?>





</form>

</table>

<br />

<br />



<? if($editar == '1' || $editar_instalacao == '1' || ($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'LOGISTICA') || ($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'MONITOR' && $linha['status'] == 'DEVOLVIDO')) {?>



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
