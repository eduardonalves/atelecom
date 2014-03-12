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

$os = $_POST['os'];

$esn = $_POST['esn'];

$tipoLinha = $_POST['tipolinha'];

$tipoAssinatura = $_POST['tipoassinatura'];

$tipoPlano = $_POST['tipoplano'];

$plano = $_POST['plano'];

$valorPlano = $_POST['valorplano'];

$aparelho = $_POST['aparelho'];

$numchip=$_POST['numchip'];

$valorAparelho = $_POST['valoraparelho'];

$pagamento = $_POST['pagamento'];

$data0 = explode('/',$_POST['idata']);

$data = $data0[2].$data0[1].$data0[0];

$vencimento = $_POST['vencimento'];

$tipoEntrega = $_POST['tipoEntrega'];


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






	



$inserir = $conexao->query("INSERT INTO vendas_clarotv (protocolo,produto,tipoVenda,pessoa,nome,nome_mae,nascimento,cpf,rg,org_exp,data_exp,profissao,sexo,estado_civil,email,telefone,tipo_tel1,telefone2,tipo_tel2,telefone3,tipo_tel3,endereco,numero,lote,quadra,complemento,bairro,cidade,uf,cep,ponto_referencia,operador,monitor,os,esn,tipoLinha,tipoAssinatura,tipoPlano,plano,valorPlano,aparelho,valorAparelho,pagamento,tipoEntrega,data,data_venda,vencimento,status, numchip) VALUES ('".$protocolo."','3','".$tipoVenda."','".$pessoa."','".$nome."','".$nome_mae."','".$nascimento."','".$cpf."','".$rg."','".$org_exp."','".$data_exp."','".$profissao."','".$sexo."','".$estado_civil."','".$email."','".$telefone."','".$tipo_tel1."','".$telefone2."','".$tipo_tel2."','".$telefone3."','".$tipo_tel3."','".$endereco."','".$numero."','".$lote."','".$quadra."','".$complemento."','".$bairro."','".$cidade."','".$uf."','".$cep."','".$ponto_referencia."','".$operador."','".$monitor."','".$os."','".$esn."','".$tipoLinha."','".$tipoAssinatura."','".$tipoPlano."','".$plano."','".$valorPlano."','".$aparelho."','".$valorAparelho."','".$pagamento."','".$tipoEntrega."','".$data."','".$data."','".$vencimento."','".$status."', '".$numchip."')") or die('Ocorreu um Erro ao inserir os dados!');





//LOG



$datadehoje = date("Y-m-d H:i:s");

$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$datadehoje."','".$_SESSION['usuario']."','Inseriu um novo dado no sistema.')");



?>



<script type="text/javascript">



window.alert("Cadastro efetuado com sucesso!");

window.location = '?p=clarofixo';





</script>





<?



}



?>







<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />



<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>

<script type="text/javascript" src="js/calendario.js"></script>

<script type="text/javascript" src="js/cep.js"></script>

<script type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.7.3.custom.css" />

<link rel="stylesheet" type="text/css" href="css/geral.css" />

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



