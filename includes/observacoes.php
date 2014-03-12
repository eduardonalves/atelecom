<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
.fotouser{ margin-right:8px; border: 1px solid #CCC;}
</style>
<?
switch($tipoOBS){
	
	case 1: $nameObsInput = 'obsgravacao'; break;
	case 2: $nameObsInput = 'obsentrega'; break;
	case 3: $nameObsInput = 'obsfinalizada'; break;

	
	}
	
?>



<? if($editar == '1' || ($USUARIO['id']==3179 || $USUARIO['id']==3227)){?>
<tr><td colspan="2"><hr size="1" style="border-bottom: 1px dashed #EDEDED;" color="#FFF" /></td></tr>		

<tr>
<td><b>Nova Obs.:</b></td>
<td>
<? if($USUARIO['foto']){?>
<img src="img/fotos/<?= $USUARIO['foto']?>.jpg" class="fotouser" border="1" width="40" align="left" />
<? } ?>
<input type="text" name="<?= $nameObsInput?>" autocomplete="off" size="40" /></td>
</tr>
<? } ?>

<?
switch($tipoOBS){
	
	case 1: $nameObsInput = 'obsgravacao'; break;
	case 2: $nameObsInput = 'obsentrega'; break;
	case 3: $nameObsInput = 'obsfinalizada'; break;

	
	}


$conOBSGRAVACAO = $conexao->query("SELECT DATE_FORMAT(observacoes.data, '%d/%m/%Y às %H:%i:%s') AS data,
										  observacoes.observacao AS obs, 
										  usuarios.nome AS usuario,
										  usuarios.foto AS foto
				   				   FROM observacoes 
				                   INNER JOIN usuarios ON usuarios.id = observacoes.id_usuario 
				                   WHERE observacoes.id_venda = '".$_GET['id']."' &&
								         observacoes.tipo = '".$tipoOBS."'
								   ORDER BY observacoes.id DESC
										  
										  ");


while($OBSGRAVACAO = mysql_fetch_array($conOBSGRAVACAO)){ ?>

<tr><td colspan="2"><hr size="1" style="border-bottom: 1px dashed #EDEDED;" color="#FFF" /></td></tr>		
    
<tr>
<td><b>Obs.:</b></td>
<td>
<span style="color:#787878; font-size:11px;">
<? if($OBSGRAVACAO['foto']){?>
<img src="img/fotos/<?= $OBSGRAVACAO['foto']?>.jpg" class="fotouser" border="1" width="40" align="left" />
<? } ?>
<b> <?= $OBSGRAVACAO['usuario'];?> </b> em <?= $OBSGRAVACAO['data'];?>
</span><br />
<?= $OBSGRAVACAO['obs'];?>
</td>
</tr>


	
<?	} ?>
