<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<table border="0" width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr style="font-size:13px">

<td>Mostrar: <span style=" cursor:pointer; <? if(!$_GET['t'] && !$_GET['f'] && !$_GET['s'] && !$_GET['v'] && !$_GET['i'] && !$_GET['b'] && !$_GET['di'] ){?> font-weight:bold;<? } ?>" onclick="window.location = '?p=<?= $_GET['p'];?>'">Todos</span></td>

<td> | Plano: 

<select name="t" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<option value="1MB" <? if($_GET['t'] == '1MB'){?>selected="selected"<? }?>>1MB</option>
<option value="2MB" <? if($_GET['t'] == '2MB'){?>selected="selected"<? }?>>2MB</option>
<option value="5MB" <? if($_GET['t'] == '5MB'){?>selected="selected"<? }?>>5MB</option>
<option value="10MB" <? if($_GET['t'] == '10MB'){?>selected="selected"<? }?>>10MB</option>
<option value="15MB" <? if($_GET['t'] == '15MB'){?>selected="selected"<? }?>>15MB</option>
<option value="20MB" <? if($_GET['t'] == '20MB'){?>selected="selected"<? }?>>20MB</option>

</select>

</td>

<td >
| Velox + Fixo: 

<select name="pacvf" onchange="javascript:document.forms.filtro.submit();" style="width: 167px;">

<option value=""></option>
<option value="Fale a vontade 39,90" <? if($_GET['pacvf'] == 'Fale a vontade 39,90'){?>selected="selected"<? }?>>Fale a vontade 39,90</option>
<option value="Fixo local ilimitado 28,90" <? if($_GET['pacvf'] == 'Fixo local ilimitado 28,90'){?>selected="selected"<? }?>>Fixo local ilimitado 28,90</option>
<option value="Ilimitado fim de semana 29,90" <? if($_GET['pacvf'] == 'Ilimitado fim de semana 29,90'){?>selected="selected"<? }?>>Ilimitado fim de semana 29,90</option>

</select>
</td>



<td>

 | Status:

<select name="s" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<option value="GRAVAR" <? if($_GET['s'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>
<option value="APROVADO" <? if($_GET['s'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="ANÁLISE" <? if($_GET['s'] == 'ANÁLISE'){?>selected="selected"<? } ?>>Análise</option>
<option value="PRÉ-ANÁLISE" <? if($_GET['s'] == 'PRÉ-ANÁLISE'){?>selected="selected"<? } ?>>Pré-Análise</option>
<option value="PENDENTE" <? if($_GET['s'] == 'PENDENTE'){?>selected="selected"<? } ?>>Pendente</option>
<option value="DEVOLVIDO" <? if($_GET['s'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="FINALIZADA" <? if($_GET['s'] == 'FINALIZADA'){?>selected="selected"<? }?>>Finalizada</option>
<option value="SEM CONTATO" <? if($_GET['s'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
<option value="RESTRIÇÃO" <? if($_GET['s'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<option value="CANCELADO" <? if($_GET['s'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
<option value="CONECTADO" <? if($_GET['s'] == 'CONECTADO'){?>selected="selected"<? } ?>>Conectado</option>




</select>

</td>





<td> | Venda de: <input type="text" name="v" id="calendario" onKeyPress="mascara(this,data)" value="<?= $_GET['v'];?>" maxlength="10" size="15" onchange="javascript:document.forms.filtro.submit();" /></td>



<td>At&eacute;: <input type="text" name="i" id="calendario2" onKeyPress="mascara(this,data)" value="<?= $_GET['i'];?>" maxlength="10" size="15" onchange="javascript:document.forms.filtro.submit();" /></td>



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

