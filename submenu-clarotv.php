<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<table border="0" width="100%" class="submenu" cellspacing="0" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr align="center">
<td></td>

<td width="120px" style="cursor:pointer" <? if($_GET['p'] == 'clarotv'){?>class="submenuselected"<? }?> onClick="window.location = '?p=clarotv'">

Vendas
</td>

<? if($USUARIO['inserir_dados'] == 1){?>
<td width="150px" style="cursor:pointer" <? if($_GET['p'] == 'inserir-dados-clarotv'){?>class="submenuselected"<? }?> onClick="window.location = '?p=inserir-dados-clarotv'">
Inserir Dados
</td>
<? } ?>

<td width="140px" style="cursor:pointer" <? if($_GET['p'] == 'estatisticas-clarotv'){?>class="submenuselected"<? }?> onClick="window.location = '?p=estatisticas-clarotv'">
Estat&iacute;sticas
</td>

<td></td>
</tr>
</table>