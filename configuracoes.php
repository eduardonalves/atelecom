
<script src="js/jquery.Jcrop.min.js"></script>
<script src="js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

<script type="text/javascript">

//Script para Preview e Corte da foto do usuário

var api;
var cropWidth = 40;
var cropHeight = 40;
var img_input, init_coords;

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        img_input = false;
        init_coords = true;

        reader.onload = function (e) {
			
			if(api){
				$(function(){
					api.destroy();
					});
				}
				
				$('#cropbox').attr('src','');

				$('#cropbox').css('width', 'auto');
				$('#cropbox').css('height', 'auto');
				$('#cropbox').css('max-width', '250px');
				$('#cropbox').attr('src', e.target.result);
				$("#cropbox").css('visibility', 'visible')
				
				img_input = true;
				
                $(function(){
				
				// inicializa JCrop
				$('#cropbox').Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords
                },function(){
					api = this;
				});

				// seta a área de seleção
				api.animateTo([0,0,cropWidth,cropHeight]);
				
				});
				

			}

		reader.readAsDataURL(input.files[0]);
	}
}

//Verifica se uma foto foi adicionada e chama readURL
$(function(){
	$("#foto_input").change(function(){
		readURL(this);
	});
});

//atualiza coordenadas
function updateCoords(c)
{
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
    init_coords = false;
};
 
//verifica se a foto foi selecionada para corte
function checkCoords()
{
	if(img_input){
		if(parseInt($('#w').val()) && !init_coords) return true;
		alert('Selecione a região para recortar.');
		return false;
	}
};

</script>

<?

header("Content-type: text/html; charset=UTF-8", true);
if(isset($_POST['nome'])){

if(!$_POST['nome'] || !$_POST['email'] || !$_POST['senha']){

?>

<script type="text/javascript">

window.alert("ERRO: Todos os campos devem ser preenchidos");

</script>

<?	
	
}else{
	
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
extract($_FILES);

// Validação da foto - INÍCIO
		
		if (! empty($foto['name'])) {
		
			if (! preg_match('/^image\/(jpeg|jpg)$/', $foto["type"])) {
				?>
				<script type="text/javascript">

				window.alert("ERRO: Formato não suportado (formatos aceitos: JPG, JPEG).");

				</script>
				<?
				die();
			}
		
		//Pega extensão da foto
		//preg_match('/\.(jpeg|jpg){1}$/i', $foto['name'], $ext);
		
		$ext = "jpg";
		
		//Gera um nome único para a imagem
		$nome_imagem = md5(uniqid(time()));
		$nome_imagem_completo = $nome_imagem . "." . $ext;
		
		//Destino da imagem
		$caminho_imagem = "img/fotos/" . $nome_imagem_completo;
		
		//Faz o upload da imagem para seu respectivo caminho
		move_uploaded_file($foto["tmp_name"], $caminho_imagem);
		
		//INÍCIO TRATAMENTO DA FOTO
		
		//obtém a imagem recortada pelo usuário a partir das coordenadas fornecidas, redimensionando caso seja necessário
	
		if($foto["type"]=="image/jpeg" || $foto["type"]=="image/jpg"){
				$img_antiga = imagecreatefromjpeg($caminho_imagem);
			}

		$x = imagesx($img_antiga);
		$y = imagesy($img_antiga);
		
		$img_recorte = imagecreatetruecolor(150,150);
		
		if($x>250){
			$largura = 250;
			$altura = (int) (($largura * $y) / $x);
			$img_antiga_r = imagecreatetruecolor($largura, $altura);
			imagecopyresampled($img_antiga_r,$img_antiga,0,0,0,0, $largura, $altura, $x, $y);
			imagecopyresampled($img_recorte,$img_antiga_r,0,0,$_POST['x'],$_POST['y'], 150, 150,$_POST['w'],$_POST['h']);
			}
		else{
			imagecopyresampled($img_recorte,$img_antiga,0,0,$_POST['x'],$_POST['y'], 150, 150,$_POST['w'],$_POST['h']);
			}
		
		//Pega as dimensões originais do recorte
		$x = imagesx($img_recorte);
		$y = imagesy($img_recorte);
			
		//Define as dimensões finais da imagem
		$largura = 40;
		$altura = (int) (($largura * $y) / $x);
		
		//Redimensiona para 40x40
		
		$img_nova = imagecreatetruecolor($largura,$altura);
		imagecopyresampled($img_nova, $img_recorte, 0, 0, 0, 0, $largura, $altura, $x, $y);
		$img_nova2 = imagecreatetruecolor(40,40);
		imagecopyresampled($img_nova2, $img_nova, 0, 0, 0, 0, $largura, $altura, 40, 40);
			
		if($foto["type"]=="image/jpeg" || $foto["type"]=="image/jpg"){
			imagejpeg($img_nova2, $caminho_imagem, 100);	
		}
				
		imagedestroy($img_nova);
		imagedestroy($img_nova2);
		imagedestroy($img_recorte);
		imagedestroy($img_antiga);
		
		//FIM DO TRATAMENTO DA FOTO
		
		$inserir = $conexao->query("UPDATE usuarios SET nome = '".$nome."', email = '".$email."', senha = '".$senha."', foto = '".$nome_imagem."' WHERE id = '".$USUARIO['id']."'") or die("Erro ao atualizar os dados!");
		
		}
else
{
$inserir = $conexao->query("UPDATE usuarios SET nome = '".$nome."', email = '".$email."', senha = '".$senha."' WHERE id = '".$USUARIO['id']."'") or die("Erro ao atualizar os dados!");
}
?>

<script type="text/javascript">

window.alert("Configurações realizadas com sucesso!");

window.location = '?p=configuracoes';

</script>

<?
	
}}


