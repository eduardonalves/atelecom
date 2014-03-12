
<?php

require "../conexao.php";

$tipo = $_GET["tipo"];

switch ($tipo)
{
	
	case "entrada":
	
	$queryEsn = "Select esn.id_esnsentrada, esn.id_entrada, esn.esn, esn.status FROM ESNsEntradas AS esn
							WHERE esn.id_entrada=" . $_GET["id"];
	break;
	
	case "saida":

	$queryEsn = "Select esn.id_esnssaida, esn.id_saida, esn.esn, esn.status FROM ESNsSaida AS esn
							WHERE esn.id_saida=" . $_GET["id"];

	break;
	
	default:
	
	esnError();
	
	break;
	

	
}

function esnError()
{
	echo "</table><div style=\"width:100%; margin-top:30px; text-align:center;\">N&atilde;o foi encontrada nenhuma ESN para este item.</div>";
}

if(isset($queryEsn)) { 
	
	
	criaTabela($queryEsn); 
	
	
	}

function criaTabela($qry)

{
	global $conexao;

	$ESNs = $conexao->query($qry);

	if(mysql_num_rows($ESNs)>0)
	{
	?>
	
		<div style="margin-top:20px; left:5px; font-size:20px; position:relative; float:left;">
			Serias de <b><?php echo $_GET["nome"]; ?></b> referentes a esta saída
		</div>
		<div style="margin-top:10px; right:20px; font-size:20px; position:relative; float:right;">
					<img src="img/voltar.png" alt="Voltar" title="Voltar" style="padding-top:10px;" class="item-entrada item-saida" />

		</div>
		<table width="100%" style="margin-left:0px; margin-top:20px; position:relative; float:left;" class="tabela">
			
			<tr width="100%" height="50px" style="font-size:20px; color:#FFFFFF;">
				<td align="center" width="70%"><span style="padding:10px"><b>ESN</b></span></td>
				<td align="center"><span style="padding:10px"><b>Status</b></span></td>
			</tr>
	
	<?php

	} else {
		esnError();
		return 0;
	}
	
	while($esn = mysql_fetch_array($ESNs))
	{

	?>

			<tr width="100%" id="<?php echo $esn["id_esnsentrada"]; ?>" class="item-entrada item-saida">
				<td align="center"><span style="padding:30px"><?php echo $esn["esn"]; ?></span></td>
				<td align="center"><span style="padding:30px"><?php echo $esn["status"]; ?></span></td>
			</tr>

	<?php
	}
}

?>
		</table>

		<div style="margin-top:10px; right:20px; font-size:20px; position:relative; float:right;">
			<img src="img/voltar.png" alt="Voltar" title="Voltar" style="padding-top:10px;" class="item-entrada item-saida" />
		</div>

