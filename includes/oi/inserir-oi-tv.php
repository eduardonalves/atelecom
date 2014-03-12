<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript">


///////////////////////////////////////////////

function verificavalor(){

    oifixo = document.getElementById('oifixo').value;
    pagamento = document.getElementById('pagamento').value;
    plano = document.getElementById('plano').value;


    if(oifixo == 'SIM'){
		
if(pagamento == ''){$('#pagamento').html('<option value=""></option><option value="BOLETO">BOLETO</option><option value="CONTA FIXO">CONTA FIXO</option><option value="DÉBITO">DÉBITO</option>');}

        if (pagamento == 'BOLETO') {

        if(plano == "OI TV MEGA HD"){ document.getElementById('valor').value = '119,90'; }
        else if(plano == "OI TV MEGA HBO/MAX HD"){ document.getElementById('valor').value = '149,90';}
        else if(plano == "OI TV MEGA TELECINE HD"){ document.getElementById('valor').value = '159,90'; }
        else if(plano == "OI TV MEGA CINEMA HD"){ document.getElementById('valor').value = '189,90'; }
        else if(plano == "OI TV MAIS HD"){ document.getElementById('valor').value = '89,90'; }
        else if(plano == "OI TV MAIS TELECINE HD"){ document.getElementById('valor').value = '129,90'; }
        else if(plano == "OI TV MAIS HBO/MAX HD"){ document.getElementById('valor').value = '119,90'; }
        else if(plano == "OI TV MAIS CINEMA HD"){ document.getElementById('valor').value = '159,90'; }
        else { document.getElementById('valor').value = ''; }
		
	$("#idbanco").fadeOut(800);
	document.getElementById('banco').value = '';
	document.getElementById('agencia').value = '';
	document.getElementById('contacorrente').value = '';
    }


    else if (pagamento == 'DÉBITO') {

    if(plano == "OI TV MEGA HD"){ document.getElementById('valor').value = '109,90'; }
    else if(plano == "OI TV MEGA HBO/MAX HD"){ document.getElementById('valor').value = '139,90';}
    else if(plano == "OI TV MEGA TELECINE HD"){ document.getElementById('valor').value = '149,90'; }
    else if(plano == "OI TV MEGA CINEMA HD"){ document.getElementById('valor').value = '179,90'; }
    else if(plano == "OI TV MAIS HD"){ document.getElementById('valor').value = '49,90'; }
    else if(plano == "OI TV MAIS TELECINE HD"){ document.getElementById('valor').value = '89,90'; }
    else if(plano == "OI TV MAIS HBO/MAX HD"){ document.getElementById('valor').value = '79,90'; }
    else if(plano == "OI TV MAIS CINEMA HD"){ document.getElementById('valor').value = '119,90'; }
    else { document.getElementById('valor').value = ''; }
	
	$("#idbanco").fadeIn(800);

    }

else if (pagamento == 'CONTA FIXO') {

    if(plano == "OI TV MEGA HD"){ document.getElementById('valor').value = '109,90'; }
    else if(plano == "OI TV MEGA HBO/MAX HD"){ document.getElementById('valor').value = '139,90';}
    else if(plano == "OI TV MEGA TELECINE HD"){ document.getElementById('valor').value = '149,90'; }
    else if(plano == "OI TV MEGA CINEMA HD"){ document.getElementById('valor').value = '179,90'; }
    else if(plano == "OI TV MAIS HD"){ document.getElementById('valor').value = '49,90'; }
    else if(plano == "OI TV MAIS TELECINE HD"){ document.getElementById('valor').value = '89,90'; }
    else if(plano == "OI TV MAIS HBO/MAX HD"){ document.getElementById('valor').value = '79,90'; }
    else if(plano == "OI TV MAIS CINEMA HD"){ document.getElementById('valor').value = '119,90'; }
    else { document.getElementById('valor').value = ''; }
	
	$("#idbanco").fadeOut(800);
	document.getElementById('banco').value = '';
	document.getElementById('agencia').value = '';
	document.getElementById('contacorrente').value = '';
	
    }
	
else {

    if(plano == "OI TV MEGA HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MEGA HBO/MAX HD"){ document.getElementById('valor').value = '';}
    else if(plano == "OI TV MEGA TELECINE HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MEGA CINEMA HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MAIS HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MAIS TELECINE HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MAIS HBO/MAX HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MAIS CINEMA HD"){ document.getElementById('valor').value = ''; }
    else { document.getElementById('valor').value = ''; }
	
	$("#idbanco").fadeOut(800);
	document.getElementById('banco').value = '';
	document.getElementById('agencia').value = '';
	document.getElementById('contacorrente').value = '';
    }	
};


if(oifixo == 'NÃO'){
	
if(pagamento == '' || pagamento == 'CONTA FIXO'){ $('#pagamento').html('<option value=""></option><option value="BOLETO">BOLETO</option><option value="DÉBITO">DÉBITO</option>');}

if (pagamento == 'BOLETO') {

    if(plano == "OI TV MEGA HD"){ document.getElementById('valor').value = '129,90'; }
    else if(plano == "OI TV MEGA HBO/MAX HD"){ document.getElementById('valor').value = '159,90';}
    else if(plano == "OI TV MEGA TELECINE HD"){ document.getElementById('valor').value = '169,90'; }
    else if(plano == "OI TV MEGA CINEMA HD"){ document.getElementById('valor').value = '199,90'; }
    else if(plano == "OI TV MAIS HD"){ document.getElementById('valor').value = '99,90'; }
    else if(plano == "OI TV MAIS TELECINE HD"){ document.getElementById('valor').value = '139,90'; }
    else if(plano == "OI TV MAIS HBO/MAX HD"){ document.getElementById('valor').value = '129,90'; }
    else if(plano == "OI TV MAIS CINEMA HD"){ document.getElementById('valor').value = '169,90'; }
    else { document.getElementById('valor').value = ''; }
	
	$("#idbanco").fadeOut(800);
	document.getElementById('banco').value = '';
	document.getElementById('agencia').value = '';
	document.getElementById('contacorrente').value = '';
}

else if (pagamento == 'DÉBITO') {

    if(plano == "OI TV MEGA HD"){ document.getElementById('valor').value = '119,90'; }
    else if(plano == "OI TV MEGA HBO/MAX HD"){ document.getElementById('valor').value = '149,90';}
    else if(plano == "OI TV MEGA TELECINE HD"){ document.getElementById('valor').value = '159,90'; }
    else if(plano == "OI TV MEGA CINEMA HD"){ document.getElementById('valor').value = '189,90'; }
    else if(plano == "OI TV MAIS HD"){ document.getElementById('valor').value = '89,90'; }
    else if(plano == "OI TV MAIS TELECINE HD"){ document.getElementById('valor').value = '129,90'; }
    else if(plano == "OI TV MAIS HBO/MAX HD"){ document.getElementById('valor').value = '119,90'; }
    else if(plano == "OI TV MAIS CINEMA HD"){ document.getElementById('valor').value = '159,90'; }
    else { document.getElementById('valor').value = ''; }
	
	$("#idbanco").fadeIn(800);

    }
	
else {

    if(plano == "OI TV MEGA HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MEGA HBO/MAX HD"){ document.getElementById('valor').value = '';}
    else if(plano == "OI TV MEGA TELECINE HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MEGA CINEMA HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MAIS HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MAIS TELECINE HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MAIS HBO/MAX HD"){ document.getElementById('valor').value = ''; }
    else if(plano == "OI TV MAIS CINEMA HD"){ document.getElementById('valor').value = ''; }
    else { document.getElementById('valor').value = ''; }
	
	$("#idbanco").fadeOut(800);
	document.getElementById('banco').value = '';
	document.getElementById('agencia').value = '';
	document.getElementById('contacorrente').value = '';
    }		

}; 

}


