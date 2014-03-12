<?
date_default_timezone_set("Brazil/East");

$conexao = mysql_connect('localhost','root','v3nt0adm');
$db = mysql_select_db('test');

session_start();


// Verificar se está logado
if(!isset($_SESSION['usuario'])){ ?>
	
<script type="text/javascript">
window.location = 'index.php'
window.close();
</script>	
	
	
<? } 


$conUSUARIO = "SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'";
$resUSUARIO = mysql_query($conUSUARIO,$conexao);
$USUARIO = mysql_fetch_array($resUSUARIO);


ini_set('upload_max_filesize', '40M');  
ini_set('post_max_size', '40M');  
ini_set('max_input_time', 300);  
ini_set('max_execution_time', 300);







if($_GET['p']){
$consulta = "SELECT * FROM vendas_clarotv WHERE proposta = '".$_GET['p']."'";
$resultado = mysql_query($consulta,$conexao) or die('Erro ao selecionar a tabela');
$linha = mysql_fetch_array($resultado);
} else { ?>
		
<script type="text/javascript">

window.alert('Número de proposta não encontrado!');
window.close();

</script>

	
<? }




if(isset($_POST['upload'])){

$status = $_POST['status'];
$data_marcada0 = explode('/',$_POST['datamarcada']);
$data_marcada = $data_marcada0[2].$data_marcada0[1].$data_marcada0[0];

if($_POST['motivo'] != ''){
$motivo_cancelamento = $_POST['motivo']." (Cancelado na Gravação)";}


$arquivo = date('YmdHis').'-'.$linha['proposta'].'.mp3';

$pasta = "/media/audio/clarotv/";	

foreach($_FILES["gravacao"]["error"] as $key => $error){
	
	if($error == UPLOAD_ERR_OK){

$tmp_name = $_FILES["gravacao"]["tmp_name"][$key];
$gravacao = $_FILES["gravacao"]["name"][$key];


$uploadfile = $pasta . $arquivo;


if(move_uploaded_file($tmp_name, $uploadfile)){ 

$update = mysql_query("UPDATE vendas_clarotv SET gravacao = '".$arquivo."', auditor = '".$USUARIO['id']."', status = '".$status."', data_marcada = '".$data_marcada."', motivo_cancelamento = '".$motivo_cancelamento."' WHERE proposta = '".$linha['proposta']."'");

//LOG

$datadehoje = date("Y-m-d H:i:s");
$insert_log = mysql_query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$datadehoje."','".$_SESSION['usuario']."','Inseriu uma nova gravação no sistema (Proposta: ".$linha['proposta'].").')");

?>
	
<script type="text/javascript">

window.alert('O arquivo "<?= $gravacao ?>" foi enviado com sucesso!');
window.close();

</script>	

<?
}



}}


	
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>UpLoad Gravação</title>
</head>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript" src="js/calendario.js"></script>
<script type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type=text/css href="css/ui-lightness/jquery-ui-1.7.3.custom.css" />

<script type="text/javascript">

function checkarquivo(v){
	
	
	
	}

function checkstatus(v){
	
	if(v == 'GRAVADO'){ document.getElementById('dataid').style.display = '';  
	                    document.getElementById('motivoid').style.display = 'none';
						document.getElementById('motivo').value = '';
						 }
	
	
	else if(v == 'CANCELADO'){ document.getElementById('uploadid').style.display = 'none'; 
	                    	   document.getElementById('dataid').style.display = 'none';
							   document.getElementById('calendario').value = '';  
                          	   document.getElementById('motivoid').style.display = ''}


   else if(v == 'SEM CONTATO'){ document.getElementById('uploadid').style.display = ''; 
	                    	   document.getElementById('dataid').style.display = 'none';
							   document.getElementById('calendario').value = '';  
    	   					   document.getElementById('motivo').value = '';
                          	   document.getElementById('motivoid').style.display = 'none'}	


   else if(v == 'DEVOLVIDO'){ document.getElementById('uploadid').style.display = ''; 
	                    	   document.getElementById('dataid').style.display = 'none';
							   document.getElementById('calendario').value = '';  
    	   					   document.getElementById('motivo').value = '';
                          	   document.getElementById('motivoid').style.display = 'none'}	
	
	else{ document.getElementById('uploadid').style.display = 'none'; 
	      document.getElementById('dataid').style.display = 'none'; 
	      document.getElementById('motivoid').style.display = 'none' }
	
	}



