<?php
	
	//include "../conexao.php";
	
	
	$idPRODUTO = $_GET['pro'];
	
	//Dados Comuns
	$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE  id = '".$_SESSION['usuario']."'");
	$USUARIO = mysql_fetch_assoc($conUSUARIO);
	
	if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}
	if($_GET['d'] == ''){ $dia = date("d"); } else if($_GET['d'] == 'Todos'){ $dia = '';} else { $dia = $_GET['d'];}
	if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
	if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}

	$label=Array();
	
	if($idPRODUTO == '1'){
		//Claro TV
		
		$label[1] = 'Vendas';	
		$conVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[1] = mysql_num_rows($conVENDAS);

		$label[2] = 'Instalações';	
		$conINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'CONECTADO' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[2] = mysql_num_rows($conINST);
		
		$label[3] = 'Instalar';	
		$conINSTA = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && status = 'INSTALAR' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[3] = mysql_num_rows($conINSTA);
		
		$label[4] = 'Restrições';
		$conRES = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && status = 'RESTRIÇÃO' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[4] = mysql_num_rows($conRES);

		$label[5] = 'Canceladas';
		$conCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && status = 'CANCELADO' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[5] = mysql_num_rows($conCANC);

		$label[6] = 'Outros';
		$conOUT = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && ((status = 'CONECTADO' && data_instalacao NOT LIKE '%".$ano.$mes.$dia."%') || (status != 'CONECTADO'  && status != 'RESTRIÇÃO' && status != 'CANCELADO' && status != 'INSTALAR')) && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[6] = mysql_num_rows($conOUT);
	}

	if($idPRODUTO == '2'){
	
		//Claro 3G
		$label[1] = 'Vendas';
		$conVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[1] = mysql_num_rows($conVENDAS);

		$label[2] = 'Autorizadas';
		$conINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && data_autorizacao LIKE '%".$ano.$mes.$dia."%' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS' || status = 'ATIVADO') && monitor LIKE '%".$loginMONITOR."%'");
		$bar[2] = mysql_num_rows($conINST);

		$label[3] = 'Ativados';
		$conPEND = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && status = 'ATIVADO' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[3] = mysql_num_rows($conPEND);
		
		$label[4] = 'Restrições';
		$conRES = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && status = 'RESTRIÇÃO' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[4] = mysql_num_rows($conRES);

		$label[5] = 'Rejeitados';
		$conCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'DEVOLVIDO' || status = 'CANCELADO' || status = 'SEM CONTATO') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[5] = mysql_num_rows($conCANC);

		$label[6] = 'Auditoria';
		$conOUT = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'PRE-ANALISE' || status = 'GRAVAR' || status = 'GRAVADO') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[6] = mysql_num_rows($conOUT);
	}
	
	if($idPRODUTO == '3'){
		//Relatório Claro Fixo
		// Vendas Total
		$label[1] = 'Vendas';
		$conVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[1] = mysql_num_rows($conVENDAS);

		// Vendas Finalizadas
		$label[2] = 'Finalizadas';
		$conINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[2] = mysql_num_rows($conINST);

		// Para finalizar ( Enviar Gravação + Boleto Gerado) 
		$label[3] = 'P/Finalizar';
		$conPEND = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'ENVIAR GRAVAÇÃO' || status = 'BOLETO GERADO') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[3] = mysql_num_rows($conPEND);

		// Com restrição (=Restrição + Redirecionado + Sem Cobertura)
		$label[4] = 'C/Restrição';
		$conRES = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'RESTRIÇÃO' || status = 'REDIRECIONADO' || status = 'SEM COBERTURA') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[4] = mysql_num_rows($conRES);

		// Rejeitados (=Devolvido + Cancelado + Sem Contato)
		$label[5] = 'Rejeitados';
		$conCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'DEVOLVIDO' || status = 'CANCELADO' || status = 'SEM CONTATO') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[5] = mysql_num_rows($conCANC);

		// Tratar Auditoria (Pré-Análise + Gravar + Gravado + Pendente)
		$label[6] = 'Auditoria';
		$conOUT = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'PRE-ANALISE' || status = 'GRAVAR' || status = 'GRAVADO' || status = 'PENDENTE') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[6] = mysql_num_rows($conOUT);
	}
	
	if($idPRODUTO == '4') {	
		//Oi TV
		// Vendas Total
		$label[1] = 'Vendas';
		$conVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[1] = mysql_num_rows($conVENDAS);

		// Vendas Conectadas
		$label[2] = 'Instalações';
		$conINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'CONECTADA' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[2] = mysql_num_rows($conINST);

		// Instalar 
		$label[3] = 'Instalar';
		$conPEND = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'INSTALAR') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[3] = mysql_num_rows($conPEND);

		// Com restrição
		$label[4] = 'Restrições';
		$conRES = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'RESTRIÇÃO') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[4] = mysql_num_rows($conRES);

		// Rejeitados (=Devolvido + Cancelado + Sem Contato)
		$label[5] = 'Canceladas';
		$conCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'DEVOLVIDO' || status = 'CANCELADO' || status = 'SEM CONTATO') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");
		$bar[5] = mysql_num_rows($conCANC);

		// Tratar Auditoria (Gravar + Aprovado)
		$label[6] = 'Outros';
		$conOUT = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$idPRODUTO."' && (status = 'GRAVAR' || status = 'APROVADO') && data LIKE '%".$ano.$mes.$dia."%' && monitor LIKE '%".$loginMONITOR."%'");

		$bar[6] = mysql_num_rows($conOUT);
	}
?>
