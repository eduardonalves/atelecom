<?php

include "conexao.php";
session_start();

// Verificar se estÃ¡ logado

if(!isset($_SESSION['usuario'])){ ?>
<script type="text/javascript">

window.location = 'index.php'

</script>	


<? } 


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalhes Venda Claro Fixo</title>
<style type="text/css">
body{margin: 0 0 0 0; font-family:Arial, Helvetica, sans-serif;}

#topo{position:relative; background:url(img/topo-bg.png) repeat-x; top:0px; height:120px; width:100%;}


table.tabela tr:nth-child(odd) td {
	
	background-color:#F5F5F5;
	}

	
table.tabela tr:hover td{
	background-color:#DCDCDC;
	
}

table.tabela tr:first-child td {
	
	background-color:#808080;
	}
	
table.tabela tr{
	height:35px;
}

.item-entrada:hover {
	
	cursor:pointer;
}

</style>
</head>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>

<script type="text/javascript">


	$(document).ready(function(){
		$("#layer").toggle(1);
		  
		  $(".item-entrada").click(function(){

				$.ajax({
					url: 'ajax/aparelhos-get-esns.php?tipo=entrada&id=' + $(this).attr("id") + '&nome=' + $("#nome-item-" + $(this).attr("id")).text(),
					dataType: 'html',
					success: function (source) {

					$("#esns").html(source);
				}
			});

			
			$("#layer").toggle(400, function() {
				
				$("#itens-entrada").css("display", "none");
				
				});
			
		  });
		  
		  $("#layer").click(function(){
			  
			
			$("#layer").toggle(400, function() {
				
				$("#itens-entrada").css("display", "block");
				
				});
			
		  });

	});

</script>

<div id="main">

	<div id="topo">

		<img src="img/LOGO-VENTO-p.png" />

	</div>
	
	<div id="label-detalhes" style=" margin-top:20px; width:100%; text-align:center; background-color:#F6F6F6; color:#666666; font-size:20px; padding-top:5px; padding-bottom:5px; border-top: 1px solid #CCC; border-bottom: 1px solid #CCC;">
		DETALHES DA ENTRADA
	</div>
	
	<div id="dados-entrada">
		
		<br />

		<?php
		
			$queryEntrada = "Select aparelhos.id_aparelho, aparelhos.marca, aparelhos.modelo, itens.id_itensEntrada, itens.id_aparelho, itens.qtde, itens.id_entrada, usuarios.nome AS estoquista, ent.id_entrada, ent.id_estoquista, ent.nf, ent.origem, DATE_FORMAT(ent.data, '%d/%m/%Y &agrave;s %H:%i:%s') AS data FROM entradas ent
							INNER JOIN usuarios ON (usuarios.id=ent.id_estoquista)
							INNER JOIN itensEntrada itens ON (itens.id_entrada=ent.id_entrada)
							INNER JOIN aparelhos ON (aparelhos.id_aparelho=itens.id_aparelho)
							WHERE ent.id_entrada=" . $_GET["id"];
							
			$registros = $conexao->query($queryEntrada);
			
		$itensEntrada = array();
		
		while($registro = mysql_fetch_array($registros))
		{
			array_push($itensEntrada, $registro);
		}

		?>
		<table width="100%" style="">
		
			<tr>
			
				<td style="padding:5px;"><b>Data:</b></td>
				<td width="80%"><?php echo $itensEntrada[0]["data"]; ?></td>
			
			</tr>
			
			<tr>
			
				<td style="padding:5px;"><b>Nota Fiscal:</b></td>
				<td><?php echo $itensEntrada[0]["nf"]; ?></td>
			
			</tr>

			<tr>
			
				<td style="padding:5px;"><b>Estoquista:</b></td>
				<td><?php echo $itensEntrada[0]["estoquista"]; ?></td>
			
			</tr>

			<tr>
			
				<td style="padding:5px;"><b>Origem:</b></td>
				<td><?php echo $itensEntrada[0]["origem"]; ?></td>
			
			</tr>
		</table>

		<div id="label-detalhes" style=" margin-top:10px;border-bottom:1px solid #CCC; border-top:1px solid #CCC; width:100%; text-align:left; background-color:#F6F6F6; color:#666666; font-size:16px; padding-top:5px; padding-bottom:5px; ">
		<span style="padding-left:10px">Produtos desta Entrada</span>
		</div>
		
		<div id="itens-entrada">
		<table width="100%" style="margin-left:0px; margin-top:20px;" class="tabela">

			
			<tr width="100%" height="50px" style="font-size:20px; color:#FFFFFF;">

				<td align="center" width="70%"><span style="padding:10px"><b>Aparelho</b></span></td>
				<td align="center"><span style="padding:10px"><b>Quantidade</b></span></td>
				<td align="center"><span style="padding:5px"><b>ESNs</b></span></td>

			</tr>
			
			<?php 
			
			for($i=0; $i<count($itensEntrada); $i++)
			{
			
			?>

			<tr width="100%" id="<?php echo $itensEntrada[$i]["id_itensEntrada"]; ?>" class="item-entrada" >
				<td align="center"><span id="nome-item-<?php echo $itensEntrada[$i]["id_itensEntrada"]; ?>" style="padding:30px"><?php echo $itensEntrada[$i]["marca"]; ?> - <?php echo $itensEntrada[$i]["modelo"]; ?></span></td>
				<td align="center"><span style="padding:30px"><?php echo $itensEntrada[$i]["qtde"]; ?></span></td>
				<td valign="middle" align="center" width="1"><img src="img/icone-ver-lista.png" title="Vizualizar ESNs" alt="Vizualizar ESNs" /></td>
			</tr>


			<?php
			}
			?>

		</table>
		
		
		<div id="box-botoes" style="width:100%; text-align:center; margin-top:30px;">

			<!-- 
			<img src="img/editar.png" height="25" onClick="window.location = '?id=<?= $_GET['id'];?>&e=1'" style="cursor:pointer" /> 
			<img src="img/imprimir.png" height="25" onClick="javascript:print();" style="cursor:pointer" />
			-->
		
		</div>
		
		</div>

		<div id="layer" style="text-align:center; position:absolute; left:0px; top:333px; width:100%; background-color:#FFFFFF; z-index:999">

			<div id="esns">
				<br />
				<br />
				Aguarde carregando dados...
			</div><!-- esns -->

		</div><!-- layer -->

	
	</div>

</div>
