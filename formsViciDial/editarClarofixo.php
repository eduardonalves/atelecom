<?

include "../conexao.php";

$convar = $conexao->query("SELECT * FROM vendas_clarotv WHERE id = '".$_GET['owner']."'");
$val = mysql_fetch_array($convar);

if(isset($_POST['nome'])){
	
$os = $_POST['os'];
$esn = $_POST['esn'];
$novoNumero = $_POST['novonumero'];

$obs_gravacao = $_POST['obsGravacao'];

// Dados Pessoais
if($val['pessoa']){ $nome = $_POST['nome']; $cpf = $_POST['cpf'];} else { $nome = $_POST['razaoSocial']; $cpf = $_POST['cnpj'];}

$nomeMae = $_POST['nomeMae'];
$nascimento = $_POST['nascimento'];


$rg = $_POST['rg'];
$org_exp = $_POST['orgexp'];
$data_exp = $_POST['dataExp'];

$profissao = $_POST['profissao'];
$sexo = $_POST['sexo'];

$estado_civil = $_POST['estCiv'];
$email = $_POST['email'];
$telefone = $_POST['tel'];
$tipo_tel1 = 'Residencial';

$telefone2 = $_POST['telCel'];
$tipo_tel2 = 'Celular';

$telefone3 = $_POST['telCom'];
$tipo_tel3 = 'Comercial';


// Endereço Instalação
$endereco = $_POST['endereco'];	
$numero = $_POST['numEnd'];	
$lote = $_POST['lote'];	
$quadra = $_POST['quadra'];	

$complemento = $_POST['complemento'];	
$bairro = $_POST['bairro'];	
$cidade = $_POST['cidade'];	
$uf = $_POST['uf'];
$cep = $_POST['cep'];
$ponto_referencia = $_POST['pontoref'];


// Dados da Venda

//$operador = $_POST['operador'];
//$monitor = $_POST['monitor'];

$tipoLinha = $_POST['tipoLinha'];
$tipoAssinatura = $_POST['tipoAss'];
$tipoPlano = $_POST['tipoPlano'];
$plano = $_POST['plano'];
$valorPlano = $_POST['valorPlano'];
$aparelho = $_POST['aparelho'];
$valorAparelho = $_POST['valorAparelho'];
$pagamento = $_POST['pagamento'];

//$data0 = explode('/',$_POST['data']);
//$data = $data0[2].$data0[1].$data0[0];

$plano = $_POST['plano'];
$vencimento = $_POST['vencimento'];

$auditornome = $_POST['auditor'];
$gravacao = $_GET['recording_filename'].'-all.mp3';

// Dados da Instalação
$data_marcada0 = explode('/',$_POST['dataentrega']);
$data_entrega = $data_marcada0[2].$data_marcada0[1].$data_marcada0[0];
$obs1 = $_POST['obs1'];

$data_instalacao0 = explode('/',$_POST['datainstalacao']);
$data_finalizada = $data_instalacao0[2].$data_instalacao0[1].$data_instalacao0[0];

$obs = $_POST['obs'];

$motivo_restricao = $_POST['motivorestricao'];
$motivo_cancelamento = $_POST['motivocancelamento'];

// Cartão

if(strstr($_POST['numCar'],'XXXX-XXXX')){
$numCar = $linha['numCar'];
} else {
$numCar = base64_encode($_POST['numCar']);
}

if(strstr($_POST['codSeg'],'XX')){
$codSeg = $linha['numcodseguranca'];
} else {
$codSeg = $_POST['codSeg'];
}

$carVal = $_POST['validade'];
$carBan= $_POST['carBan'];
$numParcelas = $_POST['numparcelas'];

$status = $_POST['status'];

//////////////////////
// Atualizar Dados //
////////////////////

$update = $conexao->query("UPDATE vendas_clarotv SET os = '".$os."', esn = '".$esn."', novoNumero = '".$novoNumero."', obs_gravacao = '".$obs_gravacao."', nome = '".$nome."', nascimento = '".$nascimento."', cpf = '".$cpf."', rg = '".$rg."', org_exp = '".$org_exp."', profissao = '".$profissao."', sexo = '".$sexo."', estado_civil = '".$estado_civil."', email = '".$email."', telefone = '".$telefone."', tipo_tel1 = '".$tipo_tel1."', telefone2 = '".$telefone2."', tipo_tel2 = '".$tipo_tel2."', telefone3 = '".$telefone3."', tipo_tel3 = '".$tipo_tel3."', endereco = '".$endereco."', numero = '".$numero."', lote = '".$lote."', quadra = '".$quadra."', complemento = '".$complemento."', bairro = '".$bairro."', cidade = '".$cidade."', uf = '".$uf."', cep = '".$cep."', ponto_referencia = '".$ponto_referencia."', tipoLinha = '".$tipoLinha."', tipoAssinatura = '".$tipoAssinatura."', tipoPlano = '".$tipoPlano."', plano = '".$plano."', valorPlano = '".$valorPlano."', aparelho = '".$aparelho."', valorAparelho = '".$valorAparelho."', pagamento = '".$pagamento."', status = '".$status."', obs = '".$obs."', vencimento = '".$vencimento."', motivo_restricao = '".$motivo_restricao."',motivo_cancelamento = '".$motivo_cancelamento."', data_marcada = '".$data_entrega."', obs1 = '".$obs1."', data_instalacao = '".$data_finalizada."', numCar = '".$numCar."', codSeg = '".$codSeg."', carVal = '".$carVal."', carBan = '".$carBan."', numParcelas = '".$numParcelas."', auditor = '".$auditornome."', gravacao = '".$gravacao."' WHERE id = '".$_GET['owner']."' ") or die('Ocorreu um Erro ao inserir os dados!');


/////////////////
// Insert LOG //
///////////////

$data = date("Y-m-d H:i:s");
$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$_GET['user']."','Atualizou um dado no sistema (ID: ".$_GET['owner'].").')");

?>


