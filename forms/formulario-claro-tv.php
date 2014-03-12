<?

include "conexao.php";

if(isset($_POST['nome'])){
		
//vendedor
$data = date("Y-m-d H:i:s");
$vendedor = $_GET['user'];
$vendedor_nome = $_GET['fullname'];
//cliente	
$nome = $_POST['nome'];	
$nascimento = $_POST['nascd']."/".$_POST['nascm']."/".$_POST['nasca'];	
$cpf = $_POST['icpf'];
$rg = $_POST['rg'];
$org_exp = $_POST['rgorg'];
$profissao = $_POST['profissao'];
$sexo = $_POST['sexo'];
$estado_civil = $_POST['estadocivil'];
$telefone = $_POST['itelefone'];
$celular = $_POST['icelular'];
$email = $_POST['email'];
//endereço de instalação
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$lote = $_POST['lote'];
$quadra = $_POST['quadra'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$cep = $_POST['icep'];
//dados da compra
$plano_escolhido = $_POST['plano'];
$plano_ponto_principal = $_POST['planopontoprincipal'];
$pacotes_e_canais_adicionais = $_POST['pacotesadicionais'];
$ponto_extra = $_POST['pontoextra'];
$combo = $_POST['combo'];
$dia_vencimento = $_POST['vencimento'];
$forma_pagamento = $_POST['pagamento'];
$banco = $_POST['Banco'];
$agencia = $_POST['agencia'];
$conta_corrente = $_POST['contacorrente'];
$status = "SALE";

$inserir = "INSERT INTO vento_forms_clarotv (data,vendedor,vendedor_nome,nome,nascimento,cpf,rg,org_exp,profissao,sexo,estado_civil,telefone,celular,email,rua,numero,lote,quadra,complemento,bairro,cidade,cep,plano_escolhido,plano_ponto_principal,pacotes_e_canais_adicionais,ponto_extra,combo,dia_vencimento,forma_pagamento,banco,agencia,conta_corrente,status) VALUES ('".$data."', '".$vendedor."', '".$vendedor_nome."', '".$nome."', '".$nascimento."', '".$cpf."', '".$rg."', '".$org_exp."', '".$profissao."', '".$sexo."', '".$estado_civil."', '".$telefone."', '".$celular."', '".$email."', '".$rua."', '".$numero."', '".$lote."', '".$quadra."', '".$complemento."', '".$bairro."', '".$cidade."', '".$cep."', '".$plano_escolhido."', '".$plano_ponto_principal."', '".$pacotes_e_canais_adicionais."', '".$ponto_extra."', '".$combo."', '".$dia_vencimento."', '".$forma_pagamento."', '".$banco."', '".$agencia."', '".$conta_corrente."', '".$status."')"; 

$query = mysql_query($inserir,$conexao) or die("Erro ao enviar o Formulário!");

?>

<script type="text/javascript">
window.alert('Formulário enviado com Sucesso!');
window.close();
</script>
	
<? } ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Formul&aacute;rio - Claro TV</title>
</head>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

<script type="text/javascript">
		function toggleLayer(val)
		{
			if(val == 'Débito')
			{
				document.getElementById('banco').style.display = '';
				document.getElementById('vencimento5').style.display = '';
				document.getElementById('venci20txt').style.display = '';


			}
			else if(val == 'Boleto')
			{

				document.getElementById('banco').style.display = 'none';
				document.getElementById('vencimento5').style.display = 'none';
				document.getElementById('venci20txt').style.display = 'none';
				document.getElementById('vencimento5').checked = false;

			}
		}
		
		
		
		
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
        //Coloca parênteses em volta dos dois primeiros dígitos
        //Coloca hífen entre o quarto e o quinto dígitos
        v=v.replace(/(\d{5})(\d)/,"$1-$2");
        //retorne o resultado
        return v;
    }	
	
	
	
	
	
/////////////////////////////////////////////////////////////////////////	
//////////////////////////CONFERIR DADOS/////////////////////////////////		
/////////////////////////////////////////////////////////////////////////


