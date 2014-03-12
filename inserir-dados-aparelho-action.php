<?php
	/*ConexÃ£o com Banco*/
	include("conexao.php");
	
	$duplicado = array();
	$erro = array("marca"=> 0, "modelo" =>0, "precoPortabilidade" =>0, "precoNovaLinhaPre" =>0, "precoNovaLinhaControle" =>0, "precoNovaLinhaPos" =>0, "imagem" =>0);

	/*Recuperando Valores do Form*/
	$marca = $_POST['textBoxMarca'];
	$modelo = $_POST['textBoxModelo'];
	$precoPortabilidade = $_POST['textBoxPrecoPortabilidade'];
	$precoNovaLinhaPre = $_POST['textBoxPrecoPre'];
	$precoNovaLinhaControle = $_POST['textBoxPrecoControle'];
	$precoNovaLinhaPos = $_POST['textBoxPrecoPos'];
	$precoRep = $_POST['textBoxPrecoRep'];
	$imagem = $_POST["imagem_aparelho"];
	
	if ($marca == "")
	{
		$erro['marca'] = 1;
	}
	
	if ($modelo == "")
	{
		$erro['modelo'] = 1;
	}

	if ($precoPortabilidade == "" || $precoPortabilidade == "0,00")
	{
		$erro['precoPortabilidade'] = 1;
	}

	if ($precoNovaLinhaPre == "" || $precoNovaLinhaPre == "0,00")
	{
		$erro['precoNovaLinhaPre'] = 1;
	}

	if ($precoNovaLinhaControle == "" || $precoNovaLinhaControle == "0,00")
	{
		$erro['precoNovaLinhaControle'] = 1;
	}

	if ($precoNovaLinhaPos == "" || $precoNovaLinhaPos == "0,00")
	{
		$erro['precoNovaLinhaPos'] = 1;
	}

	if ($precoRep == "" || $precoRep == "0,00")
	{
		$erro['precoNovaLinhaRep'] = 1;
	}


	if ($imagem == "n")
	{
		$erro['imagem'] = 1;
	}
	
	if($erro["marca"]!=0 || $erro["modelo"]!=0 || $erro["precoPortabilidade"]!=0 || $erro["precoNovaLinhaPre"]!=0 || $erro["precoNovaLinhaControle"]!=0 || $erro["precoNovaLinhaPos"]!=0 || $erro["imagem"]!=0 ) //// IF VERIICA ESNs
			{
				if($erro["marca"]!=0)
				{
				echo "<script>alert(\"ERRO: Preencha o campo Marca.\");history.back();</script>";
				}
				if($erro["modelo"]!=0)
				{
				echo "<script>alert(\"ERRO: Preencha o campo Modelo.\");history.back();</script>";
				}		
				if($erro["precoPortabilidade"]!=0)
				{
				echo "<script>alert(\"ERRO: Preencha o preco do aparelho para Portabilidade.\");history.back();</script>";
				}		
				if($erro["precoNovaLinhaPre"]!=0)
				{
				echo "<script>alert(\"ERRO: Preencha o preco do aparelho para Novas Linhas Pre.\");history.back();</script>";
				}		
				if($erro["precoNovaLinhaControle"]!=0)
				{
				echo "<script>alert(\"ERRO: Preencha o preco do aparelho para Novas Linhas Controle.\");history.back();</script>";
				}		
				if($erro["precoNovaLinhaPos"]!=0)
				{
				echo "<script>alert(\"ERRO: Preencha o preco do aparelho para Novas Linhas Pos.\");history.back();</script>";
				}		
				if($erro["imagem"]!=0)
				{
				echo "<script>alert(\"ERRO: Selecione a imagem do aparelho.\");history.back();</script>";
				}		
			}
			
			else{

	/*Inserindo conteÃºdo no Banco*/
	$sql = "INSERT INTO aparelhos (marca, modelo, preco_portabilidade, preco_novalinha_pre, preco_novalinha_controle, preco_novalinha_pos, preco_reposicao, imagem_aparelho) VALUES ('$marca','$modelo','$precoPortabilidade','$precoNovaLinhaPre','$precoNovaLinhaControle','$precoNovaLinhaPos','$precoRep','$imagem')";
	$query = mysql_query($sql);
		}

	/*Testa se foi cadastrado, da um alert, e redireciona para a home*/
	if ($sql){
       
        echo "<script>alert('Cadastro efetuado com sucesso!');location.href='adm?p=index-estoque-clarofixo&es=inserir-dados-aparelho-clarofixo&m=';</script>";
    }else{
        echo "<script>alert('Desculpe, o cadastro nÃ£o foi efetuado.');history.back()';</script>";
    }
?>