function verificapessoa(v){

if(v == 'Pessoa Jurí­dica') {

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


} else if(v == "Pessoa Física") {

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

function verificaassinatura(v){

if(v == "Nova Linha"){ $('#tipoplano').html('<option value=""></option><!-- <option value="Pré Pago">Pré Pago</option> --><option value="Pós Pago">Pós Pago</option>'); }

else if(v == "Portabilidade"){ $('#tipoplano').html('<option value=""></option><option value="Pós Pago">Pós Pago</option>'); }

else { $('#tipoplano').html('<option value=""></option>');}



verificatipoplano('');

verificaplano('');

verificaaparelho('');

}



function verificatipoplano(v){



if(v == "Pré Pago"){ $('#plano').html('<option value=""></option><option value="Pré 15">Pré 15</option><option value="Pré Fixo Ilimitado Local">Pré Fixo Ilimitado Local</option>'); }



else if(v == "Pós Pago"){ 
	
	$('#plano').html('<option value=""></option><option value="FAV Local">FAV Local</option><option value="FAV Local com DDD">FAV Local com DDD</option><option value="FAV Local e DDD">FAV Local e DDD</option><option value="FAV Local e DDD com Móvel">FAV Local e DDD com Móvel</option>'); 
	$('#plano').append('<option value=""></option><option value="FAV Local + TV">FAV Local + TV</option><option value="FAV Local com DDD + TV">FAV Local com DDD + TV</option><option value="FAV Local e DDD + TV">FAV Local e DDD + TV</option><option value="FAV Local e DDD com Móvel + TV">FAV Local e DDD com Móvel + TV</option>'); 
	
	}

else { $('#plano').html('<option value=""></option>');}



verificaplano('');

verificaaparelho('');



}		

	

	



function verificaplano(v){



if(v == "Pré 15"){ document.getElementById('valorplano').value = '15,00'; }

else if(v == "Pré Fixo Ilimitado Local"){ document.getElementById('valorplano').value = '19,90';}

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

include_once "lib/class.controleEstoque.php";

$estoque = new controleEstoque($conexao);

$aparelhos = $estoque->getAparelhos();
$htmlAparelhos = "<option value=\"\"></option>";

foreach($aparelhos as $key=>$value)
{
	$htmlAparelhos .= "<option value=\"". $value["id_aparelho"] . "\">". $value["marca"] . " - " . $value["modelo"] ."</option>";
}

?>

//$('#aparelho').html('<option value=""></option><option value="Alcatel OT 208">Alcatel OT 208</option><option value="ALCATEL CF100">ALCATEL CF100</option><option value="ALCATEL MF100">ALCATEL MF100</option><option value="Huawei 8551">Huawei 8551</option><option value="Huawei 2555">Huawei 2555</option><option value="Huawei U2800 (Cinza)">Huawei U2800 (Cinza)</option><option value="Huawei U2800 (Branco)">Huawei U2800 (Branco)</option><option value="Huawei C2610">Huawei C2610</option><option value="Chip Claro Fixo">Chip Claro Fixo</option>');
$('#aparelho').html('<?php echo $htmlAparelhos; ?>');



verificaaparelho('');



}





function verificaaparelho(v){



var tipoassinatura = document.getElementById('tipoassinatura').value;



////////////// PORTABILIDADE ////////////////



if(tipoassinatura == 'Portabilidade'){

	
<?php

foreach($aparelhos as $key=>$value)
{
	if($key==0)
	{

?>
if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_portabilidade"]; ?>'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/<?php echo $value["imagem_aparelho"]; ?>' />"); 

$("#fotoaparelho").fadeIn(600); });}

<?php

	}else{

?>

else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_portabilidade"]; ?>'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/<?php echo $value["imagem_aparelho"]; ?>' />"); 

$("#fotoaparelho").fadeIn(600); });}

<?php
	}
}
?>



else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600); }	

	

	

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

if(plano == 'Pré 15' || plano == 'Pré Fixo Ilimitado Local'){ 



if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_pre"]; ?>'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/<?php echo $value["imagem_aparelho"]; ?>' />"); 

$("#fotoaparelho").fadeIn(600); });}

<?php

	}else{

?>

else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_pre"]; ?>'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/<?php echo $value["imagem_aparelho"]; ?>' />"); 

$("#fotoaparelho").fadeIn(600); });}

<?php 
	}
}
?>


else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600); }

                                                    }







////////////// PLANO CONTROLE ////////////////



else if(plano == 'FAV Local'){ 

<?php

foreach($aparelhos as $key=>$value)
{
	if($key==0)
	{

?>

if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_controle"]; ?>'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/<?php echo $value["imagem_aparelho"]; ?>' />"); 

$("#fotoaparelho").fadeIn(600); });}
<?php

	}else{
		
?>


else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_controle"]; ?>'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/<?php echo $value["imagem_aparelho"]; ?>' />"); 

$("#fotoaparelho").fadeIn(600); });}

<?php 

	}
}
?>


else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600);}

                                                    }	







////////////// PLANO PÓS ////////////////



else if(plano == 'FAV Local com DDD' || plano == 'FAV Local e DDD' || plano == 'FAV Local e DDD com Móvel'){ 

<?php

foreach($aparelhos as $key=>$value)
{
	if($key==0)
	{

?>

if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_pos"]; ?>'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/<?php echo $value["imagem_aparelho"]; ?>' />"); 

$("#fotoaparelho").fadeIn(600); });}

