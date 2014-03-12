<meta name="http-equiv" content="Content-type: text/html; charset=UTF-8"/>

<link rel="stylesheet" type="text/css" href="css/tables.css" />

<style type="text/css">

	.up-falho {
		
		color:#FF0000;
		
	}

	.up-ok {
		
		color:#1C8C1C;
		
	}

</style>

<script type="text/javascript">

	$(document).ready( function() {
		
		var id;
		var total = $( ".tb-line" ).length;
		
		$("[name='filtro-status']").live("change", function() {
			
			var status = $(this).val();
			
			if(status=="up-ok")
			{
				
				$( ".up-ok" ).each(function( index ) {
				
				id = $(this).attr("id");
				$("#line-"+id).css("display", "table-row");
				});

				$( ".up-falho" ).each(function( index ) {
				
				id = $(this).attr("id");
				$("#line-"+id).css("display", "none");
				});

			
			}else if(status=="up-falho"){

				$( ".up-ok" ).each(function( index ) {
				
				id = $(this).attr("id");
				$("#line-"+id).css("display", "none");
				});

				$( ".up-falho" ).each(function( index ) {
				
				id = $(this).attr("id");
				$("#line-"+id).css("display", "table-row");
				});
			
			}else{
				
				$( ".up-ok" ).each(function( index ) {
				
				id = $(this).attr("id");
				$("#line-"+id).css("display", "table-row");
				});

				$( ".up-falho" ).each(function( index ) {
				
				id = $(this).attr("id");
				$("#line-"+id).css("display", "table-row");
				});
			}
			
		});
		
		$( ".tb-line" ).each(function( index ) {
			
			id = $(this).attr("id");
			id = id.replace("line-", "");
			//return false;
			var serializedData = $("#form-line-"+id).serialize();
			
			//alert(serializeData);
			request = $.ajax({
				
				url: "ajax/status-portal-update.php",
				async: false,
				type: "post",
				data: serializedData,
				success: function(data) {
					
					//alert(data);
					
					if(data>0)
					{
						//alert(data);
						upStatus = "up-ok";
					
						$("#"+id).attr("class", upStatus);
						$("#"+id).html("ATUALIZADO");
					
					}else{

						upStatus = "up-falho";
					
						$(id).attr("class", upStatus);
						$(id).html("FALHOU");
						
					}
					
					
					
					$("#line-"+id).css("display", "table-row");
					
					if((id-1)==total)
					{
						$("#load-label").html("Conclu&iacute;do " + total + " registros verificados.");
					
					}else{
					
						$("#load-label").html("Verificando " + (id-1) + " de " + total + " registros");	
					}
					
					
					var percent = (id*100) / total;
					
					$("#load-bar").css("width", percent+"%");
					//alert(data);
					}
				});

		});
		
	//alert($(".tb-line").length);
	});

</script>

<?php
require_once 'lib/PHPExcel/IOFactory.php';
require_once 'lib/PHPExcel.php';

$camposPlanilhas = array();


$saidaTexto = new Accents( Accents::UTF_8, Accents::ISO_8859_1 );

$objPlanilhas = new planilhaQualidade($conexao);

$curTipoPlanilha = $_POST["tipoPlanilha"];
$camposPlanilhaCur = $objPlanilhas->getCamposPlanilha($curTipoPlanilha);

//print_r($camposPlanilhaCur);

$inputFileName = 'upload/'. $_POST['unique-filename']. '.xls';

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
//echo 'Carregando ',pathinfo($inputFileName,PATHINFO_BASENAME),' information using IOFactory with a defined reader type of ',$inputFileType,'<br />';

$objReader = PHPExcel_IOFactory::createReader($inputFileType);

$objPHPExcel = $objReader->load($inputFileName);
$objPHPExcel->setActiveSheetIndex(0);
//$cell = $worksheet->getCellByColumnAndRow(, 1);
//echo $cell->getValue();
//echo objPHPExcel->getTitle();
//echo $objPHPExcel->getSheetCount();
//echo $objPHPExcel->getActiveSheet()->getCell("B2");

$totalLinhas = $objPHPExcel->getActiveSheet()->getHighestRow();
//echo "Numero de linhas:" . $objPHPExcel->getActiveSheet()->getHighestRow();

?>
<div id="label-importacao" style="width:100%; margin-left:10px; margin-top:10px; font-size:14px; color:#999;">
<b>Importando arquivo:</b> <?php echo $_POST["original-filename"]; ?>
<br />
<b>Tipo de Planilha:</b> <?php echo $saidaTexto->clear( $objPlanilhas->getTiposPlanilhas($curTipoPlanilha) ); ?>
</div>

