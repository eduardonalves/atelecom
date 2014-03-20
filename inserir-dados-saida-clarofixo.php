<!--Referencias -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<link rel="stylesheet" type=text/css href="css/ui-lightness/jquery-ui-1.7.3.custom.css" />
<script type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="jquery.validate.js" type="text/javascript"></script>

<!--Javascript/Jquery - COMEÃO-->
<script>
    
/*$(document).ready( function() {
    $("#formularioContato").validate({
        // Define as regras
	rules:{
            textBoxQuantidade1:{
            // campoNome serÃ¡ obrigatÃ³rio (required) e terÃ¡ tamanho mÃ­nimo (minLength)
            required: true, minlength: 2
            },
            campoEmail:{
            // campoEmail serÃ¡ obrigatÃ³rio (required) e precisarÃ¡ ser um e-mail vÃ¡lido (email)
            required: true, email: true
            },
            campoMensagem:{
            // campoMensagem serÃ¡ obrigatÃ³rio (required) e terÃ¡ tamanho mÃ­nimo (minLength)
            required: true, minlength: 2
            },
            camapoNome:{
            // campoNome serÃ¡ obrigatÃ³rio (required) e terÃ¡ tamanho mÃ­nimo (minLength)
            required: true, minlength: 2
            },
            },
            // Define as mensagens de erro para cada regra
            messages:{
            campoNome:{
            required: "Digite o seu nome",
            minLength: "O seu nome deve conter, no mÃ­nimo, 2 caracteres"
            },
            campoEmail:{
            required: "Digite o seu e-mail para contato",
            email: "Digite um e-mail vÃ¡lido"
            },
            campoMensagem:{
            required: "Digite a sua mensagem",
            minLength: "A sua mensagem deve conter, no mÃ­nimo, 2 caracteres"
            }
	}
    });
});*/

    
    jQuery(function($){
        $("#textBoxDataSaida").mask("99/99/9999");
    });
    
    $(function(){
        $("#textBoxDataSaida").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: [
        'Domingo','Segunda','Ter&ccedil;a','Quarta','Quinta','Sexta','S&aacute;bado','Domingo'
        ],
        dayNamesMin: [
        'D','S','T','Q','Q','S','S','D'
        ],
        dayNamesShort: [
        'Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b','Dom'
        ],
        monthNames: [
        'Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro',
        'Outubro','Novembro','Dezembro'
        ],
        monthNamesShort: [
        'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',
        'Out','Nov','Dez'
        ],
        nextText: 'Pr&oacute;ximo',
        prevText: 'Anterior'

        });
    });
		

    



    
    function FunSubmit() {
        $(".desabilitar").attr("disabled", false);
        document.forms['inserir'].action = "inserir-dados-saida-action.php";
        document.forms['inserir'].submit();
    }

    $(window).load( function() {

		<?php
		
		 
		
		if(count($_POST)>0)
		{?>
		$("[name='selectEstoquista']").val('<?=$_POST['selectEstoquista'];?>');
		$("[name='textBoxParceiro']").val('<?=$_POST['textBoxParceiro'];?>');
		$("[name='selectAparelho1']").val('<?=$_POST['selectAparelho1'];?>');
		
		<?
			
			}

		$qt_aparelhos = $_POST["textBoxQuantidade1"];

		if($qt_aparelhos!="")
		{
			?>


			
			$('#textBoxQuantidade1').val('<?=$qt_aparelhos;?>');
			$(".desabilitar").trigger("change");
			
			$('.codigo2').val('<?=$_POST["serial11"];?>');
			
			<?
			for($i=1; $i<$qt_aparelhos; $i++)
			{
				if($i==1)
				{
				?>
				
				$('.codigo2:last').trigger("change");
				
				<?}else{?>
				
				$('.codigo:last').trigger("change");
				$(".codigo[name='serial1<?=$i;?>']").val('<? echo $_POST["serial1$i"];?>');
				
				<?
					if (($i+1)==$qt_aparelhos) 
					{ 
						$i++; 
						?>
						$(".codigo[name='serial1<?=$i;?>']").val('<? echo $_POST["serial1$i"];?>');
						<?
					}
				}
			}
			
			echo "$(\".codigo2\").focus()";
		}
		?>
		
	});


    $( document ).ready(function() {
                var n1=1;
                var n2=0;
                var n3 = 0;
                var n4 = 1;
                var n5 = 1;
 			
 			$('.edit_quantidade').live("click", function(){
        	
				var edit = confirm("Isto ira limpar todos os ESNs adicionados. Deseja continuar?");
				
				if(edit)
				{
				$(".desabilitar").attr("disabled", false);
				
				var id = $(this).attr("id");
				var num_aparelho = id.substr((id.length)-1,1);
				
				$(".ap"+num_aparelho).remove();
				$("#textBoxQuantidade"+num_aparelho).focus();
				$("#textBoxQuantidade"+num_aparelho).val("");
				$("#serial"+num_aparelho+"1").val("");
				}
				
				return false;
				
        	
            });
            
          /* $("#botaoAppend").click(function(){
                n1++;
                document.getElementById("qntdAparelho").value = n1;
                $("#campoDinamico").append("<tr align='left'><td class ='diagramacaoSerial2'colspan='2'><hr size='1' color='#CCCCCC'/></td></tr>");	
                $("#campoDinamico").append("<tr align='left'><td class ='diagramacaoSerial2' style='color:#069; font-size:12px'>Itens de Saida</td></tr>");
                $('#campoDinamico').append("<tr align='left'><td class ='diagramacaoSerial2'>Aparelho:</td><td><select name='selectAparelho"+n1+"' id='selectAparelho"+n1+"'><?$sql = 'SELECT id_aparelho, modelo FROM aparelhos'; $aparelho = mysql_query($sql); while ($array= mysql_fetch_array($aparelho)) { echo"<option value=".$array['id_aparelho'].">".$array['modelo']."</option>"; }?> </select></td></tr>");
                $('#campoDinamico').append("<tr align='left'><td class ='diagramacaoSerial2'>Quantidade:</td><td><input type='text' id='textBoxQuantidade"+n1+"' name='textBoxQuantidade"+n1+"' class='desabilitar' /> <a class=\"edit_quantidade\" id='teste"+n1+"' href=\"#\"><img src='img/icone-editar.png'</a></td>");
                $('#campoDinamico').append("<tr align='left'><td style='width:158px;' class ='diagramacaoSerial2'>Serial 1:</td><td><input type='text' name='serial"+n1+"1' class='codigo' id='serial"+n1+"1'/></td></tr>");       
			});*/
    
            $('.codigo').live("change", function(){
                
                n2 = $("#textBoxQuantidade"+n1+"").val();
                n3++;   
                n4 = n3+1;
                if (n3 < n2) 
                {
                    $("#campoDinamico").append("<tr class='ap"+ n1 +"' align='left'><td style='width:158px;'><label id='serial' class='diagramacaoSerial' class='diagramacaoSerial2'>Serial "+n4+":</label> </td><td><input type='text' name='serial"+n1+n4+"' class='codigo' id='serial"+n1+n4+"'/><span class='campoobrigatorio' title='Campo Obrigatï¿½rio'>*</span><span class='erro' id='epessoa' style='display:none'>Por favor, selecione o tipo do cliente!</span></td></tr>");
					$("#serial"+n1+n4).focus();
                }
                else{
                    n3=0;
                    //alert("Numero de serial precisa ser igual o numero de aparelhos ");
                }  
            });

            $(".codigo2").change(function(){
                
                n2 = $("#textBoxQuantidade1").val();
                n3++;   
                n4 = n3+1;
               if (n3 < n2) 
                {
                    $("#campoDinamico").append("<tr class='ap"+ n1 +"' align='left'><td style='width:158px;'><label id='serial'>Serial "+n4+":</label> </td><td><input type='text' name='serial"+n1+n4+"' class='codigo' id='serial"+n1+n4+"'/><span class='campoobrigatorio' title='Campo Obrigatï¿½rio'>*</span><span class='erro' id='epessoa' style='display:none'>Por favor, selecione o tipo do cliente!</span></td></tr>");
					$("#serial"+n1+n4).focus();
                }
                else{
                    n3=0;
                    //alert("Numero de serial precisa ser igual o numero de aparelhos ");
                }       
            });
            
            
            
            });
            
                        
            $(".desabilitar").live("change", function(){
                $(".desabilitar").attr("disabled", true);
               
              }); 
              