<?php
	}else{
		
	?>

else if(v == '<?php echo $value["id_aparelho"]; ?>'){document.getElementById('valoraparelho').value = '<?php echo $value["preco_novalinha_pos"]; ?>'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/<?php echo $value["imagem_aparelho"]; ?>' />"); 

$("#fotoaparelho").fadeIn(600); });}

<?php
	}
}
?>


else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600);}

                                                    }



else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600);}



}



else{ document.getElementById('valoraparelho').value = '';  $("#fotoaparelho").fadeOut(600);}



                            }



	

	

///////////////////////





function submitform(){

e=0;

if(document.getElementById('numero').value == ''){
	if((document.getElementById('lote').value == '') || (document.getElementById('quadra').value == '')){
		e=(e+1);}
	}

/////// -- DADOS PESSOAIS -- ////////

if(!document.getElementById('pessoa1').checked && !document.getElementById('pessoa2').checked){ document.getElementById('epessoa').style.display = ''; e=(e+1)} else { document.getElementById('epessoa').style.display = 'none';}

if(document.getElementById('nome').value == ''){ document.getElementById('enome').style.display = ''; e=(e+1)} else { document.getElementById('enome').style.display = 'none';}	

if(document.getElementById('idcpf').value == '' && document.getElementById('idcnpj').value == ''){ document.getElementById('ecpf').style.display = ''; e=(e+1)} else { document.getElementById('ecpf').style.display = 'none';}

if(document.getElementById('idcpf').value == '' && document.getElementById('idcnpj').value == '' && document.getElementById('pessoa2').checked){ document.getElementById('ecnpj').style.display = ''; e=(e+1)} else { document.getElementById('ecnpj').style.display = 'none';}

if(!document.getElementById('pessoa2').checked){

if(document.getElementById('nomemae').value == ''){ document.getElementById('enomemae').style.display = ''; e=(e+1)} else { document.getElementById('enomemae').style.display = 'none';}

if(document.getElementById('nascd').value == '' || document.getElementById('nascm').value == '' || document.getElementById('nasca').value == ''){ document.getElementById('enasc').style.display = ''; e=(e+1)} else { document.getElementById('enasc').style.display = 'none';}	

if(document.getElementById('rg').value == '' || document.getElementById('orgexp').value == ''){ document.getElementById('erg').style.display = ''; e=(e+1)} else { document.getElementById('erg').style.display = 'none';}

//if(document.getElementById('profissao').value == ''){ document.getElementById('eprofissao').style.display = ''; e=(e+1)} else { document.getElementById('eprofissao').style.display = 'none';}

if(!document.getElementById('sexo1').checked && !document.getElementById('sexo2').checked){ document.getElementById('esexo').style.display = ''; e=(e+1)} else { document.getElementById('esexo').style.display = 'none';}

//if(document.getElementById('estadocivil').value == ''){ document.getElementById('eestadocivil').style.display = ''; e=(e+1)} else { document.getElementById('eestadocivil').style.display = 'none';}

//if(document.getElementById('estadocivil').value == ''){ document.getElementById('eestadocivil').style.display = ''; e=(e+1)} else { document.getElementById('eestadocivil').style.display = 'none';}


}

//if(document.getElementById('email').value == ''){ document.getElementById('eemail').style.display = ''; e=(e+1)} else { document.getElementById('eemail').style.display = 'none';}

if(document.getElementById('tel1').value == ''){ document.getElementById('etelefone').style.display = ''; e=(e+1)} else { document.getElementById('etelefone').style.display = 'none';}

if(document.getElementById('tel2').value == ''){ document.getElementById('etelefone2').style.display = ''; e=(e+1)} else { document.getElementById('etelefone2').style.display = 'none';}


/////// -- ENDEREÇO CLIENTE -- ////////

if(document.getElementById('endereco').value == ''){ document.getElementById('eendereco').style.display = ''; e=(e+1)} else { document.getElementById('eendereco').style.display = 'none';}

if(document.getElementById('bairro').value == ''){ document.getElementById('ebairro').style.display = ''; e=(e+1)} else { document.getElementById('ebairro').style.display = 'none';}

if(document.getElementById('uf').value == ''){ document.getElementById('euf').style.display = ''; e=(e+1)} else { document.getElementById('euf').style.display = 'none';}	

if(document.getElementById('cidade').value == ''){ document.getElementById('ecidade').style.display = ''; e=(e+1)} else { document.getElementById('ecidade').style.display = 'none';}	

if(document.getElementById('idcep').value == ''){ document.getElementById('ecep').style.display = ''; e=(e+1)} else { document.getElementById('ecep').style.display = 'none';}	


/////// -- DADOS DA VENDA -- ////////

if(document.getElementById('monitor').value == ''){ document.getElementById('emonitor').style.display = ''; e=(e+1)} else { document.getElementById('emonitor').style.display = 'none';}	

if(document.getElementById('operador').value == ''){ document.getElementById('eoperador').style.display = ''; e=(e+1)} else { document.getElementById('eoperador').style.display = 'none';}	

if(document.getElementById('tipolinha').value == ''){ document.getElementById('etipolinha').style.display = ''; e=(e+1)} else { document.getElementById('etipolinha').style.display = 'none';}	

if(document.getElementById('tipoassinatura').value == ''){ document.getElementById('etipoassinatura').style.display = ''; e=(e+1)} else { document.getElementById('etipoassinatura').style.display = 'none';}	

if(document.getElementById('tipoplano').value == ''){ document.getElementById('etipoplano').style.display = ''; e=(e+1)} else { document.getElementById('etipoplano').style.display = 'none';}	

if(document.getElementById('plano').value == ''){ document.getElementById('eplano').style.display = ''; e=(e+1)} else { document.getElementById('eplano').style.display = 'none';}	

if(document.getElementById('aparelho').value == ''){ document.getElementById('eaparelho').style.display = ''; e=(e+1)} else { document.getElementById('eaparelho').style.display = 'none';}

/*

if(document.getElementById('calendario2').value == ''){ document.getElementById('evenda').style.display = ''; e=(e+1)} else { document.getElementById('evenda').style.display = 'none';}


*/


if(!document.getElementById('venci1').checked && !document.getElementById('venci2').checked && !document.getElementById('venci3').checked && !document.getElementById('venci4').checked ){ document.getElementById('evencimento').style.display = ''; e=(e+1)} else { document.getElementById('evencimento').style.display = 'none';}


/////// -- VERIFICAR SE EXISTEM ERROS -- ////////

if(e!=0){ window.alert('ERRO: Preencha todos os campos indicados, corretamente'); $('body,html').animate({scrollTop: 150}, 800);} else { document.forms.inserir.submit(); }


}







