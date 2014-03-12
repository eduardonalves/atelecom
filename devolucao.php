<table style="width:100%; text-align:center;">

	<tr style="background-color:#CCCCCC">

		<th>ESN</th>
		<th>Saida</th>
		<th>Estoquista</th>
		<th>Monitor</th>
		<th>Action</th>

	</tr>
	

<?php

require "lib/class.controleEstoque.php";

$g = new controleEstoque($conexao);

if($_POST['del']=="1")
{


	$filtro_esn = array();

	if(isset($_GET["esns"]))
	{
		$filtro_esn = explode(",",$_GET["esns"]);
		
	}

	$esns = $g->getESNsDeSaida($filtro_esn);

		while($l = mysql_fetch_assoc($esns))
			{
				
				$qtde = mysql_fetch_assoc($conexao->query("Select * from itenssaida where id_itenssaida='" . $l['id_itenssaida'] . "'"));
				echo $l['esn']."<span style='color:red;'> REMOVIDO </span><br>";
				
				if ($qtde['qtde']>1)
				{
					$conexao->query("UPDATE itenssaida SET qtde=qtde-1 where id_itenssaida='" . $l['id_itenssaida'] . "'"); 
					$conexao->query("DELETE FROM ESNsSaida WHERE id_esnssaida='" . $l['id_esnssaida'] . "'");
					$conexao->query("UPDATE ESNsEntradas SET status='Em Estoque' where esn='" . $l['esn'] . "'"); 
				}else{
					
					$conexao->query("DELETE FROM itenssaida where id_itenssaida='" . $l['id_itenssaida'] . "'"); 
					$conexao->query("DELETE FROM saidas where id_saida='" . $l['id_saida'] . "'"); 
					$conexao->query("DELETE FROM ESNsSaida WHERE id_esnssaida='" . $l['id_esnssaida'] . "'");
					$conexao->query("UPDATE ESNsEntradas SET status='Em Estoque' where esn='" . $l['esn'] . "'"); 
				}
			}
	
	
}else{


	$filtro_esn = array();

	if(isset($_GET["esns"]))
	{
		$filtro_esn = explode(",",$_GET["esns"]);
		
	}

$esns = $g->getESNsDeSaida($filtro_esn);
$total = mysql_num_rows($esns);


		
		while($l = mysql_fetch_assoc($esns))
		{
			echo "<tr>";

			echo "<td>".$l['esn']."</td>";
			echo "<td>".$l['data']."</td>";
			echo "<td>".$l['estoquista']."</td>";
			echo "<td>".$l['parceiro']."</td>";
			echo "</tr>";
		}
		
}

?>
	
	<tr style="background-color:#CCCCCCC;">

		<td colspan="4"></td>
		<td>Total: <?php echo $total; ?></td>

	</tr>

</table>

<form method="post">
<input type="hidden" name="del" value="1" />
<input type="submit" value="Retirar Saidas" />
</form>
