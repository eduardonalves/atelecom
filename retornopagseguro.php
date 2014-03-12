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

$esn = $_POST['esn'];

$tipoLinha = $_POST['tipolinha'];

$tipoAssinatura = $_POST['tipoassinatura'];

$tipoPlano = $_POST['tipoplano'];

$plano = $_POST['plano'];

$valorPlano = $_POST['valorplano'];

$aparelho = $_POST['aparelho'];

$valorAparelho = $_POST['valoraparelho'];

$pagamento = $_POST['pagamento'];

$data0 = explode('/',$_POST['idata']);

$data = $data0[2].$data0[1].$data0[0];

$vencimento = $_POST['vencimento'];



// Verificar venda parceiro/interno



$conTipovenda = $conexao->query("SELECT * FROM usuarios WHERE id = '".$monitor."'");

$rowTipovenda = mysql_fetch_array($conTipovenda);



if($rowTipovenda['acesso_usuario'] == 'INTERNO'){

	

	$tipoVenda = 'INTERNA'; $idTipoVenda = '01';

	

	} else {

		

		$tipoVenda = 'EXTERNA'; $idTipoVenda = '02';

	}





// PROTOCOLO

$conNumvenda = $conexao->query("SELECT * FROM vendas_clarotv WHERE data LIKE '%".date('Ymd')."%'");

$rowNumvenda = mysql_num_rows($conNumvenda);



$protocolo = date("ymdHi").$idTipoVenda.str_pad(($rowNumvenda+1),4, "0", STR_PAD_LEFT);









if($cpf == '' || $cpf == '000.000.000-00' || $cpf == '111.111.111-11' || $cpf == '00.000.000/0000-00'){ $status = "GRAVAR"; } else { $status = "PRE-ANALISE";}







	



$inserir = $conexao->query("INSERT INTO vendas_clarotv (protocolo,produto,tipoVenda,pessoa,nome,nome_mae,nascimento,cpf,rg,org_exp,data_exp,profissao,sexo,estado_civil,email,telefone,tipo_tel1,telefone2,tipo_tel2,telefone3,tipo_tel3,endereco,numero,lote,quadra,complemento,bairro,cidade,uf,cep,ponto_referencia,operador,monitor,esn,tipoLinha,tipoAssinatura,tipoPlano,plano,valorPlano,aparelho,valorAparelho,pagamento,data,data_venda,vencimento,status) VALUES ('".$protocolo."','3','".$tipoVenda."','".$pessoa."','".$nome."','".$nome_mae."','".$nascimento."','".$cpf."','".$rg."','".$org_exp."','".$data_exp."','".$profissao."','".$sexo."','".$estado_civil."','".$email."','".$telefone."','".$tipo_tel1."','".$telefone2."','".$tipo_tel2."','".$telefone3."','".$tipo_tel3."','".$endereco."','".$numero."','".$lote."','".$quadra."','".$complemento."','".$bairro."','".$cidade."','".$uf."','".$cep."','".$ponto_referencia."','".$operador."','".$monitor."','".$esn."','".$tipoLinha."','".$tipoAssinatura."','".$tipoPlano."','".$plano."','".$valorPlano."','".$aparelho."','".$valorAparelho."','".$pagamento."','".$data."','".$data."','".$vencimento."','".$status."')") or die('Ocorreu um Erro ao inserir os dados!');





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







function verificaassinatura(v){



if(v == "Nova Linha"){ $('#tipoplano').html('<option value=""></option><option value="Pré Pago">Pré Pago</option><option value="Pós Pago">Pós Pago</option>'); }

else if(v == "Portabilidade"){ $('#tipoplano').html('<option value=""></option><option value="Pós Pago">Pós Pago</option>'); }

else { $('#tipoplano').html('<option value=""></option>');}



verificatipoplano('');

verificaplano('');

verificaaparelho('');

}



function verificatipoplano(v){



if(v == "Pré Pago"){ $('#plano').html('<option value=""></option><option value="Pré 15">Pré 15</option><option value="Pré Fixo Ilimitado Local">Pré Fixo Ilimitado Local</option>'); }



else if(v == "Pós Pago"){ $('#plano').html('<option value=""></option><option value="FAV Local">FAV Local</option><option value="FAV Local com DDD">FAV Local com DDD</option><option value="FAV Local e DDD">FAV Local e DDD</option><option value="FAV Local e DDD com Móvel">FAV Local e DDD com Móvel</option>'); }

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

else { document.getElementById('valorplano').value = '';}



$('#aparelho').html('<option value=""></option><option value="Alcatel OT 208">Alcatel OT 208</option><option value="ALCATEL CF100">ALCATEL CF100</option><option value="ALCATEL MF100">ALCATEL MF100</option><option value="Huawei 8551">Huawei 8551</option><option value="Huawei 2555">Huawei 2555</option><option value="Huawei U2800 (Cinza)">Huawei U2800 (Cinza)</option><option value="Huawei U2800 (Branco)">Huawei U2800 (Branco)</option><option value="Huawei C2610">Huawei C2610</option><option value="Chip Claro Fixo">Chip Claro Fixo</option>');



verificaaparelho('');



}