///////////////////////////////////

///////// CHECAR PROPOSTA////////

/////////////////////////////////



function checkcpf(c){

	

	

	$('#loadcpf').load('check-cpf-clarofixo.php?c='+c);

	

	

	}

	

function checkoperador(m){

	

	

	$('#loadoperadores').load('check-operadores.php?m='+m+'&g=0003');

	

	

	}

	

function checkcidades(uf,cidade){

	

	

	$('#loadcidades').load('check-cidades.php?uf='+uf+'&c='+cidade);

	

	

	

	}	

	



$(document).ready(function(e) {

	

	checkoperador();

	checkcidades();
	var valAparelho;
	var pagamento;
$('#aparelho').live('change', function(){
	$(".pagseguro").hide();
	valAparelho = $(this).val();
	
	valAparelhoText = $('#aparelho option:selected').text();

	if(pagamento=='Pagseguro'){
		if(valAparelho=='166'){
			$(".pagseguro").hide();
			$("#166").show();
		}
		if(valAparelho=='ALCATEL CF100'){
			$(".pagseguro").hide();
			$("#AlcatelCF100").show();
		}
		if(valAparelho=='ALCATEL MF100'){
			$(".pagseguro").hide();
			$("#AlcatelMF100").show();
		}
		if(valAparelho=='Huawei 8551'){
			$(".pagseguro").hide();
			$("#Huawei8551").show();
		}
		if(valAparelho=='Huawei 2555'){
			$(".pagseguro").hide();
			$("#Huawei2555").show();
		}
		if(valAparelho=='Huawei U2800(Cinza)'){
			$(".pagseguro").hide();
			$("#HuaweiU2800Cinza").show();
		}
		if(valAparelho=='Huawei U2800(Branco)'){
			$(".pagseguro").hide();
			$("#HuaweiU2800Branco").show();
		}
		if(valAparelho=='Huawei C2610'){
			$(".pagseguro").hide();
			$("#HuaweiC2610").show();
		}
		if(valAparelho=='Chip Claro Fixo'){
			$(".pagseguro").hide();
			$("#chipclarofixo").show();
		}
	}
	
	if(valAparelhoText=='Huawei-U2800'){
			$('#numchip').show();
	}else{
			$('#numchip').hide();
	}
	
});	
$('#pagamento').live('change', function(){
	
	$(".pagseguro").hide();
	pagamento=$(this).val();

	if(pagamento=='Pagseguro'){
		if(valAparelho=='Alcatel OT 208'){
			$(".pagseguro").hide();
			$("#AlcatelOT208").show();
		}
		if(valAparelho=='ALCATEL CF100'){
			$(".pagseguro").hide();
			$("#AlcatelCF100").show();
		}
		if(valAparelho=='ALCATEL MF100'){
			$(".pagseguro").hide();
			$("#AlcatelMF100").show();
		}
		if(valAparelho=='Huawei 8551'){
			$(".pagseguro").hide();
			$("#Huawei8551").show();
		}
		if(valAparelho=='Huawei 2555'){
			$(".pagseguro").hide();
			$("#Huawei2555").show();
		}
		if(valAparelho=='Huawei U2800(Cinza)'){
			$(".pagseguro").hide();
			$("#HuaweiU2800Cinza").show();
		}
		if(valAparelho=='Huawei U2800(Branco)'){
			$(".pagseguro").hide();
			$("#HuaweiU2800Branco").show();
		}
		if(valAparelho=='Huawei C2610'){
			$(".pagseguro").hide();
			$("#HuaweiC2610").show();
		}
		if(valAparelho=='Chip Claro Fixo'){
			$(".pagseguro").hide();
			$("#chipclarofixo").show();
		}
	}
});
	});