function conferir(){

e=0;


/////// -- DADOS DO CLIENTE -- ////////
if(document.getElementById('nome').value == ''){ document.getElementById('enome').style.display = ''; e=(e+1)} else { document.getElementById('enome').style.display = 'none';}

if(document.getElementById('nascd').value == '' || document.getElementById('nascm').value == '' || document.getElementById('nasca').value == ''){ document.getElementById('enascimento').style.display = ''; e=(e+1)} else { document.getElementById('enascimento').style.display = 'none';}

if(document.getElementById('icpf').value == ''){ document.getElementById('ecpf').style.display = ''; e=(e+1)} else { document.getElementById('ecpf').style.display = 'none';}

if(document.getElementById('rg').value == '' || document.getElementById('rgorg').value == ''){ document.getElementById('erg').style.display = ''; e=(e+1)} else { document.getElementById('erg').style.display = 'none';}

if(document.getElementById('profissao').value == ''){ document.getElementById('eprofissao').style.display = ''; e=(e+1)} else { document.getElementById('eprofissao').style.display = 'none';}

if(!document.getElementById('sexo1').checked && !document.getElementById('sexo2').checked){ document.getElementById('esexo').style.display = ''; e=(e+1)} else { document.getElementById('esexo').style.display = 'none';}

if(document.getElementById('estadocivil').value == ''){ document.getElementById('eestadocivil').style.display = ''; e=(e+1)} else { document.getElementById('eestadocivil').style.display = 'none';}

if(document.getElementById('estadocivil').value == ''){ document.getElementById('eestadocivil').style.display = ''; e=(e+1)} else { document.getElementById('eestadocivil').style.display = 'none';}

/////// -- ENDEREÇO DE INSTALAÇÃO -- ////////

if(document.getElementById('rua').value == '' || document.getElementById('numero').value == ''){ document.getElementById('erua').style.display = ''; e=(e+1)} else { document.getElementById('erua').style.display = 'none';}

if(document.getElementById('cidade').value == ''){ document.getElementById('ecidade').style.display = ''; e=(e+1)} else { document.getElementById('ecidade').style.display = 'none';}

if(document.getElementById('bairro').value == ''){ document.getElementById('ebairro').style.display = ''; e=(e+1)} else { document.getElementById('ebairro').style.display = 'none';}

if(document.getElementById('icep').value == ''){ document.getElementById('ecep').style.display = ''; e=(e+1)} else { document.getElementById('ecep').style.display = 'none';}

/////// -- DADOS DA COMPRA -- ////////

if(!document.getElementById('plano1').checked && !document.getElementById('plano2').checked){ document.getElementById('eplano').style.display = ''; e=(e+1)} else { document.getElementById('eplano').style.display = 'none';}

if(!document.getElementById('planopontoprincipal1').checked && !document.getElementById('planopontoprincipal2').checked && !document.getElementById('planopontoprincipal3').checked){ document.getElementById('eplanoponto').style.display = ''; e=(e+1)} else { document.getElementById('eplanoponto').style.display = 'none';}

if(!document.getElementById('pontoextra1').checked && !document.getElementById('pontoextra2').checked){ document.getElementById('epontoextra').style.display = ''; e=(e+1)} else { document.getElementById('epontoextra').style.display = 'none';}

if(!document.getElementById('combo1').checked && !document.getElementById('combo2').checked){ document.getElementById('ecombo').style.display = ''; e=(e+1)} else { document.getElementById('ecombo').style.display = 'none';}

if(!document.getElementById('vencimento1').checked && !document.getElementById('vencimento2').checked && !document.getElementById('vencimento3').checked && !document.getElementById('vencimento4').checked && !document.getElementById('vencimento5').checked){ document.getElementById('evencimento').style.display = ''; e=(e+1)} else { document.getElementById('evencimento').style.display = 'none';}

if(!document.getElementById('pagamento1').checked && !document.getElementById('pagamento2').checked){ document.getElementById('epagamento').style.display = ''; e=(e+1)} else { document.getElementById('epagamento').style.display = 'none';}

if(document.getElementById('pagamento1').checked && (document.getElementById('Banco').value == '' || document.getElementById('agencia').value == '' || document.getElementById('contacorrente').value == '')){ document.getElementById('ebanco').style.display = ''; e=(e+1)} else { document.getElementById('ebanco').style.display = 'none';}


// SE TIVER ALGUM ERRO

if(e!=0){ window.alert('ERRO: Preencha todos os campos incados, corretamente'); $('body,html').animate({scrollTop: 130}, 800);}	

else { document.forms['clarotv'].submit();}
	
}


