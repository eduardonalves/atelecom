<?



// Verificar se está logado

if(!isset($_SESSION['usuario'])){ ?>

	

<script type="text/javascript">

window.location = 'index.php'

</script>	

	

	

<? } 



if(isset($_POST['nome'])){

		

// Dados do cliente



$pessoa = $_POST['pessoa'];

$nome = $_POST['nome'];

$nome_mae = $_POST['nomemae'];

$nascimento = $_POST['nascd'].'/'.$_POST['nascm'].'/'.$_POST['nasca'];

if($_POST['icpf']){ $cpf = $_POST['icpf'];} else { $cpf = $_POST['icnpj'];}

$rg = $_POST['rg'];

$org_exp = $_POST['orgexp'];

$data_exp0 = explode('/',$_POST['dataexp']);

$data_exp = $data_exp0[2].$data_exp0[1].$data_exp0[0];

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





// Ensereço Instalação



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

$plano = $_POST['plano'];

$pontos = $_POST['pontos'];

$pagamento = $_POST['pagamento'];

$data0 = explode('/',$_POST['idata']);

$data = $data0[2].$data0[1].$data0[0];

$vencimento = $_POST['vencimento'];



$valor = str_replace(',','.',$_POST['valor']);





$banco = $_POST['banco'];

$agencia = $_POST['agencia'];

$conta_corrente = $_POST['contacorrente'];



// Verificar venda parceiro/interno



$conTipovenda = $conexao->query("SELECT * FROM usuarios WHERE id = '".$monitor."'");

$rowTipovenda = mysql_fetch_array($conTipovenda);


if($rowTipovenda['acesso_usuario'] == 'INTERNO'){

	if ( strstr(strtolower($rowTipovenda['login']), "internet") )
	{
	
		$tipoVenda = 'INTERNET'; $idTipoVenda = '03';
	
	}else{
		
		$tipoVenda = 'INTERNA'; $idTipoVenda = '01';
	}

	} else {

		

		$tipoVenda = 'EXTERNA'; $idTipoVenda = '02';

	}





// PROTOCOLO

$conNumvenda = $conexao->query("SELECT * FROM vendas_clarotv WHERE data LIKE '%".date('Ymd')."%'");

$rowNumvenda = mysql_num_rows($conNumvenda);



$protocolo = date("ymdHi").$idTipoVenda.str_pad(($rowNumvenda+1),4, "0", STR_PAD_LEFT);







if($cpf == '' || $cpf == '000.000.000-00' || $cpf == '111.111.111-11' || $cpf == '00.000.000/0000-00'){ $status = "GRAVAR"; } else { $status = "PRE-ANALISE";}


// EXCESSAO PARA USUARIO DE INTERNET
if  (strstr(strtolower($USUARIO['login']), 'internet')) 

{
	$status = "PRE-ANALISE";
	
}





	



$inserir = $conexao->query("INSERT INTO vendas_clarotv (protocolo,produto,tipoVenda,pessoa,nome,nome_mae,nascimento,cpf,rg,org_exp,data_exp,profissao,sexo,estado_civil,email,telefone,tipo_tel1,telefone2,tipo_tel2,telefone3,tipo_tel3,endereco,numero,lote,quadra,complemento,bairro,cidade,uf,cep,ponto_referencia,operador,monitor,plano,pagamento,data,data_venda,vencimento,valor,banco,agencia,conta_corrente,status) VALUES ('".$protocolo."','2','".$tipoVenda."','".$pessoa."','".$nome."','".$nome_mae."','".$nascimento."','".$cpf."','".$rg."','".$org_exp."','".$data_exp."','".$profissao."','".$sexo."','".$estado_civil."','".$email."','".$telefone."','".$tipo_tel1."','".$telefone2."','".$tipo_tel2."','".$telefone3."','".$tipo_tel3."','".$endereco."','".$numero."','".$lote."','".$quadra."','".$complemento."','".$bairro."','".$cidade."','".$uf."','".$cep."','".$ponto_referencia."','".$operador."','".$monitor."','".$plano."','".$pagamento."','".$data."','".$data."','".$vencimento."','".$valor."','".$banco."','".$agencia."','".$conta_corrente."','".$status."')") or die('Ocorreu um Erro ao inserir os dados!');





//LOG



$datadehoje = date("Y-m-d H:i:s");

$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$datadehoje."','".$_SESSION['usuario']."','Inseriu um novo dado no sistema.')");



?>



<script type="text/javascript">