<script type="text/javascript">

window.alert('Dados salvos com sucesso!');
window.close();

</script>

<?
}
?>



<!doctype html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="pt-br" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="pt-br" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="pt-br" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="pt-br" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="pt-br" class="no-js"> <!--<![endif]-->  
<head>

	
        
		<meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1" />
        <meta NAME="REVISIT-AFTER" CONTENT="1 DAYS">
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="expires" content="Mon, 01 Jan 1990 00:00:01 GMT" />
		<meta http-equiv="Content-Language" content="pt-br">
		
		
		<link rel="shortcut icon" href="image/favicon.ico" />

		<title>Vento Admin</title>
<meta name="author" content="Vento-Consulting" >
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" >
<link href="css/jqueryui.css" media="screen" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jqueryui.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/actionsJquery.js"></script>   
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>   

<script type="text/javascript">

		$(document).ready(function(){ 
		
		<? if($val['pessoa'] != 'Pessoa Jurídica'){ ?>
		$('input[name="cnpj"]').hide();
		$('.razaoSocial').hide();
		$('input[name="razaoSocial"]').hide();
		$('.cnpj').hide();
		$('input[name="cpf"]').show();
		$('.cpf').show();
		$('input[name="nomeMae"]').show();
		$('label[for="field8"]').show();
	    $('label[for="field7"]').show();
		$('#field7').show();
		$('label[for="field9"]').show();
		$('#field9').show();
		$('label[for="field7"]').show();
		$('#field7').show();
		$('label[for="field10"]').show();
		$('#field10').show();
		$('label[for="field11"]').show();
		$('#field11').show();
		$('label[for="field12"]').show();
		$('#field12').show();
		$('label[for="field13"]').show();
		$('#field13').show();
		$('label[for="field14"]').show();
	    $('#field14').show();
		$('.nome').show();
		$('.nomeMae').show();
		$('.nascimento').show();
		$('.rg').show();
		$('.orgExp').show();
		$('.dataExped').show();
		$('.estCiv').show();
		<? } ?>
		
		
		<? if($val['pessoa'] == 'Pessoa Jurídica'){ ?>
		 $('input[name="cnpj"]').show();
		 $('.razaoSocial').show();
		 $('input[name="razaoSocial"]').show();
		 $('.cnpj').show();
		 $('input[name="cpf"]').hide();
		 $('.cpf').hide();
		 $('input[name="nomeMae"]').hide();
		 $('label[for="field8"]').hide();
		 $('label[for="field7"]').hide();
		 $('#field7').hide();
		 $('label[for="field9"]').hide();
		 $('#field9').hide();
		 $('label[for="field7"]').hide();
		 $('#field7').hide();
		 $('label[for="field10"]').hide();
		 $('#field10').hide();
		 $('label[for="field11"]').hide();
		 $('#field11').hide();
		 $('label[for="field12"]').hide();
		 $('#field12').hide();
		 $('label[for="field13"]').hide();
		 $('#field13').hide();
		 $('label[for="field14"]').hide();
		 $('#field14').hide();
		 $('.nome').hide();
		 $('.nomeMae').hide();
		 $('.nascimento').hide();
		 $('.rg').hide();
		 $('.orgExp').hide();
		 $('.dataExp').hide();
		 $('.profissao').hide();
		 $('.estCiv').hide();
		 
		<? } ?>
		
		
		$('.cancelamento').hide();
		$('.restricao').hide();
		<? if($val['pagamento'] != 'CARTÃO DE CRÉDITO'){ ?>
		$('.labCar').hide(); 
		<? } ?>
	});

function display(el)
{

 style = $(el).attr('style');
 if(style!=null){
	 
  crs = style.split(':');
  

  styleF = $.trim(crs[1].replace(';',''));
  
 }
 
 else{
	     styleF ='block';
	 }
 
 return styleF ;

}

