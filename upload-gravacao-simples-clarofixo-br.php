<?
date_default_timezone_set("Brazil/East");

ini_set('upload_max_filesize', '40M');  
ini_set('post_max_size', '40M');  
ini_set('max_input_time', 300);  
ini_set('max_execution_time', 300);

$uploaded = 0;

if(isset($_POST['upload']))
{
	
	$arquivo = date('Ymd').'-'.$_GET['id'].'.mp3';
	$pasta = "../audio/clarofixo/orig/";	

	foreach($_FILES["gravacao"]["error"] as $key => $error)
	{
	
		if($error == UPLOAD_ERR_OK)
		{

			$tmp_name = $_FILES["gravacao"]["tmp_name"][$key];
			$gravacao = $_FILES["gravacao"]["name"][$key];

			$uploadfile = $pasta . $arquivo;


			if(move_uploaded_file($tmp_name, $uploadfile))
			{ 
				$uploaded = 1;
			}



		}
	}	
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>UpLoad GravaÃ§Ã£o</title>

<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>

<script type="text/javascript">

$(document).ready( function() {

	$("[name='gravacoes']").trigger("submit");

});

</script>

</head>

<body style="font-family:Arial, Helvetica, sans-serif">

<form name="gravacoes" action="http://vem.vento-consulting.com/upload-gravacao-simples-clarofixo.php?id=<?php echo $_GET["id"]; ?>" enctype="multipart/form-data" method="post">

<input type="hidden" name="uploaded" value="<?php echo $uploaded; ?>" />
<input type="hidden" size="40" name="os" value="<?= $_POST['os'];?>" />
<input type="hidden" size="40" name="esn" value="<?= $_POST['esn'];?>" />
<input type="hidden" size="40" name="cliente" value="<?= strtoupper($_POST['cliente']);?>" />
<input type="hidden" size="40" name="telefone" value="<?= $_POST['telefone'];?>" />
<input type="hidden" name="auditor" value="<?php echo $_POST["auditor"];?>" />
<input type="hidden" name="upload" value="Enviar" />
</form>
</body>
</html>