//

///////////////////////////////////

</script>



<!-- 
//////////////////////////////////////////
//////////////// TABELA TV //////////////
////////////////////////////////////////
-->

<input type="hidden" name="produto" value="4" />
<input type="hidden" name="redir" id="redir" value="4" />

<table border="0" width="100%">

<tr align="left">
<td>Cliente Oi:</td>
<td>
<select name="oifixo" id="oifixo"  onchange="verificavalor();">
<option value=""></option>
<option value="SIM">SIM</option>
<option value="NÃO">NÃO</option>
</select>
<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
</td> 
</tr>

<tr align="left" id="TRnum" style="display:none;">
<td>Número Oi Fixo:</td>
<td>
<input type="text" name="telOifixo" onKeyPress="mascara(this,telefone)" maxlength="14" size="20" size="30" >
<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
</td> 
</tr>

<tr align="left">
<td>Pagamento:</td>
<td>
<select name="pagamento" id="pagamento" onchange="verificavalor();"> 
<option value=""></option>
</select>
<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
</td> 
</tr>

<tr id="idbanco" style="display:none">
<td>Banco:</td>
<td>

<select id="banco" name="banco">
<option value=""></option>
<option value="ITAU">ITAU</option>
<option value="BRADESCO">BRADESCO</option>
<option value="HSBC">HSBC</option>
<option value="SANTANDER">SANTANDER</option>
<option value="CAIXA">CAIXA</option>
<option value="BANCO DO BRASIL">BANCO DO BRASIL</option>
</select> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>
 AG: <input type="text" name="agencia" id="agencia" size="5" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>
 CC: <input type="text" name="contacorrente" id="contacorrente" size="7" /> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>