$(function(){

$('#salvar').click(function(){

  
  
  for(i=1;i<300;i++){

      nameField ='#field'+i;
      field     ='field'+i;
      
	if ( $(nameField).length ){

     name = $(nameField).attr('name');

      label = $('label[for="'+field+'"]').text();
      ps = $('label[for="'+field+'"]').position().top;
      
        message = '<center><b style="color:#f00;">O campo '+label+' está vazio!!</b></center>';
       
         if($(nameField).val()=='' && display(nameField)!='none'){
                 
                 
        	  $('#error-insert span').html(message);
        	  
              $('#error-insert').css('display','block');

                   alertError(ps,nameField);

                return false;
         
              } 
               
		}
   }
	
   });
   	
		
   $('select[name="status"]').change(function() { 
      val = $(this).val();
	   if(val=='CANCELADO'){
		$('.restricao').hide();
		$('.cancelamento').show();
	   }
	   
		else if(val=='RESTRIÇÃO'){
		$('.cancelamento').hide();
		$('.restricao').show();
		}
		
		else if(val==''){
		$('.cancelamento').hide();
		$('.restricao').hide();
		}
	});
   

    $('select[name="pagamento"]').change(function() { 
   
      val = $(this).val();
	  
	   if(val=='DÉBITO'){
		
		$('input[name="banco"]').show();
		$('input[name="agencia"]').show();
		$('input[name="cc"]').show();
		$('label:contains("Banco")').show();
		$('label:contains("Agência")').show();
		$('label:contains("CC")').show();
		$('.agencia').show();
		$('.banco').show();
		$('.cc').show();
		$('.pagInst').hide();
		$('.labCar').hide();
		$('select[name="pagInst"]').hide();
		}
		
		else if (val=='BOLETO'){
		$('input[name="banco"]').hide();
		$('input[name="agencia"]').hide();
		$('input[name="cc"]').hide();
		$('label:contains("Banco")').hide();
		$('label:contains("Agência")').hide();
		$('label:contains("CC")').hide();
		$('.agencia').hide();
		$('.banco').hide();
		$('.cc').hide();
		$('.labCar').hide();
		$('.pagInst').show();
		$('select[name="pagInst"]').show();
		}
	
		else if (val=='CARTÃO DE CRÉDITO'){
		$('input[name="banco"]').hide();
		$('input[name="agencia"]').hide();
		$('input[name="cc"]').hide();
		$('label:contains("Banco")').hide();
		$('label:contains("Agência")').hide();
		$('label:contains("CC")').hide();
		$('.agencia').hide();
		$('.banco').hide();
		$('.cc').hide();
		$('.pagInst').hide();
		$('.labCar').show();

		}
	});
	

$('select[name="tipoAss"]').change( function(){ 

  valor = $('select[name="tipoAss"]').val(); 
  verificaassinatura(valor);
});


function verificaassinatura(v){

if(v == "Nova Linha"){ 
$('select[name="tipoPlano"]').html('<option value=""></option><option value="Pré Pago">Pré Pago</option><option value="Pós Pago">Pós Pago</option>'); 

}


else if(v == "Portabilidade"){ 

   $('select[name="tipoPlano"]').html('<option value=""></option><option value="Pós Pago">Pós Pago</option>');

 }
else { 

  $('select[name="tipoPlano"]').html('<option value=""></option>');

}

verificatipoplano('');
verificaplano('');
verificaaparelho('');
}


///////////	
$('select[name="tipoPlano"]').change( function(){ 

  valor = $('select[name="tipoPlano"]').val(); 
 verificatipoplano(valor);
});

function verificatipoplano(v){

if(v == "Pré Pago"){ $('select[name="plano"]').html('<option value=""></option><option value="Pré 35">Pré 35</option><option value="Pré Ilimitado 35">Pré Ilimitado 35</option>'); }

else if(v == "Pós Pago"){ $('select[name="plano"]').html('<option value=""></option><option value="Controle Fixo">Controle Fixo</option><option value="Pós 33 com Isenção">Pós 33 com Isenção</option><option value="Pós Fale a Vontade">Pós Fale a Vontade</option><option value="Pós Fixo Ilimitado">Pós Fixo Ilimitado</option>'); }
else { $('select[name="plano"]').html('<option value=""></option>');}

verificaplano('');
verificaaparelho('');

}		


///////////	
$('select[name="plano"]').change( function(){ 

  valor = $('select[name="plano"]').val(); 
  verificaplano(valor);
});
	
function verificaplano(v){

if(v == "Pré 35"){ $('input[name="valorPlano"]').val('35,00');}
else if(v == "Pré Ilimitado 35"){ $('input[name="valorPlano"]').val('35,00');}
else if(v == "Controle Fixo"){ $('input[name="valorPlano"]').val('29,90');}
else if(v == "Pós 33 com Isenção"){ $('input[name="valorPlano"]').val('33,00');}
else if(v == "Pós Fale a Vontade"){ $('input[name="valorPlano"]').val('19,90');}
else if(v == "Pós Fixo Ilimitado"){ $('input[name="valorPlano"]').val('53,00');}
else { $('input[name="valorPlano"]').val('');}

$('select[name="aparelho"]').html('<option value=""></option><option value="Alcatel OT 208">Alcatel OT 208</option><option value="Huawei 8551">Huawei 8551</option><option value="Huawei 2555">Huawei 2555</option>');

verificaaparelho('');

}


///////////	

$('select[name="aparelho"]').change( function(){ 

  valor = $('select[name="aparelho"]').val(); 
  tipoassinatura(valor);
});

function tipoassinatura(v){
tipoassinatura = $('select[name="tipoAss"]').val();
if(tipoassinatura == 'Portabilidade'){
	
if(v == 'Alcatel OT 208'){$('input[name="valorAparelho"]').val('34,50');}
else if(v == 'Huawei 8551'){$('input[name="valorAparelho"]').val('79,00');}
else if(v == 'Huawei 2555'){$('input[name="valorAparelho"]').val('49,00');}
else {$('input[name="valorAparelho"]').val('');}
	
}



else if(tipoassinatura == 'Nova Linha'){

var plano = $('select[name="plano"]').val();
	
if(plano == 'Pré 35' || plano == 'Pré Ilimitado 35'){ 

if(v == 'Alcatel OT 208'){$('input[name="valorAparelho"]').val('69,00');}
else if(v == 'Huawei 8551'){$('input[name="valorAparelho"]').val('179,00');}
else if(v == 'Huawei 2555'){$('input[name="valorAparelho"]').val('149,00');}
else{$('input[name="valorAparelho"]').val('');}
}

else if(plano == 'Controle Fixo'){ 

if(v == 'Alcatel OT 208'){$('input[name="valorAparelho"]').val('49,00');}
else if(v == 'Huawei 8551'){$('input[name="valorAparelho"]').val('119,00');}
else if(v == 'Huawei 2555'){$('input[name="valorAparelho"]').val('79,00');}
else{$('input[name="valorAparelho"]').val('');}
}	

else if(plano == 'Pós 33 com Isenção' || plano == 'Pós Fale a Vontade' || plano == 'Pós Fixo Ilimitado'){ 

if(v == 'Alcatel OT 208'){$('input[name="valorAparelho"]').val('49,00');}
else if(v == 'Huawei 8551'){$('input[name="valorAparelho"]').val('119,00');}
else if(v == 'Huawei 2555'){$('input[name="valorAparelho"]').val('79,00');}
else{$('input[name="valorAparelho"]').val('');}
                                                    }

else{$('input[name="valorAparelho"]').val('');}

}

else{$('input[name="valorAparelho"]').val('');}

}


//////////////////////////////////////////////////////////////////////////


  $('input[name="dataDesej"]').keyup(function(){
	     hoje = new Date();
		 dia = hoje.getDate();
		 mes = hoje.getMonth()+1;
		 ano = hoje.getFullYear();
		
          val = $(this).val();

          if(dia < 10){ 
 
        	    day = "0"+ dia;  
        	}   else { day = dia; }

          if(mes < 10){  
      	    month = "0"+ mes;  
      	}  else { month = mes; }
      	
          dataToday = ano+''+month+''+day;
         
           if(val.length>=10){
               
        	   exp = val.split('/');
        	   
                dataIns = exp[2]+exp[1]+exp[0];
               
                
                  if(parseInt(dataIns) < parseInt(dataToday)){
                     $(this).val('');
                     $(this).attr('placeholder','Data não válida!!');
                       // alert('data nao valida!!');
                    }
               

               }

	  });

});


