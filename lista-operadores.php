<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

if($_GET['p'] != 'configuracoes'){ ?>

<script>
window.location = "?p=configuracoes&es=3";	
</script>
<?
	
}
?>

<link rel="stylesheet" href="css/tables.css" />

<script type="text/javascript">

function editar(id){

document.getElementById('tr'+id).style.display = 'none';
document.getElementById('tredit'+id).style.display = '';
		
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
    
    function telefone(v){
        //Remove tudo o que não é dígito
        v=v.replace(/\D/g,"");
        //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2");
        //Coloca hífen entre o quarto e o quinto dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2");
        //retorne o resultado
        return v;
    }
	
    function cpf(v){
        //Remove tudo o que não é dígito
        v=v.replace(/\D/g,"");
        //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/^(\d{3})(\d)/g,"$1.$2");
        //Coloca hífen entre o quarto e o quinto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2");
        //retorne o resultado
		v=v.replace(/(\d{3})(\d)/,"$1-$2");
        return v;
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


<?

if(isset($_POST['editar'])){

$IDoperador = $_POST['idoperador'];
	
$NOMEoperador = $_POST['nomeoperador'];
$IDmonitor = $_POST['nomemonitor'];
$grupo = $_POST['grupo'];

$data_admissao0 = explode('/',$_POST['dataadmissao']);
$data_admissao = $data_admissao0[2].'-'.$data_admissao0[1].'-'.$data_admissao0[0];

$data_efetivacao0 = explode('/',$_POST['dataefetivacao']);
$data_efetivacao = $data_efetivacao0[2].'-'.$data_efetivacao0[1].'-'.$data_efetivacao0[0];

$data_nascimento0 = explode('/',$_POST['datanascimento']);
$data_nascimento = $data_nascimento0[2].'-'.$data_nascimento0[1].'-'.$data_nascimento0[0];

$tipo_contrato = $_POST['tipocontrato'];
$status = $_POST['status'];
$email = $_POST['email'];

if (! preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $email) && $email!='') {			
			die('Endereço de email inválido.');
		}

$telefone1 = $_POST['telefone1'];
$telefone2 = $_POST['telefone2'];

if($NOMEoperador != '' && $IDmonitor != '' && $grupo != '' && $status != '' && $email != ''){
	$update = $conexao->query("UPDATE operadores SET nome = '".$NOMEoperador."', monitor = '".$IDmonitor."', grupo = '".$grupo."', tipo_contrato = '".$tipo_contrato."', data_admissao = '".$data_admissao."', data_efetivacao = '".$data_efetivacao."', status = '".$status."', email = '".$email."', telefone = '".$telefone1."', telefone2 = '".$telefone2."', data_nascimento = '".$data_nascimento."' WHERE operador_id = '".$IDoperador."'");

?>

<script>
window.alert('Operador alterado com sucesso!');
</script>
	
<?	
	}
else { ?>

<script>
window.alert('ERRO: Algum campo não foi preenchido corretamente!');
</script>	
	
<?	
}}

if(isset($_POST['salvar'])){
	
$login = $_POST['login'];
$nome = $_POST['nomeoperador'];
$cpf = $_POST['icpf'];
$grupo = $_POST['grupo'];
$nmonitor = $_POST['nomemonitor'];
$contrato = $_POST['contrato'];

$data_admissao0 = explode('/',$_POST['dataadmissao']);
$data_admissao = $data_admissao0[2].'-'.$data_admissao0[1].'-'.$data_admissao0[0];

$data_efetivacao0 = explode('/',$_POST['dataefetivacao']);
$data_efetivacao = $data_efetivacao0[2].'-'.$data_efetivacao0[1].'-'.$data_efetivacao0[0];

$data_nascimento0 = explode('/',$_POST['datanascimento']);
$data_nascimento = $data_nascimento0[2].'-'.$data_nascimento0[1].'-'.$data_nascimento0[0];

$status = $_POST['status'];
$email = $_POST['email'];

echo $nmonitor;
if (! preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $email) && $email!='') {			
			die('Endereço de email inválido.');
		}

$telefone1 = $_POST['telefone1'];
$telefone2 = $_POST['telefone2'];

if($login != '' && $nome != '' && $grupo != '' && ($cpf!= '' && $cpf!='000.000.000-00') && ($data_admissao!='' && $data_admissao<=date('Y-m-d')) && ($data_nascimento!='' && $data_nascimento<=date('Y-m-d')) && $nmonitor != '' && $status != '' && $telefone1 != '' && $telefone2 != '' && $email != ''){

	$insert = $conexao->query("INSERT INTO operadores (login,nome,cpf,data_admissao,data_efetivacao,grupo,monitor,status, email, telefone, telefone2, data_nascimento) VALUES ('".$login."','".$nome."','".$cpf."','".$data_admissao."','".$data_efetivacao."','".$grupo."','".$nmonitor."','".$status."','".$email."','".$telefone1."','".$telefone2."','".$data_nascimento."') ");
	
?>

<script>
window.alert('Operador inserido com sucesso!');
</script>
	
<?	
	
} else { ?>

<script>
window.alert('ERRO: Algum campo não foi preenchido corretamente!');
</script>	
	
<?	
}}