</script>
        
        
<style type="text/css">

body{font-family:Arial, Helvetica, sans-serif; margin: 0 0 0 0;}


#topo{position: absolute; width: 100%; height: 160px; background-color:#DEDEDE;


background-image: linear-gradient(bottom, #FFFFFF 1%, #DEDEDE 100%);
background-image: -o-linear-gradient(bottom, #FFFFFF 1%, #DEDEDE 100%);
background-image: -moz-linear-gradient(bottom, #FFFFFF 1%, #DEDEDE 100%);
background-image: -webkit-linear-gradient(bottom, #FFFFFF 1%, #DEDEDE 100%);
background-image: -ms-linear-gradient(bottom, #FFFFFF 1%, #DEDEDE 100%);

background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0.01, #FFFFFF),
	color-stop(1, #DEDEDE)
);
}



#conteudo{position:absolute; width:1000px; margin: 0 0 0 -500px; left:50%; top:133px;}


.t1{ font-weight:bold; color:#B00; cursor:default;}

.t2{ color:#AAA; font-size:16px;}

.erro{font-size:10px; color:#900;}
</style>

<body>
<link rel="shortcut icon" href="../img/icone.ico" />

<div id="topo">

<center>
<table border="0" width="1000px">

<tr>
<td width="150px"><img src="img/logo-claro.png" /></td>
<td style="color:#565656;font-size:32px"><b style="font-size:48px">Claro TV</b> - Formul&aacute;rio de Venda</td>
<td width="150px"><img src="img/logo-vento-40.png" /></td>
</tr>


<tr>
<td colspan="3" align="right">


<table border="0">

<tr algin="right">
<td class="t1" width="60px">
Operador:
</td>
<td><?= $_GET['fullname'];?></td>

<td>&nbsp; &nbsp;</td>
<td class="t1">
Data:
</td>
<td><?= date("d/m/Y")?></td>
</tr>

</table>


</td>
</tr>

</table>
</center>


</div>



<div id="conteudo">
<br />

<table width="100%">

<form name="clarotv" action="" method="post">

<tr valign="bottom">
<td colspan="2" class="t2">
Dados do Cliente
<hr size="1" color="#CCCCCC" />
</td>
</tr>


<tr>
<td class="t1">Nome:</td>
<td><input type="text" id="nome" name="nome" <? if($_GET['first_name']){?>value="<?=$_GET['first_name']." ".$_GET['middle_initial']." ".$_GET['last_name']; ?>"<? } ?> size="60" /> <span class="erro" id="enome" style="display:none">Por favor, preencha o nome do cliente!</span></td>
</tr>

<tr>
<td class="t1">Nascimento:</td>
<td>
<select name="nascd" id="nascd">
<option value=""></option>
<? $i='1'; while($i<=31){ $nascD = $i++; ?>
<option value="<?= $nascD;?>"><?= $nascD;?></option>
<? } ?>
</select>

<select name="nascm" id="nascm">
<option value=""></option>
<? $i2='1'; while($i2<=12){ $nascM = $i2++; ?>
<option value="<?= $nascM;?>"><?= $nascM;?></option>
<? } ?>
</select>


<select name="nasca" id="nasca">
<option value=""></option>
<? $i3=date('Y'); while($i3>=1900){ $nascA = $i3--; ?>
<option value="<?= $nascA;?>"><?= $nascA;?></option>
<? } ?>
</select>
<span class="erro" id="enascimento" style="display:none">Por favor, selecione uma data v&aacute;lida!</span>
</td>
</tr>


<tr>
<td class="t1">CPF:</td>
<td><input type="text" name="icpf" id="icpf" onKeyPress="mascara(this,cpf)" maxlength="14" size="30" /> <span class="erro" id="ecpf" style="display:none">Por favor, digite os n&uacute;meors do CPF do cliente!</span></td>
</tr>

<tr>
<td class="t1">RG:</td>
<td><input type="text" name="rg" id="rg" size="30" /> &nbsp;
<span class="t1">Org. Exp.:</span> <input type="text" name="rgorg" id="rgorg" size="30" />
<br /><span class="erro" id="erg" style="display:none">Por favor, digite o RG e o &Oacute;rg&atilde;o Expedidor corretamente!</span>
</td>
</tr>


<tr>
<td class="t1">Profiss&atilde;o:</td>
<td><input type="text" name="profissao" id="profissao" size="50" /> <span class="erro" id="eprofissao" style="display:none">Por favor, preencha a profiss&atilde;o do cliente!</span></td>
</tr>

<tr>
<td class="t1">Sexo:</td>
<td><input type="radio" name="sexo" id="sexo1" value="Masculino" /> Masculino <input type="radio" name="sexo" id="sexo2" value="Feminino" /> Feminino
<span class="erro" id="esexo" style="display:none">Por favor, selecione o sexo do cliente!</span>
</td>
</tr>

<tr>
<td class="t1">Estado Civil:</td>
<td>
<select name="estadocivil" id="estadocivil" >
<option value=""></option>
<option value="Solteiro">Solteiro</option>
<option value="Casado">Casado</option>
<option value="Desquitado">Desquitado</option>
<option value="Separado">Separado</option>
<option value="Divorciado">Divorciado</option> 
<option value="Viúvo">Vi&uacute;vo</option> 
</select>
<span class="erro" id="eestadocivil" style="display:none">Por favor, selecione o Estado Civil do cliente!</span>
</td>
</tr>

<? 

$phoneprefixo = substr($_GET['phone_number'],0,1);


if($_GET['phone_number']){
if($phoneprefixo != '9' && $phoneprefixo != '8' && $phoneprefixo != '7' && $phoneprefixo != '6'){
	
$GETtelefone = "(".$_GET['phone_code'].") ".substr($_GET['phone_number'],0,4)."-".substr($_GET['phone_number'],4,8);		
		
		
} else {
	
			
$GETcelular = "(".$_GET['phone_code'].") ".substr($_GET['phone_number'],0,4)."-".substr($_GET['phone_number'],4,8);		
	
	
}}
?>

<tr>
<td class="t1">Telefone:</td>
<td><input type="text" name="itelefone" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $GETtelefone;?>" size="35" /></td>
</tr>


<tr>
<td class="t1">Celular:</td>
<td><input type="text" name="icelular" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $GETcelular;?>" size="35" /></td>
</tr>


<tr>
<td class="t1">Email:</td>
<td><input type="text" name="email" value="<?= $_GET['email'];?>" size="35" /></td>
</tr>



<tr valign="bottom" height="80px">
<td colspan="2" class="t2">
Endere&ccedil;o de Instala&ccedil;&atilde;o
<hr size="1" color="#CCCCCC" />
</td>
</tr>

<tr>
<td class="t1">Endereço:</td>
<td><input type="text" name="rua" id="rua" size="55" value="<?= $_GET['address1']; ?>" /> &nbsp;
<span class="t1">N&ordm;:</span> <input type="text" name="numero" id="numero" size="5" /> &nbsp;
<span class="t1">Lote:</span> <input type="text" name="lote" size="5" /> &nbsp;
<span class="t1">Quadra:</span> <input type="text" name="quadra" size="5" /><br />
<span class="erro" id="erua" style="display:none">Por favor, preecha pelo menos a Rua e o N&uacute;mero do endere&ccedil;o do cliente!</span>
</td>
</tr>


<tr>
<td class="t1">Complemento:</td>
<td><input type="text" name="complemento" size="40" /></td>
</tr>

<tr>
<td class="t1">Bairro:</td>
<td><input type="text" name="bairro" id="bairro" size="40" />
<span class="erro" id="ebairro" style="display:none">Por favor, preecha o bairro do cliente!</span>

</td>
</tr>

<tr>
<td class="t1">Cidade:</td>
<td><input type="text" value="<?= $_GET['city']; ?>" name="cidade" id="cidade" size="40" />
<span class="erro" id="ecidade" style="display:none">Por favor, preecha a cidade do cliente!</span>
</td>
</tr>

<tr>
<td class="t1">CEP:</td>
<td><input type="text" name="icep" id="icep" onKeyPress="mascara(this,cep)" maxlength="9" value="<?= $_GET['postal_code']; ?>" size="40" />
<span class="erro" id="ecep" style="display:none">Por favor, digite o CEP do cliente!</span>
</td>
</tr>


<tr valign="bottom" height="80px">
<td colspan="2" class="t2">
Dados da Compra
<hr size="1" color="#CCCCCC" />
</td>
</tr>

<tr>
<td class="t1">Plano Escolhido:</td>
<td><input type="radio" name="plano" id="plano1" value="via completo" /> Via Completo <input type="radio" name="plano" id="plano2" value="via banco fidelidade" /> Via Banco Fidelidade
<span class="erro" id="eplano" style="display:none">Por favor, selecione o plano escolhido pelo cliente!</span>
</td>
</tr>

<tr>
<td class="t1" title="Plano Escolhido - Ponto Principal">Plano P. Principal:</td>
<td>
<input type="radio" name="planopontoprincipal" id="planopontoprincipal1" value="Essencial" /> Essencial 
<input type="radio" name="planopontoprincipal" id="planopontoprincipal2" value="Família" /> Fam&iacute;lia 
<input type="radio" name="planopontoprincipal" id="planopontoprincipal3" value="Fácil" /> F&aacute;cil

<span class="erro" id="eplanoponto" style="display:none">Por favor, selecione o plano escolhido - ponto principal do cliente!</span>
</td>
</tr>

<tr>
<td class="t1">Pacotes e Canais <br />
Adicionais:</td>
<td><input type="text" name="pacotesadicionais" id="pacotesadicionais" size="40" /></td>
</tr>


<tr>
<td class="t1">Ponto Extra:</td>
<td>
<input type="radio" name="pontoextra" id="pontoextra1" value="Sim" /> Sim 
<input type="radio" name="pontoextra" id="pontoextra2" value="Não" /> N&atilde;o
<span class="erro" id="epontoextra" style="display:none">Por favor, selecione uma das op&ccedil;&otilde;es!</span>
</td>
</tr>

<tr>
<td class="t1">Combo:</td>
<td>
<input type="radio" name="combo" id="combo1" value="Sim" /> Sim 
<input type="radio" name="combo" id="combo2" value="Não" /> N&atilde;o
<span class="erro" id="ecombo" style="display:none">Por favor, selecione uma das op&ccedil;&otilde;es!</span>
</td>
</tr>


<tr>
<td class="t1">Dia do Vencimento:</td>
<td>
<input type="radio" name="vencimento" id="vencimento1" value="1" /> 1 
<input type="radio" name="vencimento" id="vencimento2" value="4" /> 4 
<input type="radio" name="vencimento" id="vencimento3" value="6" /> 6 
<input type="radio" name="vencimento" id="vencimento4" value="8" /> 8 
<input type="radio" name="vencimento" id="vencimento5" value="20" style="display:none"/> <span id="venci20txt" style="display:none">20</span>
<span class="erro" id="evencimento" style="display:none">Por favor, selecione o dia de vencimento escolhido pelo cliente!</span>
</td>
</tr>


<tr>
<td class="t1">Forma de Pagamento:</td>
<td>
<input type="radio" name="pagamento" onClick="toggleLayer(this.value);" id="pagamento1" value="Débito" /> D&eacute;bito 
<input type="radio" name="pagamento" onClick="toggleLayer(this.value);" id="pagamento2" value="Boleto" /> Boleto
<span class="erro" id="epagamento" style="display:none">Por favor, selecione a forma de pagamento escolhida pelo cliente!</span>
</td>
</tr>


<tr id="banco" style="display:none">
<td class="t1">Banco</td>
<td><input type="text" name="Banco" id="Banco" size="40" /> &nbsp;
<span class="t1">Ag&ecirc;ncia:</span> <input type="text" name="agencia" id="agencia" size="10" /> &nbsp;
<span class="t1" title="Conta Corrente">CC:</span> <input type="text" name="contacorrente" id="contacorrente" size="15" /><br />
<span class="erro" id="ebanco" style="display:none">Por favor, digite todas as inform&ccedil;&otilde;es do banco do cliente!</span>
</td>
</tr>


<tr height="50px" valign="bottom">
<td></td>
<td> <img src="img/bt-enviar.png" border="0" style="cursor:pointer" onClick="conferir()" /></td>
</tr>

</form>
</table>
<br />
<br />
<br />

</div>




</body>
</html>