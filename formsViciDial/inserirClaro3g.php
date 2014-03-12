<?



include "../conexao.php";





if(isset($_POST['salvar'])){





// Dados do cliente



$pessoa = $_POST['tipo'];

$nascimento = $_POST['nascimento'];

if($_POST['tipo'] == 'Pessoa Física'){ $nome = $_POST['nome']; $cpf = $_POST['cpf'];} else {  $nome = $_POST['razaoSocial']; 

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





// Endereço Instalação



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



$conAUDITOR = $conexao->query("SELECT * FROM usuarios WHERE id='".$val['auditor']."'");

$AUDITOR = mysql_fetch_array($conAUDITOR);



//$data = $data0[2].$data0[1].$data0[0];

$operador = $resoperador['operador_id'];

$monitor = $resoperador['monitor'];

$data_venda = $_POST['data_venda'];

$tipoVenda = $_POST['tipoVenda'];

$vencimento = $_POST['vencimento'];

$auditor = $conAUDITOR ['auditor'];

$obs_gravacao = $_POST['obs_gravacao'];

$pagamento = $_POST['pagamento'];



$valor = str_replace(',','.',$_POST['valor']);



$banco = $_POST['banco'];

$agencia = $_POST['agencia'];

$conta_corrente = $_POST['cc'];







$status = "NOVO";



$inserir = $conexao->query("INSERT INTO vendas_clarotv (produto,pessoa,nome,nome_mae,nascimento,cpf,rg,org_exp,data_exp,profissao,sexo,estado_civil,email,telefone,tipo_tel1,telefone2,tipo_tel2,telefone3,tipo_tel3,endereco,numero,lote,quadra,complemento,bairro,cidade,uf,cep,ponto_referencia,operador,monitor,data_venda,tipoVenda,vencimento,auditor,obs_gravacao,pagamento,valor,banco,agencia,conta_corrente) VALUES ('2','".$pessoa."','".$nome."','".$nomeMae."','".$nascimento."','".$cpf."','".$rg."','".$org_exp."','".$data_exp."','".$profissao."','".$sexo."','".$estado_civil."','".$email."','".$telefone."','".$tipo_tel1."','".$telefone2."','".$tipo_tel2."','".$telefone3."','".$tipo_tel3."','".$endereco."','".$numero."','".$lote."','".$quadra."','".$complemento."','".$bairro."','".$cidade."','".$uf."','".$cep."','".$ponto_referencia."','".$operador."','".$monitor."','".$data_venda."','".$tipoVenda."','".$vencimento."','".$auditor."','".$obs_gravacao."','".$pagamento."','".$valor."')") or die('Ocorreu um Erro ao inserir os dados!');





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

  

	<body>

   

		<div class="header">



			<div id="topo">

			

				<div id="topoCont">

       

					<a href="/" id="logo"><img src="image/logo-vento-p.png"></a>

										

				</div><!-- Fim topoCont -->

				

				

					

					

				<!----------------------------- Menu Principal --------------------------- -->

			  

				

				<div id="menu"></div>



            </div><!-- Fim topo -->



			<!----------------------------- Fim Menu Principal --------------------------- -->

			

			

			

			<!----------------------------- Conteúdo --------------------------- -->

          		  

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

		$('label:contains("Agência")').hide();

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

   

   

   

   

    $('select[name="pagamento"]').change(function() { 

   

      val = $(this).val();

	  

	   if(val=='DÉ‰BITO'){

		

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

		$('.pagInst').show();

		$('select[name="pagInst"]').show();

		}

	});

	

	

	

		

   $('select[name="tipo"]').change(function() { 

   

      val = $(this).val();

	  

	   if(val=='Pessoa Física'){



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

		}

		

		else if (val=='Pessoa Jurídica'){

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

/*Claro 3g select de plano*/

   $('select[name="plano"]').change(function(){ 



   	  valor = $('select[name="plano"]').val(); 

   	  verificaplan(valor);

   	});

   	

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

                     $(this).attr('placeholder','Data não é valida!!');

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

										 

										  

			

			<option> Pessoa Física </option>

			<option> Pessoa Jurídica </option>

			

		

										  

										

								          </select>

								  

								  <span class="campoobrigatorioSel tipo">*</span>

								

								</div><div class="formDados">

				                

				                

				             <label class="cnpj" >CNPJ</label>

				               

							<input type="text" placeholder="Exemplo(99.999.999/9999-99)" id="" name="cnpj"/>

									

					   </div><div class="formDados">

				                

				                

				             <label class="razaoSocial" >Razão Social</label>

				               

							<input type="text" placeholder=" " id="" name="razaoSocial"/>

									

					   </div><div class="formDados">

				                

				                

				             <label class="cpf" >CPF</label>

				               

							<input type="text" placeholder="Exemplo(999.999.999-99)" id="" name="cpf"/>

									

					   </div>

               			     			               

				               

							  <input type="hidden" name="produto" value="claro3g"/>

                

				             				

				       <div class="formDados">

									

									  <label for="field7">Nome</label>

				               

									        <input type="text" placeholder="" id="field7" name="nome"/>

										

										<span class="campoobrigatorio nome">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field8">Nome da Mãe</label>

				               

									        <input type="text" id="field8" name="nomeMae"/>

										

										<span class="campoobrigatorio nomeMae">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field9">Nascimento</label>

				               

									        <input type="text" placeholder="Exemplo(dd/mm/aaaa)" id="field9" name="nascimento"/>

										

										<span class="campoobrigatorio nascimento">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field10">RG</label>

				               

									        <input type="text" placeholder="" id="field10" name="rg"/>

										

										<span class="campoobrigatorio rg">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field11">Orgão Expeditor</label>

				               

									        <input type="text" placeholder="" id="field11" name="orgExp"/>

										

										<span class="campoobrigatorio orgExp">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field12">Data da Expedição</label>

				               

									        <input type="text" placeholder="Exemplo(dd/mm/aaaa)" id="field12" name="dataExp"/>

										

										<span class="campoobrigatorio dataExp">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field13">Profissão</label>

				               

									        <input type="text" placeholder="" id="field13" name="profissao"/>

										

										<span class="campoobrigatorio profissao">*</span>

									

									

									

									</div><div class="formDados">

								     

								      <label class="estCiv" for="field14">Estado civil</label>

				                

								      <select  id="field14"  name="estCiv">

										 

										  

			

			<option>Solteiro</option>

			<option>Casado</option>

			<option>Desquitado</option>

			<option>Separado</option>

			<option>Divorciado</option>

			<option>Viúvo</option>

			

		

										  

										

								          </select>

								  

								  <span class="campoobrigatorioSel estCiv">*</span>

								

								</div><div class="formDados">

									

									  <label for="field15">E-mail</label>

				               

									        <input type="text" placeholder="" id="field15" name="email"/>

										

										<span class="campoobrigatorio email">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field16">Telefone</label>

				               

									        <input type="text" placeholder="Exemplo((99) 9999-9999)" id="field16" name="tel"/>

										

										<span class="campoobrigatorio tel">*</span>

									

									

									

									</div><div class="formDados">

				                

				                

				             <label class="telCom" >Telefone Comercial</label>

				               

							<input type="text" placeholder="Exemplo((99) 9999-9999)" id="" name="telCom"/>

									

					   </div><div class="formDados">

				                

				                

				             <label class="telCel" >Telefone Celular</label>

				               

							<input type="text" placeholder="Exemplo((99) 9999-9999)" id="" name="telCel"/>

									

					   </div><div class="formDados">

				                

				                

				             <label class="telAdic" >Telefone Adicional</label>

				               

							<input type="text" placeholder="Exemplo((99) 9999-9999)" id="" name="telAdic"/>

									

					   </div><span>

			<p class="subTab1">Endereço de instalação</p>

			<br><hr id="hrForm">

		</span><div class="formDados">

									

									  <label for="field21">CEP</label>

				               

									        <input type="text" placeholder="Exemplo(99999-999)" id="field21" name="cep"/>

										

										<span class="campoobrigatorio cep">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field22">Endereço</label>

				               

									        <input type="text" placeholder="" id="field22" name="endereco"/>

										

										<span class="campoobrigatorio endereco">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field23">Número</label>

				               

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

         <option value="AP">Amapá</option>

         <option value="BA">Bahia</option>

         <option value="CE">Ceará</option>

         <option value="DF">Distrito Federal</option>

         <option value="ES">Espírito Santo</option>

         <option value="GO">Goiás</option>

         <option value="MA">Maranhão</option>

         <option value="MG">Minas Gerais</option>

         <option value="MS">Mato Grosso do Sul</option>

         <option value="MT">Mato Grosso</option>

         <option value="PA">Pará</option>

         <option value="PB">Paraíba</option>

         <option value="PE">Pernambuco</option>

         <option value="PI">Piauí</option>

         <option value="PR">Paraná</option>

         <option value="RJ">Rio de Janeiro</option>

         <option value="RN">Rio Grande do Norte</option>

         <option value="RO">Rondônia</option>

         <option value="RR">Roraima</option>

         <option value="RS">Rio Grande do Sul</option>

         <option value="SC">Santa Catarina</option>

         <option value="SE">Sergipe</option>

         <option value="SP">São Paulo</option>

         <option value="TO">Tocantins</option>

		</select>

								  

								  <span class="campoobrigatorioSel estado">*</span>

								

								</div><div class="formDados">

									

									  <label for="field29">Cidade</label>

				               

									        <input type="text" placeholder="" id="field29" name="cidade"/>

										

										<span class="campoobrigatorio cidade">*</span>

									

									

									

									</div>

				   

				             <label  id="labelpontRefe">Ponto de referência</label> 

				              

							   <textarea  class="textpontRefe" id="field30" name="pontRef"></textarea>

				   <span>

			<p class="subTab">Dados da venda</p>

			<br><hr id="hrForm">

		</span><div class="formDados">

								     

								      <label class="monitor2" for="field32">Monitor</label>

				                

								      <select  id="field32"  name="monitor2">

										 

										   

			

			<option value="1">thiago santos</option>

			<option value="5">carlos nascimento</option>

				

		

										  

										

								          </select>

								  

								  <span class="campoobrigatorioSel monitor2">*</span>

								

								</div><div class="formDados">

								     

								      <label class="operador2" for="field33">Operador</label>

				                

								      <select  id="field33"  name="operador2">

										 

										  

		

			<option value="8">carla almeida</option>

			<option value="25">alberto vieira</option>

				

		 

										  

										

								          </select>

								  

								  <span class="campoobrigatorioSel operador2">*</span>

								

								</div><div class="formDados">

								     

								      <label class="plano" for="field34">Plano</label>

				                

								      <select  id="field34"  name="plano">

										 

										  

			

			<option> </option>

			<option>10GB</option>

			<option>5GB</option>

			<option>3GB</option>

			<option>2GB</option>

			

		

										  

										

								          </select>

								  

								  <span class="campoobrigatorioSel plano">*</span>

								

								</div><div class="formDados">

									

									  <label for="field35">Valor</label>

				               

									        <input type="text" placeholder="" id="field35" name="valor"/>

										

										<span class="campoobrigatorio valor">*</span>

									

									

									

									</div><div class="formDados">

								     

								      <label class="pagamento" for="field36">Pagamento</label>

				                

								      <select  id="field36"  name="pagamento">

										 

										  

			

			<option>BOLETO</option>

			<option>DÉBITO</option>

			

		

										  

										

								          </select>

								  

								  <span class="campoobrigatorioSel pagamento">*</span>

								

								</div><div class="formDados">

									

									  <label for="field37">Banco</label>

				               

									        <input type="text" placeholder="" id="field37" name="banco"/>

										

										<span class="campoobrigatorio banco">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field38">Agência</label>

				               

									        <input type="text" placeholder="" id="field38" name="agencia"/>

										

										<span class="campoobrigatorio agencia">*</span>

									

									

									

									</div><div class="formDados">

									

									  <label for="field39">CC</label>

				               

									        <input type="text" placeholder="" id="field39" name="cc"/>

										

										<span class="campoobrigatorio cc">*</span>

									

									

									

									</div><div class="formDados">

								     

								      <label class="vencimento" for="field40">Vencimento</label>

				                

								      <select  id="field40"  name="vencimento">

										 

										  

			

			<option>2</option>

			<option>5</option>

			<option>10</option>

			<option>12</option>

			<option>20</option>

			<option>24</option>

			

		

										  

										

								          </select>

								  

								  <span class="campoobrigatorioSel vencimento">*</span>

								

								</div><p>

				

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

			<!----------------------------- RodapÃ© ----------------------------->

           

			<div class="footer">

			

			    <h3>

					Vento Consulting &copy; 2012 - VersÃ£o 2.1

                </h3>

			<!-- Fim footer -->

			

			<!----------------------------- Fim RodapÃ© ----------------------------->



		</div><!-- Fim header -->



	</body>



</html>