</script>









<style type="text/css">



.erro{color:#C00; font-size:12px;}



#fotoaparelho{ position:absolute; height:280px; width:280px; background-color:#CCC; top: 880px; left:50%; margin:0 0 0 100px;

display:none;



-webkit-box-shadow: 0px 0px 3px 1px #CCCCCC;

box-shadow: 0px 0px 3px 1px #CCCCCC;



background: #ffffff; /* Old browsers */

/* IE9 SVG, needs conditional override of 'filter' to 'none' */

background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmNmY2ZjYiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);

background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 100%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#f6f6f6)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 100%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #ffffff 0%,#f6f6f6 100%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #ffffff 0%,#f6f6f6 100%); /* IE10+ */

background: linear-gradient(to bottom,  #ffffff 0%,#f6f6f6 100%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 ); /* IE6-8 */

}



</style>



<!-- SUBMENU -->

<? include "submenu-clarofixo.php";?>

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


<?
	if($USUARIO["tipo_usuario"]=="MONITOR")
	{
	
		$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario = 'MONITOR' && grupo LIKE '%0003%' && status='ATIVO' && id=" . $USUARIO["id"] . " order by nome");
	
	}else{
	
		$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario = 'MONITOR' || tipo_usuario = 'MONITORBO' && grupo LIKE '%0003%' && status='ATIVO' order by nome");
	}

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

<input type="radio" name="pessoa" id="pessoa1" value="Pessoa Física" onchange="verificapessoa(this.value)" /> Pessoa Fí­sica

<input type="radio" name="pessoa" id="pessoa2" value="Pessoa Jurí­dica" onchange="verificapessoa(this.value)" /> Pessoa Jurídica

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

<script type="text/javascript">

$(document).ready( function() {

	$(".data-nasc").bind("change", function() {
		

		
		vData = new Date();
		
		vDia = $("#nascd").val();
		vMes = $("#nascm").val();
		vAno = $("#nasca").val();
		
		vAnoAtual = vData.getFullYear();
		vMesAtual = vData.getMonth()+1;
		vDiaAtual = vData.getDate();
		vAnoMaximo = vAnoAtual - 18;

		
		if (vDia!='' && vMes!='' && vAno!='')
		{

			if(vAno==vAnoMaximo)
			{

				if(parseInt(vMes)<parseInt(vMesAtual))
				{
					vDia = $("#nascd").val('');
					vMes = $("#nascm").val('');
					
					alert('O cliente precisa ser maior de 18 anos. Verifique se a data de nascimento está correta.');

				}else if (parseInt(vMes)==parseInt(vMesAtual)) {

					if(parseInt(vDia)<parseInt(vDiaAtual))
					{
						vDia = $("#nascd").val('');
						vMes = $("#nascm").val('');
						
						alert('O cliente precisa ser maior de 18 anos. Verifique se a data de nascimento está correta.');
						
					}
				}
			}
		}
	
	});

});