if(isset($_POST['logins'])){
	
	
$logins = explode(',',$_POST['logins']);

if($_POST['grupo'] != ''){ $grupo = ", grupo = '".$_POST['grupo']."'";}


if($_POST['nomemonitor'] != ''){ $monitor = ", monitor = '".$_POST['nomemonitor']."'"; }


if($_POST['tipocontrato'] != ''){ $contrato = ", tipo_contrato = '".$_POST['tipocontrato']."'"; }


if($_POST['status'] != ''){ $status = ", status = '".$_POST['status']."'";}

$n=0;
foreach($logins as $lo){ 
	
	if($lo != ''){
	$insert = $conexao->query("UPDATE operadores SET login = '".$lo."' ".$grupo.$monitor.$contrato.$status." WHERE login = '".$lo."'");
	$n++;
	}
	}	
	
?>

<script type="text/javascript">
alert("<?= $n;?> Operador(es) Modificado(s)!");
window.location = "?p=configuracoes&es=3"
</script>

<?	
	
	}

?>

<br />
<center>

<script type="text/javascript">

function addcheck(l){
		current = document.getElementById('logins').value;
	
	if(current.indexOf(l) != -1){ document.getElementById('logins').value = current.replace(l+",","");} else {
	
	document.getElementById('logins').value = current + l + ',';}
	}

</script>


<!-- INSERIR -->
<form name="novooperador" action="" method="post">
<input type="hidden" name="salvar" />
<? $conLOGIN = $conexao->query("SELECT * FROM operadores ORDER BY ABS(login) DESC");
$ultLOGIN = mysql_fetch_array($conLOGIN);
?>
<input type="hidden" value="<?= ($ultLOGIN['login']+1);?>" name="login" />
<table border="0" width="900px"style="color:#999; font-size:14px;">
<tr>
	<td colspan="2" style="color:#999; font-size:18px;">Inserir Operador</td>
</tr>


<tr bgcolor="#333" style="color:#FFF">
	<td>Nome:</td>
	<td>CPF :</td>
	<td>Produto:</td>
	<td>Monitor:</td>
</tr>