<br />
<span class="erro" id="ebanco" style="display:none">Por favor, preencha todos os dados da conta do cliente!</span>
 </td>
</tr>


<tr align="left">
<td>Plano:</td>
<td>
<select name="plano" id="plano" onchange="verificavalor();">
<option value=""></option>

<option value="OI TV MEGA HD">OI TV MEGA HD</option>
<option value="OI TV MEGA HBO/MAX HD">OI TV MEGA HBO/MAX HD</option>
<option value="OI TV MEGA TELECINE HD">OI TV MEGA TELECINE HD</option>
<option value="OI TV MEGA CINEMA HD">OI TV MEGA CINEMA HD</option>
<option value="OI TV MAIS HD">OI TV MAIS HD</option>
<option value="OI TV MAIS TELECINE HD">OI TV MAIS TELECINE HD</option>
<option value="OI TV MAIS HBO/MAX HD">OI TV MAIS HBO/MAX HD</option>
<option value="OI TV MAIS CINEMA HD">OI TV MAIS CINEMA HD</option>

</select>
<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
<span class="erro" id="eplano" style="display:none">Por favor, selecione um plano!</span>
</td>
</tr>



<tr align="left">
<td>Pacotes adicionais:</td>
<td>

<input type="checkbox" name="pacAdi1" value="SEXYPRIVÊ">Sexy Privê &nbsp;&nbsp;
<input type="checkbox" name="pacAdi2" value="ÉTNICOS">Étnicos &nbsp;&nbsp;
<input type="checkbox" name="pacAdi3" value="TV CORINTHIANS">TV Corinthians &nbsp;&nbsp;
<input type="checkbox" name="pacAdi4" value="PLAYBOY TV">Playboy TV &nbsp;&nbsp;
<input type="checkbox" name="pacAdi5" value="SEXY HOT">Sexy Hot &nbsp;&nbsp;<br> 
<input type="checkbox" name="pacAdi6" value="SEXY HOT + PLAYBOY TV">Sexy Hot + Playboy TV &nbsp;&nbsp;
<input type="checkbox" name="pacAdi7" value="COMBATE">Combate &nbsp;&nbsp;

</td>
</tr>



<tr align="left">
<td>Pacotes com escolha:</td>
<td>
<select name="pacEsc" id="pacEsc">
<option value=""></option>

<option value="01 ESTADUAL + SÉRIE A - 67,90">01 ESTADUAL + SÉRIE A - 67,90</option>
<option value="02 ESTADUAIS + SÉRIE A - 67,90">02 ESTADUAIS + SÉRIE A - 67,90</option>
<option value="01 ESTADUAL + SÉRIE A + B - 82,90">01 ESTADUAL + SÉRIE A + B - 82,90</option>
<option value="01 ESTADUAL + SÉRIE B - 82,90">01 ESTADUAL + SÉRIE B - 82,90</option>

</select>
</td>
</tr>


<tr align="left">
<td>Eventos da Temporada:</td>
<td>
<select name="evTemp" id="pacEsc">
<option value=""></option>

<option value="BIG BROTHER BRASIL 13">BIG BROTHER BRASIL 13</option>

</select>
</td>
</tr>

<tr align="left">
<td>Pontos Adicionais:</td>
<td>
<input type="radio" id="ponto1" name="pontos" value="0" /> 0 &nbsp;
<input type="radio" id="ponto2" name="pontos" value="1" /> 1 &nbsp;
<input type="radio" id="ponto3" name="pontos" value="2" /> 2 &nbsp;
<input type="radio" id="ponto4" name="pontos" value="3" /> 3 &nbsp;
<input type="radio" id="ponto5" name="pontos" value="4" /> 4 &nbsp;
<span class="campoobrigatorio" title="Campo Obrigatório">*</span>
<span class="erro" id="epontos" style="display:none">Por favor, selecione o número de pontos adicionais!</span>

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
<td>Vencimento:</td>
<td>
<input type="radio" id="venci1" name="vencimento" value="1" /> 1 
<input type="radio" id="venci2" name="vencimento" value="4" /> 4
<input type="radio" id="venci3" name="vencimento" value="8" /> 8 
<input type="radio" id="venci4" name="vencimento" value="10" /> 10 <span class="campoobrigatorio" title="Campo Obrigatório">*</span>
 <span class="erro" id="evencimento" style="display:none">Por favor, selecione uma data de vencimento da fatura!</span>
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
<span class="button" align="absmiddle" onclick="submitform('4');">Inserir nova venda</span> 
<span class="button" align="absmiddle" onclick="submitform();">Inserir venda outro produto</span>
<span class="campoobrigatorio">(*) Campos Obrigatórios!</span>
</td>
</tr>

</table>

<!-- 
//////////////////////////////////////////
///////////// FIM TABELA TV /////////////
////////////////////////////////////////
-->
