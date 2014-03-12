<!-- Javascript/Jquery - COMEÃO -->
<script>    
    function FunSubmit() {
        document.forms['inserir'].action = "inserir-dados-aparelho-action.php";
        document.forms['inserir'].submit();
    }

    $(document).ready(function() {    
	
		$(".real").maskMoney({decimal:",",thousands:"."});
		
		$("#imagem_aparelho").live ("change", function() {
			
			
			if($("#imagem_aparelho").val()=="")
			{

			$("#preview-imagem").css("display", "none");
				
			}else{

			$("#preview-imagem").attr("src", "img/aparelhos/"+$("#imagem_aparelho").val());
			$("#preview-imagem").css("display", "block");
				
			}
			
		});

	});

</script>

<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>

<script type="text/javascript" src="js/jquery.maskMoney.js"></script>

<!-- Javascript/Jquery - FIM -->


<!-- Layout - COMEÃO --> 
<style type="text/css">

.erro{color:#C00; font-size:12px;}

</style>

<!-- SUBMENU -->
<? include "submenu-clarofixo.php";?>
<!-- FIM DO SUBMENU -->
<? include ("menu-lateral-estoque-clarofixo.php") ; ?>
<center>
    <table border="0" width="1000px">

        <tr valign="bottom" height="40px" align="left">
        <td style="font-size:14px; color:#999;">Cadastro de Aprelhos</td>
        
        </tr>

        <tr>
        <td><hr size="1" color="#CCCCCC" /></td>
        </tr>

    </table>
<!-- Layout FIM -->

<!-- FormulÃ¡rio COMEÃO -->
<center>
<form name="inserir" action="inserir-dados-aparelho-action.php" method="post">

<table border="0" width="850px" >

<tr align="left">
<td>Marca:</td>
<td>
<input type="text" id="textBoxMarca" name="textBoxMarca">
<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
<span class="erro" id="marca" style="display:none">Por favor, selecione a marca do Aparelho!</span>
</td>
</tr>

<tr align="left">
<td>Modelo:</td>
<td>
<input type="text" id="textBoxModelo" name="textBoxModelo">
<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
<span class="erro" id="emonitor" style="display:none">Por favor, selecione o modelo do Aparelho!</span>
</td>
</tr>

<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2" style="font-size:14px; color:#999;">Pre&ccedil;o do Aparelho para portabilidade</td></tr>
<tr><td colspan="2"><hr size="1" color="#CCCCCC" /></td></tr>

<tr align="left">
<td style="font-size:14px;">Todos os Planos:</td>
<td>
<input type="text" class="real" id="textBoxPrecoPortabilidade" name="textBoxPrecoPortabilidade">
<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
<span class="erro" id="etextBoxPrecoPortabilidade" style="display:none">Por favor, selecione o pre&ccedil; do Aparelho!</span>
</td>
</tr>

<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2" style="font-size:14px; color:#999;">Pre&ccedil;o do Aparelho para Novas Linhas</td></tr>
<tr><td colspan="2"><hr size="1" color="#CCCCCC" /></td></tr>

<tr align="left">
<td style="font-size:14px;">Pr&eacute; 15 e Pr&eacute; Fixo Ilimitado Local: </td>
<td>
<input type="text" class="real" id="textBoxPrecoPre" name="textBoxPrecoPre">
<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
<span class="erro" id="etextBoxPrecoPre" style="display:none">Por favor, selecione o pre&ccedil; do Aparelho!</span>
</td>
</tr>

<tr align="left">
<td style="font-size:14px;">Plano FAV Local: </td>
<td>
<input type="text" class="real" id="textBoxPrecoControle" name="textBoxPrecoControle">
<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
<span class="erro" id="etextBoxPrecoControle" style="display:none">Por favor, selecione o pre&ccedil; do Aparelho!</span>
</td>
</tr>

<tr align="left" style="margin:20px;">
<td style="font-size:14px; width:250px;">FAV Local com DDD, FAV Local e DDD e FAV Local e DDD com M&oacute;vel: </td>
<td>
<input type="text" class="real" id="textBoxPrecoPos" name="textBoxPrecoPos">
<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
<span class="erro" id="etextBoxPrecoPos" style="display:none">Por favor, selecione o pre&ccedil; do Aparelho!</span>
</td>
</tr>

<tr align="left" style="margin:20px;">
<td style="font-size:14px; width:250px;">Reposi&ccedil;&atilde;o: </td>
<td>
<input type="text" class="real" id="textBoxPrecoRep" name="textBoxPrecoRep">
<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
<span class="erro" id="etextBoxPrecoRep" style="display:none">Por favor, selecione o pre&ccedil; do Aparelho!</span>
</td>
</tr>

<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2" style="font-size:14px; color:#999;">Imagem do Aparelho</td></tr>
<tr><td colspan="2"><hr size="1" color="#CCCCCC" /></td></tr>

<tr align="left" style="margin:20px;" valign="top">
<td style="font-size:14px; width:250px;">Selecione a Imagem: </td>
<td>
<select id="imagem_aparelho" name="imagem_aparelho">

	<option value="n">Todos</option>
	<option value="alcate_cf100_-_claro-fixo.png">Alcatel CF 100</option>
	<option value="alcate_mf100_-_claro-fixo.png">Alcatel MF 100</option>
	<option value="alcate_ot_208_-_claro-fixo.png">Alcatel OT 208</option>
	<option value="huawei_2555_-_claro-fixo.png">Huawei 2555</option>
	<option value="huawei_c2610_-_claro-fixo.png">Huawei C-2610</option>
	<option value="huawei_8551_-_claro-fixo.png">Huawei 8551</option>
	<option value="huawei-U2800.png">Huawei U2800</option>
	<option value="chip-claro-fixo.png">Chip Claro Fixo</option>

</select>

<span class="campoobrigatorio" title="Campo Obrigat&oacute;rio">*</span>
<span class="erro" id="eimagem_aparelho" style="display:none">Por favor, selecione a imagem do Aparelho!</span>

<img src="" id="preview-imagem" style="display:none; border:0px; float:right;" />

</td>
</tr>


<tr><td>&nbsp;</td></tr>


<tr height="50px" valign="bottom" align="left">
<td></td>
<td> <img src="img/salvar.png" style="cursor:pointer" align="absmiddle" onclick="FunSubmit();"/>
<span class="campoobrigatorio">(*) Campos Obrigat&oacute;rios!</span>
</td>
</tr>

</table>
</td>
</tr>
</table>
</form>

<!-- FormulÃ¡rio FIM -->
