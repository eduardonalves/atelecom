<?

include "../conexao.php";


if(isset($_POST['salvar'])){


// Dados do cliente

$pessoa = $_POST['tipo'];
$nascimento = $_POST['nascimento'];
if($_POST['tipo'] == 'Pessoa FÌsica'){ $nome = $_POST['nome']; $cpf = $_POST['cpf'];} else {  $nome = $_POST['razaoSocial']; 
$cpf = $_POST['cnpj'];}

$nomeMae = $_POST['nomeMae'];

$rg = $_POST['rg'];
$org_exp = $_POST['orgExp'];
$data_exp0 = explode('/',$_POST['dataExp']);
$data_exp = $data_exp0[2].$data_exp0[1].$data_exp0[0];

$profissao = $_POST['profissao'];
$sexo = $_POST['sexo'];
$estado_civil = $_POST['estCiv'];
$email = $_POST['email'];
$telefone = $_POST['tel'];
$tipo_tel1 = $_POST['tipotel1'];
$telefone2 = $_POST['telCom'];
$tipo_tel2 = $_POST['tipotel2'];
$telefone3 = $_POST['telCel'];
$tipo_tel3 = $_POST['tipotel3'];


// EnsereÁo InstalaÁ„o

$endereco = $_POST['endereco'];
$numero = $_POST['numEnd'];
$lote = $_POST['lote'];
$quadra = $_POST['quadra'];	
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];		
$cidade = $_POST['cidade'];	
$uf = $_POST['estado'];	
$cep = $_POST['cep'];
$ponto_referencia = $_POST['pontRef'];

// Dados da Venda	

$conoperador = $conexao->query("SELECT * FROM operadores WHERE login = '".$_GET['user']."'");
$resoperador  = mysql_fetch_array($conoperador);

$operador = $resoperador['operador_id'];
$monitor = $resoperador['monitor'];
$plano = $_POST['plano'];
$pontos = $_POST['pontos'];
$pagamento = $_POST['pagamento'];
$data0 = explode('/',$_POST['dataVenda']);
$data = $data0[2].$data0[1].$data0[0];
$vencimento = $_POST['vencimento'];

$valor = str_replace(',','.',$_POST['valor']);


$banco = $_POST['banco'];
$agencia = $_POST['agencia'];
$conta_corrente = $_POST['cc'];

// Dados da InstalaÁ„o
$data_desejada0 = explode('/',$_POST['dataDesej']);
$data_desejada = $data_desejada0[2].$data_desejada0[1].$data_desejada0[0];

$tipo_instalacao = $_POST['tipoInst'];

if($tipo_instalacao == 'EXTERNA'){ $tecnico = '1';}

$pagamento_instalacao = $_POST['pagamentoinstalacao'];


$status = "NOVO";

$inserir = $conexao->query("INSERT INTO vendas_clarotv (produto,pessoa,nome,nome_mae,nascimento,cpf,rg,org_exp,data_exp,profissao,sexo,estado_civil,email,telefone,tipo_tel1,telefone2,tipo_tel2,telefone3,tipo_tel3,endereco,numero,lote,quadra,complemento,bairro,cidade,uf,cep,ponto_referencia,operador,monitor,plano,pontos,pagamento,data,data_venda,vencimento,valor,banco,agencia,conta_corrente,data_desejada,tipo_instalacao,tecnico_id,pagamento_instalacao,status) VALUES ('1','".$pessoa."','".$nome."','".$nomeMae."','".$nascimento."','".$cpf."','".$rg."','".$org_exp."','".$data_exp."','".$profissao."','".$sexo."','".$estado_civil."','".$email."','".$telefone."','".$tipo_tel1."','".$telefone2."','".$tipo_tel2."','".$telefone3."','".$tipo_tel3."','".$endereco."','".$numero."','".$lote."','".$quadra."','".$complemento."','".$bairro."','".$cidade."','".$uf."','".$cep."','".$ponto_referencia."','".$operador."','".$monitor."','".$plano."','".$pontos."','".$pagamento."','".$data."','".$data."','".$vencimento."','".$valor."','".$banco."','".$agencia."','".$conta_corrente."','".$data_desejada."','".$tipo_instalacao."','".$tecnico."','".$pagamento_instalacao."','".$status."')") or die('Ocorreu um Erro ao inserir os dados!');


