<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript">


///////////////////////////////////////////////

function verificavalor(){

    plano = document.getElementById('plano').value;

if(plano == '1MB'){document.getElementById('valor').value = '29,90'; }
else if(plano == '2MB'){document.getElementById('valor').value = '49,90'; }
else if(plano == '5MB'){document.getElementById('valor').value = '59,90'; }
else if(plano == '10MB'){document.getElementById('valor').value = '69,90'; }
else if(plano == '15MB'){document.getElementById('valor').value = '79,90'; }
else{ document.getElementById('valor').value = '';}
    

}



</script>



<!-- 
//////////////////////////////////////////
//////////////// TABELA VELOX //////////////
////////////////////////////////////////
-->

<input type="hidden" name="produto" value="6" />
<input type="hidden" name="redir" id="redir" value="6" />

<table border="0" width="100%">

<tr align="left">
<td>Plano:</td>
<td>
<select name="plano" id="plano" onchange="verificavalor();">
<option value=""></option>

<option value="1MB">1MB</option>
<option value="2MB">2MB</option>
<option value="5MB">5MB</option>
<option value="10MB">10MB</option>
<option value="15MB">15MB</option>


</select>
<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
<span class="erro" id="eplano" style="display:none">Por favor, selecione um plano!</span>
</td>
</tr>


<tr align="left">
<td>Data Venda:</td>
<td><input type="text" id="calendario2" name="idata" onKeyPress="mascara(this,data)" maxlength="10" value="<?= date("d/m/Y");?>" size="20" /> <span style="font-size:12px; color:#999; font-style:italic">(dd/mm/aaaa)</span> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>
 <br /> 
<span class="erro" id="evenda" style="display:none">Por favor, selecione a data da venda!</span>
</td>
</tr>


<tr align="left">
<td>Valor:</td>
<td> <span style="font-size:12px; color:#999; font-style:italic">R$</span> <input type="text" id="valor" name="valor" value="" size="8" maxlength="10" /> <span style="font-size:12px; color:#999; font-style:italic">(0,00)</span> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>
 <br /> <span class="erro" id="evalor" style="display:none">Por favor, digite o valor da instalação!</span>
</td> 
</tr>

<tr align="left">
<td>Obs.:</td>
<td>
<textarea name="obs" rows="3" cols="30"></textarea>
</td>
</tr>

<tr height="80px" valign="middle" align="left" bgcolor="#FFFFFF">
<td></td>
<td>
<span class="button" align="absmiddle" onclick="submitform('6');">Inserir nova venda</span> 
<span class="button" align="absmiddle" onclick="submitform();">Inserir venda outro produto</span>
<span class="campoobrigatorio">(*) Campos Obrigatórios!</span>
</td>
</tr>

</table>

<!-- 
//////////////////////////////////////////
///////////// FIM TABELA VELOX /////////////
////////////////////////////////////////
-->