<div id="progress-bar" style="overflow:hidden; border:1px solid #E5E5E5; margin-left:10px;width:98%; position:relative; display:block; float:left; margin-bottom:15px;margin-top:15px;">
	
	<span id="load-bar" style="display:block; width:50%; background-color:#E5E5E5; position:absolute;height:20px;padding:3px;"></span>
	<span id="load-label" style="color:#7F7F7F; position:relative;height:20px;padding:3px;display:block;"></span>

</div>

<div id="filtro" style="display:block; position:relative; float:left; margin-left:15px;margin-bottom:15px;">
	<label for="filtro-status">Filtrar por Status: </label>
	<select name="filtro-status">
		
		<option value="" selected="selected">Todos</option>
		<option value="up-ok">Atualizados</option>
		<option value="up-falho">Falhos</option>		
		
	</select>
</div>

<br style="clear:both" />
<center>
<table id="tabela-status-importacao" width="98%">

	<tr style="padding-top:5px; padding-bottom:3px; background-color:#565656; text-align:center;color:#FFF; font-size:14px; font-weight:bold;" class="tr1">
		
		<td style="width:50px;">LINHA</td>
		
		<?php 
		foreach($camposPlanilhaCur as $key=>$value)
		{
		?>
		
		<td><?php 
		
			if(strstr($value, "data"))
			{
			
			$col_name = "DATA " . $objPlanilhas->getTiposPlanilhas($curTipoPlanilha);
			echo $saidaTexto->clear(mb_strtoupper($col_name, "UTF-8")); 
			
			}else{
			
			echo $saidaTexto->clear(mb_strtoupper($objPHPExcel->getActiveSheet()->getCell($key . "1"), "UTF-8")); 
			
			}
			?>
		</td>

		<?php
		}
		?>
		
		<td style="width:80px">STATUS</td>
	</tr>
	
	<?php
	for($i=2; $i<=$totalLinhas; $i++)
	{
		$status = "up-ok";
	?>
	<tr id="line-<?php echo $i;?>" style="display:none" class="tb-line">
		
		<td><?php echo "$i"; ?></td>
				
		<?php
		
		$updateArray["tipo_planilha"] = $curTipoPlanilha;
		
		foreach($camposPlanilhaCur as $key=>$value)
		{
		?>
		
		<td>
		
			<?php

				$cellVal = $saidaTexto->clear(mb_strtoupper($objPHPExcel->getActiveSheet()->getCell($key . "$i"), "UTF-8"));
				
				if(strstr($value, "novoNumero"))
				{
					$cellVal = (int) $cellVal;
					Qualidade::maskTel($cellVal);
					
					$updateArray["numero"] = $cellVal;
				}
				
				elseif(strstr($value, "data"))
				{
					if($curTipoPlanilha!=4 && $curTipoPlanilha!=5)
					{
						$cellVal = date("Y-m-d H:i:s", strtotime($cellVal));
												
						$updateArray["data-status"] = $cellVal;
						
					}else{
						
						$cellVal_toUp =  substr($cellVal, 0, 4) . "-" . substr($cellVal, 4, 2) . "-01 00:00:00";
						$updateArray["data-status"] = $cellVal_toUp;
						
						$cellVal = substr($cellVal, 4, 2) . "-" . substr($cellVal, 0, 4);
						
					}
				}elseif(strstr($value, "status_processo"))
				{

						if(strstr($cellVal, "SEM"))
						{
							$updateArray["status-processo"] = 1;
						
						}else{
							$updateArray["status-processo"] = 2;
						}
						
				}
				
				echo $cellVal;
			?>
		
		</td>
		
		<?php
		}
		?>

		<form id="form-line-<?php echo $i;?>" name="form-line-<?php echo $i;?>">
		
		<?php foreach($updateArray as $key=>$value)
		{
			echo "<input type=\"hidden\" name=\"$key\" value=\"$value\" />";
		}
		?>
		
		</form>
		<?php
			//$upStatus = $objPlanilhas->atualizaNumero($updateArray);

			
			if($upStatus<=0)
			{
				$status="up-falho";
			}
			
		?>
		
		<td id="<?php echo $i;?>" class="<?php echo $status; ?>">FALHOU</td>
		
	</tr>
	<?php
	}
	?>

</table>
</center>
<?php
//var_dump($objPHPExcel);
//echo "..as";
//$loadedSheetNames = $objPHPExcel->getSheetNames();
//var_dump($loadedSheetNames);

/*foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)

{
	echo "<br><br>ROW: " . $worksheet->getHighestRow(); 
    echo "<br>COL: " .  $worksheet->getHighestColumn();
    echo "<br>COL Index: ".  PHPExcel_Cell::columnIndexFromString($worksheet->getHighestColumn());
}*/

//print_r($_POST);

?>
