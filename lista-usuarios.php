<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

require_once "conexao.php";
	
	$erros = array();

	if( $_POST['action']=='add' )
	{
		extract($_POST);
		extract($_FILES);
			
		// ###################### ROTINAS DE VALIDACAO DE DADOS ###################
			
		$searchlogin = mysql_fetch_assoc($conexao->query("Select count(*) from usuarios where login='$login'"));

		if ($searchlogin['count(*)'] > 0 )
		{
			array_push($erros, 'Já existe um usuário para o login digitado.');
		}
		
		if (! preg_match('/^[a-za-zA-Z\d_]{4,}[a-za-zA-Z\d_\.]*$/i', $login)) { 
				
			array_push($erros, 'Nome de usuário inválido. Mínimo de quatro caracteres e que sejam alfanuméricos.');
			
		}
			
		if (! preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $email) && $email!='') {
			
			array_push($erros, 'Endereço de email inválido.');
		}
	
		if( count($erros) == 0 )
		
		{

			$sqlquery = "INSERT INTO usuarios (nome, login, grupo, supervisor, email, sexo, tipo_usuario, acesso_usuario, status) 
			VALUES('$nome', '$login', '$grupo', '$supervisor', '$email', '$sexo', '$tipo_usuario', '$acesso_usuario', '$status')";
			
			$conInsert = $conexao->query($sqlquery);
			
			if(! $conInsert )
			{
				array_push($erros, 'Erro ao cadastrar usuário.');
			}
			
		}

		result_page($erros);
		
		//header('Location: ' . $_SERVER['HTTP_REFERER']);

	} // fim add

	
	if( $_POST['action']=='edit' )
	{
		extract($_POST);
		
		$userquery = "Select * from usuarios where id='$id'";
		
		$editUser = mysql_fetch_assoc($conexao->query($userquery));
		
		if($editUser['login']!=$login)
		{
			
			// ###################### ROTINAS DE VALIDACAO DE DADOS ###################
			
			$searchlogin = mysql_fetch_assoc($conexao->query("Select count(*) from usuarios where login='$login'"));

			if ($searchlogin['count(*)'] > 0 )
			{
				array_push($erros, 'Já existe um usuário para o login digitado.');
			}
			
			if (! preg_match('/^[a-za-zA-Z\d_]{4,}[a-za-zA-Z\d_\.]*$/i', $login)) {
				
				array_push($erros, 'Login inválido. Mínimo de quatro caracteres e que sejam alfanuméricos ou ponto (.).');
			
			}
			
		}
		
		if (! preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,4}$/', $email) && $email=='') {
			
			array_push($erros, 'Endereço de email inválido.');
		}

		
		if( count($erros) == 0 )
		
		{
		
			$sqlquery = "UPDATE usuarios SET nome='$nome', login='$login', grupo='$grupo', supervisor='$supervisor', email='$email', sexo='$sexo'
						, tipo_usuario='$tipo_usuario', acesso_usuario='$acesso_usuario', status='$status' where usuarios.id='$id'";
			
			$conUpdate = $conexao->query($sqlquery);

			if( mysql_affected_rows($conexao->connection) <= 0 )
			{
				array_push($erros, 'Erro ao atualizar usuário. Usuário não modificado.');
			}
		
		}

		result_page($erros);

		die();
		//header('Location: ' . $_SERVER['HTTP_REFERER']);

	}
?>

<?php function result_page($erros) {?>

	<?php if(count($erros)==0) { ?>

	<meta http-equiv="refresh" content="3;url=<?php echo $_SERVER['HTTP_REFERER']; ?>">
	
	<table align="center" height="90%" width="60%" valign="middle" style="background-color:#EFEBEB; border: 1px solid #BFBFBF;" >
	
		<tr style="font-family:arial;" valign="middle">
			<td align="center"><h3>Usuário editado com sucesso.</h3></td>
		</tr>

		<tr style="font-family:arial; font-size:12px; color:#4D4D4D;" valign="middle">
			<td align="center">Aguarde você será redirecionado dentro de 3 segundos...</td>
		</tr>
	
	</table>
	
	<?php } else { ?>

	<table align="center" height="90%" width="60%" valign="middle" style="background-color:#EFEBEB; border: 1px solid #BFBFBF;" >
	
		<tr style="font-family:arial;" valign="middle">
			<td align="center">
				<h3>Erro ao editar usuário.</h3>
				
				<br />
				
				<div style="text-align:left; width:500px; color:#A52A2A; font-size:12px;">
				
				<ul>
					<?php foreach($erros as $erro) { ?>
					<li><?php echo $erro; ?></li>
					<?php } ?>
				</ul>
				
				</div>
				
			</td>
		</tr>

		<tr style="font-family:arial; font-size:12px; color:#4D4D4D;" valign="middle">
			<td align="center">
				<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Clique aqui para voltar a lista de usuários</a>
			</td>
		</tr>
	
	</table>
	
	<?php } // if erros ?>

<?php } ?>
<!-- INSERIR -->

