<?



include "../conexao.php";



$convar = $conexao->query("SELECT * FROM vendas_clarotv WHERE id = '".$_GET['owner']."'");

$val = mysql_fetch_array($convar);



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



<script type="text/javascript">



		$(document).ready(function(){ 

		

		<? if($val['pessoa'] == 'Pessoa Física'){ ?>

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

		

		/////////////////

		

		<? if($val['status'] == 'CANCELADO'){ ?>

		$('.cancelamento').show();

		$('.restricao').hide();

		<? } ?>

		

		<? if($val['status'] == 'RESTRIÇÃO'){ ?>

		$('.cancelamento').hide();

		$('.restricao').hide();

		<? } ?>

		

		<? if($val['status'] == ' '){ ?>

		$('.cancelamento').hide();

		$('.restricao').hide();

		<? } ?>

				

		////////////////

		

		 <? if($val['pagamento'] == 'DÉBITO'){ ?>

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

		$('.pagInst').hide();

		<? } ?>

		

		<? if($val['pagamento'] == 'BOLETO'){ ?>

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

		$('.pagInst').show();

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

		$('.restricao').hide();

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

					<h2>Nova venda</h2>

					<hr id="hrTopTab"/>



					<form class="dadosDaVenda" method="post" action="/admin/dadosdavenda/inserir">



						<span>

						<p class="subTab">Dados do cliente</p>

						<br><hr id="hrForm">

						</span>

						

						<div class="formDados">

								<label class="cnpj">CNPJ</label>

								<input type="text" placeholder="Exemplo(99.999.999/9999-99)" value="<?=$val['cpf']?>" name="cnpj"/>	

							</div>

							

							

							<div class="formDados"> 

								<label class="razaoSocial" >Razão Social</label> 

								<input type="text" placeholder=" " id="" name="razaoSocial" value="<?=$val['razaoSocial']?>"/>

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

								<label class="estCiv" for="field14">Estado civil</label>

				                <select  id="field14"  name="estCiv">

									<option value="Solteiro"  <? if($val['estado_civil'] == 'Solteiro'){ ?>selected="selected" <? }?>>Solteiro</option>

									<option  value="Casado" <? if($val['estado_civil'] == 'Casado'){ ?>selected="selected" <? }?>>Casado</option>

									<option  value="Desquitado" <? if($val['estado_civil'] == 'Desquitado'){ ?>selected="selected" <? }?>>Desquitado</option>

									<option  value="Separado" <? if($val['estado_civil'] == 'Separado'){ ?>selected="selected" <? }?>>Separado</option>

									<option  value="Divorciado" <? if($val['estado_civil'] == 'Divorciado'){ ?>selected="selected" <? }?>>Divorciado</option>

									<option  value="Viúvo" <? if($val['estado_civil'] == 'Viúvo'){ ?>selected="selected" <? }?>>Viúvo</option>

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

								<input type="text" placeholder="" id="field23" name="numEnd" value="<?=$val['cep']?>"/>

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



									$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE grupo LIKE '%0001%' && tipo_usuario = 'MONITOR' ORDER BY nome ASC"); 

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



									$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE grupo LIKE '%0001%' && status != 'DESLIGADO' ORDER BY nome ASC");

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

								<label for="field43">Data Venda</label>

								<input type="text" placeholder="Exemplo(dd/mm/aaaa)" id="field43" name="dataVenda" value="<?=$val['data_venda']?>"/>

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

								<label class="plano" for="field34">Plano</label>

								

										

				                <select name="plano" id="plano">

									<option></option>

									<option value="FÁCIL" <? if($val['plano'] == 'FÁCIL'){ ?> selected="selected" <? }?>>FÁCIL</option>

									<option value="FÁCIL HBO BRASIL" <? if($val['plano'] == 'FÁCIL HBO BRASIL'){ ?> selected="selected" <? }?>>FÁCIL HBO BRASIL</option>

									<option value="FÁCIL TELECINE LIGHT" <? if($val['plano'] == 'FÁCIL TELECINE LIGHT'){ ?> selected="selected" <? }?>>FÁCIL TELECINE LIGHT</option>

									<option value=""></option>

									<option value="ESSENCIAL" <? if($val['plano'] == 'ESSENCIAL'){ ?> selected="selected" <? }?>>ESSENCIAL</option>

									<option value="ESSENCIAL TELECINE LIGHT" <? if($val['plano'] == 'ESSENCIAL TELECINE LIGHT'){ ?> selected="selected" <? }?>>ESSENCIAL TELECINE LIGHT</option>

									<option value="ESSENCIAL TELECINE" <? if($val['plano'] == 'ESSENCIAL TELECINE'){ ?> selected="selected" <? }?>>ESSENCIAL TELECINE</option>

									<option value="ESSENCIAL HBO BRASIL" <? if($val['plano'] == 'ESSENCIAL HBO BRASIL'){ ?> selected="selected" <? }?>>ESSENCIAL HBO BRASIL</option>

									<option value="ESSENCIAL HBO MAX" <? if($val['plano'] == 'ESSENCIAL HBO MAX'){ ?> selected="selected" <? }?>>ESSENCIAL HBO MAX</option>

									<option value="ESSENCIAL HBO" <? if($val['plano'] == 'ESSENCIAL HBO'){ ?> selected="selected" <? }?>>ESSENCIAL HBO</option>

									<option value="ESSENCIAL HBO MAX DIGITAL" <? if($val['plano'] == 'ESSENCIAL HBO MAX DIGITAL'){ ?> selected="selected" <? }?>>ESSENCIAL HBO MAX DIGITAL</option>

									<option value="ESSENCIAL CINEMA TOTAL" <? if($val['plano'] == 'ESSENCIAL CINEMA TOTAL'){ ?> selected="selected" <? }?>>ESSENCIAL CINEMA TOTAL</option>

									<option value=""></option>

									<option value="FAMÍLIA" <? if($val['plano'] == 'FAMÍLIA'){ ?> selected="selected" <? }?>>FAMÍLIA</option>

									<option value="FAMÍLIA TELECINE" <? if($val['plano'] == 'FAMÍLIA TELECINE'){ ?> selected="selected" <? }?>>FAMÍLIA TELECINE</option>

									<option value="FAMÍLIA HBO MAX" <? if($val['plano'] == 'FAMÍLIA HBO MAX'){ ?> selected="selected" <? }?>>FAMÍLIA HBO MAX</option>

									<option value="FAMÍLIA HBO" <? if($val['plano'] == 'FAMÍLIA HBO'){ ?> selected="selected" <? }?>>FAMÍLIA HBO</option>

									<option value="FAMÍLIA HBO MAX DIGITAL" <? if($val['plano'] == 'FAMÍLIA HBO MAX DIGITAL'){ ?> selected="selected" <? }?>>FAMÍLIA HBO MAX DIGITAL</option>

									<option value="FAMÍLIA CINEMA TOTAL" <? if($val['plano'] == 'FAMÍLIA CINEMA TOTAL'){ ?> selected="selected" <? }?>>FAMÍLIA CINEMA TOTAL</option>

									<option value=""></option>

									<option value="FAMÍLIA HD" <? if($val['plano'] == 'FAMÍLIA HD'){ ?> selected="selected" <? }?>>FAMÍLIA HD</option>

									<option value="FAMÍLIA TELECINE HD" <? if($val['plano'] == 'FAMÍLIA TELECINE HD'){ ?> selected="selected" <? }?>>FAMÍLIA TELECINE HD</option>

									<option value="FAMÍLIA HBO HD" <? if($val['plano'] == 'FAMÍLIA HBO HD'){ ?> selected="selected" <? }?>>FAMÍLIA HBO HD</option>

									<option value="FAMÍLIA CINEMA HD" <? if($val['plano'] == 'FAMÍLIA CINEMA HD'){ ?> selected="selected" <? }?>>FAMÍLIA CINEMA HD</option>

								</select>			

								



															

								<span class="campoobrigatorioSel plano">*</span>

								

							</div>

								

								

								<div class="formDados">

								    <label class="pontAdic" for="field35">Pontos Adicionais</label>

									<select  id="field35"  name="pontAdic">

										<option value="0" <? if($val['pontos'] == '0'){ ?> selected="selected" <? }?>>0</option>

										<option value="1" <? if($val['pontos'] == '1'){ ?> selected="selected" <? }?>>1</option>

										<option value="2" <? if($val['pontos'] == '2'){ ?> selected="selected" <? }?>>2</option>

									</select>

									<span class="campoobrigatorioSel pontAdic">*</span>

								</div>

								

								<div class="formDados">

									<label class="vencimento" for="field44">Vencimento</label>

									<select  id="field44"  name="vencimento">

										<option> </option>

										<option value="8"<? if($val['vencimento'] == '8'){ ?>selected="selected" <? }?>>8</option>

										<option value="11"<? if($val['vencimento'] == '11'){ ?>selected="selected" <? }?>>11</option>

										<option value="20"<? if($val['vencimento'] == '20'){ ?>selected="selected" <? }?>>20</option>

										<option value="25"<? if($val['vencimento'] == '25'){ ?>selected="selected" <? }?>>25</option>

									</select>

									<span class="campoobrigatorioSel vencimento">*</span>

								</div>

								

								<div class="formDados">

									<label for="">Agendamento</label>

									<input type="text" placeholder="Exemplo(dd/mm/aaaa)" id="" name="agendamento" value="<?=$val['data_marcada']?>"/>

									<span class="campoobrigatorio dataVenda">*</span>

								</div>

								

								<div class="formDados">

									<label for="">Gravação</label>

									<input type="text" disabled="disabled" id="" name="gravacao" value="<?=$_GET['recording_filename'];?>"/>

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

									<option value="<?= $AUDITOR['id'];?>" <? if($val['auditor'] == $AUDITOR['id']){?> selected="selected" <? } ?>>

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

								

								<span>

								<br><br>

								<p class="subTab">Dados da Instalação</p>

								<br><hr id="hrForm">

								</span>

									

									

								<div class="formDados">

									<label for="">Tipo de instalação</label>

									<select  id="field42"  name="tipoInst"  value="<?=$val['tipo_instalacao']?>">

										<option> </option>

										<option value="Interna" <? if($val['tipo_instalacao'] == 'INTERNA'){ ?>selected="selected" <? }?>>Interna</option>  

										<option value="Externa" <? if($val['tipo_instalacao'] == 'EXTERNA'){ ?>selected="selected" <? }?>>Externa</option>  

									</select>

									<span class="campoobrigatorio tipoVenda">*</span>

								</div>

								

																			

								<div class="formDados">

									<label for="field42">Valor</label>

									<input type="text" placeholder="" id="field42" name="valor" value="<?=$val['valor']?>"/>

									<span class="campoobrigatorio valor">*</span>

								</div>

								

								<div class="formDados">

									<label class="pagamento" for="field42">Pagamento</label>

									<select  id="field42"  name="pagamento">

										<option> </option>

										<option value="BOLETO" <? if($val['pagamento'] == 'BOLETO'){ ?>selected="selected" <? }?>>BOLETO</option>  

										<option value="DÉBITO" <? if($val['pagamento'] == 'DÉBITO'){ ?>selected="selected" <? }?>>DÉBITO</option>  

									</select>

									<span class="campoobrigatorioSel pagamento">*</span>

								</div>

								

								<div class="formDados">

								    <label class="pagInst" for="">Pagamento instalação</label>

									<select  id=""  name="pagInst" class="pagInst">

										<option></option>

										<option <? if($val['pagamento_instalacao'] == 'DINHEIRO'){ ?>selected="selected" <? }?>>Dinheiro</option>

										<option <? if($val['pagamento_instalacao'] == 'CARTÃO DE CRÉDITO'){ ?>selected="selected" <? }?>>Cartão de crédito</option>

									</select>

									

								</div>

							

								<div class="formDados">

									<label for="field37">Banco</label>

									<input type="text" placeholder="" id="field37" name="banco" value="<?=$val['banco']?>"/>

									<span class="campoobrigatorio banco">*</span>

								</div>

								

								<div class="formDados">

									<label for="field38">Agência</label>

									<input type="text" placeholder="" id="field38" name="agencia" value="<?=$val['agencia']?>"/>

									<span class="campoobrigatorio agencia">*</span>

								</div>

								

								<div class="formDados">

									<label for="field39">CC</label>

									<input type="text" placeholder="" id="field39" name="cc" value="<?=$val['conta_corrente']?>"/>

									<span class="campoobrigatorio cc">*</span>

								</div>

																

								<div class="formDados">

									<label for="">Status</label>

									<select  id=""  class="" name="status">

										<option></option>

										<option value="GRAVAR" <? if($val['status'] == 'GRAVAR'){?> selected="selected" <? } ?>>Gravar</option>

										<option value="CANCELADO" <? if($val['status'] == 'CANCELADO'){?> selected="selected" <? } ?>>Cancelado</option>

										<option value="RESTRIÇÃO" <? if($val['status'] == 'RESTRIÇÃO'){?> selected="selected" <? } ?>>Restrição</option>

									</select>

									<span class="campoobrigatorio dataVenda">*</span>

								</div>		

															

								<div class="formDados">

									<label class="cancelamento" for="">Motivos de cancelamento</label>

									<select name="motivocancelamento" class="cancelamento">

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

						   Por favor preencher todos os campos obrigatorios! 

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