function checkdata(v){
	
	if(v.length == 10){ document.getElementById('uploadid').style.display = ''}
	else{ document.getElementById('uploadid').style.display = 'none' }
	
	}
	
		
function checkmotivo(v){
	
	if(v.length > 8){ document.getElementById('uploadid').style.display = ''}
	else{ document.getElementById('uploadid').style.display = 'none' }
	
	}	



 /*Cria uma função de nome mascara, onde o primeiro argumento passado é um dos
     objetos input O segundo é especificando o tipo de método no qual será tratado*/
    function mascara(o,f){
        v_obj=o;
        v_fun=f;
        setTimeout("execmascara()",1);
    }
    
    function execmascara(){
        /*Pegue o valor do objeto e atribua o resultado da função v_fun; cujo o conteúdo
        da mesma é a função que foi referida e que será utilizada para tratar dos dados*/
        v_obj.value=v_fun(v_obj.value);
    }
    
    function soNumeros(v){
        return v.replace(/\D/g,"");//Exclua tudo que não for numeral e retorne o valor
    }
    
	
    function data(v){
        //Remove tudo o que não é dígito
        v=v.replace(/\D/g,"");
        //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/^(\d{2})(\d)/g,"$1/$2");
        //Coloca hífen entre o quarto e o quinto dígitos
        v=v.replace(/(\d{2})(\d)/,"$1/$2");
        return v;
    }	
	
	
</script>



<body style="font-family:Arial, Helvetica, sans-serif">


<table border="0" width="100%">

<tr valign="bottom" height="40px">
<td style="font-size:18px; color:#999">INSERIR GRAVAÇÃO</td>
</tr>

<tr>
<td><hr size="1" color="#CCCCCC" /></td>
</tr>

</table>

<table border="0">
<form name="gravacoes" action="" enctype="multipart/form-data" method="post">

<tr>
<td>Proposta:</td> <td><input type="text" disabled="disabled" size="40" name="proposta" value="<?= $linha['proposta'];?>" /></td>
</tr>

<tr>
<td>Cliente:</td> <td><input type="text" disabled="disabled" size="40" name="cliente" value="<?= strtoupper($linha['nome']);?>" /></td>
</tr>

<tr>
<td>Telefone:</td> <td><input type="text" disabled="disabled" size="40" name="telefone" value="<?= $linha['telefone'];?>" /></td>
</tr>

<tr height="50px" valign="bottom">
<td>Gravação:</td> <td><input type="file" name="gravacao[]" size="40" /></td>
</tr>


<tr align="left">
<td>Status:</td> 
<td>
<select name="status" onChange="checkstatus(this.value)">
<option value=""></option>
<option value="GRAVADO">GRAVADO</option>
<option value="CANCELADO">CANCELADO</option>
<option value="DEVOLVIDO">DEVOLVIDO</option>
<option value="SEM CONTATO">SEM CONTATO</option>

</select>
</td>
</tr>

<tr id="dataid" align="left" style="display:none">
<td>Agendamento:</td>
<td><input type="text" id="calendario" name="datamarcada" onKeyPress="mascara(this,data)" onChange="checkdata(this.value)" maxlength="10" value="" size="20" /> <span style="font-size:12px; color:#999; font-style:italic">(dd/mm/aaaa)</span>
</td>
</tr>


<tr id="motivoid" align="left" style="display:none">
<td>Motivo:</td>
<td>
<input type="text" size="40" name="motivo" id="motivo" onKeyUp="checkmotivo(this.value)">
</td>
</tr>


<tr id="uploadid" height="40px" valign="bottom" style="display:none">
<td></td>
<td><input type="submit" name="upload" value="Enviar" /></td>
</tr>

</form>
</table>

</body>
</html>