//////////////////////////////////
//////Menu Lateral Labels///////
//////////////////////////////////

$es1 = 'Dados de Usuário';
$es2 = 'Definir Metas';
$es3 = 'Lista Operadores';
//$es4 = 'Status Portal';
$es5 = 'Lista Usuários';

?>


<style type="text/css">

input[type="submit"]{ padding:7px; border:1px solid #CCC; color:#777;
 background: #ededed; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSI4JSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUzJSIgc3RvcC1jb2xvcj0iI2ZjZmNmYyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlZGVkZWQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #ffffff 8%, #fcfcfc 53%, #ededed 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(8%,#ffffff), color-stop(53%,#fcfcfc), color-stop(100%,#ededed)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 ); /* IE6-8 */
}

input[type="submit"]:hover{ border:1px solid #AAA; color:#434343; cursor:pointer;}

input[type="submit"]:active{ background:#ededed;}

</style>


<center>

<table border="0" width="100%">
<tr>
<td>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr valign="top">

<!-- /////////// Menu Lateral ////////// -->
<td class="menulateral" width="189px" bgcolor="#999999">

<table width="100%" id="mlateral" border="0" cellpadding="0" cellspacing="0">

<tr height="100px">
<td></td>
</tr>

<tr height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=1'" class="<? if($_GET['es'] == '1' || $_GET['es'] == ''){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es1; ?></td>
</tr>

<? if($USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){?>
<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=2'"  class="<? if($_GET['es'] == '2'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es2; ?></td>
</tr>
<? } ?>

<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=3'"  class="<? if($_GET['es'] == '3'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es3; ?></td>
</tr>

<? if($USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){?>
<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=5'"  class="<? if($_GET['es'] == '5'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es5; ?></td>
</tr>
<? } ?>


<? /* if($USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){?>
<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=4'"  class="<? if($_GET['es'] == '4' || $_GET['es'] == '4-update'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es4; ?></td>
</tr>
<? } */?>

</table>

</td>

<td>

<? if($_GET['es'] == '1' || !$_GET['es']){ ?>
<center>
<table width="90%" border="0" height="500px">
<tr valign="top">
<td>

<table width="1000px" border="0" align="center">

<form name="config" action="" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
<tr height="60px" valign="bottom" align="left">
<td colspan="2" style=" font-size:18px; color:#999; font-weight:bold">Configura&ccedil;&otilde;es <hr size="1" color="#CCCCCC" /></td>
</tr>

</table>
<div style="width: 700px; float: left;">
<table width="700px" border="0" align="left">
<tr align="left">
<td>Nome:</td>
<td><input type="text" name="nome" value="<?= $USUARIO['nome']; ?>" size="40"></td>
</tr>

<tr align="left">
<td>Email:</td>
<td><input type="text" name="email" value="<?= $USUARIO['email']; ?>" size="40"></td>
</tr>

<tr align="left">
<td>Login:</td>
<td><?= $USUARIO['login']; ?></td>
</tr>

<tr align="left">
<td>Senha:</td>
<td><input type="password" name="senha" value="" size="40"></td>
</tr>

<tr align="left" height="40px" style="line-height: 40px;">
<td>Trocar Foto:</td>
<td><input type="file" id="foto_input" name="foto" size="25" /></td>
</tr>

<tr height="50px" valign="bottom" align="left">
<td></td>
<td><input type="submit" name="salvar" value="Salvar" /></td>
</tr>

<input type="hidden" id="x" name="x" />
<input type="hidden" id="y" name="y" />
<input type="hidden" id="w" name="w" />
<input type="hidden" id="h" name="h" />

</form>
</table>
</div>
<div style="width: 250px; float: right; margin-right:20px">
<img src="#" id="cropbox" style="visibility: hidden;"/>
</div>
</td>
</tr></table>

</center>

<? } else if($_GET['es'] == '2' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){ include "definir-metas.php"; } 

else if($_GET['es'] == '3'){ include "lista-operadores.php"; } 

else if($_GET['es'] == '5'){ include "lista-usuarios.php"; } 

/*
 * else if($_GET['es'] == '4'){ include "status-portal.php"; } 
 * else if($_GET['es'] == '4-update'){ include "status-portal-update.php"; } 
 * 
 */

?>

</td>
</tr>
</table>
</center>