//LOG

$datadehoje = date("Y-m-d H:i:s");
$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$datadehoje."','".$_GET['user']."','Inseriu um novo dado no sistema (Contrato: $contrato).')");

?>

<script type="text/javascript">

window.alert("Cadastro efetuado com sucesso!");
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

	
        
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta NAME="REVISIT-AFTER" CONTENT="1 DAYS">
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="expires" content="Mon, 01 Jan 1990 00:00:01 GMT" />
		<meta http-equiv="Content-Language" content="pt-br">
		
        <style type="text/css">
	:-moz-placeholder {color:#DDD; font-size:12px; font-style:italic;}
	::-webkit-input-placeholder {color:#DDD; font-size:12px; font-style:italic;}
</style>
		
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
	
     	
	 </head>
   
  
	<body id="body">
   
		<div class="header">
		
       
          
          
			<div id="topo">
			
				<div id="topoCont">
       
					<a href="/" id="logo"><img src="image/logo-vento-p.png"></a>
										
				</div><!-- Fim topoCont -->
				
				<!----------------------------- Fim Menu usu√°rio ----------------------------->
					
					
					
				<!----------------------------- Menu Principal ----------------------------->
			 
			 
				<center><div id="menu">
				   

				</div></center><!-- Fim menu -->
				
				
             
            </div><!-- Fim topo -->
			
			
                              
			
			<!----------------------------- Fim Menu Principal --------------------------- -->
			
			
			
			<!----------------------------- Conte˙do --------------------------- -->
          		  
			<div class="mainContent">
			
				
         
				<div class="container">
				     
					 <script type="text/javascript">

$(document).ready(function(){ 
		$('input[name="cnpj"]').hide();
		$('input[name="razaoSocial"]').hide();
		$('input[name="banco"]').hide();		
		$('input[name="agencia"]').hide();
		$('input[name="cc"]').hide();

		$('label:contains("Banco")').hide();
		$('label:contains("AgÍncia")').hide();
		$('label:contains("CC")').hide();


		
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



// SALVAR
$(function(){

$('#salvar').click(function(){

  for(i=1;i<300;i++){

      nameField ='#field'+i;
      field     ='field'+i;
      
	if ( $(nameField).length ){

     name = $(nameField).attr('name');

      label = $('label[for="'+field+'"]').text();
      ps = $('label[for="'+field+'"]').position().top;
      
        message = '<center><b style="color:#f00;">O campo '+label+' est· vazio!!</b></center>';
       
         if($(nameField).val()=='' && display(nameField)!='none'){
                 
                 
        	  $('#error-insert span').html(message);
        	  
              $('#error-insert').css('display','block');

                   alertError(ps,nameField);

                return false;
         
              } 
               
		} 
   }
   
   

	
   });
   
   
   
   
    $('select[name="pagamento"]').change(function() { 
   
      val = $(this).val();
	  
	   if(val=='D…BITO'){
		
		$('input[name="banco"]').show();
		$('input[name="agencia"]').show();
		$('input[name="cc"]').show();
		$('label:contains("Banco")').show();
		$('label:contains("AgÍncia")').show();
		$('label:contains("CC")').show();
		$('.agencia').show();
		$('.banco').show();
		$('.cc').show();
		$('.pagInst').hide();
		$('select[name="pagInst"]').hide();
		}
		
		else if (val=='BOLETO'){
		$('input[name="banco"]').hide();
		$('input[name="agencia"]').hide();
		$('input[name="cc"]').hide();
		$('label:contains("Banco")').hide();
		$('label:contains("AgÍncia")').hide();
		$('label:contains("CC")').hide();
		$('.agencia').hide();
		$('.banco').hide();
		$('.cc').hide();
		$('.pagInst').show();
		$('select[name="pagInst"]').show();
		}
	});
	
	
	
		
   $('select[name="tipo"]').change(function() { 
   
      val = $(this).val();
	  
	   if(val=='Pessoa FÌsica'){

		$('input[name="cnpj"]').hide();
		$('.razaoSocial').hide();
		$('input[name="razaoSocial"]').hide();
		$('.cnpj').hide();
		$('input[name="cnpj"]').val('');
		$('input[name="razaoSocial"]').val('');
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
		$('.sexo').show();
		}
		
		else if (val=='Pessoa JurÌdica'){
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
		 $('.sexo').hide();
		 
		 $('input[name="cpf"]').val('');
		 $('.cpf').val('');
		 $('input[name="nomeMae"]').val('');
		 $('label[for="field8"]').val('');
		 $('label[for="field7"]').val('');
		 $('#field7').val('');
		 $('label[for="field9"]').val('');
		 $('#field9').val('');
		 $('label[for="field7"]').val('');
		 $('#field7').val('');
		 $('label[for="field10"]').val('');
		 $('#field10').val('');
		 $('label[for="field11"]').val('');
		 $('#field11').val('');
		 $('label[for="field12"]').val('');
		 $('#field12').val('');
		 $('label[for="field13"]').val('');
		 $('#field13').val('');
		 $('label[for="field14"]').val('');
		 $('#field14').val('');
		 $('.nome').val('');
		 $('.nomeMae').val('');
		 $('.nascimento').val('');
		 $('.rg').val('');
		 $('.orgExp').val('');
		 $('.dataExp').val('');
		 $('.profissao').val('');
		 $('.estCiv').val('');
		}
		
	});


//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
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
                     $(this).attr('placeholder','Data n√£o √© valida!!');
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

/*Claro 3G Plano*/





function verificaplan(p){

	 
	if(p == '10GB'){$('input[name="valor"]').val('159,92');}
	else if(p == '5GB'){$('input[name="valor"]').val('95,92');}
	else if(p == '3GB'){$('input[name="valor"]').val('71,92');}
	else if(p == '2GB'){$('input[name="valor"]').val('63,92');}
	else {$('input[name="valor"]').val('');}
		
	}	

 </script>


<br> 
<h2>Nova venda</h2>
<hr id="hrTopTab"/>

<form class="dadosDaVenda" method="post" action="">

<span>
			<p class="subTab">Dados do cliente</p>
			<br><hr id="hrForm">
		</span><div class="formDados">
								     
								      <label class="tipo" for="field2">Tipo</label>
				                
								      <select  id="field2"  name="tipo">
										 
										  
			
			<option value="Pessoa FÌsica">Pessoa FÌsica</option>
			<option value="Pessoa JurÌdica">Pessoa JurÌdica</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel tipo">*</span>
								
								</div><div class="formDados">
				                
				                
				             <label class="cnpj" >CNPJ</label>
				               
							<input type="text" placeholder="ex: (99.999.999/9999-99)" id="" name="cnpj"/>
									
					   </div><div class="formDados">
				                
				                
				             <label class="razaoSocial" >Raz„o Social</label>
				               
							<input type="text" placeholder="" id="" name="razaoSocial"/>
									
					   </div><div class="formDados">
				                
				                
				             <label class="cpf" >CPF</label>
				               
							<input type="text" placeholder="ex: (999.999.999-99)" id="" name="cpf"/>
									
					   </div>
               			     			               
				               
							  <input type="hidden" name="produto" value="clarotv"/>
                
				             				
				       <div class="formDados">
									
									  <label for="field7">Nome</label>
				               
									        <input type="text" placeholder="" value="<? if($_GET['first_name'] != ''){ echo $_GET['first_name'].' '.$_GET['middle_initial'].' '.$_GET['last_name'];} ?>" id="field7" name="nome"/>
										
										<span class="campoobrigatorio nome">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field8">Nome da M„e</label>
				               
									        <input type="text" id="field8" name="nomeMae"/>
										
										<span class="campoobrigatorio nomeMae">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field9">Nascimento</label>
				               
									        <input type="text" placeholder="ex: (dd/mm/aaaa)" id="field9" name="nascimento"/>
										
										<span class="campoobrigatorio nascimento">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field10">RG</label>
				               
									        <input type="text" placeholder="" id="field10" name="rg"/>
										
										<span class="campoobrigatorio rg">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field11">Org„o Expeditor</label>
				               
									        <input type="text" placeholder="" id="field11" name="orgExp"/>
										
										<span class="campoobrigatorio orgExp">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field12">Data da ExpediÁ„o</label>
				               
									        <input type="text" placeholder="ex: (dd/mm/aaaa)" id="field12" name="dataExp"/>
										
										<span class="campoobrigatorio dataExp">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field13">Profiss„o</label>
				               
									        <input type="text" placeholder="" id="field13" name="profissao"/>
										
										<span class="campoobrigatorio profissao">*</span>
									
									
									
									</div>
                                    
                                  <div class="formDados">
								     
								      <label class="sexo" for="field48">Sexo</label>
				                
								      <select class="sexo"  id="field48"  name="sexo">
			                            <option></option>
			                            <option>Masculino</option>
			                            <option>Feminino</option>
								       </select>
								  
								  <span class="campoobrigatorioSel sexo">*</span>
								
								  </div>
                                    
                                    
                                    <div class="formDados">
								     
								      <label class="estCiv" for="field14">Estado civil</label>
				                
								      <select  id="field14"  name="estCiv">
										 
										  
			
			<option></option>
			<option>Solteiro</option>
			<option>Casado</option>
			<option>Desquitado</option>
			<option>Separado</option>
			<option>Divorciado</option>
			<option>Vi˙vo</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel estCiv">*</span>
								
								</div><div class="formDados">
									
									  <label for="field15">E-mail</label>
				               
									        <input type="text" placeholder="" id="field15" name="email"/>
										
										<span class="campoobrigatorio email">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field16">Telefone</label>
				               
									        <input type="text" placeholder="ex: ((99) 9999-9999)" value="<?= $_GET['phone_code'].$_GET['phone_number'];?>" id="field16" name="tel"/>
										
										<span class="campoobrigatorio tel">*</span>
									
									
									
									</div><div class="formDados">
				                
				                
				             <label class="telCom" >Telefone Comercial</label>
				               
							<input type="text" placeholder="ex: ((99) 9999-9999)" id="" name="telCom"/>
									
					   </div><div class="formDados">
				                
				                
				             <label class="telCel" >Telefone Celular</label>
				               
							<input type="text" placeholder="ex: ((99) 9999-9999)" id="" name="telCel"/>
									
					   </div><div class="formDados">
				                
				                
				             <label class="telAdic" >Telefone Adicional</label>
				               
							<input type="text" placeholder="ex: ((99) 9999-9999)" id="" name="telAdic"/>
									
					   </div><span>
			<p class="subTab1">EndereÁo de instalaÁ„o</p>
			<br><hr id="hrForm">
		</span><div class="formDados">
									
									  <label for="field21">CEP</label>
				               
									        <input type="text" placeholder="ex: (99999-999)" id="field21" name="cep"/>
										
										<span class="campoobrigatorio cep">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field22">EndereÁo</label>
				               
									        <input type="text" placeholder="" id="field22" name="endereco"/>
										
										<span class="campoobrigatorio endereco">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field23">N˙mero</label>
				               
									        <input type="text" placeholder="" id="field23" name="numEnd"/>
										
										<span class="campoobrigatorio numEnd">*</span>
									
									
									
									</div><div class="formDados">
				                
				                
				             <label class="lote" >Lote</label>
				               
							<input type="text" placeholder="" id="" name="lote"/>
									
					   </div><div class="formDados">
				                
				                
				             <label class="quadra" >Quadra</label>
				               
							<input type="text" placeholder="" id="" name="quadra"/>
									
					   </div><div class="formDados">
				                
				                
				             <label class="complemento" >Complemento</label>
				               
							<input type="text" placeholder="" id="" name="complemento"/>
									
					   </div><div class="formDados">
									
									  <label for="field27">Bairro</label>
				               
									        <input type="text" placeholder="" id="field27" name="bairro"/>
										
										<span class="campoobrigatorio bairro">*</span>
									
									
									
									</div><div class="formDados">
								     
								      <label class="estado" for="field28">Estado</label>
				                
								      <select  id="field28"  name="estado">
										 
										   
		
		
		<option value = "">Selecione seu Estado</option>
		 <option value="AC">Acre</option>
         <option value="AL">Alagoas</option>
         <option value="AM">Amazonas</option>
         <option value="AP">Amap·</option>
         <option value="BA">Bahia</option>
         <option value="CE">Cear·</option>
         <option value="DF">Distrito Federal</option>
         <option value="ES">EspÌrito Santo</option>
         <option value="GO">Goi·s</option>
         <option value="MA">Maranh„o</option>
         <option value="MG">Minas Gerais</option>
         <option value="MS">Mato Grosso do Sul</option>
         <option value="MT">Mato Grosso</option>
         <option value="PA">Par·</option>
         <option value="PB">ParaÌba</option>
         <option value="PE">Pernambuco</option>
         <option value="PI">PiauÌ≠</option>
         <option value="PR">Paran·</option>
         <option value="RJ">Rio de Janeiro</option>
         <option value="RN">Rio Grande do Norte</option>
         <option value="RO">RondÙnia</option>
         <option value="RR">Roraima</option>
         <option value="RS">Rio Grande do Sul</option>
         <option value="SC">Santa Catarina</option>
         <option value="SE">Sergipe</option>
         <option value="SP">S„o Paulo</option>
         <option value="TO">Tocantins</option>

		
		
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel estado">*</span>
								
								</div><div class="formDados">
									
									  <label for="field29">Cidade</label>
				               
									        <input type="text" placeholder="" id="field29" name="cidade"/>
										
										<span class="campoobrigatorio cidade">*</span>
									
									
									
									</div>
				   
				             <label  id="labelpontRef">Ponto de referÍncia</label> 
				              
							   <textarea  class="textpontRef" id="field30" name="pontRef"></textarea>
				   <span>
			<p class="subTab">Dados da venda</p>
			<br><hr id="hrForm">
		</span><div class="formDados">
		<?
		
		$conOPERADOR = $conexao->query("SELECT * FROM operadores WHERE login = '".$_GET['user']."'");
		$OPERADOR = mysql_fetch_array($conOPERADOR);
		
		$conMONITOR = $conexao->query("SELECT * FROM usuarios WHERE id = '".$OPERADOR['monitor']."'");
		$MONITOR = mysql_fetch_array($conMONITOR);
		?>
								     
								      <label class="monitor2" for="field32">Monitor</label>
				                
								      <input type="text"  id="field32" value="<?= $MONITOR['nome'];?>" disabled="disabled"  name="monitor">
										
								  
								  <span class="campoobrigatorioSel monitor2">*</span>
								
								</div><div class="formDados">
								     
								      <label class="operador2" for="field33">Operador</label>
				                
								      <input type="text"  id="field33" value="<?= $OPERADOR['nome'];?>" disabled="disabled"  name="operador">

								  
								  <span class="campoobrigatorioSel operador2">*</span>
								
								</div><div class="formDados">
								     
								      <label class="plano" for="field34">Plano</label>
				                
								      <select  id="field34"  name="plano">
										 
										  
			<option></option>
			<option>F¡CIL</option>
			<option>F¡ÅCIL HBO BRASIL</option>
			<option>F¡CIL TELECINE LIGHT</option>
			<option></option>
			<option>ESSENCIAL</option>
			<option>ESSENCIAL TELECINE LIGHT</option>
			<option>ESSENCIAL TELECINE</option>
			<option>ESSENCIAL HBO BRASIL</option>
			<option>ESSENCIAL HBO MAX</option>
			<option>ESSENCIAL HBO</option>
			<option>ESSENCIAL HBO MAX DIGITAL</option>
			<option>ESSENCIAL CINEMA TOTAL</option>
			<option></option>
			<option>FAMÕçLIA</option>
			<option>FAMÕLIA TELECINE</option>
			<option>FAMÕçLIA HBO MAX</option>
			<option>FAMÕLIA HBO</option>
			<option>FAMÕçLIA HBO MAX DIGITAL</option>
			<option>FAMÕLIA CINEMA TOTAL</option>
			<option></option>
			<option>FAMÕçLIA HD</option>
			<option>FAMÕLIA TELECINE HD</option>
			<option>FAMÕLIA HBO HD</option>
			<option>FAMÕLIA CINEMA HD</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel plano">*</span>
								
								</div><div class="formDados">
								     
								      <label class="pontAdic" for="field35">Pontos Adicionais</label>
				                
								      <select  id="field35"  name="pontAdic">
										 
										  
			
			<option>0</option>
			<option>1</option>
			<option>2</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel pontAdic">*</span>
								
								</div><div class="formDados">
								     
								      <label class="pagamento" for="field36">Pagamento</label>
				                
								      <select  id="field36"  name="pagamento">
										 
										  
			
			<option>BOLETO</option>
			<option>D…BITO</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel pagamento">*</span>
								
								</div><div class="formDados">
									
									  <label for="field37">Banco</label>
				               
									        <input type="text" placeholder="" id="field37" name="banco"/>
										
										<span class="campoobrigatorio banco">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field38">AgÍncia</label>
				               
									        <input type="text" placeholder="" id="field38" name="agencia"/>
										
										<span class="campoobrigatorio agencia">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field39">CC</label>
				               
									        <input type="text" placeholder="" id="field39" name="cc"/>
										
										<span class="campoobrigatorio cc">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field40">Data venda</label>
				               
									        <input type="text" placeholder="ex: (dd/mm/aaaa)" value="<?= date('dmY')?>" id="field40" name="dataVenda"/>
										
										<span class="campoobrigatorio dataVenda">*</span>
									
									
									
									</div><div class="formDados">
								     
								      <label class="vencimento" for="field41">Vencimento</label>
				                
								      <select  id="field41"  name="vencimento">
										 
										  
			
			<option>1</option>
			<option>4</option>
			<option>8</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel vencimento">*</span>
								
								</div><div class="formDados">
									
									  <label for="field42">Valor</label>
				               
									        <input type="text" placeholder="" id="field42" value="49,90" name="valor"/>
										
										<span class="campoobrigatorio valor">*</span>
									
									
									
									</div><div class="formDados">
									
									  <label for="field43">Data desejada</label>
				               
									        <input type="text" placeholder="ex: (dd/mm/aaaa)" id="field43" name="dataDesej"/>
										
										<span class="campoobrigatorio dataDesej">*</span>
									
									
									
									</div><div class="formDados">
								     
								      <label class="tipoInst" for="field44">Tipo de instalaÁ„o</label>
				                
								      <select  id="field44"  name="tipoInst">
										 
										  
			
			<option>Interna</option>
			<option>Externa</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel tipoInst">*</span>
								
								</div><div class="formDados">
								     
								      <label class="pagInst" for="field45">Pagamento instalaÁ„o</label>
				                
								      <select  id="field45"  name="pagInst">
										 
										  
			
			<option>Dinheiro</option>
			<option>Cart„o de crÈdito</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel pagInst">*</span>
								
								</div><p>
				
				                <input type="submit" value="Salvar"  id="salvar" name="salvar"/>
                
				            </p>


</form>

<div id="error-insert" title="Campos vazios!!">
     <p>
       Por favor preencher todos os campos obrigatÛrios! 
     </p>
    <span></span>
	<span class="contentPlaceholder"></span>
</div>				
				</div><!-- Fim container -->
          
			</div><!-- Fim mainContent -->
			
			<!----------------------------- Fim Conte√∫do --------------------------- -->
			
			
			<div class="mask"></div>
			<!----------------------------- Rodap√© --------------------------- -->
           
			<div class="footer">
			
			    <h3>
					Vento Consulting &copy; 2012 - Vers„o 2.1
                </h3>
			<!-- Fim footer -->
			
			<!----------------------------- Fim RodapÈ --------------------------- -->

		</div><!-- Fim header -->

	</body>

</html>