window.alert("Cadastro efetuado com sucesso!");

window.location = '?p=claro3g';





</script>





<?



}



?>







<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>

<script type="text/javascript" src="js/calendario.js"></script>

<script type="text/javascript" src="js/cep.js"></script>

<script type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" type=text/css href="css/ui-lightness/jquery-ui-1.7.3.custom.css" />

<link rel="stylesheet" type="text/css" href="css/geral.css" />

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

	

	    function cnpj(v){

        //Remove tudo o que não é dígito

        v=v.replace(/\D/g,"");

        //Coloca parênteses em volta dos dois primeiros dígitos

        v=v.replace(/^(\d{2})(\d)/g,"$1.$2");

        //Coloca hífen entre o quarto e o quinto dígitos

        v=v.replace(/(\d{3})(\d)/,"$1.$2");

        //retorne o resultado

		v=v.replace(/(\d{3})(\d)/,"$1/$2");

        //retorne o resultado

		v=v.replace(/(\d{4})(\d)/,"$1-$2");

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

	

	

	

	

	

////////////////////////////////////



function verificapagamento(v){

	

	if(v == "DÉBITO"){ 

	document.getElementById('idbanco').style.display = '';

	document.getElementById('inppagamentoinstalacao').style.display = 'none';

	

	 } else { 

	          document.getElementById('idbanco').style.display = 'none'; 	

			  document.getElementById('inppagamentoinstalacao').style.display = '';   

			  }

	

	}

	

	

function verificaplano(v){



if(v == "10GB"){ document.getElementById('valor').value = '159,92'; }

else if(v == "5GB"){ document.getElementById('valor').value = '95,92'; }

else if(v == "3GB"){ document.getElementById('valor').value = '71,92'; }

else if(v == "2GB"){ document.getElementById('valor').value = '63,92'; }

else { document.getElementById('valor').value = '';}



}

	

	

function verificapessoa(v){

	

if(v == 'Pessoa Jurídica') {

	

     document.getElementById('nomel').innerHTML = 'Razão Social:';

     document.getElementById('nomemael').style.display = 'none';

     document.getElementById('cpfl').style.display = 'none';

	 document.getElementById('idcpf').value = '';

     document.getElementById('cnpjl').style.display = '';

	 

	 document.getElementById('inpnasc').style.display = 'none';

	 document.getElementById('inprg').style.display = 'none';

	 document.getElementById('inpprofissao').style.display = 'none';

	 document.getElementById('inpsexo').style.display = 'none';

	 document.getElementById('inpestadocivil').style.display = 'none';

	 

} else if(v == 'Pessoa Física') {

	

     document.getElementById('nomel').innerHTML = 'Nome:';

     document.getElementById('nomemael').style.display = '';	 

     document.getElementById('cpfl').style.display = '';

 	 document.getElementById('idcnpj').value = '';

     document.getElementById('cnpjl').style.display = 'none';



	 document.getElementById('inpnasc').style.display = '';

	 document.getElementById('inprg').style.display = '';

	 document.getElementById('inpprofissao').style.display = '';

	 document.getElementById('inpsexo').style.display = '';

	 document.getElementById('inpestadocivil').style.display = '';

	 

	

	}

	

	

	}

	

	

///////////////////////





function submitform(){

	

	

e=0;



/////// -- DADOS PESSOAIS -- ////////

if(!document.getElementById('pessoa1').checked && !document.getElementById('pessoa2').checked){ document.getElementById('epessoa').style.display = ''; e=(e+1)} else { document.getElementById('epessoa').style.display = 'none';}



if(document.getElementById('nome').value == ''){ document.getElementById('enome').style.display = ''; e=(e+1)} else { document.getElementById('enome').style.display = 'none';}	



	

//if(document.getElementById('idcpf').value == '' && document.getElementById('idcnpj').value == ''){ document.getElementById('ecpf').style.display = ''; e=(e+1)} else { document.getElementById('ecpf').style.display = 'none';}



//if(document.getElementById('idcpf').value == '' && document.getElementById('idcnpj').value == '' && document.getElementById('pessoa2').checked){ document.getElementById('ecnpj').style.display = ''; e=(e+1)} else { document.getElementById('ecnpj').style.display = 'none';}





if(!document.getElementById('pessoa2').checked){

	

if(document.getElementById('nomemae').value == ''){ document.getElementById('enomemae').style.display = ''; e=(e+1)} else { document.getElementById('enomemae').style.display = 'none';}

	

if(document.getElementById('nascd').value == '' || document.getElementById('nascm').value == '' || document.getElementById('nasca').value == ''){ document.getElementById('enasc').style.display = ''; e=(e+1)} else { document.getElementById('enasc').style.display = 'none';}	



//if(document.getElementById('rg').value == '' || document.getElementById('orgexp').value == ''){ document.getElementById('erg').style.display = ''; e=(e+1)} else { document.getElementById('erg').style.display = 'none';}



if(document.getElementById('profissao').value == ''){ document.getElementById('eprofissao').style.display = ''; e=(e+1)} else { document.getElementById('eprofissao').style.display = 'none';}



if(!document.getElementById('sexo1').checked && !document.getElementById('sexo2').checked){ document.getElementById('esexo').style.display = ''; e=(e+1)} else { document.getElementById('esexo').style.display = 'none';}



if(document.getElementById('estadocivil').value == ''){ document.getElementById('eestadocivil').style.display = ''; e=(e+1)} else { document.getElementById('eestadocivil').style.display = 'none';}



if(document.getElementById('estadocivil').value == ''){ document.getElementById('eestadocivil').style.display = ''; e=(e+1)} else { document.getElementById('eestadocivil').style.display = 'none';}





}





if(document.getElementById('email').value == ''){ document.getElementById('eemail').style.display = ''; e=(e+1)} else { document.getElementById('eemail').style.display = 'none';}



if(document.getElementById('tel1').value == ''){ document.getElementById('etelefone').style.display = ''; e=(e+1)} else { document.getElementById('etelefone').style.display = 'none';}







/////// -- ENDEREÇO CLIENTE -- ////////



if(document.getElementById('endereco').value == '' || document.getElementById('numero').value == ''){ document.getElementById('eendereco').style.display = ''; e=(e+1)} else { document.getElementById('eendereco').style.display = 'none';}		

	

if(document.getElementById('bairro').value == ''){ document.getElementById('ebairro').style.display = ''; e=(e+1)} else { document.getElementById('ebairro').style.display = 'none';}



if(document.getElementById('uf').value == ''){ document.getElementById('euf').style.display = ''; e=(e+1)} else { document.getElementById('euf').style.display = 'none';}	



if(document.getElementById('cidade').value == ''){ document.getElementById('ecidade').style.display = ''; e=(e+1)} else { document.getElementById('ecidade').style.display = 'none';}	



//if(document.getElementById('idcep').value == ''){ document.getElementById('ecep').style.display = ''; e=(e+1)} else { document.getElementById('ecep').style.display = 'none';}	





/////// -- DADOS DA VENDA -- ////////





if(document.getElementById('operador').value == ''){ document.getElementById('eoperador').style.display = ''; e=(e+1)} else { document.getElementById('eoperador').style.display = 'none';}	



if(document.getElementById('monitor').value == ''){ document.getElementById('emonitor').style.display = ''; e=(e+1)} else { document.getElementById('emonitor').style.display = 'none';}	



if(document.getElementById('plano').value == ''){ document.getElementById('eplano').style.display = ''; e=(e+1)} else { document.getElementById('eplano').style.display = 'none';}	





if(document.getElementById('calendario2').value == ''){ document.getElementById('evenda').style.display = ''; e=(e+1)} else { document.getElementById('evenda').style.display = 'none';}

	


if(document.getElementById('valor').value == ''){ document.getElementById('evalor').style.display = ''; e=(e+1)} else { document.getElementById('evalor').style.display = 'none';}



if( document.getElementById('pagamento').value == 'DÉBITO' && (document.getElementById('banco').value == '' || document.getElementById('agencia').value == '' || document.getElementById('contacorrente').value == '')){ document.getElementById('ebanco').style.display = ''; e=(e+1)} else { document.getElementById('ebanco').style.display = 'none';}


if(document.getElementById('vencimento').value == ''){ document.getElementById('evencimento').style.display = ''; e=(e+1)} else { document.getElementById('evencimento').style.display = 'none';}	
	


/////// -- VERIFICAR SE EXISTEM ERROS -- ////////



if(e!=0){ window.alert('ERRO: Preencha todos os campos indicados, corretamente'); $('body,html').animate({scrollTop: 150}, 800);} else { document.forms.inserir.submit(); }

	

}







///////////////////////////////////

///////// CHECAR PROPOSTA////////

/////////////////////////////////



function checkcpf(c){

	

	

	$('#loadcpf').load('check-cpf-claro3g.php?c='+c);

	

	

	}

	

function checkoperador(m){

	

	

	$('#loadoperadores').load('check-operadores.php?m='+m+'&g=0002');

	

	

	}

	

function checkcidades(uf,cidade){

	

	

	$('#loadcidades').load('check-cidades.php?uf='+uf+'&c='+cidade);

	

	

	

	}	

	



$(document).ready(function(e) {

	

	checkoperador();

	checkcidades()

	});



</script>









<style type="text/css">



.erro{color:#C00; font-size:12px;}



</style>



<!-- SUBMENU -->

<? include "submenu-claro3g.php";?>

<!-- FIM DO SUBMENU -->



<center>

<table border="0" width="1000px">



<tr valign="bottom" height="40px" align="left">

<td style="font-size:14px; color:#999;">NOVA VENDA</td>

<td align="right"><img src="img/voltar.png" style="cursor:pointer" onclick="window.location = '?p=clarotv'" /></td>

</tr>



<tr>

<td colspan="2"><hr size="1" color="#CCCCCC" /></td>

</tr>



</table>





<center>

<form name="inserir" action="" method="post">



<table border="0" width="850px" >



<tr align="left">

<td>Monitor:</td>

<td>

<select type="text" id="monitor" name="monitor" onchange="checkoperador(this.value)">

<option value=""></option>

<? $conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario = 'MONITOR' && grupo LIKE '%0002%'");

   while($MONITORES = mysql_fetch_array($conMONITORES)){

?>

<option value="<?= $MONITORES['id']?>"><?= $MONITORES['nome']?></option>

<? } ?>

</select> 

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="emonitor" style="display:none">Por favor, selecione o monitor responsável pelo operador que fez a venda!</span>

</td>

</tr>



<tr align="left">

<td>Operador:</td>

<td>

<div id="loadoperadores" style="position:relative"></div>

</td>

</tr>



<tr height="30px" valign="bottom" align="left">

<td style="color:#069; font-size:12px">Dados do Cliente</td>

</tr>



<tr align="left">

<td>Tipo:</td>

<td>

<input type="radio" name="pessoa" id="pessoa1" value="Pessoa Física" onchange="verificapessoa(this.value)" /> Pessoa Física

<input type="radio" name="pessoa" id="pessoa2" value="Pessoa Jurídica" onchange="verificapessoa(this.value)" /> Pessoa Jurídica

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="epessoa" style="display:none">Por favor, selecione o tipo do cliente!</span>

</td>

</tr>



<tr align="left">

<td id="nomel">Nome:</td>

<td><input type="text" id="nome" name="nome" size="40" />

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="enome" style="display:none">Por favor, digite o nome do cliente!</span>

</td>

</tr>



<tr align="left" id="nomemael">

<td>Nome da Mãe:</td>

<td><input type="text" id="nomemae" name="nomemae" size="40" />

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="enomemae" style="display:none">Por favor, digite o nome da mãe do cliente!</span>

</td>

</tr>



<tr align="left" id="inpnasc">

<td>Nascimento:</td>

<td>



<select name="nascd" id="nascd">

<option value=""></option>

<? $d = 1; while($d <= 31){ $dn = $d++;?>

<option value="<?= sprintf("%02d", $dn); ?>"> <?= sprintf("%02d", $dn); ?></option>

<? } ?>

</select>



<select name="nascm" id="nascm">

<option value=""></option>

<? $m = 1; while($m <= 12){ $mn = $m++;?>

<option value="<?= sprintf("%02d", $mn); ?>"> <?= sprintf("%02d", $mn); ?></option>

<? } ?>

</select>



<select name="nasca" id="nasca">

<option value=""></option>

<? $a = date('Y'); while($a > 1900){ $an = $a--;?>

<option value="<?= $an; ?>"> <?= $an; ?></option>

<? } ?>

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="enasc" style="display:none">Por favor, selecione uma data de nascimento válida!</span>

</td>

</tr>





<tr align="left" id="cpfl">

<td>CPF:</td>

<td id="cpfinp"> <div id="loadcpf"></div> <input type="text" id="idcpf" name="icpf" onKeyPress="mascara(this,cpf)" onkeyup="checkcpf(this.value)" maxlength="14" size="20" />

<span class="erro" id="ecpf" style="display:none">Por favor, digite o CPF do cliente!</span>

</td>

</tr>





<tr align="left" id="cnpjl" style="display:none">

<td>CNPJ:</td>

<td id="cpfinp"><input type="text" id="idcnpj" name="icnpj" onKeyPress="mascara(this,cnpj)" maxlength="18" size="20" />

<span class="erro" id="ecnpj" style="display:none">Por favor, digite o CNPJ do cliente!</span>

</td>

</tr>





<tr align="left" id="inprg">

<td>RG:</td>

<td id="rginp"><input type="text" id="rg" name="rg" size="20" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span> Org. Exp: <input type="text" title="Orgão Expedidor" id="orgexp" name="orgexp" size="20" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span> 

 Data Exp: <input type="text" title="Data Expedição" id="dataexp" name="dataexp" onKeyPress="mascara(this,data)" maxlength="10" size="20" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span> 



<span class="erro" id="erg" style="display:none">Por favor, digite o RG do cliente!</span>

</td>

</tr>





<tr align="left" id="inpprofissao">

<td class="t1">Profissão:</td>

<td><input type="text" name="profissao" id="profissao" size="50" /> 

<span class="campoobrigatorio" title="Campo Obrigatório">*</span> 

<span class="erro" id="eprofissao" style="display:none">Por favor, preencha a profissão do cliente!</span></td>

</tr>



<tr align="left" id="inpsexo">

<td class="t1">Sexo:</td>

<td><input type="radio" name="sexo" id="sexo1" value="Masculino" /> Masculino <input type="radio" name="sexo" id="sexo2" value="Feminino" /> Feminino

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="esexo" style="display:none">Por favor, selecione o sexo do cliente!</span>

</td>

</tr>



<tr align="left" id="inpestadocivil">

<td class="t1">Estado Civil:</td>

<td>

<select name="estadocivil" id="estadocivil" >

<option value=""></option>

<option value="Solteiro">Solteiro</option>

<option value="Casado">Casado</option>

<option value="Desquitado">Desquitado</option>

<option value="Separado">Separado</option>

<option value="Divorciado">Divorciado</option> 

<option value="Viúvo">Viúvo</option> 

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="eestadocivil" style="display:none">Por favor, selecione o Estado Civil do cliente!</span>

</td>

</tr>





<tr align="left">

<td>Email:</td>

<td><input type="text" id="email" name="email"  size="30" />

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="eemail" style="display:none">Por favor, digite o Email do cliente!</span>

</td>

</tr>



<tr align="left">

<td>Telefone 1:</td>

<td><input type="text"  id="tel1" name="itelefone" onKeyPress="mascara(this,telefone)" maxlength="15" size="20" /> 

<select name="tipotel1">

<option value="DBM">DBM</option> 

<option value="Residencial">Residencial</option> 

<option value="Celular">Celular</option>

<option value="Comercial">Comercial</option>

</select> 

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="etelefone" style="display:none">Por favor, digite pelo menos um telefone do cliente!</span>

</td>

</tr>



<tr align="left">

<td>Telefone 2:</td>

<td><input type="text" name="itelefone2" onKeyPress="mascara(this,telefone)" maxlength="15" size="20" /> 

<select name="tipotel2">

<option value="DBM">DBM</option> 

<option value="Residencial" selected="selected">Residencial</option> 

<option value="Celular">Celular</option>

<option value="Comercial">Comercial</option>

</select>

</td>

</tr>



<tr align="left">

<td>Telefone 3:</td>

<td><input type="text" name="itelefone3" onKeyPress="mascara(this,telefone)" maxlength="15" size="20" /> 

<select name="tipotel3">

<option value="DBM">DBM</option> 

<option value="Residencial">Residencial</option> 

<option value="Celular" selected="selected">Celular</option>

<option value="Comercial">Comercial</option>

</select>

</td>

</tr>



<tr height="30px" valign="bottom" align="left">

<td style="color:#069; font-size:12px">Endereço do Cliente</td>

</tr>



<tr align="left">

<td>CEP:</td>

<td><input type="text" id="idcep" onkeyup="return getEndereco()" onchange="return getEndereco()" name="icep" size="30" onKeyPress="mascara(this,cep)" maxlength="9" > <span class="erro" id="ecep" style="display:none">Por favor, digite o CEP da instalação!</span></td>

</tr>



<tr align="left">

<td>Endereço:</td>

<td><input type="text" id="endereco" name="endereco" size="40" > <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 Nº: <input type="text" name="numero" id="numero" size="5" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 Lote: <input type="text" name="lote" id="lote" size="5" /> 

 Quadra: <input type="text" name="quadra" id="quadra" size="5" /> <br /> 

 <span class="erro" id="eendereco" style="display:none">Por favor, digite pelo menos o logradouro e o número do endereço de instalação!</span>

 </td>

</tr>



<tr align="left">

<td>Complemento:</td>

<td><input type="text" id="complemento" name="complemento" size="30" ></td>

</tr>



<tr align="left">

<td>Bairro:</td>

<td><input type="text" id="bairro" name="bairro" size="30" > 

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="ebairro" style="display:none">Por favor, digite o bairro da instalação!</span></td>

</tr>





<tr align="left">

<td>Estado:</td>

<td>

<select name="uf" id="uf" onchange="checkcidades(this.value,'')">

<option value=""></option>

<? $conESTADO = $conexao->query("SELECT DISTINCT(uf),nome FROM tb_estados");

   while($ESTADO = mysql_fetch_array($conESTADO)){

?>



<option value="<?= $ESTADO['uf'];?>"><?= $ESTADO['nome'];?></option>



<? } ?>

</select> 

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="euf" style="display:none">Por favor, selecione o estado da instalação!</span>

</td>

</tr>



<tr align="left">

<td>Cidade:</td>

<td>

<input type="text" id="cidade" name="cidade" size="30" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>



<span class="erro" id="ecidade" style="display:none">Por favor, selecione a cidade da instalação!</span></td>

</tr>





<tr align="left">

<td>Ponto de Referência:</td>

<td><textarea name="pontoref" rows="3" cols="30"></textarea>

</td>

</tr>









<tr height="30px" valign="bottom" align="left">

<td style="color:#069; font-size:12px">Dados da Venda</td>

</tr>



<tr align="left">

<td>Plano:</td>

<td>

<select name="plano" id="plano" onchange="verificaplano(this.value);">

<option value=""></option>



<option value="10GB">10GB</option>

<option value="5GB">5GB</option>

<option value="3GB">3GB</option>

<option value="2GB">2GB</option>





</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="eplano" style="display:none">Por favor, selecione um plano!</span>

</td>

</tr>





<tr align="left">

<td>Valor:</td>

<td> <span style="font-size:12px; color:#999; font-style:italic">R$</span> <input type="text" id="valor" name="valor" readonly="readonly" size="8" maxlength="10" /> <span style="font-size:12px; color:#999; font-style:italic">(0,00)</span> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 <br /> <span class="erro" id="evalor" style="display:none">Por favor, digite o valor da instalação!</span>

</td>

</tr>



<tr align="left">

<td>Pagamento:</td>

<td>

<select name="pagamento" id="pagamento" onchange="verificapagamento(this.value);">

<option value="BOLETO">BOLETO</option>

<option value="DÉBITO">DÉBITO</option>

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

</td>

</tr>



<tr align="left">

<td>Data Venda:</td>

<td><input type="text" id="calendario2" name="idata" onKeyPress="mascara(this,data)" maxlength="10" value="<?= date("d/m/Y");?>" size="20" /> <span style="font-size:12px; color:#999; font-style:italic">(dd/mm/aaaa)</span> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 <br /> 

<span class="erro" id="evenda" style="display:none">Por favor, selecione a data da venda!</span>

</td>

</tr>



<tr align="left">

<td>Vencimento:</td>

<td>

<select name="vencimento" id="vencimento">

<option value=""></option>
<option value="03">03</option>
<option value="12">12</option>
<option value="15">15</option>
<option value="19">19</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="24">24</option>
<option value="26">26</option>


</select>




<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 <span class="erro" id="evencimento" style="display:none">Por favor, selecione uma data de vencimento da fatura!</span>

</td>

</tr>



<tr id="idbanco" style="display:none">

<td>Banco:</td>

<td><input type="text" id="banco" name="banco" size="20" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 AG: <input type="text" name="agencia" id="agencia" size="5" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 CC: <input type="text" name="contacorrente" id="contacorrente" size="7" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<br />

<span class="erro" id="ebanco" style="display:none">Por favor, preencha todos os dados da conta do cliente!</span>

 </td>

</tr>





<tr height="50px" valign="bottom" align="left">

<td></td>

<td><img src="img/salvar.png" style="cursor:pointer" align="absmiddle" onclick="submitform();" /> 

<span class="campoobrigatorio">(*) Campos Obrigatórios!</span>

</td>

</tr>



</table>



</form>



</center>	

</center>



<br />

<br />

