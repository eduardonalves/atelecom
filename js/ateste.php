<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" height="100%">

<head>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<title>Vento Admin</title>


<!-- 
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
 -->
 
 <script type="text/javascript" src="jquery-1.8.2.min.js"></script>
 <script type="text/javascript">
 
	$(document).ready( function() {
 	
 			$("#t").live("submit", function(event) {
 			
				event.preventDefault();
				//alert($("[name='file']").val());
				var serializedData = $("#t").serialize();
				
				//alert(serializeData);
				request = $.ajax({
					
					url: "teste.php",
					async: false,
					enctype: 'multipart/form-data',
					type: "post",
					data: serializedData,
					success: function(data) {
					$("#conternt").html(data);
					}
				});
			});
	});
 </script>
 
 </head>
 
 <body>
	 
	 <div id="main">
	 <div id="conternt"></div>
	 
	 <div>
	 <form id="t" name="t" enctype="multipart/form-data" method="post">
	 <input type="hidden" name="a" value="avalue" />
	 <input type="hidden" name="b" value="bvalue" />
	 <input type="hidden" name="c" value="cvalue" />
	 <input type="hidden" name="d" value="dvalue" />
	 <input type="file" name="file">
	 <input type="submit">
	 </form>
	 </div>
	 
	 </div>
	 dsds

 <?php
 //phpinfo();
 if(!extension_loaded('curl')){
	$ext = preg_match('/win/i', PHP_OS)? '.dll' : '.so';
	$prefix = ($ext == '.dll')? 'php_' : '';
	if(!dl($prefix.'curl'.$ext)){
		echo 'A extensão curl é necessária para a execução correta desse script';
		exit(0);
	}
}
 $postfields = array(
						'nome' => 'Beraldo',
						'site' => 'www.rberaldo.com.br',
						'arquivo' => '@/tmp/imagem.jpg'
					);
 
// pÃ¡gina que receberÃ¡ a requisiÃ§Ã£o post
$pagina = 'http://localhost/vento-adm-bk/js/teste.php';
 
$ch = curl_init();
 
/*curl_setopt( $ch, CURLOPT_URL, $pagina );
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $postfields );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_HEADER, true );
 
$retorno = curl_exec( $ch );
 
 echo "UU";
curl_close( $ch );*/
?>
 dsd

 
 </body>
 </html>