function verificaaparelho(v){



var tipoassinatura = document.getElementById('tipoassinatura').value;



////////////// PORTABILIDADE ////////////////



if(tipoassinatura == 'Portabilidade'){

	

if(v == 'Alcatel OT 208'){document.getElementById('valoraparelho').value = '34,50'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_ot_208_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'ALCATEL CF100'){document.getElementById('valoraparelho').value = '49,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_cf100_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'ALCATEL MF100'){document.getElementById('valoraparelho').value = '79,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_mf100_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'Huawei 8551'){document.getElementById('valoraparelho').value = '79,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_8551_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });  }



else if(v == 'Huawei 2555'){document.getElementById('valoraparelho').value = '49,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_2555_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else if(v == 'Huawei U2800 (Cinza)'){document.getElementById('valoraparelho').value = '99,00'; 

$("#fotoaparelho").fadeOut(600);}



else if(v == 'Huawei U2800 (Branco)'){document.getElementById('valoraparelho').value = '99,00';

$("#fotoaparelho").fadeOut(600); }



else if(v == 'Huawei C2610'){document.getElementById('valoraparelho').value = '34,50'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_c2610_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });  }



else if(v == 'Chip Claro Fixo'){document.getElementById('valoraparelho').value = '5,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/chip-claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600); }	

	

	

	}









else if(tipoassinatura == 'Nova Linha'){



var plano = document.getElementById('plano').value;



////////////// PLANO PRÉ ////////////////



	

if(plano == 'Pré 15' || plano == 'Pré Fixo Ilimitado Local'){ 



if(v == 'Alcatel OT 208'){document.getElementById('valoraparelho').value = '69,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_ot_208_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'ALCATEL CF100'){document.getElementById('valoraparelho').value = '79,90'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_cf100_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'ALCATEL MF100'){document.getElementById('valoraparelho').value = '79,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_mf100_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'Huawei 8551'){document.getElementById('valoraparelho').value = '179,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_8551_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });  }



else if(v == 'Huawei 2555'){document.getElementById('valoraparelho').value = '149,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_2555_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else if(v == 'Huawei U2800 (Cinza)'){document.getElementById('valoraparelho').value = '99,00'; 

$("#fotoaparelho").fadeOut(600);}



else if(v == 'Huawei U2800 (Branco)'){document.getElementById('valoraparelho').value = '99,00'; 

$("#fotoaparelho").fadeOut(600);}



else if(v == 'Huawei C2610'){document.getElementById('valoraparelho').value = '69,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_c2610_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });  }



else if(v == 'Chip Claro Fixo'){document.getElementById('valoraparelho').value = '5,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/chip-claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600); }

                                                    }







////////////// PLANO CONTROLE ////////////////



else if(plano == 'FAV Local'){ 



if(v == 'Alcatel OT 208'){document.getElementById('valoraparelho').value = '49,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_ot_208_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'ALCATEL CF100'){document.getElementById('valoraparelho').value = '79,90'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_cf100_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'ALCATEL MF100'){document.getElementById('valoraparelho').value = '79,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_mf100_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'Huawei 8551'){document.getElementById('valoraparelho').value = '119,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_8551_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });  }



else if(v == 'Huawei 2555'){document.getElementById('valoraparelho').value = '79,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_2555_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else if(v == 'Huawei U2800 (Cinza)'){document.getElementById('valoraparelho').value = '99,00'; 

$("#fotoaparelho").fadeOut(600);}



else if(v == 'Huawei U2800 (Branco)'){document.getElementById('valoraparelho').value = '99,00'; 

$("#fotoaparelho").fadeOut(600);}



else if(v == 'Huawei C2610'){document.getElementById('valoraparelho').value = '49,00';

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_c2610_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });  }



else if(v == 'Chip Claro Fixo'){document.getElementById('valoraparelho').value = '5,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/chip-claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600);}

                                                    }	







////////////// PLANO PÓS ////////////////



else if(plano == 'FAV Local com DDD' || plano == 'FAV Local e DDD' || plano == 'FAV Local e DDD com Móvel'){ 



if(v == 'Alcatel OT 208'){document.getElementById('valoraparelho').value = '49,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_ot_208_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'ALCATEL CF100'){document.getElementById('valoraparelho').value = '79,90'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_cf100_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'ALCATEL MF100'){document.getElementById('valoraparelho').value = '79,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/alcate_mf100_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });}



else if(v == 'Huawei 8551'){document.getElementById('valoraparelho').value = '119,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_8551_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else if(v == 'Huawei 2555'){document.getElementById('valoraparelho').value = '79,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_2555_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else if(v == 'Huawei U2800 (Cinza)'){document.getElementById('valoraparelho').value = '99,00'; 

$("#fotoaparelho").fadeOut(600);}



else if(v == 'Huawei U2800 (Branco)'){document.getElementById('valoraparelho').value = '99,00'; 

$("#fotoaparelho").fadeOut(600);}



else if(v == 'Huawei C2610'){document.getElementById('valoraparelho').value = '49,00';

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/huawei_c2610_-_claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); });  }



else if(v == 'Chip Claro Fixo'){document.getElementById('valoraparelho').value = '5,00'; 

$("#fotoaparelho").fadeOut(600, function(){

$("#fotoaparelho").html("<img src='img/aparelhos/chip-claro-fixo.png' />"); 

$("#fotoaparelho").fadeIn(600); }); }



else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600);}

                                                    }



