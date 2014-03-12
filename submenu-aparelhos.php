<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<table border="0" width="100%" class="submenu" cellspacing="0" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr align="center">
<td></td>

<td width="200px" style="cursor:pointer" <? if($_GET['p'] == 'inserir-dados-aparelho-clarofixo'){?>class="submenuselected"<? }?> onClick="window.location = '?p=inserir-dados-aparelho-clarofixo'">

Cadastrar Aparelho
</td>

<td width="200px" style="cursor:pointer" <? if($_GET['p'] == 'aparelhos-clarofixo'){?>class="submenuselected"<? }?> onClick="window.location = '?p=aparelhos-clarofixo'">

Estoque Interno
</td>

<td width="200px" style="cursor:pointer" <? if($_GET['p'] == 'estoque-clarofixo'){?>class="submenuselected"<? }?> onClick="window.location = '?p=estoque-clarofixo'">

Estoque Externo
</td>


<? if($USUARIO['inserir_dados'] == 1){?>
<td width="250px" style="cursor:pointer" <? if($_GET['p'] == 'estoque-unificado-clarofixo'){?>class="submenuselected"<? }?> onClick="window.location = '?p=estoque-unificado-clarofixo'">
Relatório Estoque Parceiros
</td>
<? } ?>


<td></td>
</tr>
</table>
