<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<table border="0" width="100%" class="submenu" cellspacing="0" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr align="center">
<td></td>

<td width="120px" style="cursor:pointer" <? if($_GET['p'] == 'oi'){?>class="submenuselected"<? }?> onClick="window.location = '?p=oi'">

Vendas
</td>

<? if($USUARIO['inserir_dados'] == 1){?>
<td width="150px" style="cursor:pointer" <? if($_GET['p'] == 'inserir-dados-oi'){?>class="submenuselected"<? }?> onClick="window.location = '?p=inserir-dados-oi'">
Inserir Dados
</td>
<? } ?>

<td width="140px" style="cursor:pointer" <? if($_GET['p'] == 'estatisticas-oivelox'){?>class="submenuselected"<? }?> onClick="window.location = '?p=estatisticas-oivelox'">
Estat&iacute;sticas
</td>

<td></td>
</tr>
</table>