</script>

<select name="nascd" id="nascd" class="data-nasc">

<option value=""></option>

<? $d = 1; while($d <= 31){ $dn = $d++;?>

<option value="<?= sprintf("%02d", $dn); ?>"> <?= sprintf("%02d", $dn); ?></option>

<? } ?>

</select>



<select name="nascm" id="nascm" class="data-nasc">

<option value=""></option>

<? $m = 1; while($m <= 12){ $mn = $m++;?>

<option value="<?= sprintf("%02d", $mn); ?>"> <?= sprintf("%02d", $mn); ?></option>

<? } ?>

</select>



<select name="nasca" id="nasca" class="data-nasc">

<option value=""></option>

<? $a = date('Y')-18; while($a > 1900){ $an = $a--;?>

<option value="<?= $an; ?>"> <?= $an; ?></option>

<? } ?>

</select>


<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="enasc" style="display:none">Por favor, selecione uma data de nascimento válida!</span>


</td>

</tr>


<tr align="left" id="cpfl">

<td>CPF:</td>

<td id="cpfinp"> <div id="loadcpf"></div> <input type="text" id="idcpf" name="icpf" onKeyPress="mascara(this,cpf)" onkeyup="checkcpf(this.value)" onChange="checkcpf(this.value)" maxlength="14" size="20" />

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
<span class="erro" id="ecpf" style="display:none">Por favor, digite o CPF do cliente!</span>

</td>

</tr>

<tr align="left" id="cnpjl" style="display:none">

<td>CNPJ:</td>

<td id="cpfinp"><input type="text" id="idcnpj" name="icnpj" onKeyPress="mascara(this,cnpj)" maxlength="18" size="20" />

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
<span class="erro" id="ecnpj" style="display:none">Por favor, digite o CNPJ do cliente!</span>

</td>

</tr>


<tr align="left" id="inprg">

<td>RG:</td>

<td id="rginp"><input type="text" id="rg" name="rg" size="20" maxlength="12" onKeyPress="mascara(this,rg)"/> <span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

 Org. Exp: <input type="text" title="Orgão Expedidor" id="orgexp" name="orgexp" size="20" /> <span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

 Data Exp: <input type="text" title="Data Expedição" id="dataexp" name="dataexp" onKeyPress="mascara(this,data)" maxlength="10" size="20" />

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
<span class="erro" id="erg" style="display:none">Por favor, digite o RG do cliente!</span>

</td>

</tr>

<tr align="left" id="inpprofissao">

<td class="t1">Profissão:</td>

<td><input type="text" name="profissao" id="profissao" size="50" /> 

<!-- 

<span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span> 

<span class="erro" id="eprofissao" style="display:none">Por favor, preencha a profissÃ£o do cliente!</span>

-->

</td>

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

<!-- 

<span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

<span class="erro" id="eestadocivil" style="display:none">Por favor, selecione o Estado Civil do cliente!</span>

-->

</td>

</tr>





<tr align="left">

<td>Email:</td>

<td><input type="text" id="email" name="email"  size="30" />

<!-- 

<span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

<span class="erro" id="eemail" style="display:none">Por favor, digite o Email do cliente!</span>

-->

</td>

</tr>



<tr align="left">

<td>Telefone 1:</td>

<td><input type="text"  id="tel1" name="itelefone" onKeyPress="mascara(this,telefone)" onchange="mascara(this,telefone)" maxlength="15" size="20" /> 

<select name="tipotel1">

<option value="Residencial">Residencial</option> 

<option value="Celular">Celular</option>

<option value="Comercial">Comercial</option>

</select> 

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="etelefone" style="display:none">Por favor, digite o telefone 1 do cliente!</span>

</td>

</tr>



<tr align="left">

<td>Telefone 2:</td>

<td><input type="text" id="tel2" name="itelefone2" onKeyPress="mascara(this,telefone)" onchange="mascara(this,telefone)" maxlength="15" size="20" /> 

<select name="tipotel2">

<option value="Residencial">Residencial</option> 

<option value="Celular" selected="selected">Celular</option>

<option value="Comercial">Comercial</option>

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="etelefone2" style="display:none">Por favor, digite o telefone 2 do cliente!</span>

