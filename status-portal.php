<meta name="http-equiv" content="Content-type: text/html; charset=UTF-8"/>

<link rel="stylesheet" type=text/css href="css/tables.css" />
<link rel="stylesheet" type=text/css href="css/paginacao.css" />

<?php
// Verificar se estÃ¡ logado

if(!isset($_SESSION['usuario'])){ ?>

	

<script type="text/javascript">

<!-- window.location = 'index.php' -->

</script>	

	

	

<?php } 

$saidaTexto = new Accents( Accents::UTF_8, Accents::ISO_8859_1 );
$objPlanilhas = new planilhaQualidade($conexao);
?>

<link rel="stylesheet" type="text/css" href="css/custom.css" />
<script type="text/javascript" src="js/pekeUpload.js"></script>

<style type="text/css">



#blackout{position:fixed; top:0px; left:0px; width:100%; height:100%; background-color:#000; z-index:200; opacity: 0.6; display:none; }



#colunas{position:fixed; padding-bottom:20px; width:400px; background-color:#FFF; top:30px; left:-50%; margin: 0 0 0 -200px; z-index:300; display:none; opacity: 0;



-webkit-border-radius: 10px;

border-radius: 10px;



-webkit-box-shadow:  0px 0px 10px 2px #999;

        

box-shadow:  0px 0px 10px 2px #999;

}



.close{position:absolute; right:6px; top:3px; font-size:12px;     background: none repeat scroll 0 0 #B6B6B6;

	border-radius: 15px;

	color: #FFFFFF;

	float: right;

	height: 15px;

	line-height: 15px;

	padding: 3px;

	margin-top:4px;

	text-align: center;

	width: 15px;

	cursor:pointer;}

.colunas-option{
	
	margin-bottom:10px;
	font-size:14px;
	left:20px;
	
	}


</style>

<script type="text/javascript">

	function _GET(name)
	{
	  var url   = window.location.search.replace("?", "");
	  var itens = url.split("&");

	  for(n in itens)
	  {
		if( itens[n].match(name) )
		{
		  return decodeURIComponent(itens[n].replace(name+"=", ""));
		}
	  }
	  return null;
	}

	$(document).ready( function() {
		

		$("#statusForm").live("submit", function(event, x){
		
		if(x!==true) {return false; }
		
		$("[name='original-filename']").val( $("#file").val() );
		});
			
			
			$("#bt-submit").live("click", function(){

				if($("#tipoPlanilha").val()==0)
				{
					alert(decodeURIComponent(escape("Tipo de planilha nÃ£o selecionado.")));
					return false;
				}else
				
				{

					if($("#file").val()=="")
					{
						alert(decodeURIComponent(escape("Arquivo de planilha nÃ£o selecionado.")));
						return false;

					}
				}
			 });

		$("#file").pekeUpload({invalidExtError:'Tipo de arquivo inv&aacute;lido', file:'arquivo', onSubmit:true, multi:false, data:'<?php $curTime = time(); echo $curTime;?>', btnText:'Selecionar arquivo', allowedExtensions:"xls", onFileSuccess: function(file,data){ $("#statusForm").trigger("submit", [true]);}});
		

	});


</script>



<div id="main" style="position:relative; width:1000px; margin-right:auto; margin-left:auto;font-size:14px; color:#999;">
	
	<div id="importar-label" style="position:relative; display:block;padding-top:30px;">
	
		<span style="float:left;">STATUS PORTAL</span>
	
	</div><!-- importar-label -->
	
	<hr style="width:100%; display:block; float:left;" size="1" color="#CCCCCC" />
	
	<div id="conteudo" style="width:1000px; margin-top:50px; margin-left:auto; margin-right:auto; position:relative; background-color:#CCC">
		
		<div id="importar-box" style=" position:relative; display:block; width:850px; margin-left:auto; margin-right:auto; margin-bottom:150px;">
		
			<form id="statusForm" name="statusForm" method="post" action="?p=configuracoes&es=4-update" enctype="multipart/form-data">
				
				<input type="hidden" name="unique-filename" value="<?php echo $curTime; ?>" />
				<input type="hidden" name="original-filename" value="<?php echo $curTime; ?>" />
				
				<label for="tipoPlanilha" style="display:block; width:100%">Tipo de Planilha:</label>
				
				<select id="tipoPlanilha" name="tipoPlanilha" style="min-width:250px; border:1px solid #BFBFBF; float:left; margin-right:20px;">
				
					<option value="0">N&atilde;o Selecionado</option>
				<?php
				
				$tiposPlanilhas = $objPlanilhas->getTiposPlanilhas("nao", 2);
				
				foreach($tiposPlanilhas as $key=>$value)
				{
					if($key!=0)
					{
				?>
					<option value="<?php echo $key; ?>"><?php echo $saidaTexto->Clear($value); ?></option>
				<?php
					}
				}
				?>
				
				</select><!-- tipoPlanilha -->
				
				<input id="file" type="file" name="arquivo" style="border-left: 1px solid #CCCCCC; padding-left:3px;display:block; float:left; clear:both;" />
				
				<input id="bt-submit" type="submit" value="Importar Planilha" style="margin-top:40px; clear:both; min-width:140px; display:block; float:left;" />
				
			</form><!-- statusForm -->
		
		</div><!-- importar-box -->

	</div><!-- conteudo -->

</div><!-- main -->

