<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<table border="0" width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr style="font-size:13px">

<td>Mostrar: <span style=" cursor:pointer; <? if(!$_GET['t'] && !$_GET['f'] && !$_GET['s'] && !$_GET['v'] && !$_GET['i'] && !$_GET['b'] && !$_GET['di'] ){?> font-weight:bold;<? } ?>" onclick="window.location = '?p=<?= $_GET['p'];?>'">Todos</span></td>

<td> | Plano: 

<select name="t" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<option value="OI TV MEGA HD" <? if($_GET['t'] == 'OI TV MEGA HD'){?>selected="selected"<? }?>>OI TV MEGA HD</option>

<option value="OI TV MEGA HBO/MAX HD" <? if($_GET['t'] == 'OI TV MEGA HBO/MAX HD'){?>selected="selected"<? }?>>OI TV MEGA HBO/MAX HD</option>

<option value="OI TV MEGA TELECINE HD" <? if($_GET['t'] == 'OI TV MEGA TELECINE HD'){?>selected="selected"<? }?>>OI TV MEGA TELECINE HD</option>

<option value="OI TV MEGA CINEMA HD" <? if($_GET['t'] == 'OI TV MEGA CINEMA HD'){?>selected="selected"<? }?>>OI TV MEGA CINEMA HD</option>

<option value="OI TV MAIS HD" <? if($_GET['t'] == 'OI TV MAIS HD'){?>selected="selected"<? }?>>OI TV MAIS HD</option>

<option value="OI TV MAIS TELECINE HD" <? if($_GET['t'] == 'OI TV MAIS TELECINE HD'){?>selected="selected"<? }?>>OI TV MAIS TELECINE HD</option>

<option value="OI TV MAIS HBO/MAX HD" <? if($_GET['t'] == 'OI TV MAIS HBO/MAX HD'){?>selected="selected"<? }?>>OI TV MAIS HBO/MAX HD</option>

<option value="OI TV MAIS CINEMA HD" <? if($_GET['t'] == 'OI TV MAIS CINEMA HD'){?>selected="selected"<? }?>>OI TV MAIS CINEMA HD</option>

</select>

</td>



<td>

 | Pagamento:

<select name="f" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<option value="BOLETO" <? if($_GET['f'] == 'BOLETO'){?>selected="selected"<? }?>>Boleto</option>

<option value="DÉBITO" <? if($_GET['f'] == 'DÉBITO'){?>selected="selected"<? }?>>D&eacute;bito</option>

<option value="CONTA FIXO" <? if($_GET['f'] == 'CONTA FIXO'){?>selected="selected"<? }?>>Conta Fixo</option>



</select>

</td>



<td>

 | Status:

<select name="s" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<option value="CANCELADO" <? if($_GET['s'] == 'CANCELADO'){?>selected="selected"<? }?>>Cancelado</option>

<option value="CONECTADO" <? if($_GET['s'] == 'CONECTADO'){?>selected="selected"<? }?>>Conectado</option>

<option value="DEVOLVIDO" <? if($_GET['s'] == 'DEVOLVIDO'){?>selected="selected"<? }?>>Devolvido</option>

<option value="INSTALAR" <? if($_GET['s'] == 'INSTALAR'){?>selected="selected"<? }?>>Instalar</option>

<option value="GRAVAR" <? if($_GET['s'] == 'GRAVAR'){?>selected="selected"<? }?>>Gravar</option>

<option value="APROVADO" <? if($_GET['s'] == 'APROVADO'){?>selected="selected"<? }?>>Aprovado</option>

<option value="PRÉ-ANÁLISE" <? if($_GET['s'] == 'PRÉ-ANÁLISE'){?>selected="selected"<? }?>>Pré-Análise</option>

<option value="PENDENTE" <? if($_GET['s'] == 'PENDENTE'){?>selected="selected"<? }?>>Pendente</option>

<option value="RESTRIÇÃO" <? if($_GET['s'] == 'RESTRIÇÃO'){?>selected="selected"<? }?>>Restri&ccedil;&atilde;o</option>

<option value="SEM CONTATO" <? if($_GET['s'] == 'SEM CONTATO'){?>selected="selected"<? }?>>Sem Contato</option>





</select>

</td>





<td> | Venda de: <input type="text" name="v" id="calendario" onKeyPress="mascara(this,data)" value="<?= $_GET['v'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



<td>At&eacute;: <input type="text" name="i" id="calendario2" onKeyPress="mascara(this,data)" value="<?= $_GET['i'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



</tr>



</table>

<table width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">

<tr align="left" height="40" style="font-size:13px">





<td width="190px"> Data Finalizada: <input type="text" name="di" id="calendario4" onKeyPress="mascara(this,data)" value="<?= $_GET['di'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



<td width="210px" align="center"> | Com Grava&ccedil;&atilde;o: <input type="radio" name="g" value="1" <? if($_GET['g'] == '1'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> Sim <input type="radio" name="g" value="0" <? if($_GET['g'] == '0'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> N&atilde;o</td>



<td>| Buscar: <input type="text" size="40" value="<?= $_GET['b']; ?>" name="b" onkeyup="keypressed()" /> &nbsp;



<img src="img/bt_ok.png" style="cursor:pointer; position:absolute; padding-top:2px;" onclick="javascript:document.forms.filtro.submit();" valign="bootom" /></td>

</tr>





</table>