function somenteNumero(e){
	var tecla=(window.event)?event.keyCode:e.which;
	if((tecla>47 && tecla<58)) return true;
	else{
	if (tecla==8 || tecla==0) return true;
	else return false;
}
}

</script>
<!--Javascript/Jquery - FIM-->



<!-- Layout - COMEÃO --> 
<style type="text/css">
.erro{color:#C00; font-size:12px;}

#campoDinamico{width:850px;}


</style>
<!-- SUBMENU -->
<? include "submenu-clarofixo.php";?>
<!-- FIM DO SUBMENU -->

<? include ("menu-lateral-estoque-clarofixo.php"); ?>

<center>
    <table border="0" width="1000px">

        <tr valign="bottom" height="40px" align="left">
        <td style="font-size:14px; color:#999;">Cadastro de Aparelhos - Saida</td>
        
        </tr>

        <tr>
        <td><hr size="1" color="#CCCCCC" /></td>
        </tr>

    </table>
<!-- Layout FIM -->



<!-- FormulÃ¡rio COMEÃO -->
<center>
	<form id="inserir" name="inserir" action="" method="post">
		<table id="tableAppend" border="0" width="850px" >

			<tr align="left">
				<td style="color:#069; font-size:12px">Saida</td>
			</tr>



			<tr align="left">
				<td>Data:</td>
				<td>
					<!-- <input type="text" name="textBoxDataSaida" id="textBoxDataSaida" /> -->
					<input type="hidden"  value="<? echo date("d/m/Y");?>" name="textBoxDataSaida" id="textBoxDataSaida" />
					<span><? echo date("d/m/Y");?></span>
					<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
					<span class="erro" id="epessoa" style="display:none">Por favor, selecione o tipo do cliente!</span>
				</td>

			</tr>


			<tr align="left">
				<td>Estoquista:</td>
				<td>
					<select name="selectEstoquista" id="selectEstoquista">
					<? 
						echo"<option value=".$USUARIO['id'].">".$USUARIO['nome']."</option>"; 
					?>
					</select>
    
					<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
					<span class="erro" id="enome" style="display:none">Por favor, digite o nome do cliente!</span>

				</td>
			</tr>


			<tr align="left">
				<td>Parceiro:</td>
				<td>

					<select name="textBoxParceiro" id="textBoxParceiro">

					<?

					$sql = "SELECT id, nome FROM usuarios WHERE tipo_usuario='MONITOR' || tipo_usuario='MONITORBO' && (acesso_usuario='INTERNO' || acesso_usuario='EXTERNO') && status='ATIVO' order by nome";
					$parceiros = mysql_query($sql); 

					while ($array= mysql_fetch_array($parceiros)) 
					{ 
						echo"<option value=".$array['id'].">".$array['nome']."</option>"; 
					}
						
						?>

					</select>
					<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
					<span class="erro" id="enome" style="display:none">Por favor, digite o nome do cliente!</span>
				</td>
			</tr>

			<input type="hidden" value="Em Estoque" name="selectStatus" id="selectStatus" />

			<tr align="left">
				<td style="color:#069; font-size:12px">Itens de Saida</td>
			</tr>

			<tr>
				<td colspan="2"><hr size="1" color="#CCCCCC" /></td>
			</tr>


			<tr align='left'>
				<td>Aparelho:</td>
				<td>
				<?
					$sql = "SELECT id_aparelho, marca, modelo FROM aparelhos "; 
					$aparelho = mysql_query($sql); 
					
					echo"<select name='selectAparelho1' id='selectAparelho1'>";
					
					while ($array= mysql_fetch_array($aparelho)) {
						echo"<option value=".$array['id_aparelho'].">".$array['marca']." - ".$array['modelo']."</option>";
						
					}
					echo"</select>";
				?>
				</td>
			</tr>


			<tr align='left'>
				<td>Quantidade:</td>
				<td><input type='text' style="width:40px;" id='textBoxQuantidade1' class='desabilitar' name='textBoxQuantidade1' onkeypress="return somenteNumero(event)"/> <a class="edit_quantidade" id='teste1' href="#"><img src='img/icone-editar.png'/></a></td>
			</tr>
    
			<tr align='left'>
				<td>Serial 1:</td>
				<td><input type='text' name='serial11' id='serial11' class='codigo2'/>
				<span class="campoobrigatorio">*</span>
				</td>
			</tr>

		</table>
    


		<table border="0" id="campoDinamico">
		</table>



		
<!--			<tr align="left">
				<td><a id="Append" href="#"><img src="img/adicionarAparelho.png"/></a> </td>
			</tr>
    
			<tr height="50px" valign="bottom" align="left">
				<td></td>
			</tr> -->
		
	<table border="0">	
		<img src="img/salvar.png" style="cursor:pointer" align="absmiddle" onclick="FunSubmit();" /> 
		<span class="campoobrigatorio"> (*) Campos Obrigat&oacute;rios!</span>

		<input type="hidden" id="qntdAparelho" name="qntdAparelho" value="1"/>
</table>
	</form>
</center>

</td>
</tr>
</table>


<!-- FormulÃ¡rio FIM -->
