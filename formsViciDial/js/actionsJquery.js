$(document).ready(function(){



	centerMenu();

	animateMenulateral();

    insertAno();

	jClarod();

	

	 //loadChartPie();

	   //limpar input

	

	   $('input[type=text]').focus(function(){

	

		    

		    $(this).attr('placeholder','');

		    

	   

	    });

	  

	   //reset link menus

	   

	   $('#menu a').click(function(){

		   

		  lk = $(this).attr('href');

		  

		  lk2 = lk.split('/');

		  

		  for(i=0;i< lk2.length;i++){

		 	 

		 	 if(lk2[i]=='p' && lk2[i+1]=='%23'){

		 		 

		 		return false;

		 	 }

		 	

		  }

		  

	   });

	  

	  

		

	 //Fechar LightBox



	 $('body').delegate('#closeDash3 ,#closeDash4 , #closeDash5, #closeDash6','click',function(){



	     closeLightbox();

	 });

	 

	// Mostrar Informações colunas

	

	

	

	// Claro 3G

	

	 $('body').delegate('#contentDash_2 #col1' ,'mouseover' , function(){

	 $("contentDash_2 #col1 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_2 #col1' ,'mouseout' , function(){

	 $("contentDash_2 #col1 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_2 #col2' ,'mouseover' , function(){

	 $("contentDash_2 #col2 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_2 #col2' ,'mouseout' , function(){

	 $("contentDash_2 #col2 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_2 #col3' ,'mouseover' , function(){

	 $("contentDash_2 #col3 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_2 #col3' ,'mouseout' , function(){

	 $("contentDash_2 #col3 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_2 #col4' ,'mouseover' , function(){

	 $("contentDash_2 #col4 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_2 #col4' ,'mouseout' , function(){

	 $("contentDash_2 #col4 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_2 #col5' ,'mouseover' , function(){

	 $("contentDash_2 #col5 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_2 #col5' ,'mouseout' , function(){

	 $("contentDash_2 #col5 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_2 #col6' ,'mouseover' , function(){

	 $("#contentDash_2 col6 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_2 #col6' ,'mouseout' , function(){

	 $("#contentDash_2 col6 .infoCol").stop().fadeOut(300);

	 });

	 

	 

	 // Claro TV

	

	 $('body').delegate('#contentDash_1 #col1' ,'mouseover' , function(){

	 $("#contentDash_1 #col1 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_1 #col1' ,'mouseout' , function(){

	 $("#contentDash_1 #col1 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_1 #col2' ,'mouseover' , function(){

	 $("#contentDash_1 #col2 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_1 #col2' ,'mouseout' , function(){

	 $("#contentDash_1 #col2 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_1 #col3' ,'mouseover' , function(){

	 $("#contentDash_1 #col3 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_1 #col3' ,'mouseout' , function(){

	 $("#contentDash_1 #col3 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_1 #col4' ,'mouseover' , function(){

	 $("#contentDash_1 #col4 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_1 #col4' ,'mouseout' , function(){

	 $("#contentDash_1 #col4 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_1 #col5' ,'mouseover' , function(){

	 $("#contentDash_1 #col5 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_1 #col5' ,'mouseout' , function(){

	 $("#contentDash_1 #col5 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_1 #col6' ,'mouseover' , function(){

	 $("#contentDash_1 #col6 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_1 #col6' ,'mouseout' , function(){

	 $("#contentDash_1 #col6 .infoCol").stop().fadeOut(300);

	 });

	 

	 

	 // Claro Fixo

	

	 $('body').delegate('#contentDash_3 #col1' ,'mouseover' , function(){

	 $("#contentDash_3 #col1 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_3 #col1' ,'mouseout' , function(){

	 $("#contentDash_3 #col1 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_3 #col2' ,'mouseover' , function(){

	 $("#contentDash_3 #col2 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_3 #col2' ,'mouseout' , function(){

	 $("#contentDash_3 #col2 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_3 #col3' ,'mouseover' , function(){

	 $("#contentDash_3 #col3 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_3 #col3' ,'mouseout' , function(){

	 $("#contentDash_3 #col3 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_3 #col4' ,'mouseover' , function(){

	 $("#contentDash_3 #col4 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_3 #col4' ,'mouseout' , function(){

	 $("#contentDash_3 #col4 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_3 #col5' ,'mouseover' , function(){

	 $("#contentDash_3 #col5 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_3 #col5' ,'mouseout' , function(){

	 $("#contentDash_3 #col5 .infoCol").stop().fadeOut(300);

	 });

	 

	 $('body').delegate('#contentDash_3 #col6' ,'mouseover' , function(){

	 $("#contentDash_3 #col6 .infoCol").stop().fadeIn(300); 

	 });

	 $('body').delegate('#contentDash_3 #col6' ,'mouseout' , function(){

	 $("#contentDash_3 #col6 .infoCol").stop().fadeOut(300);

	 });



	 

 

	//abir e fechar aba de configuração...

	   ///fechar paineis modal ao clicar na tecla ESC

	 $(window).bind("keydown",function(e){



		    if(e.which == '27'){



		    $(".loadConfig").slideUp("400",function(){

		       

		        $(".mask").fadeOut('1000',function(){

		       	 

		       	 

		      	 window.location ="";

		       	 

		        });

		           

		      });



		    }

		});





	 

	 ////

	 

	

  $("#menu_usuario").click(function(){

	  

	$("#menu_usuario ul").slideDown('500');

	  

  });

	

  $("#menu_usuario ul").mouseover(function(){

	  

	  $(this).stop().slideDown('500');

	 

	});

	



  $("#menu_usuario").mouseout(function(){

		

	 $('#menu_usuario ul').stop().slideUp('500');	 

	 

	  });



});

////date picker

$(function() {

	

	selectors = ["input[name='nascimento']","input[name='dataExp']","input[name='dataDesej']","input[name='datavenda']","input[name='dataVenda']","input[name='datafinalizada']","input[name='agendamento']","input[name='datainstalada']","input[name='dataate']","input[name='dataautorizacao']"];

	

    for(i=0;i < selectors.length;i++){

    	

	datepicker(selectors[i]);



	

    }

 });

///funcao..reset..link menu





///function JW PLAYER para ouvir as gravações.....



function jw(mp3 ,root){



  jwplayer("audio").setup({

	  

       flashplayer: root+"/js/player.swf",

       controlbar:'bottom',

       file: root+'/audio/'+mp3,

       autostart: true,

       skin: root+"/js/skin/blueratio.zip",

       image:root+"/image/logo-vento-b.jpg",

       height: 300,

       width : 440

      

      });



 }

//mascara data

function mascaraData(seletor){

	

	$(seletor).keyup(function(){

		

    	$(this).attr('maxlength',10);

    	

    	  if( $(this).val().length == 2){

    		

    		   $(this).val($(this).val()+'/');

    		

    	      } 	

    	

            if( $(this).val().length == 5){

    		

    		   $(this).val($(this).val()+'/');

    		

    	     } 	

    	

    }); 

	

	

}





///datepicker

function datepicker(seletor){

	if(seletor =="input[name='dataDesej']"){

		

		$(seletor).datepicker({

			dateFormat:'dd/mm/yy',

			minDate: "+0d" ,

	        changeMonth: true,

	        changeYear: true

	    });

	

		

	}

	

	else if(seletor =="input[name='nascimento']"){

		

		$(seletor).datepicker({

			dateFormat:'dd/mm/yy',

			minDate: "-85y" ,

			maxDate: "-18y" ,

	        changeMonth: true,

	        changeYear: true

	    });

		 

	}	 

	else{

	   $(seletor).datepicker({

		   dateFormat:'dd/mm/yy',

        changeMonth: true,

        changeYear: true

        });

	

	  }

}



// Colocar menu ao centro

function centerMenu()

 {



    mfmenu = $('#menu').width();

	mftopo = $('#topo').width();

	mf = (mftopo - mfmenu)/2;

	MF = mf+'px';

	

	$('#menu').css('margin-left', MF);

	$('#menu').fadeIn(800);

	

	mfsubmenu = $('#submenu').width();

	mftopo = $('#topo').width();

	mf = (mftopo - mfmenu)/2;

	MF = mf+'px';

	

	$('#submenu ul').css('margin-left', MF);

	$('#submenu ul').fadeIn(800);



}



//Mostrar esconder op��es usuario







 function usernavigator(a){



 if(a == 'mostrar'){



    $('#navigation').stop().slideDown(500);



}







}

 

 

 function animateMenulateral()

 {

	 

	$('#estatEsquerda').animate({'width':'15%'},1000); 

	

	    $('#estatEsquerda ul').toggle(1300); 

	    

	       $('#estatEsquerda ul li').fadeIn(1300); 

	

	  $('#estatDireita').animate({'width':'80%'},1000); 

	  

	

	 

 }

 

 function insertAno()

 {

	 hoje = new Date();

	 dia = hoje.getDate();

	 mes = hoje.getMonth();

	 ano = hoje.getFullYear();

	 

    for(i = ano-100;i<=ano;i++){

    	

    	str ='<option value="'+i+'">'+i+'</option>';

        

    	$('select[name="ano"]').prepend(str);	

    	

     }	 

	 

 }

 ///loadprogress

 cont = new Array();

 cont = 0;

 function loadProgressBar(){

	 

	 $('body').html('<p></p>'); 

	 $('body').css({'background':'#fff'}); 

	 $('body').append('<div class="bglogin"><div id="progressbar"><div id="percent"></div></div><div class="nuvens"></div></div>');



	 setInterval(function(){setProgress();},40);

	 

 }

 function setProgress()

 {

	  

	  

  	if(cont>100){

  	   

  	   cont=-1;

  		

  	  setTimeout(function(){ window.location='./'; $('body').html('<p></p>');   },1100);

  	

      }

	  

	if(cont==-1){

		///aguardando o setTimeout

      }

  	

  	

  	else{

  		 $( "#progressbar" ).progressbar({

             value: cont

           }); 

         $('#percent').html('<p>'+cont+'%</p>');

         

         $('#percent').css('margin-left',cont+'%');

         

         cont++;

  	}

 	 

 }

 ////

 function LoadDashboards()

 {

	 

	 dashs = new Array();

	 dashs =[' ','/admin/show-dashboards/graficovendasclarotv/produto/clarotv','/admin/show-dashboards/graficovendasclaro3g/produto/claro3g','/admin/show-dashboards/graficovendasclarofixo/produto/clarofixo','/admin/show-dashboards/gravarclarotv/produto/clarotv','/admin/show-dashboards/installtodayclarotv/produto/clarotv'];

	 

	 for(i=0;i<10;i++){

	 

	 if ( $("#contentDash_"+i).length ){

               

		 $("#contentDash_"+i).html('<div id="loadingCicle"></div>');

		 

		    $("#contentDash_"+i).load(dashs[i]);

   	  

    	}

	 

	

	 }

	 

 }

 

 function refreshDashboards(rel)

 {

	 

	 dashs = new Array();

	 dashs =[' ','/admin/show-dashboards/graficovendasclarotv/produto/clarotv','/admin/show-dashboards/graficovendasclaro3g/produto/claro3g','/admin/show-dashboards/graficovendasclarofixo/produto/clarofixo','/admin/show-dashboards/gravarclarotv/produto/clarotv','/admin/show-dashboards/installtodayclarotv/produto/clarotv'];

	 

	 $("#contentDash_"+rel).html('<div id="loadingCicle"></div>');

	 

	     $("#contentDash_"+rel).load(dashs[rel]);  

	 

	 

	 

 }

 

 //Animação dos gráficos

 



 

 function animateGraphics(divname, height, time) {

    

	 for(i=1;i< 7;i++){

	

	    sel = divname+'  #col'+i;

	

	  $(sel).stop().animate({'height':height[i]},time, function(){

	  

	  

	$('.topCol').animate({"margin-top":"-15px","color":"#7e7e7e"},1000);});

	

	}

	

	

}

 

 function closeLightbox() {

	    $('.loadConfig').slideUp(400, function(){				



		$('.mask').fadeOut(1000);

		$('.loadConfig').fadeOut(1000);

		 $('.loadConfig').css({'background':'transparent','height':'400px','width':'440px' ,'margin':'0 0 0 -220px','overflow':'hidden'});

	    $('.loadConfig').html('');

	    

	 });



	}

 //mascara



function jClarod(){



	   $("input[name='cpf']").mask("999.999.999-99");

	   $("input[name='nascimento']").mask('99/99/9999');

       $("input[name='rg']").mask('9999999999999');	   

       $("input[name='tel']").mask('(99) 9999-99999');

       $("input[name='telefone']").mask('(99) 9999-99999');

	   $("input[name='telCom']").mask('(99) 9999-99999');

	   $("input[name='telefoneComercial']").mask('(99) 9999-99999');

	   $("input[name='telAdic']").mask('(99) 9999-99999');

	   $("input[name='telefoneAdicional']").mask('(99) 9999-99999');

	   $("input[name='telCel']").mask('(99) 9999-99999');

	   $("input[name='telefoneCelular']").mask('(99) 9999-99999');

	   $("input[name='telDBM']").mask('(99) 9999-99999');

	   $("input[name='telefoneDBM']").mask('(99) 9999-99999');

	   $("input[name='cep']").mask('99999-999');

	   $("input[name='numEnd']").mask('999999');

	   $("input[name='lote']").mask('99999');

	   $("input[name='quadra']").mask('999999');

	   $("input[name='dataVenda']").mask('99/99/9999');

	   $("input[name='vencimento']").mask('99/99/9999');

	   $("input[name='pagInst']").mask('99/99/9999');

	   $("input[name='dataExp']").mask('99/99/9999');

	   $("input[name='rgDataExp']").mask('99/99/9999');

	   $("input[name='dataDesej']").mask('99/99/9999');

	   $("input[name='numCar']").mask('9999-9999-9999-9999');

	   $("input[name='dataFinalizada']").mask('99/99/9999');

	   $("input[name='dataEntrega']").mask('99/99/9999');

	   $("input[name='dataNasc']").mask('99/99/9999');

	   $("input[name='dataVendaOperdador']").mask('99/99/9999');

	   $("input[name='dataVendaSistema']").mask('99/99/9999');

	   $("input[name='dataInstalacao']").mask('99/99/9999');

	   $("input[name='agendamento']").mask('99/99/9999');	   

	   $("input[name='numOrder']").mask('99999999999999999');

	   $("input[name='dataAutorizacao']").mask('99/99/9999');

	   $("input[name='os']").mask('99999999999999999');

	   $("input[name='codAutorizacao']").mask('9999999999999');

	   $("input[name='numero']").mask('9999999999999');

	   $("input[name='codseg']").mask('9999999999999');

	   $("input[name='cnpj']").mask('99.999.999/9999-99');

	   $("input[name='validade']").mask('99/9999');

}









// Editar



function editarTipoPessoa(t){ 



if(t == 'Pessoa Física'){ 

    	$("tr:contains('CNPJ')").hide();

    	$("tr:contains('Razão Social')").hide();

    		    		 

    }else{

    	$("tr:contains('CPF')").hide();

    	$("tr:contains('Cliente')").hide();

    	$("tr:contains('Nascimento')").hide();

    	$("tr:contains('Nome da mãe')").hide();

		$("tr:contains('RG')").hide();

		$("tr:contains('Org. Exp.')").hide();

		$("tr:contains('Data Exp.')").hide();

    	$("tr:contains('Profissão')").hide();

    	$("tr:contains('Sexo')").hide();

    	$("tr:contains('Estado Civil')").hide();



		

    }   



}







// CEP

$(function() {

$('input[name="cep"]').keyup(function() {

  getEndereco();

});



});





function getEndereco() {

	

var	cep = $.trim($("input[name='cep']").val());

var tam = cep.length;

	// Se o campo CEP não estiver vazio

	if(cep != ""  && tam == 9){



			$.getScript("http://republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("input[name='cep']").val(), function(){

					// o getScript dá um eval no script, então é só ler!e

					//Se o resultado for igual a 1

					if(resultadoCEP["resultado"] && resultadoCEP["bairro"] != ""){

							// troca o valor dos elementos

							$("input[name='endereco']").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));

							$("input[name='bairro']").val(unescape(resultadoCEP["bairro"]));

							$("select[name='estado']").val(unescape(resultadoCEP["uf"]));

							

							var uf = unescape(resultadoCEP["uf"]);

							var cidade = unescape(resultadoCEP["cidade"])



							$("input[name='cidade']").val(unescape(resultadoCEP["cidade"]));



							$("input[name='numEnd']").focus();

							

					}else{

							return false;

					}

			});                             

	}

	

	else {

		  $("input[name='endereco']").val('');

		  $("input[name='bairro']").val('');

		  $("input[name='cidade']").val('');

		  $("select[name='estado']").val('');

		

		}



	

}