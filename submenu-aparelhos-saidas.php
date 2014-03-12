<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<table border="0" width="100%" class="submenu" cellspacing="0" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr align="center">
<td></td>

<? if($USUARIO['inserir_dados'] == 1){?>
<td width="85px" style="cursor:pointer" <? if($_GET['p'] == 'inserir-dados-entrada-clarofixo'){?>class="submenuselected"<? }?> onClick="window.location = '?p=inserir-dados-entrada-clarofixo'">
ENTRADA
</td>
<? } ?>

<? if($USUARIO['inserir_dados'] == 1){?>
<td width="85px" style="cursor:pointer" <? if($_GET['p'] == 'inserir-dados-saida-clarofixo'){?>class="submenuselected"<? }?> onClick="window.location = '?p=inserir-dados-saida-clarofixo'">
Sa&iacute;da
</td>
<? } ?>

<td width="190px" style="cursor:pointer" <? if($_GET['p'] == 'aparelhos-saidas-clarofixo'){?>class="submenuselected"<? }?> onClick="window.location = '?p=aparelhos-saidas-clarofixo'">
Relat&oacute;rio de Sa&iacute;das
</td>

<td width="80px" style="cursor:pointer" <? if($_GET['p'] == 'aparelhos-clarofixo'){?>class="submenuselected"<? }?> onClick="window.location = '?p=aparelhos-clarofixo'">
Estoque
</td>

<td></td>
</tr>
</table>