<link rel="stylesheet" href="css/tables.css" />
<form name="novousuario" action="lista-usuarios.php" enctype="multipart/form-data" method="post">

<input type="hidden" name="action" value="add" />

<br/ ><br />
<table border="0" width="900px"style="color:#999; font-size:14px;" align="center">
<tr>
	<td colspan="2" style="color:#999; font-size:18px;">Inserir Usuários</td>
</tr>


<tr bgcolor="#333" style="color:#FFF">
	<td>Nome:</td>
	<td>Login :</td>
	<td>Produto:</td>
	<td colspan="2">Supervisor:</td>
</tr>

<tr bgcolor="#ededed">
	<td><input type="text" id="nome" name="nome" size="15" /></td>
	<td><input type="text" id="login" name="login" maxlength="14" size="15" /></td>
	<td>
		<select name="grupo" id="grupo">
			<option value=""></option>
			<option value="0004" <? if($USUARIO['grupo'] == '0004'){ ?>selected="selected" <? } ?>>Oi</option>
			<option value="0001|0004" <? if($USUARIO['grupo'] == '0001|0004'){ ?>selected="selected" <? } ?>>Claro TV e Oi</option>
			<option value="0003|0004" <? if($USUARIO['grupo'] == '0003|0004'){ ?>selected="selected" <? } ?>>Claro Fixo e Oi</option>
			<option value="0001" <? if($USUARIO['grupo'] == '0001'){ ?>selected="selected" <? } ?>>Claro TV</option>
			<option value="0002" <? if($USUARIO['grupo'] == '0002'){ ?>selected="selected" <? } ?>>Claro 3G</option>
			<option value="0003" <? if($USUARIO['grupo'] == '0003'){ ?>selected="selected" <? } ?>>Claro FIXO</option>
			<option value="0001|0002" <? if($USUARIO['grupo'] == '0001|0002'){ ?>selected="selected" <? } ?>>Claro TV e Claro 3G</option>
			<option value="0001|0003" <? if($USUARIO['grupo'] == '0001|0003'){ ?>selected="selected" <? } ?>>Claro TV e Claro FIXO</option>
			<option value="0002|0003" <? if($USUARIO['grupo'] == '0002|0003'){ ?>selected="selected" <? } ?>>Claro 3G e Claro Fixo</option>
			<option value="0001|0002|0003" <? if($USUARIO['grupo'] == '0001|0002|0003'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G e Claro Fixo</option>
			<option value="0001|0002|0003|0004" <? if($USUARIO['grupo'] == '0001|0002|0003|0004'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G, Claro Fixo e Oi</option>
		</select>
	</td>
	<td colspan="2">
	<select name="supervisor">
	<option value=""></option>
	
	<?
	
	
	$conSUPERVISORES = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario = 'SUPERVISOR' && status != 'DESLIGADO' ORDER BY nome");
	while($SUPERVISOR = mysql_fetch_array($conSUPERVISORES)){
	
	?>
	<option value="<?= $SUPERVISOR['id']; ?>" <? if($USUARIO['id'] == $SUPERVISOR['id']){ ?>selected="selected" <? } ?>><?= $SUPERVISOR['nome']; ?></option>
	
	<? } ?>
	
	</select>
	</td>
</tr>
<tr>
	<td>Email: </td>
	<td>Sexo:</td>
	<td>Tipo de Usuário:</td>
	<td colspan="2">Acesso de Usuário:</td>
</tr>
<tr>
	<td>
		<input type="text" name="email"  onKeyPress="mascara(this,data)" maxlength="35" value="" placeholder="usuario@host.com.br">
	</td>
	<td>
		<select name="sexo">
			<option value=""></option>
			<option value="F">FEMININO</option>
			<option value="M">MASCULINO</option>
		</select>
	</td>
	
	<td>
		<select name="tipo_usuario">
			<option value=""></option>

			<option value="ADMINISTRADOR">ADMINISTRADOR</option>
			<option value="COMERCIAL">COMERCIAL</option>
			<option value="LOGISTICA">LOGISTICA</option>
			<option value="CONTROLADOR">CONTROLADOR</option>
			<option value="FINANCEIRO">FINANCEIRO</option>
			<option value="MONITOR">MONITOR</option>
			<option value="MONITORBO">MONITORBO</option>
			<option value="AUDITOR">AUDITOR</option>
			<option value="SUPERVISOR">SUPERVISOR</option>
			<option value="ESTOQUISTA">ESTOQUISTA</option>

		</select>
	</td>

	<td colspan="2">
		<select name="acesso_usuario">
			<option value=""></option>
			<option value="INTERNO">INTERNO</option>
			<option value="EXTERNO">EXTERNO</option>
		</select>
	</td>

	
</tr>

<tr>
	<td>Senha:</td>
	<td>Status:</td>
	<td colspan="2"></td>

</tr>

<tr>
	
	<td><input type="password" id="senha" name="senha" value="" size="15" /></td>
	<td>
		<select name="status">
		<option value=""></option>
		<option value="ATIVO" <? if($OPERADOR['statusoperador'] == 'ATIVO'){ ?>selected="selected" <? } ?>>ATIVO</option>
		<option value="DESLIGADO" <? if($OPERADOR['statusoperador'] == 'DESLIGADO'){ ?>selected="selected" <? } ?>>DESLIGADO</option>
		</select>
	</td>
	<td colspan="1"></td>
	<td><img src="img/icone-salvar.png" width="20" style="cursor:pointer" title="Salvar" onclick="javascript:document.novousuario.submit();" /></td>
	<td align="left" width="100%" style="cursor:pointer" title="Salvar" onclick="javascript:document.novousuario.submit();">Salvar</td>

</tr>

<tr>
	<td colspan="100">
	<hr />
	</td>
</tr>

</table>
</form>
<br>
<table id="users-table" align="center" width="80%" style="font-size:12px">
	<tr class="tr1" style="color:#FFF; font-size:12px; font-weight:bold; cursor:pointer;" align="center">
		<td>Nome</td>
		<td>Login</td>
		<td>Produto</td>
		<td>Supervisor</td>
		<td>Email</td>
		<td>Sexo</td>
		<td>Tipo de Usuário</td>
		<td>Acesso de Usuário</td>
		<td>Status</td>
		<td></td>
		
	</tr>
<?php

	$conUsuarios = $conexao->query("Select usuarios.*, supervisor.nome as supervisor_nome from usuarios
	LEFT JOIN usuarios supervisor ON (usuarios.supervisor = supervisor.id)
	order by usuarios.nome ASC");
	
	while($user = mysql_fetch_array($conUsuarios))
	{
		if($class == "tr2"){ $class = "tr3";} else { $class = "tr2";}
		
		if($user['grupo'] == '0004'){$produto = 'Oi';}
		else if($user['grupo'] == '0001|0004'){$produto = 'Claro TV e Oi';}
		else if($user['grupo'] == '0003|0004'){$produto = 'Claro Fixo e Oi';}
		else if($user['grupo'] == '0001'){$produto = 'Claro TV';}
		else if($user['grupo'] == '0002'){$produto = 'Claro 3G';}
		else if($user['grupo'] == '0003'){$produto = 'Claro FIXO';}
		else if($user['grupo'] == '0001|0002'){$produto = 'Claro TV e Claro 3G';}
		else if($user['grupo'] == '0001|0003'){$produto = 'Claro TV e Claro FIXO';}
		else if($user['grupo'] == '0002|0003'){$produto = 'Claro 3G e Claro Fixo';}
		else if($user['grupo'] == '0001|0002|0003'){$produto = 'Claro TV, Claro 3G e Claro Fixo';}
		else if($user['grupo'] == '0001|0002|0003|0004'){$produto = 'Claro TV, Claro 3G, Claro Fixo e Oi';}
		
		// ******************** codigo para vizualização do usuario ********************

		echo "<tr class=\"$class view-line". $user['id'] ."\" align=\"center\">";

			echo "<td>". $user['nome'] ."</td>";
			echo "<td>". $user['login'] ."</td>";
			echo "<td>". $produto ."</td>";
			echo "<td>", ($user['supervisor_nome']=='') ? "Não Selecionado" : $user['supervisor_nome'] ,"</td>";
			echo "<td>". $user['email'] ."</td>";
			echo "<td>", ($user['sexo']=='M') ? "Masculino" : "Feminino", "</td>";
			echo "<td>". $user['tipo_usuario'] ."</td>";
			echo "<td>". $user['acesso_usuario'] ."</td>";
			echo "<td>". $user['status'] ."</td>";
			echo "<td>";
			echo "<a href=\"#\" onclick=\"javascript:$('#users-table tr[class*=edit-line]').css('display','none').parent().find('tr[class*=view-line]').css('display', 'table-row');$('.view-line". $user['id'] ."').css('display', 'none');$('.edit-line". $user['id'] ."').css('display', 'table-row'); return false;\">";
			echo "<img src=\"img/icone-editar.png\" alt=\"Editar Usuário\" title=\"Editar Usuário\">";
			echo "</a>";
			echo "</td>";
			
		echo "</tr>";

		// ******************** codigo para edição do usuario ********************
		
		echo "<form id=\"edituser" . $user['id'] . "\" method=\"post\" action=\"lista-usuarios.php\">";
		echo "<tr style=\"font-size: 11px; display:none;\" class=\"$class edit-line". $user['id'] ."\" align=\"center\">";
			
			echo "<input type=\"hidden\" name=\"action\" value=\"edit\" />";
			echo "<input type=\"hidden\" name=\"id\" value=\"". $user['id'] ."\" />";
			echo "<td><input style=\"font-size: 11px;\" type=\"text\" name=\"nome\" value=\"". $user['nome'] ."\" /></td>";
			echo "<td><input style=\"font-size: 11px;\" type=\"text\" name=\"login\" value=\"". $user['login'] ."\" /></td>";
			echo "<td>";
			?>
				<select style="font-size: 11px;" name="grupo">
				<option value="0004" <? if($user['grupo'] == '0004'){ ?>selected="selected" <? } ?>>Oi</option>
				<option value="0001|0004" <? if($user['grupo'] == '0001|0004'){ ?>selected="selected" <? } ?>>Claro TV e Oi</option>
				<option value="0003|0004" <? if($user['grupo'] == '0003|0004'){ ?>selected="selected" <? } ?>>Claro Fixo e Oi</option>
				<option value="0001" <? if($user['grupo'] == '0001'){ ?>selected="selected" <? } ?>>Claro TV</option>
				<option value="0002" <? if($user['grupo'] == '0002'){ ?>selected="selected" <? } ?>>Claro 3G</option>
				<option value="0003" <? if($user['grupo'] == '0003'){ ?>selected="selected" <? } ?>>Claro FIXO</option>
				<option value="0001|0002" <? if($user['grupo'] == '0001|0002'){ ?>selected="selected" <? } ?>>Claro TV e Claro 3G</option>
				<option value="0001|0003" <? if($user['grupo'] == '0001|0003'){ ?>selected="selected" <? } ?>>Claro TV e Claro FIXO</option>
				<option value="0002|0003" <? if($user['grupo'] == '0002|0003'){ ?>selected="selected" <? } ?>>Claro 3G e Claro Fixo</option>
				<option value="0001|0002|0003" <? if($user['grupo'] == '0001|0002|0003'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G e Claro Fixo</option>
				<option value="0001|0002|0003|0004" <? if($user['grupo'] == '0001|0002|0003|0004'){ ?>selected="selected" <? } ?>>Claro TV, Claro 3G, Claro Fixo e Oi</option>

				</select>

			<?php
			echo "</td>";
			echo "<td>";
			?>
			
			<select style="font-size: 11px;" name="supervisor">
				<option value="0">Não Selecionado</option>
				
				<?php
				mysql_data_seek($conSUPERVISORES,0);
				while($SUPERVISOR = mysql_fetch_array($conSUPERVISORES)){
				
				?>
				<option value="<?= $SUPERVISOR['id']; ?>" <? if($user['supervisor'] == $SUPERVISOR['id']){ ?>selected="selected" <? } ?>><?= $SUPERVISOR['nome']; ?></option>
				
				<? } ?>
				
			</select>
			
			<?php
			echo "</td>";
			echo "<td><input style=\"font-size: 11px;\" type=\"text\" name=\"email\" value=\"". $user['email'] ."\" /></td>";
			echo "<td>";
			?>
			
				<select style="font-size: 11px;" name="sexo">
					<option value="F" <? if($user['sexo'] == 'F'){ ?>selected="selected" <? } ?>>Feminino</option>
					<option value="M" <? if($user['sexo'] == 'M'){ ?>selected="selected" <? } ?>>Masculino</option>
				</select>
				
			<?php
			echo "</td>";
			echo "<td>";
			?>

			<select style="font-size: 11px;" name="tipo_usuario">
				<option value=""></option>

				<option value="ADMINISTRADOR" <? if($user['tipo_usuario'] == 'ADMINISTRADOR'){ ?>selected="selected" <? } ?>>ADMINISTRADOR</option>
				<option value="COMERCIAL" <? if($user['tipo_usuario'] == 'COMERCIAL'){ ?>selected="selected" <? } ?>>COMERCIAL</option>
				<option value="LOGISTICA" <? if($user['tipo_usuario'] == 'LOGISTICA'){ ?>selected="selected" <? } ?>>LOGISTICA</option>
				<option value="CONTROLADOR" <? if($user['tipo_usuario'] == 'CONTROLADOR'){ ?>selected="selected" <? } ?>>CONTROLADOR</option>
				<option value="FINANCEIRO" <? if($user['tipo_usuario'] == 'FINANCEIRO'){ ?>selected="selected" <? } ?>>FINANCEIRO</option>
				<option value="MONITOR" <? if($user['tipo_usuario'] == 'MONITOR'){ ?>selected="selected" <? } ?>>MONITOR</option>
				<option value="MONITORBO" <? if($user['tipo_usuario'] == 'MONITORBO'){ ?>selected="selected" <? } ?>>MONITORBO</option>
				<option value="AUDITOR" <? if($user['tipo_usuario'] == 'AUDITOR'){ ?>selected="selected" <? } ?>>AUDITOR</option>
				<option value="SUPERVISOR" <? if($user['tipo_usuario'] == 'SUPERVISOR'){ ?>selected="selected" <? } ?>>SUPERVISOR</option>
				<option value="ESTOQUISTA" <? if($user['tipo_usuario'] == 'ESTOQUISTA'){ ?>selected="selected" <? } ?>>ESTOQUISTA</option>

			</select>

			<?php
			echo "</td>";
			echo "<td>";
			?>

			<select style="font-size: 11px;" name="acesso_usuario">
				<option value=""></option>
				<option value="INTERNO" <? if($user['acesso_usuario'] == 'INTERNO'){ ?>selected="selected" <? } ?>>INTERNO</option>
				<option value="EXTERNO" <? if($user['acesso_usuario'] == 'EXTERNO'){ ?>selected="selected" <? } ?>>EXTERNO</option>
			</select>

			<?php
			echo "</td>";
			echo "<td>";
			?>

			<select style="font-size: 11px;" name="status">
				<option value=""></option>
				<option value="ATIVO" <? if($user['status'] == 'ATIVO'){ ?>selected="selected" <? } ?>>ATIVO</option>
				<option value="DESLIGADO" <? if($user['status'] == 'DESLIGADO'){ ?>selected="selected" <? } ?>>DESLIGADO</option>
			</select>

			<?php
			echo "</td>";
			echo "<td>";
			echo "<a href=\"#\" onclick=\"javascript:edituser" . $user['id'] . ".submit();\">";
			echo "<img src=\"img/icone-salvar.png\" alt=\"Editar Usuário\" title=\"Editar Usuário\">";
			echo "</a>";
			echo "</td>";
			
		echo "</tr>";
		echo "</form>";
	}

?>
</table>
<br />
<br />
<!-- FIM INSERIR -->