else{ document.getElementById('valoraparelho').value = ''; $("#fotoaparelho").fadeOut(600);}



}



else{ document.getElementById('valoraparelho').value = '';  $("#fotoaparelho").fadeOut(600);}



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

	

//if(document.getElementById('nomemae').value == ''){ document.getElementById('enomemae').style.display = ''; e=(e+1)} else { document.getElementById('enomemae').style.display = 'none';}

	

//if(document.getElementById('nascd').value == '' || document.getElementById('nascm').value == '' || document.getElementById('nasca').value == ''){ document.getElementById('enasc').style.display = ''; e=(e+1)} else { document.getElementById('enasc').style.display = 'none';}	



//if(document.getElementById('rg').value == '' || document.getElementById('orgexp').value == ''){ document.getElementById('erg').style.display = ''; e=(e+1)} else { document.getElementById('erg').style.display = 'none';}



//if(document.getElementById('profissao').value == ''){ document.getElementById('eprofissao').style.display = ''; e=(e+1)} else { document.getElementById('eprofissao').style.display = 'none';}



//if(!document.getElementById('sexo1').checked && !document.getElementById('sexo2').checked){ document.getElementById('esexo').style.display = ''; e=(e+1)} else { document.getElementById('esexo').style.display = 'none';}



//if(document.getElementById('estadocivil').value == ''){ document.getElementById('eestadocivil').style.display = ''; e=(e+1)} else { document.getElementById('eestadocivil').style.display = 'none';}



//if(document.getElementById('estadocivil').value == ''){ document.getElementById('eestadocivil').style.display = ''; e=(e+1)} else { document.getElementById('eestadocivil').style.display = 'none';}





}





//if(document.getElementById('email').value == ''){ document.getElementById('eemail').style.display = ''; e=(e+1)} else { document.getElementById('eemail').style.display = 'none';}



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



/*if(document.getElementById('tipolinha').value == ''){ document.getElementById('etipolinha').style.display = ''; e=(e+1)} else { document.getElementById('etipolinha').style.display = 'none';}	



if(document.getElementById('tipoassinatura').value == ''){ document.getElementById('etipoassinatura').style.display = ''; e=(e+1)} else { document.getElementById('etipoassinatura').style.display = 'none';}	



if(document.getElementById('tipoplano').value == ''){ document.getElementById('etipoplano').style.display = ''; e=(e+1)} else { document.getElementById('etipoplano').style.display = 'none';}	



if(document.getElementById('plano').value == ''){ document.getElementById('eplano').style.display = ''; e=(e+1)} else { document.getElementById('eplano').style.display = 'none';}	



if(document.getElementById('aparelho').value == ''){ document.getElementById('eaparelho').style.display = ''; e=(e+1)} else { document.getElementById('eaparelho').style.display = 'none';}



if(document.getElementById('calendario2').value == ''){ document.getElementById('evenda').style.display = ''; e=(e+1)} else { document.getElementById('evenda').style.display = 'none';}

	

	

if(!document.getElementById('venci1').checked && !document.getElementById('venci2').checked && !document.getElementById('venci3').checked && !document.getElementById('venci4').checked ){ document.getElementById('evencimento').style.display = ''; e=(e+1)} else { document.getElementById('evencimento').style.display = 'none';}

	

*/



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

	checkcidades()

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


<span>Sucesso!</span>
