
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
   	
///////////////////////////////////////////////////////////////////////////

$('select[name="tipoAss"]').change( function(){ 

  valor = $('select[name="tipoAss"]').val(); 
  verificaassinatura(valor);
});


function verificaassinatura(v){

if(v == "Nova linha"){ 
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
else if(v == "Pós 33 com IsenÃ§Ã£o"){ $('input[name="valorPlano"]').val('33,00');}
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



else if(tipoassinatura == 'Nova linha'){

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


<br> 
<h2>Nova venda</h2>
<hr id="hrTopTab"/>

<form class="dadosDaVenda" method="post" action="/admin/dadosdavenda/inserir">


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
               			     			               
				               
							  <input type="hidden" name="produto" value="clarofixo"/>
                
				             				
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
			<p class="subTab1">Endereço do Cliente</p>
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
				                
				                
				             <label class="esn" >Esn</label>
				               
							<input type="text" placeholder="" id="" name="esn"/>
									
					   </div><div class="formDados">
								     
								      <label class="tipoLinha" for="field35">Tipo Linha</label>
				                
								      <select  id="field35"  name="tipoLinha">
										 
										  
			
			<option>Residencial</option>
			<option>Comercial</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel tipoLinha">*</span>
								
								</div><div class="formDados">
								     
								      <label class="tipoAss" for="field36">Tipo Assinatura</label>
				                
								      <select  id="field36"  name="tipoAss">
										 
										  
			
			<option></option>
			<option>Nova linha</option>
			<option>Portabilidade</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel tipoAss">*</span>
								
								</div><div class="formDados">
								     
								      <label class="tipoPlano" for="field37">Tipo Plano</label>
				                
								      <select  id="field37"  name="tipoPlano">
										 
										  
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel tipoPlano">*</span>
								
								</div><div class="formDados">
								     
								      <label class="plano" for="field38">Plano</label>
				                
								      <select  id="field38"  name="plano">
										 
										  
			
			<option> </option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel plano">*</span>
								
								</div><div class="formDados">
									
									  <label for="field39">Valor Plano</label>
				               
									        <input type="text" placeholder="" id="field39" name="valorPlano"/>
										
										<span class="campoobrigatorio valorPlano">*</span>
									
									
									
									</div><div class="formDados">
								     
								      <label class="aparelho" for="field40">Aparelho</label>
				                
								      <select  id="field40"  name="aparelho">
										 
										  
			
			<option> </option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel aparelho">*</span>
								
								</div><div class="formDados">
									
									  <label for="field41">Valor Aparelho</label>
				               
									        <input type="text" placeholder="" id="field41" name="valorAparelho"/>
										
										<span class="campoobrigatorio valorAparelho">*</span>
									
									
									
									</div><div class="formDados">
								     
								      <label class="pagamento" for="field42">Pagamento</label>
				                
								      <select  id="field42"  name="pagamento">
										 
										  
			
			<option>BOLETO</option>
			<option>CARTÃO DE CRÉDITO</option>
			
		
										  
										
								          </select>
								  
								  <span class="campoobrigatorioSel pagamento">*</span>
								
								</div><div class="formDados">
									
									  <label for="field43">Data Venda</label>
				               
									        <input type="text" placeholder="Exemplo(dd/mm/aaaa)" id="field43" name="dataVenda"/>
										
										<span class="campoobrigatorio dataVenda">*</span>
									
									
									
									</div><div class="formDados">
								     
								      <label class="vencimento" for="field44">Vencimento</label>
				                
								      <select  id="field44"  name="vencimento">
										 
										  
			
			<option>8</option>
			<option>11</option>
			<option>20</option>
			<option>25</option>
			
		
										  
										
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