<tr bgcolor="#ededed">
	<td><input type="text" id="nome" name="nomeoperador" size="15" /></td>
	<td><input type="text" id="idcpf" name="icpf" onKeyPress="mascara(this,cpf)" maxlength="14" size="15" /></td>
	<td>
		<select name="grupo" id="grupo">
			<option value=""></option>
			<option value="0004" <? if($OPERADOR['grupooperador'] == '0004'){ ?>selected="selected" <? } ?>>Oi</option>
			<option value="0001|0004" <? if($OPERADOR['grupooperador'] == '0001|0004'){ ?>selected="selected" <? } ?>>Claro TV e Oi</option>
			<option value="0003|0004" <? if($OPERADOR['grupooperador'] == '0003|0004'){ ?>selected="selected" <? } ?>>Claro Fixo e Oi</option>
			<option value="0001" <? if($OPERADOR['grupooperador'] == '0001'){ ?>selected="selected" <? } ?>>Claro TV</option>
			<option value="0002" <? if($OPERADOR['grupooperador'] == '0002'){ ?>selected="selected" <? } ?>>Claro 3G</option>
			<option value="0003" <? if($OPERADOR['grupooperador'] == '0003'){ ?>selected="selected" <? } ?>>Claro FIXO</option>
			<option value="0001|0002" <? if($OPERADOR['grupooperador'] == '0001|0002'){ ?>selected="selected" <? } ?>>Claro TV e Claro 3G</option>
			<option value="0001|0003" <? if($OPERADOR['grupooperador'] == '0001|0003'){ ?>selected="selected" <? } ?>>Claro TV e Claro FIXO</option>
			<option value="0002|0003" <? if($OPERADOR['grupooperador'] == '0002|0003'){ ?>selected="selected" <? } ?>>Claro 3G e Claro Fixo</option>
			<option value="0001|0002|0003" <? if($OPERADOR['grupooperador'] == '0001|0002|0003'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G e Claro Fixo</option>
			<option value="0001|0002|0003|0004" <? if($OPERADOR['grupooperador'] == '0001|0002|0003|0004'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G, Claro Fixo e Oi</option>
		</select>
	</td>
	<td>
	<select name="nomemonitor">
	<option value=""></option>
	
	<?
	
	if($USUARIO['tipo_usuario'] == 'MONITOR'){ $ifmonitor = "&& id = ".$USUARIO['id']; }
	
	$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario = 'MONITOR' || tipo_usuario = 'MONITORBO' ".$ifmonitor." && status != 'DESLIGADO' ORDER BY nome");
	while($MONITOR = mysql_fetch_array($conMONITORES)){
	
	?>
	<option value="<?= $MONITOR['id']; ?>" <? if($OPERADOR['idmonitor'] == $MONITOR['id']){ ?>selected="selected" <? } ?>><?= $MONITOR['nome']; ?></option>
	<? } ?>
	
	</select>
	</td>
</tr>
<tr>
	<td>Data Admissão:</td>
	<td>Tipo Contrato:</td>
	<td>Status:</td>
	<td>Email:</td>
	<td>
</tr>
<tr>
	<td>
		<input type="text" name="dataadmissao"  onKeyPress="mascara(this,data)" maxlength="10" value="" placeholder="ex:(dd/mm/aaaa)" />
	</td>
	<td>
		<select name="tipocontrato">
			<option value=""></option>
			<option value="TREINAMENTO">TREINAMENTO</option>
			<option value="EFETIVO">EFETIVO</option>
		</select>
	</td>
	<td>
		<select name="status">
		<option value=""></option>
		<option value="ATIVO" <? if($OPERADOR['statusoperador'] == 'ATIVO'){ ?>selected="selected" <? } ?>>ATIVO</option>
		<option value="DESLIGADO" <? if($OPERADOR['statusoperador'] == 'DESLIGADO'){ ?>selected="selected" <? } ?>>DESLIGADO</option>
		</select>
	</td>
	<td><input type="text" id="email" name="email" onKeyPress="mascara(this,email)" maxlength="35" value="" placeholder="usuario@host.com.br" /></td>

</tr>

<tr>
	<td>Data de Nascimento:</td>
	<td>Telefone 1:</td>
	<td>Telefone 2:</td>
</tr>

<tr>
	<td><input type="text" name="datanascimento" onKeyPress="mascara(this,data)" maxlength="10" value="" placeholder="ex:(dd/mm/aaaa)" /></td>
	<td><input type="text" name="telefone1"  onKeyPress="mascara(this,telefone)" maxlength="14" value="" /></td>
	<td><input type="text" name="telefone2"  onKeyPress="mascara(this,telefone)" maxlength="14" value="" /></td>
	<td align="left" width="100%" style="cursor:pointer" title="Salvar" onclick="javascript:document.novooperador.submit();"><img src="img/icone-salvar.png" width="20" style="cursor:pointer" title="Salvar" onclick="javascript:document.novooperador.submit();" />    Salvar</td>
</tr>

<tr>
	<td colspan="100">
	<hr />
	</td>
</tr>

</table>
</form>
<br>
<!-- FIM INSERIR -->

<!-- PARA SELECIONADOS -->

<form name="checkactions" action="" method="post">
<input type="hidden" name="p" value="<?= $_GET['p'];?>" />
<input type="hidden" name="es" value="<?= $_GET['es'];?>" />
<input type="hidden" id="logins" name="logins" />


<table border="0" width="900px"style="color:#999; font-size:14px;" bgcolor="#f6f6f6">
<tr>
<td colspan="2" style="color:#999; font-size:18px;">Editar Selecionados</td>
</tr>


<tr bgcolor="#333" style="color:#FFF">
<td>Produto:</td>
<td>Monitor:</td>
<td>Tipo Contrato:</td>
<td>Status:</td>
<td>
</tr>

<tr bgcolor="#CCC">
<td>
<select name="grupo" id="grupo">
<option value=""></option>
<option value="0004" <? if($OPERADOR['grupooperador'] == '0004'){ ?>selected="selected" <? } ?>>Oi</option>
<option value="0001|0004" <? if($OPERADOR['grupooperador'] == '0001|0004'){ ?>selected="selected" <? } ?>>Claro TV e Oi</option>
<option value="0003|0004" <? if($OPERADOR['grupooperador'] == '0003|0004'){ ?>selected="selected" <? } ?>>Claro Fixo e Oi</option>
<option value="0001" <? if($OPERADOR['grupooperador'] == '0001'){ ?>selected="selected" <? } ?>>Claro TV</option>
<option value="0002" <? if($OPERADOR['grupooperador'] == '0002'){ ?>selected="selected" <? } ?>>Claro 3G</option>
<option value="0003" <? if($OPERADOR['grupooperador'] == '0003'){ ?>selected="selected" <? } ?>>Claro FIXO</option>
<option value="0001|0002" <? if($OPERADOR['grupooperador'] == '0001|0002'){ ?>selected="selected" <? } ?>>Claro TV e Claro 3G</option>
<option value="0001|0003" <? if($OPERADOR['grupooperador'] == '0001|0003'){ ?>selected="selected" <? } ?>>Claro TV e Claro FIXO</option>
<option value="0002|0003" <? if($OPERADOR['grupooperador'] == '0002|0003'){ ?>selected="selected" <? } ?>>Claro 3G e Claro Fixo</option>
<option value="0001|0002|0003" <? if($OPERADOR['grupooperador'] == '0001|0002|0003'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G e Claro Fixo</option>
<option value="0001|0002|0003|0004" <? if($OPERADOR['grupooperador'] == '0001|0002|0003|0004'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G, Claro Fixo e Oi</option>

</select>
</td>
<td>
<select name="nomemonitor">
<option value=""></option>

<?

$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario = 'MONITOR' || tipo_usuario = 'MONITORBO' && status != 'DESLIGADO' ORDER BY nome");
while($MONITOR = mysql_fetch_array($conMONITORES)){

?>
<option value="<?= $MONITOR['id']; ?>" <? if($OPERADOR['idmonitor'] == $MONITOR['id']){ ?>selected="selected" <? } ?>><?= $MONITOR['nome']; ?></option>

<? } ?>

</select>
</td>

<td>
<select name="tipocontrato">
<option value=""></option>
<option value="TREINAMENTO">TREINAMENTO</option>
<option value="EFETIVO">EFETIVO</option>
</select>
</td>
<td>
<select name="status">
<option value=""></option>
<option value="ATIVO" <? if($OPERADOR['statusoperador'] == 'ATIVO'){ ?>selected="selected" <? } ?>>ATIVO</option>
<option value="DESLIGADO" <? if($OPERADOR['statusoperador'] == 'DESLIGADO'){ ?>selected="selected" <? } ?>>DESLIGADO</option>
</select>
</td>

<td>
	<img src="img/icone-salvar.png" width="20" style="cursor:pointer" title="Salvar" onclick="javascript:document.checkactions.submit();" />
</td>
</tr>

<tr height="10px">
<td colspan="100">
</td>
</tr>

</table>
</form>

<!-- FIM PARA SELECIONADOS -->

<!-- LISTA -->
<table border="0" width="900px">

	<input type="hidden" name="o" value="<?= $_GET['o'];?>" />

	<tr style="color:#FFF; font-size:14px; font-weight:bold; cursor:pointer;" class="tr1" align="center">
		<td></td>
		
		<td title="Login" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'ABS(operadores.login) ASC'){ echo 'ABS(operadores.login) ASC'; } 
		else { echo 'ABS(operadores.login) DESC'; }?>'">Login<? if($_GET['o'] == 'ABS(operadores.login) DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'ABS(operadores.login) ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

		<td title="Data Admissão" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.data_admissao ASC'){ echo 'operadores.data_admissao ASC'; } 
		else { echo 'operadores.data_admissao DESC'; }?>'">Data Admissão<? if($_GET['o'] == 'operadores.data_admissao DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.data_admissao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

		<td title="Data Efetivação" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.data_efetivacao ASC'){ echo 'operadores.data_efetivacao ASC'; } 
		else { echo 'operadores.data_efetivacao DESC'; }?>'">Data Efetivação<? if($_GET['o'] == 'operadores.data_efetivacao DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.data_efetivacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
		
		<td title="Data Nascimento" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.data_nascimento ASC'){ echo 'operadores.data_nascimento ASC'; } 
		else { echo 'operadores.data_nascimento DESC'; }?>'">Data Nascimento<? if($_GET['o'] == 'operadores.data_nascimento DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.data_nascimento ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
		
		<td title="Nome do Operador" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.nome ASC'){ echo 'operadores.nome ASC'; } 
		else { echo 'operadores.nome DESC'; }?>'">Nome do Operador<? if($_GET['o'] == 'operadores.nome DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.nome ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

		<td title="Email" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.email ASC'){ echo 'operadores.email ASC'; } 
		else { echo 'operadores.email DESC'; }?>'">E-mail<? if($_GET['o'] == 'operadores.email DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.email ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

		<td title="CPF" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.cpf ASC'){ echo 'operadores.cpf ASC'; } 
		else { echo 'operadores.cpf DESC'; }?>'">CPF<? if($_GET['o'] == 'operadores.cpf DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.cpf ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

		<td title="Telefone 1" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.telefone ASC'){ echo 'operadores.telefone ASC'; } 
		else { echo 'operadores.telefone DESC'; }?>'">Telefone 1<? if($_GET['o'] == 'operadores.telefone DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.telefone ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

		<td title="Telefone 2" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.telefone2 ASC'){ echo 'operadores.telefone2 ASC'; } 
		else { echo 'operadores.telefone2 DESC'; }?>'">Telefone 2<? if($_GET['o'] == 'operadores.telefone2 DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.telefone2 ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

		<td title="Monitor" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'usuarios.nome ASC'){ echo 'usuarios.nome ASC'; } 
		else { echo 'usuarios.nome DESC'; }?>'">Monitor<? if($_GET['o'] == 'usuarios.nome DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'usuarios.nome ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
		
		<td title="Produto" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.grupo ASC'){ echo 'operadores.grupo ASC'; } 
		else { echo 'operadores.grupo DESC'; }?>'">Produto<? if($_GET['o'] == 'operadores.grupo DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.grupo ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
		
		<td title="Tipo Contrato" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.tipo_contrato ASC'){ echo 'operadores.tipo_contrato ASC'; } 
		else { echo 'operadores.tipo_contrato DESC'; }?>'">Tipo Contrato<? if($_GET['o'] == 'operadores.tipo_contrato DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.tipo_contrato ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>	
		
		<td title="Status" onclick="window.location = '?p=configuracoes&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>
		&o=<? if($_GET['o'] != 'operadores.status ASC'){ echo 'operadores.status ASC'; } 
		else { echo 'operadores.status DESC'; }?>'">Status<? if($_GET['o'] == 'operadores.status DESC'){ ?>
		<img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operadores.status ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
		
		<td></td>
	</tr>


<?

$class = "tr2";

$ordem = $_GET['o'];

if($ordem == ''){ $ordem = ' operadores.nome ASC';}

if($USUARIO['tipo_usuario'] == 'MONITOR'){

	$QUERY = "AND usuarios.id = '".$USUARIO['id']."'
			  ORDER BY ".$ordem;
}else{
	$QUERY = "ORDER BY ".$ordem;
}

$conOPERADORES = $conexao->query("SELECT *, operadores.login AS loginoperador,
											DATE_FORMAT(operadores.data_admissao, '%d/%m/%Y') AS dataadmissao,
											DATE_FORMAT(operadores.data_efetivacao, '%d/%m/%Y') AS dataefetivacao,
											DATE_FORMAT(operadores.data_nascimento, '%d/%m/%Y') AS datanascimento,
											operadores.nome AS nomeoperador, 
											operadores.email AS email,
											operadores.telefone AS telefone1,
											operadores.telefone2 AS telefone2,
											operadores.cpf AS cpfoperador, 
  											operadores.operador_id AS idoperador,
											usuarios.nome AS nomemonitor, 
											usuarios.id AS idmonitor,
											operadores.grupo AS grupooperador,
											operadores.tipo_contrato AS contratooperador,
											operadores.status AS statusoperador
											FROM operadores 
											INNER JOIN usuarios ON operadores.monitor = usuarios.id 
											WHERE operadores.status != 'DESLIGADO'".$QUERY								
											);
											
while($OPERADOR = mysql_fetch_array($conOPERADORES)){


if($class == "tr2"){ $class = "tr3";} else { $class = "tr2";}

?>

<tr class="<?= $class;?>" align="center" id="tr<?= $OPERADOR['idoperador'];?>">
<td><input type="checkbox" name="checkop" onclick="addcheck(this.value)" value="<?= $OPERADOR['loginoperador'];?>" /></td>
<td><?= $OPERADOR['loginoperador'];?></td>
<td><?= $OPERADOR['dataadmissao'];?></td>
<td><?= $OPERADOR['dataefetivacao'];?></td>
<td><?= $OPERADOR['datanascimento'];?></td>
<td><?= $OPERADOR['nomeoperador'];?></td>
<td><?= $OPERADOR['email'];?></td>
<td><?= $OPERADOR['cpfoperador'];?></td>
<td><?= $OPERADOR['telefone1'];?></td>
<td><?= $OPERADOR['telefone2'];?></td>

<td><?= $OPERADOR['nomemonitor'];?></td>
<td>
<? if($OPERADOR['grupooperador'] == '0004'){$produto = 'Oi';}
else if($OPERADOR['grupooperador'] == '0001|0004'){$produto = 'Claro TV e Oi';}
else if($OPERADOR['grupooperador'] == '0003|0004'){$produto = 'Claro Fixo e Oi';}
else if($OPERADOR['grupooperador'] == '0001'){$produto = 'Claro TV';}
else if($OPERADOR['grupooperador'] == '0002'){$produto = 'Claro 3G';}
else if($OPERADOR['grupooperador'] == '0003'){$produto = 'Claro FIXO';}
else if($OPERADOR['grupooperador'] == '0001|0002'){$produto = 'Claro TV e Claro 3G';}
else if($OPERADOR['grupooperador'] == '0001|0003'){$produto = 'Claro TV e Claro FIXO';}
else if($OPERADOR['grupooperador'] == '0002|0003'){$produto = 'Claro 3G e Claro Fixo';}
else if($OPERADOR['grupooperador'] == '0001|0002|0003'){$produto = 'Claro TV, Claro 3G e Claro Fixo';}
else if($OPERADOR['grupooperador'] == '0001|0002|0003|0004'){$produto = 'Claro TV, Claro 3G, Claro Fixo e Oi';}

echo $produto;
?>

</td>
<td><?= $OPERADOR['contratooperador'];?></td>
<td><?= $OPERADOR['statusoperador'];?></td>

<td><img src="img/icone-editar.png" onclick="editar(<?= $OPERADOR['idoperador'];?>)" style="cursor:pointer" /></td>
</tr>


<form action="" method="post" name="form<?= $OPERADOR['idoperador'];?>">
<input type="hidden" name="editar" />
<tr class="<?= $class;?>" align="center" id="tredit<?= $OPERADOR['idoperador'];?>" style="display:none;">
<td></td>
<td><?= $OPERADOR['loginoperador'];?></td>

<td><input style="font-size: 11px;" type="text" name="dataadmissao" onKeyPress="mascara(this,data)" maxlength="10" size="10" value="<?= $OPERADOR['dataadmissao'];?>" /></td>

<td><input style="font-size: 11px;" type="text" name="dataefetivacao" onKeyPress="mascara(this,data)" maxlength="10" size="10" value="<?= $OPERADOR['dataefetivacao'];?>" /></td>

<td><input style="font-size: 11px;" type="text" name="datanascimento" onKeyPress="mascara(this,data)" maxlength="10" size="10" value="<?= $OPERADOR['datanascimento'];?>" /></td>

<td>
<input type="hidden" name="idoperador" value="<?= $OPERADOR['idoperador'];?>" />
<input style="font-size: 11px;" type="text" name="nomeoperador" value="<?= $OPERADOR['nomeoperador'];?>" /></td>
<td><input style="font-size: 11px;" type="text" name="email" onKeyPress="mascara(this,email)" maxlength="35" size="10" value="<?= $OPERADOR['email'];?>" /></td>
<td><?= $OPERADOR['cpfoperador'];?></td>
<td><input style="font-size: 11px;" type="text" name="telefone1" size="10" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $OPERADOR['telefone1'];?>" /></td>
<td><input style="font-size: 11px;" type="text" name="telefone2" size="10" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $OPERADOR['telefone2'];?>" /></td>

<td>
<select style="font-size: 11px;" name="nomemonitor">
<?

$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario = 'MONITOR' && status != 'DESLIGADO' ORDER BY nome");
while($MONITOR = mysql_fetch_array($conMONITORES)){

?>
<option style="font-size: 11px;" value="<?= $MONITOR['id']; ?>" <? if($OPERADOR['idmonitor'] == $MONITOR['id']){ ?>selected="selected" <? } ?>><?= $MONITOR['nome']; ?></option>

<? } ?>

</select>
</td>
<td>
<?   if($OPERADOR['grupooperador'] == '0004'){$produto = 'Oi';}
else if($OPERADOR['grupooperador'] == '0001|0004'){$produto = 'Claro TV e Oi';}
else if($OPERADOR['grupooperador'] == '0003|0004'){$produto = 'Claro Fixo e Oi';}
else if($OPERADOR['grupooperador'] == '0001'){$produto = 'Claro TV';}
else if($OPERADOR['grupooperador'] == '0002'){$produto = 'Claro 3G';}
else if($OPERADOR['grupooperador'] == '0003'){$produto = 'Claro FIXO';}
else if($OPERADOR['grupooperador'] == '0001|0002'){$produto = 'Claro TV e Claro 3G';}
else if($OPERADOR['grupooperador'] == '0001|0003'){$produto = 'Claro TV e Claro FIXO';}
else if($OPERADOR['grupooperador'] == '0002|0003'){$produto = 'Claro 3G e Claro Fixo';}
else if($OPERADOR['grupooperador'] == '0001|0002|0003'){$produto = 'Claro TV, Claro 3G e Claro Fixo';}
else if($OPERADOR['grupooperador'] == '0001|0002|0003|0004'){$produto = 'Claro TV, Claro 3G, Claro Fixo e Oi';}

?>

<select style="font-size: 11px;" name="grupo">
<option value="0004" <? if($OPERADOR['grupooperador'] == '0004'){ ?>selected="selected" <? } ?>>Oi</option>
<option value="0001|0004" <? if($OPERADOR['grupooperador'] == '0001|0004'){ ?>selected="selected" <? } ?>>Claro TV e Oi</option>
<option value="0003|0004" <? if($OPERADOR['grupooperador'] == '0003|0004'){ ?>selected="selected" <? } ?>>Claro Fixo e Oi</option>
<option value="0001" <? if($OPERADOR['grupooperador'] == '0001'){ ?>selected="selected" <? } ?>>Claro TV</option>
<option value="0002" <? if($OPERADOR['grupooperador'] == '0002'){ ?>selected="selected" <? } ?>>Claro 3G</option>
<option value="0003" <? if($OPERADOR['grupooperador'] == '0003'){ ?>selected="selected" <? } ?>>Claro FIXO</option>
<option value="0001|0002" <? if($OPERADOR['grupooperador'] == '0001|0002'){ ?>selected="selected" <? } ?>>Claro TV e Claro 3G</option>
<option value="0001|0003" <? if($OPERADOR['grupooperador'] == '0001|0003'){ ?>selected="selected" <? } ?>>Claro TV e Claro FIXO</option>
<option value="0002|0003" <? if($OPERADOR['grupooperador'] == '0002|0003'){ ?>selected="selected" <? } ?>>Claro 3G e Claro Fixo</option>
<option value="0001|0002|0003" <? if($OPERADOR['grupooperador'] == '0001|0002|0003'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G e Claro Fixo</option>
<option value="0001|0002|0003|0004" <? if($OPERADOR['grupooperador'] == '0001|0002|0003|0004'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G, Claro Fixo e Oi</option>

</select>

</td>

<td>
	<select style="font-size: 11px;" name="tipocontrato">
		<option value="EFETIVO" <? if($OPERADOR['tipo_contrato'] == 'EFETIVO'){ ?>selected="selected" <? } ?>>EFETIVO</option>
		<option value="TREINAMENTO" <? if($OPERADOR['tipo_contrato'] == 'TREINAMENTO'){ ?>selected="selected" <? } ?>>TREINAMENTO</option>
	</select>
</td>

<td>

<select style="font-size: 11px;"name="status">

<option value="ATIVO" <? if($OPERADOR['statusoperador'] == 'ATIVO'){ ?>selected="selected" <? } ?>>ATIVO</option>
<option value="DESLIGADO" <? if($OPERADOR['statusoperador'] == 'DESLIGADO'){ ?>selected="selected" <? } ?>>DESLIGADO</option>

</select>
</td>

<td><img src="img/icone-salvar.png" width="20" style="cursor:pointer" onclick="javascript:document.form<?= $OPERADOR['idoperador'];?>.submit();" /></td>
</tr>
</form>

<?
}
?>

</table>
</center>

<br />
<br />