function alertError(ps,nameField)
 {
	 $( "#error-insert" ).dialog({width:300,
		 height:200,
         modal: true,
         resizable:false,
         buttons: {
             Ok: function() {
                 $( this ).dialog( "close" );
                 $('body').animate({scrollTop:ps},800,function(){

                	 $(nameField).focus();

                     });
             }
         }
     });

}
////////////////////////////////////////////////////////////////////////////////////////////////////////

 </script>

	
     	
	 </head>
   
  
	<body id="body">
   
		<div class="header">
		
       
          
          
			<div id="topo">
			
				<div id="topoCont">
       
					<a href="/" id="logo"><img src="image/logo-vento-p.png"></a>
										
				</div><!-- Fim topoCont -->
				
				<!----------------------------- Fim Menu usuário ----------------------------->
					
					
					
				<!----------------------------- Menu Principal ----------------------------->
			 
			 
				<center><div id="menu">
				   

				</div></center><!-- Fim menu -->
				
				
             
            </div><!-- Fim topo -->
			
			
                              
			
			<!----------------------------- Fim Menu Principal ----------------------------->
			
			
			
			<!----------------------------- Conteúdo ----------------------------->
          		  
			<div class="mainContent">
			
				
         
				<div class="container">
				     
					<br> 
					<h2>Editar Venda</h2>
					<hr id="hrTopTab"/>

					<form class="dadosDaVenda" method="post" action="">
						<br>
							
							<div class="formDados">              
								<label>OS</label>	               
								<input type="text" value="<?=$val['os']?>" id="" name="os"/>							
							</div>
							
							
							<div class="formDados">              
								<label>ESN</label>	               
								<input type="text" id="" value="<?= $val['esn']; ?>" name="esn"/>
							</div>
							
							
							<div class="formDados">              
								<label>Novo número</label>	               
								<input type="text" id="" value="<?=$val['novoNumero']?>" name="novoNumero"/>
							</div>
							
							
							<br><br>
							<span>
								<p class="subTab">Dados do cliente</p>
								<br><hr id="hrForm">
							</span>
							
								
							<div class="formDados cnpj">
								<label class="cnpj">CNPJ</label>
								<input type="text" class="cnpj" placeholder="Exemplo(99.999.999/9999-99)" value="<?=$val['cpf']?>" name="cnpj" />	
							</div>
							
							
							<div class="formDados cnpj"> 
								<label class="razaoSocial" >Razão Social</label> 
								<input type="text" class="razaoSocial" name="razaoSocial" value="<?=$val['razaoSocial']?>"/>
							</div>
					   
					   
							<div class="formDados">
					            <label class="cpf" >CPF</label>
								<input type="text" placeholder="Exemplo(999.999.999-99)" id="" name="cpf" value="<?=$val['cpf']?>"/>	
							</div>
               			     			               
				               
							<input type="hidden" name="produto" value="clarofixo"/>
                
				             				
							<div class="formDados">
								<label for="field7">Nome</label>
								<input type="text" placeholder="" id="field7" name="nome" value="<?=$val['nome']?>"/>
								<span class="campoobrigatorio nome">*</span>
							</div>
							
							
							<div class="formDados">
								<label for="field8">Nome da Mãe</label>
								<input type="text" id="field8" name="nomeMae" value="<?=$val['nome_mae']?>"/>
								<span class="campoobrigatorio nomeMae">*</span>
							</div>
							
							<div class="formDados">
								<label for="field9">Nascimento</label>
								<input type="text" placeholder="Exemplo(dd/mm/aaaa)" id="field9" name="nascimento" value="<?=$val['nascimento']?>"/>
								<span class="campoobrigatorio nascimento">*</span>
							</div>
							
							<div class="formDados">
								<label for="field10">RG</label>
								<input type="text" placeholder="" id="field10" name="rg" value="<?=$val['rg']?>"/>
								<span class="campoobrigatorio rg">*</span>
							</div>
							
							<div class="formDados">
								<label for="field11">Orgão Expeditor</label>
								<input type="text" placeholder="" id="field11" name="orgExp" value="<?=$val['org_exp']?>"/>
								<span class="campoobrigatorio orgExp">*</span>
							</div>
							
							<div class="formDados">
								<label for="field12">Data da Expedição</label>
								<input type="text" placeholder="Exemplo(dd/mm/aaaa)" id="field12" name="dataExp" value="<?=$val['data_exp']?>"/>
								<span class="campoobrigatorio dataExp">*</span>
							</div>
							
							<div class="formDados">
								<label for="field13">Profissão</label>
								<input type="text" placeholder="" id="field13" name="profissao" value="<?=$val['profissao']?>"/>
								<span class="campoobrigatorio profissao">*</span>
							</div>
                            
							<div class="formDados">
								<label class="sexo">Sexo</label>
				                <select  name="sexo">
									<option <? if($val['sexo'] == 'Masculino'){ ?>selected="selected" <? } ?>>Masculino</option>
									<option <? if($val['sexo'] == 'Feminino'){ ?>selected="selected" <? } ?>>Feminino</option>
								</select>
								<span class="campoobrigatorioSel estCiv">*</span>
							</div>
							
							<div class="formDados">
								<label class="estCiv" for="field14" value="<?=$val['estado_civil']?>">Estado civil</label>
				                <select  id="field14"  name="estCiv">
									<option <? if($val['estado_civil'] == 'Solteiro'){ ?>selected="selected" <? } ?>>Solteiro</option>
									<option <? if($val['estado_civil'] == 'Casado'){ ?>selected="selected" <? } ?>>Casado</option>
									<option <? if($val['estado_civil'] == 'Desquitado'){ ?>selected="selected" <? } ?>>Desquitado</option>
									<option <? if($val['estado_civil'] == 'Separado'){ ?>selected="selected" <? } ?>>Separado</option>
									<option <? if($val['estado_civil'] == 'Divorciado'){ ?>selected="selected" <? } ?>>Divorciado</option>
									<option <? if($val['estado_civil'] == 'Viúvo'){ ?>selected="selected" <? } ?>>Viúvo</option>
								</select>
								<span class="campoobrigatorioSel estCiv">*</span>
							</div>
											
							<div class="formDados">
								<label for="field15">E-mail</label>
								<input type="text" placeholder="" id="field15" name="email" value="<?=$val['email']?>"/>
								<span class="campoobrigatorio email">*</span>
							</div>
							
							
							<div class="formDados">
								<label for="field16">Telefone</label>
								<input type="text" placeholder="Exemplo((99) 9999-9999)" id="field16" name="tel" value="<?=$val['telefone']?>"/>
								<span class="campoobrigatorio tel">*</span>
							</div>
							
							<div class="formDados">
								<label class="telCom" >Telefone Comercial</label> 
								<input type="text" placeholder="Exemplo((99) 9999-9999)" id="" name="telCom" value="<?=$val['telefone3']?>"/>		
							</div>
							
							<div class="formDados">
								<label class="telCel" >Telefone Celular</label>
								<input type="text" placeholder="Exemplo((99) 9999-9999)" id="" name="telCel" value="<?=$val['telefone2']?>"/>
							</div>
												
							<span>
								<p class="subTab1">Endereço do Cliente</p>
								<br><hr id="hrForm">
							</span>
							
							<div class="formDados">
								<label for="field21">CEP</label>
								<input type="text" placeholder="Exemplo(99999-999)" id="field21" name="cep" value="<?=$val['cep']?>"/>
								<span class="campoobrigatorio cep">*</span>
							</div>
							
							<div class="formDados">
								<label for="field22">Endereço</label>
								<input type="text" placeholder="" id="field22" name="endereco" value="<?=$val['endereco']?>"/>
								<span class="campoobrigatorio endereco">*</span>
							</div>
							
							<div class="formDados">
								<label for="field23">Número</label>
								<input type="text" placeholder="" id="field23" name="numEnd" value="<?=$val['numero']?>"/>
								<span class="campoobrigatorio numEnd">*</span>
							</div>
												
							<div class="formDados"> 
								<label class="lote" >Lote</label>
								<input type="text" placeholder="" id="" name="lote" value="<?=$val['lote']?>"/>
							</div>
							
							<div class="formDados">
								<label class="quadra" >Quadra</label>
								<input type="text" placeholder="" id="" name="quadra" value="<?=$val['quadra']?>"/>
							</div>
							
							<div class="formDados">
								<label class="complemento" >Complemento</label>
								<input type="text" placeholder="" id="" name="complemento" value="<?=$val['complemento']?>"/>
							</div>
							
							<div class="formDados">
								<label for="field27">Bairro</label>
								<input type="text" placeholder="" id="field27" name="bairro" value="<?=$val['bairro']?>"/>
								<span class="campoobrigatorio bairro">*</span>
							</div>
							
							<div class="formDados">
								<label class="estado" for="field28">Estado</label>
				               <? $uf == $val['uf'];?>
								
								<select name="uf">
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
								<span class="campoobrigatorioSel estado">*</span>
							</div>
							
							<div class="formDados">
								<label for="field29">Cidade</label>
				               <input type="text" placeholder="" id="field29" name="cidade" value="<?=$val['cidade']?>"/>
								<span class="campoobrigatorio cidade">*</span>
							</div>
							
				            <label  id="labelpontRefe">Ponto de referência</label> 
				            <textarea  class="textpontRefe" id="field30" name="pontRef" value="<?=$val['ponto_referencia']?>"></textarea>

							<span>
								<p class="subTab">Dados da venda</p>
								<br><hr id="hrForm">
							</span>
							
							<div class="formDados">
								<label class="monitor2" for="field32">Monitor</label>
				               <!-- <select  id="field32"  name="monitor2"  value="<?=$val['monitor']?>">
									<option value="1">thiago santos</option>
									<option value="5">carlos nascimento</option>
								</select>-->
								
									<select   id="field32"  name="monitor2">
									<option value=""></option>
									<? 

									$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE grupo LIKE '%0003%' && tipo_usuario = 'MONITOR' ORDER BY nome ASC");
									while($MONITORES = mysql_fetch_array($conMONITORES)){

									?>
									<option value="<?= $MONITORES['id'];?>" <? if($val['monitor'] == $MONITORES['id']){?> selected="selected" <? } ?>><?= $MONITORES['nome'];?></option>
									<? } ?>

									</select>

								<span class="campoobrigatorioSel monitor2">*</span>
							</div>
							
							<div class="formDados">
								<label class="operador2" for="field33">Operador</label>
				                
								<?
									$conOPERADORES1 = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$val['operador']."'");
									$OPERADORES1 = mysql_fetch_array($conOPERADORES1);	

									?>
									<!--
									<div id="loadoperadores" style="position:relative"></div> 
									-->
									<select type="text" id="operador" name="operador">
									<option value="<?= $val['operador']; ?>"><?= $OPERADORES1['nome'];?></option>
									<option value="<?= $val['operador']; ?>"></option>
									<? 

									$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE grupo LIKE '%0003%' && status != 'DESLIGADO' ORDER BY nome ASC");
									while($OPERADORES = mysql_fetch_array($conOPERADORES)){

									?>

									<option value="<?= $OPERADORES['operador_id'];?>" <? if($val['operador'] == $OPERADORES['operador_id']){?> selected="selected" <? } ?>>
									<?= $OPERADORES['nome'];?>
									</option>

									<? } ?>

									</select>
									
								<span class="campoobrigatorioSel operador2">*</span>
							</div>
								
							<div class="formDados">
								<label class="tipoLinha" for="field35">Tipo Linha</label>
				                <select  id="field35"  name="tipoLinha"  value="<?=$val['tipoLinha']?>">
									<option>Residencial</option>
									<option>Comercial</option>
								</select>
								<span class="campoobrigatorioSel tipoLinha">*</span>
							</div>
							
							<div class="formDados">
								<label class="tipoAss" for="field36">Tipo Assinatura</label>
				                <select  id="field36"  name="tipoAss"  value="<?=$val['tipoAssinatura']?>">
									<option></option>
									<option value="Nova Linha" <? if($val['tipoAssinatura'] == 'Nova Linha'){ ?>selected="selected" <? }?>>Nova Linha</option>
									<option value="Portabilidade" <? if($val['tipoAssinatura'] == 'Portabilidade'){ ?>selected="selected" <? }?>>Portabilidade</option>
								</select>
								<span class="campoobrigatorioSel tipoAss">*</span>
							</div>
							
							<div class="formDados">
								<label class="tipoPlano" for="field37">Tipo Plano</label>
				                <select  id="field37"  name="tipoPlano" >
									<option> </option>
                                    <? if($val['tipoAssinatura'] == 'Nova Linha'){ ?>
                                    <option value="Pré Pago" <? if($val['tipoPlano'] == 'Pré Pago'){ ?>selected="selected" <? }?>>Pré Pago</option>  
                                    <option value="Pós Pago" <? if($val['tipoPlano'] == 'Pós Pago'){ ?>selected="selected" <? }?>>Pós Pago</option>                                  
									<? } else if($val['tipoAssinatura'] == 'Portabilidade'){ ?>
                                    <option value="Pós Pago" <? if($val['tipoPlano'] == 'Pós Pago'){ ?>selected="selected" <? }?>>Pós Pago</option> 
                                    <? } ?>
								</select>
								<span class="campoobrigatorioSel tipoPlano">*</span>
							</div>
							
							<div class="formDados">
								<label class="plano" for="field38">Plano</label>
				                <select  id="field38"  name="plano" value="<?=$val['plano']?>">
									<option> </option>
                                    <? if($val['tipoPlano'] == 'Pré Pago'){ ?>
                                    <option value="Pré Ilimitado" <? if($val['plano'] == 'Pré Ilimitado'){ ?>selected="selected" <? }?>>Pré Ilimitado</option>  
                                    <option value="Pré Ilimitado 35" <? if($val['plano'] == 'Pré Ilimitado 35'){ ?>selected="selected" <? }?>>Pré Ilimitado 35</option>                                 
									<? } else if($val['tipoPlano'] == 'Pós Pago'){ ?>
                                    <option value="Controle Fixo" <? if($val['plano'] == 'Controle Fixo'){ ?>selected="selected" <? }?>>Controle Fixo</option>  
                                    <option value="Pós 33 com Isenção" <? if($val['plano'] == 'Pós 33 com Isenção'){ ?>selected="selected" <? }?>>Pós 33 com Isenção</option>
									<option value="Pós Fale a Vontade" <? if($val['plano'] == 'Pós Fale a Vontade'){ ?>selected="selected" <? }?>>Pós Fale a Vontade</option>
									<option value="Pós Fixo Ilimitado" <? if($val['plano'] == 'Pós Fixo Ilimitado'){ ?>selected="selected" <? }?>>Pós Fixo Ilimitado</option>
                                    <? } ?>
								</select>
								<span class="campoobrigatorioSel plano">*</span>
							</div>
							
							<div class="formDados">
								<label for="field39">Valor Plano</label>
								<input type="text" placeholder="" id="field39" name="valorPlano" value="<?=$val['valorPlano']?>"/>
								<span class="campoobrigatorio valorPlano">*</span>
							</div>
							
							<div class="formDados">
								<label class="aparelho" for="field40">Aparelho</label>
				                <select  id="field40"  name="aparelho" value="<?=$val['aparelho']?>">
                                    <option value=""></option>
									<? if($val['tipoPlano'] == 'Pré Pago'){ ?>
                                    <option value="Alcatel OT 208"  <? if($val['aparelho'] == 'Alcatel OT 208'){ ?>selected="selected" <? }?>>Alcatel OT 208</option>
                                    <option value="Huawei 8551"  <? if($val['aparelho'] == 'Huawei 8551'){ ?>selected="selected" <? }?>>Huawei 8551</option>
                                    <option value="Huawei 2555"  <? if($val['aparelho'] == 'Huawei 2555'){ ?>selected="selected" <? }?>>Huawei 2555</option>
                                    <option value="ALCATEL CF100"  <? if($val['aparelho'] == 'ALCATEL CF100'){ ?>selected="selected" <? }?>>ALCATEL CF100</option>
                                    <option value="Huawei U2800 (Cinza)"  <? if($val['aparelho'] == 'Huawei U2800 (Cinza)'){ ?>selected="selected" <? }?>>Huawei U2800 (Cinza)</option>
                                    <option value="Huawei U2800 (Branco)"  <? if($val['aparelho'] == 'Huawei U2800 (Branco)'){ ?>selected="selected" <? }?>>Huawei U2800 (Branco)</option>
                                    <option value="Chip Claro Fixo"  <? if($val['aparelho'] == 'Chip Claro Fixo'){ ?>selected="selected" <? }?>>Chip Claro Fixo</option>									
									
									<? } else if($val['tipoPlano'] == 'Pós Pago'){ ?>
                                    <option value="Alcatel OT 208"  <? if($val['aparelho'] == 'Alcatel OT 208'){ ?>selected="selected" <? }?>>Alcatel OT 208</option>
                                    <option value="Huawei 8551"  <? if($val['aparelho'] == 'Huawei 8551'){ ?>selected="selected" <? }?>>Huawei 8551</option>
                                    <option value="Huawei 2555"  <? if($val['aparelho'] == 'Huawei 2555'){ ?>selected="selected" <? }?>>Huawei 2555</option>
                                    <option value="ALCATEL CF100"  <? if($val['aparelho'] == 'ALCATEL CF100'){ ?>selected="selected" <? }?>>ALCATEL CF100</option>
                                    <option value="Huawei U2800 (Cinza)"  <? if($val['aparelho'] == 'Huawei U2800 (Cinza)'){ ?>selected="selected" <? }?>>Huawei U2800 (Cinza)</option>
                                    <option value="Huawei U2800 (Branco)"  <? if($val['aparelho'] == 'Huawei U2800 (Branco)'){ ?>selected="selected" <? }?>>Huawei U2800 (Branco)</option>
                                    <option value="Chip Claro Fixo"  <? if($val['aparelho'] == 'Chip Claro Fixo'){ ?>selected="selected" <? }?>>Chip Claro Fixo</option>
                                     
                                    <? } ?>
								</select>
								<span class="campoobrigatorioSel aparelho">*</span>
							</div>
							
							<div class="formDados">
								<label for="field41">Valor Aparelho</label>
								<input type="text" placeholder="" id="field41" name="valorAparelho" value="<?=$val['valorAparelho']?>"/>
								<span class="campoobrigatorio valorAparelho">*</span>
							</div>
							
							<div class="formDados">
								<label class="pagamento" for="field42">Pagamento</label>
				                <select  id="field42"  name="pagamento"  value="<?=$val['pagamento']?>">
									<option> </option>
									<option value="BOLETO" <? if($val['pagamento'] == 'BOLETO'){ ?>selected="selected" <? }?>>BOLETO</option>  
                                    <option value="CARTÃO DE CRÉDITO" <? if($val['pagamento'] == 'CARTÃO DE CRÉDITO'){ ?>selected="selected" <? }?>>CARTÃO DE CRÉDITO</option>  
									
								</select>
								<span class="campoobrigatorioSel pagamento">*</span>
							</div>
								
							<div class="formDados">
								<label for="field43">Data Venda</label>
								<input type="text" placeholder="Exemplo(dd/mm/aaaa)" disabled="disabled" id="field43" name="data" value="<?= substr($val['data'],6,2).'/'.substr($val['data'],4,2).'/'.substr($val['data'],0,4);?>"/>
								<span class="campoobrigatorio dataVenda">*</span>
							</div>
									
							<div class="formDados">
								<label for="">Tipo Venda</label>
								
								<select  id="field42"  name="tipoVenda"  value="<?=$val['tipoVenda']?>">
									<option> </option>
									<option value="Interna" <? if($val['tipoVenda'] == 'INTERNA'){ ?>selected="selected" <? }?>>Interna</option>  
                                    <option value="Externa" <? if($val['tipoVenda'] == 'EXTERNA'){ ?>selected="selected" <? }?>>Externa</option>  
									
								</select>
								<span class="campoobrigatorio tipoVenda">*</span>
							</div>
									
							<div class="formDados">
								<label class="vencimento" for="field44">Vencimento</label>
				                <select  id="field44"  name="vencimento" value="<?=$val['vencimento']?>">
									<option> </option>
                                    <option value="2"<? if($val['vencimento'] == '2'){ ?>selected="selected" <? }?>>2</option>

									<option value="8"<? if($val['vencimento'] == '8'){ ?>selected="selected" <? }?>>8</option>
									<option value="11"<? if($val['vencimento'] == '11'){ ?>selected="selected" <? }?>>11</option>
									<option value="20"<? if($val['vencimento'] == '20'){ ?>selected="selected" <? }?>>20</option>
									<option value="25"<? if($val['vencimento'] == '25'){ ?>selected="selected" <? }?>>25</option>
							    </select>
								<span class="campoobrigatorioSel vencimento">*</span>
							</div>
								
                                								<br><hr id="hrForm">


							<div class="formDados">								 
								<label class="" >Cartão de Crédito</label>
								<input type="text"class="" name="numCar" value="<?=$val['numCar']?>"/>
							</div>
								
							<div class="formDados">								 
								<label class="labCar" >Código de Segurança</label>
								<input type="text" maxlength="3" class="labCar" name="codSeg" value="<?=$val['codSeg']?>"/>
							</div>
								
							<div class="formDados">								 
								<label class="labCar">Bandeira</label>
								<select  id="field42"  class="labCar" name="carBan" value="<?=$val['carBan']?>">
									<option value=""></option>
									<option value="Visa">Visa</option>
									<option value="MasterCard">MasterCard</option>
								</select>
							</div>
                            
                            <div class="formDados">								 
								<label class="labCar">Validade</label>
                                <input type="text" maxlength="7" size="2" placeholder="Exemplo(mm/aaaa)" class="labCar" name="validade" value="<?=$val['mesval']?>"/>
							</div>
                            
                            <div class="formDados">								 
								<label class="labCar">Parcelas</label>
								<select  id="field42"  class="labCar" name="numparcelas" value="<?=$val['numParcelas']?>">
									<option value=""></option>									
                                    <option value="1">1</option>
									<option value="2">2</option>
                                    <option value="3">3</option>
									<option value="6">6</option>
								</select>
							</div>
									
            								<br><hr id="hrForm">

                                    
							<div class="formDados">
								<label for="">Gravação</label>
				                <input type="text" disabled="disabled" id="" name="gravacao" value="<?=$_GET['recording_filename'].'.mp3';?>"/>
								<span class="campoobrigatorio dataVenda">*</span>
							</div>
									
							<div class="formDados">
								<label class="auditor" for="">Auditor</label>
								<? 
									$conAUDITOR = $conexao->query("SELECT * FROM usuarios WHERE id='".$val['auditor']."'");
									$AUDITOR = mysql_fetch_array($conAUDITOR);
								?>

								<select type="text" id="auditor" name="auditor">
									<? if($val['auditor']) {?> 
                                    <option value="<?= $val['auditor']; ?>"><?= $AUDITOR['nome'];?></option>
                                    <? } ?>
									<option value="<?= $val['auditor']; ?>"></option>
									
									<? 

									$conAUDITOR = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario = 'AUDITOR' && status != 'DESLIGADO' ORDER BY nome ASC");
									while($AUDITOR = mysql_fetch_array($conAUDITOR)){

									?>
									<option value="<?= $AUDITOR['id'];?>" <? if($_GET['user'] == $AUDITOR['id']){?> selected="selected" <? } ?>>
									<?= $AUDITOR['nome'];?>
									</option>

									<? } ?>
								</select>
								<span class="campoobrigatorioSel ">*</span>
							</div>
								
							<div class="formDados">
								<label for="">Obs Gravação</label>
				               <textarea id="" name="obsGravacao" style="width: 350px; height:100px; margin-bottom: 10px; padding: 4px; color:#999;"><?= $val['obs_gravacao']?></textarea>
							</div>
								<br><hr id="hrForm">
										
														
							<div class="formDados">
								<label for="">Data Entrega</label>
								<input type="text" placeholder="Exemplo(dd/mm/aaaa)" id="" name="dataautorizacao" value="<?=$val['data_marcada']?>"/>
								<span class="campoobrigatorio dataVenda">*</span>
							</div>	
								
							<div class="formDados">
								<label for="">Obs Entrega</label>
								<textarea id="" name="obsGravacao" style="width: 350px; height:100px; margin-bottom: 10px; padding: 4px; color:#999;" value="<?=$val['obs1']?>"></textarea>
							</div>	
								
							<div class="formDados">
								<label for="">Status</label>
								<select name="status">
									<option></option>
                                    <option value="GRAVAR" <? if($val['status'] == 'GRAVAR'){?> selected="selected" <? } ?>>Gravar</option>
                                   
                                    <option value="GRAVADO" <? if($val['status'] == 'GRAVADO'){?> selected="selected" <? } ?>>Gravado</option>
                                    <option value="SEM CONTATO" <? if($val['status'] == 'SEM CONTATO'){?> selected="selected" <? } ?>>Sem Contato</option>
                                    <option value="DEVOLVIDO" <? if($val['status'] == 'DEVOLVIDO'){?> selected="selected" <? } ?>>Devolvido</option>
									<option value="CANCELADO" <? if($val['status'] == 'CANCELADO'){?> selected="selected" <? } ?>>Cancelado</option>
									<option value="RESTRIÇÃO" <? if($val['status'] == 'RESTRIÇÃO'){?> selected="selected" <? } ?>>Restrição</option>
                                    
                                    <option value="REDIRECIONADO" <? if($val['status'] == 'REDIRECIONADO'){?> selected="selected" <? } ?>>Redirecionado</option>

								</select>
								<span class="campoobrigatorio dataVenda">*</span>
							</div>	
								
							<div class="formDados">
								<label class="restricao" for="">Motivos da restrição</label>
								<select  class="restricao" name="motivorestricao" value="<?=$val['motivo_restricao']?>">
									<option></option>
								</select>
								<span class="campoobrigatorio restricao">*</span>
							</div>	
								
							<div class="formDados">
								<label class="cancelamento" for="">Motivos de cancelamento</label>
								<select  class="cancelamento"  name="motivocancelamento">
									<option value=""></option>
									<option value="Inviabilidade Técnica" <? if($val['motivo_cancelamento'] == 'Inviabilidade Técnica'){?>selected="selected"<? } ?>>Inviabilidade Técnica</option>
									<option value="Falta de Dinheiro" <? if($val['motivo_cancelamento'] == 'Falta de Dinheiro'){?>selected="selected"<? } ?>>Falta de Dinheiro</option>
									<option value="Venda Perdida para a Concorrência" <? if($val['motivo_cancelamento'] == 'Venda Perdida para a Concorrência'){?>selected="selected"<? } ?>>Venda Perdida para a Concorrência</option>
									<option value="Desistência do Cliente" <? if($val['motivo_cancelamento'] == 'Desistência do Cliente'){?>selected="selected"<? } ?>>Desistência do Cliente</option>
									<option value="Endereço Não Encontrado" <? if($val['motivo_cancelamento'] == 'Endereço Não Encontrado'){?>selected="selected"<? } ?>>Endereço Não Encontrado</option>
									<option value="Área de Risco" <? if($val['motivo_cancelamento'] == 'Área de Risco'){?>selected="selected"<? } ?>>Área de Risco</option>
									<option value="Cancelado no VSALES" <? if($val['motivo_cancelamento'] == 'Cancelado no VSALES'){?>selected="selected"<? } ?>>Cancelado no VSALES
									</option>
									<option value="Número Inválido" <? if($val['motivo_cancelamento'] == 'Número Inválido'){?>selected="selected"<? } ?>>Número Inválido</option>
								</select>
								<span class="campoobrigatorio cancelamento">*</span>
							</div>	
														
							<p>
								<input type="submit" value="Salvar"  id="salvar" name="salvar"/>
							</p>
					</form>

					<div id="error-insert" title="Campos vazios!!">
						 <p>
						   Por favor preencher todos os campos obrigatórios! 
						 </p>
						<span></span>
						<span class="contentPlaceholder"></span>
					</div>				
				
				</div><!-- Fim container -->
          
			</div><!-- Fim mainContent -->
			
			<!----------------------------- Fim Conteúdo ----------------------------->
			
			
			<div class="mask"></div>
			<!----------------------------- Rodapé ----------------------------->
           
			<div class="footer">
			
			    <h3>
					Vento Consulting &copy; 2012 - Versão 2.1
                </h3>
			<!-- Fim footer -->
			
			<!----------------------------- Fim Rodapé ----------------------------->

		</div><!-- Fim header -->

	</body>

</html>