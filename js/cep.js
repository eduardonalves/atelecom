function getEndereco() {
	
var	cep = $.trim($("#idcep").val());
var tam = cep.length;
	// Se o campo CEP não estiver vazio
	if(cep != ""  && tam == 9){
		//document.getElementById("load").style.display = 'block';
			/* 
					Para conectar no serviço e executar o json, precisamos usar a função
					getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
					dataTypes não possibilitam esta interação entre domínios diferentes
					Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
					http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
			*/
			$.getScript("http://republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#idcep").val(), function(){
					// o getScript dá um eval no script, então é só ler!
					//Se o resultado for igual a 1
					if(resultadoCEP["resultado"] && resultadoCEP["bairro"] != ""){
							// troca o valor dos elementos
							$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
							$("#bairro").val(unescape(resultadoCEP["bairro"]));
							$("#uf").val(unescape(resultadoCEP["uf"]));
							
							var uf = unescape(resultadoCEP["uf"]);
							var cidade = unescape(resultadoCEP["cidade"])

							checkcidades(uf,cidade);
							$("#cidade").val(unescape(resultadoCEP["cidade"]));

							//$("#enderecoCompleto").show("slow");
							$("#numero").focus();
							
							//document.getElementById("load").style.display = 'none';
							//validate()
					}else{
							//$("#enderecoCompleto").show("slow");
							return false;
					}
			});                             
	}
	
	else {
		  $("#endereco").val('');
		  $("#bairro").val('');
		  $("#cidade").val('');
		  $("#uf").val('');
		
		}

	
}