</td>

</tr>



<tr align="left">

<td>Telefone 3:</td>

<td><input type="text" name="itelefone3" onKeyPress="mascara(this,telefone)" onchange="mascara(this,telefone)" maxlength="15" size="20" /> 

<select name="tipotel3">

<option value="Residencial">Residencial</option> 

<option value="Celular">Celular</option>

<option value="Comercial" selected="selected">Comercial</option>

</select>

</td>

</tr>



<tr height="30px" valign="bottom" align="left">

<td style="color:#069; font-size:12px">Endereço do Cliente</td>

</tr>



<tr align="left">

<td>CEP:</td>

<td><input type="text" id="idcep" onkeyup="return getEndereco()" onchange="return getEndereco()" name="icep" size="30" onKeyPress="mascara(this,cep)" maxlength="9" >

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
<span class="erro" id="ecep" style="display:none">Por favor, digite o CEP da instalação!</span></td>

</td>

</tr>



<tr align="left">

<td>Endereço:</td>

<td><input type="text" id="endereco" name="endereco" size="40" > <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 Nº: <input type="text" name="numero" id="numero" size="5" maxlength="10" onKeyPress="mascara(this,num);"/> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

 Lote: <input type="text" name="lote" id="lote" size="5" /> 

 Quadra: <input type="text" name="quadra" id="quadra" size="5" /> <br /> 

 <span class="erro" id="eendereco" style="display:none">Por favor, digite pelo menos o logradouro e o número do endereço de instalação! Se não houver número, por favor preencha lote e quadra.</span>

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


<tr>

<td>OS:</td>

<td>

<input type="text" name="os" id="os" size="10" onKeyPress="mascara(this,num);validaos(this.value,os);" onKeyUp="validaos(this.value,os);" onChange="mascara(this,num);validaos(this.value,os);" maxlength="8" value=""  style="float:left;" />
</td>

</tr>



<tr>

<td>ESN:</td>

<td>

<input type="text" id="input-esn" name="esn" size="20"  maxlength="14" />

</td>

</tr>





<tr>

<td>Tipo Linha:</td>

<td>

<select name="tipolinha" id="tipolinha">

<option value=""></option>

<option value="Residencial">Residencial</option>

<option value="Comercial">Comercial</option>

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="etipolinha" style="display:none">Por favor, selecione um tipo de linha!</span>

</td>

</tr>



<tr>

<td>Tipo Assinatura:</td>

<td>

<select name="tipoassinatura" id="tipoassinatura" onchange="verificaassinatura(this.value);">

<option value=""></option>

<option value="Nova Linha">Nova Linha</option>

<option value="Portabilidade">Portabilidade</option>

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="etipoassinatura" style="display:none">Por favor, selecione tipo de assinatura!</span>

</td>

</tr>


<tr>

<td>Tipo Plano:</td>

<td>

<select name="tipoplano" id="tipoplano" onchange="verificatipoplano(this.value);">

<option value=""></option>

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="etipoplano" style="display:none">Por favor, selecione um tipo de plano!</span>

</td>

</tr>



<tr align="left">

<td>Plano:</td>

<td>

<select name="plano" id="plano" onchange="verificaplano(this.value);">

<option value=""></option>

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="eplano" style="display:none">Por favor, selecione um plano!</span>


</td>

</tr>





<tr align="left">

<td>Valor Plano:</td>

<td> <span style="font-size:12px; color:#999; font-style:italic">R$</span> <input type="text" id="valorplano" name="valorplano" readonly="readonly" size="8" maxlength="10" /> <span style="font-size:12px; color:#999; font-style:italic">(0,00)</span> <!-- 

<span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

-->

<br /> 

</td>

</tr>



<tr align="left">

<td>Aparelho:</td>

<td>

<select name="aparelho" id="aparelho" onchange="verificaaparelho(this.value);">

<option value=""></option>

</select>

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="eaparelho" style="display:none">Por favor, selecione um aparelho!</span>


<div id="fotoaparelho">

</div>

</td>

</tr>

<tr align="left" id="tr-preco-promocional" style="display:none;">

<td>&nbsp;</td>
<td style="font-size:14px;"><input type="checkbox" id="preco-promocional" name="preco-promocional"  size="8" maxlength="10" /> Valor Promocional

<!--

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

