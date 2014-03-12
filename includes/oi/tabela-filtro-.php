<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<table border="0" width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr style="font-size:13px">

<td>Mostrar: <span style=" cursor:pointer; <? if(!$_GET['t'] && !$_GET['f'] && !$_GET['s'] && !$_GET['v'] && !$_GET['i'] && !$_GET['b'] && !$_GET['di'] ){?> font-weight:bold;<? } ?>" onclick="window.location = '?p=<?= $_GET['p'];?>'">Todos</span></td>


<td> | Venda de: <input type="text" name="v" id="calendario" onKeyPress="mascara(this,data)" value="<?= $_GET['v'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



<td>At&eacute;: <input type="text" name="i" id="calendario2" onKeyPress="mascara(this,data)" value="<?= $_GET['i'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>


<td width="190px"> | Data Finalizada: <input type="text" name="di" id="calendario4" onKeyPress="mascara(this,data)" value="<?= $_GET['di'];?>" maxlength="10" size="7" onchange="javascript:document.forms.filtro.submit();" /></td>



<td width="190px" align="center"> | Grava&ccedil;&atilde;o: <input type="radio" name="g" value="1" <? if($_GET['g'] == '1'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> Sim <input type="radio" name="g" value="0" <? if($_GET['g'] == '0'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> N&atilde;o</td>



<td>| Buscar: <input type="text" size="8" value="<?= $_GET['b']; ?>" name="b" onkeyup="keypressed()" /> &nbsp;



<img src="img/bt_ok.png" style="cursor:pointer; position:absolute; padding-top:2px;" onclick="javascript:document.forms.filtro.submit();" valign="bootom" /></td>

</tr>



</table>



