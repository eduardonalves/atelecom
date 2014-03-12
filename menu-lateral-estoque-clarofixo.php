<table width="100%" border="0" cellpadding="0" cellspacing="0">



<tr valign="top">



<!-- /////////// Menu Lateral ////////// -->

<td class="menulateral" width="189px" bgcolor="#999999">



<table width="100%"  id="mlateral" border="0" cellpadding="0" cellspacing="0">


<?
if ($USUARIO["tipo_usuario"]=="ESTOQUISTA" || $USUARIO["tipo_usuario"]=="ADMINISTRADOR")
	
	{
	
	?>


<tr height="35px" style="cursor:pointer" onclick="window.location='?&p=index-estoque-clarofixo&es=inserir-dados-aparelho-clarofixo&m=<?= $_GET['m'];?>'" class="<? if($_GET['es'] == 'inserir-dados-aparelho-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td>&nbsp;  &nbsp; Cadastrar Aparelho</td>

</tr>

<tr height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=inserir-dados-entrada-clarofixo&m=<?= $_GET['m'];?>'" class="<? if($_GET['es'] == 'inserir-dados-entrada-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td width="100%">&nbsp;  &nbsp; Entrada</td>

</tr>


<tr height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=inserir-dados-saida-clarofixo&m=<?= $_GET['m'];?>'" class="<? if($_GET['es'] == 'inserir-dados-saida-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td>&nbsp;  &nbsp; Sa&iacute;da</td>

</tr>



<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=aparelhos-clarofixo&m=<?= $_GET['m'];?>'"  class="<? if($_GET['es'] == 'aparelhos-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td>&nbsp;  &nbsp; Estoque Interno</td>

</tr>



<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=estoque-clarofixo&m=<?= $_GET['m'];?>'"  class="<? if($_GET['es'] == 'estoque-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td>&nbsp;  &nbsp; Estoque Externo</td>

</tr>


<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=aparelhos-entradas-clarofixo&m=<?= $_GET['m'];?>'"  class="<? if($_GET['es'] == 'aparelhos-entradas-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td> &nbsp;  &nbsp; Relat&oacute;rio de Entradas</td>

</tr>

<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=aparelhos-saidas-clarofixo&m=<?= $_GET['m'];?>'"  class="<? if($_GET['es'] == 'aparelhos-saidas-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td> &nbsp;  &nbsp; Relat&oacute;rio de Sa&iacute;das</td>

</tr>

<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=estoque-unificado-clarofixo&m=<?= $_GET['m'];?>'"  class="<? if($_GET['es'] == 'estoque-unificado-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td> &nbsp;  &nbsp; Relat&oacute;rio de Estoque</td>

</tr>

<?
	} elseif ($USUARIO["tipo_usuario"]=="MONITOR") {
		
	?>
		
<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=estoque-clarofixo&m=<?= $_GET['m'];?>'"  class="<? if($_GET['es'] == 'estoque-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td>&nbsp;  &nbsp; Relat&oacute;rio de Estoque</td>

</tr>
	
	
	<?
	}elseif ($USUARIO["tipo_usuario"]=="SUPERVISOR") {
	?>

<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=index-estoque-clarofixo&es=estoque-unificado-clarofixo&m=<?= $_GET['m'];?>&supervisor=<?= $USUARIO["id"]?>'"  class="<? if($_GET['es'] == 'estoque-unificado-clarofixo'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td>&nbsp;  &nbsp; Relat&oacute;rio de Estoque</td>

</tr>
	
	<?
	
	}
	?>

</table>



</td>

<td>
	<br />
	<br />