-->

</td>

</tr>


<tr align="left" id="numchip" style="display:none;">

<td>Número do chip:</td>

<td> <input type="text" id="input-numchip" name="numchip"  size="20" maxlength="20" /> 

<!--

<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

-->

 <br />

</td>

</tr>



<tr align="left">

<td>Valor Aparelho:</td>

<td> <span style="font-size:12px; color:#999; font-style:italic">R$</span> <input type="text" id="valoraparelho" name="valoraparelho" readonly="readonly" size="8" maxlength="10" /> <span style="font-size:12px; color:#999; font-style:italic">(0,00)</span> 

<!-- 

<span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

-->

 <br /> 

</td>

</tr>



<tr align="left">

<td>Pagamento:</td>

<td>

<select name="pagamento" id="pagamento" onchange="verificapagamento(this.value);">
<?php

if(! ($USUARIO["tipo_usuario"]=="MONITOR" && $USUARIO["acesso_usuario"]=="EXTERNO") )
{
	
?>

<option value="BOLETO">BOLETO</option>

<option value="CARTÃO DE CRÉDITO">CARTÃO DE CRÉDITO</option>

<option value="DEPÓSITO">DEPÓSITO</option>

<option value="GRÁTIS">GRÁTIS</option>

<option value="PAGSEGURO">PAGSEGURO</option>

<?php

}

?>

<option value="DINHEIRO">DINHEIRO</option>

</select>

<!-- 

<span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

-->

</td>

</tr>

<tr align="left">

<td>Tipo de Entrega:</td>

<td>

<select name="tipoEntrega" id="tipoEntrega">

<?php
if(! ($USUARIO["tipo_usuario"]=="MONITOR" && $USUARIO["acesso_usuario"]=="EXTERNO") )
{
?>
<option value="EMBRATEL">EMBRATEL</option>

<option value="MOTOBOY INTERNO">MOTOBOY INTERNO</option>

<option value="MOTOBOY EXTERNO">MOTOBOY EXTERNO</option>

<?php } ?>

<option value="PRONTA ENTREGA">PRONTA ENTREGA</option>


</select>

<!-- 

<span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

-->

</td>

</tr>


<tr align="left">

<td>Data Venda:</td>

<td><input type="text" id="calendario2" name="idata" onKeyPress="mascara(this,data)" maxlength="10" value="<?= date("d/m/Y");?>" size="20" /> <span style="font-size:12px; color:#999; font-style:italic">(dd/mm/aaaa)</span> <!-- <span class="campoobrigatorio" title="Campo ObrigatÃ³rio">*</span>

 <br /> 

<span class="erro" id="evenda" style="display:none">Por favor, selecione a data da venda!</span>

-->

</td>

</tr>



<tr align="left">

<td>Vencimento:</td>

<td>

<input type="radio" id="venci1" name="vencimento" value="8" /> 8 

<input type="radio" id="venci2" name="vencimento" value="11" /> 11

<input type="radio" id="venci3" name="vencimento" value="20" /> 20 

<input type="radio" id="venci4" name="vencimento" value="25" /> 25 





<span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="evencimento" style="display:none">Por favor, selecione uma data de vencimento da fatura!</span>



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
<div id="166" class="pagseguro" >
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="2677302DBBBB0F8994723FB6FE4BDAD5" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>

<div id="AlcatelMF100" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="03F9341B090996A1143C4F806A10D596" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>

<div id="AlcatelCF100" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="022058F5B8B80D5334DCEF9FCC4B393A" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>
<div id="Huawei8551" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="BCBEE62452526DDFF42ECFA650C97A5C" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>
<div id="Huawei2555" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="AD398550E7E7E46BB471BF9B2DDA627D" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>
<div id="Huawei2555" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="139C9C97F0F05EC114B2BFB600976D02" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>
<div id="HuaweiU2800Cinza" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="139C9C97F0F05EC114B2BFB600976D02" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>
<div id="HuaweiU2800Branco" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="3DCAA1A745459E3004514FB90723905F" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>
<div id="HuaweiC2610" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="2A64986A9393FA400418EFB35B3B818F" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>
<div id="chipclarofixo" class="pagseguro">
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="B3078F4C1A1AF4F334D2CFA62F88C2EC" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-comprar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
</div>
<style>
.pagseguro{margin-left: 446px; display:none;}
</style>
