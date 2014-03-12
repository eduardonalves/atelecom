<?php
    //ConexÃ£o com Banco
	include_once("conexao.php");
    
    
   
   $quantidadeAparelho=$_POST['qntdAparelho'];  
    
	$sql2 = "";
	
	 $data = $_POST['textBoxDataSaida'];
            
            $arrayData = explode("/", $data);
            $TempArrayData[0] = $arrayData[2];
            $TempArrayData[1] = $arrayData[1];
            $TempArrayData[2] = $arrayData[0];
            
            $data = implode("-", $TempArrayData);
            $data .= " " . date("H:i:s");
            
            $estoquista = $_POST['selectEstoquista'];
            $parceiro = $_POST['textBoxParceiro'];			

            
      
    for ( $x = 1; $x <= $quantidadeAparelho ; $x++ ){   
			$quantidade_itens = $_POST["textBoxQuantidade$x"]; 
            
			
			$duplicado = array();
			$erro = array("duplicado"=> 0, "inexistente" =>0, "vazio" => 0, "quantidade" => 0, "aparelho"=>0);

			if ($quantidade_itens == "" || $quantidade_itens==0 || (!is_numeric($quantidade_itens)) )
			{
				$erro['quantidade'] = 1;
			}

			for ( $c = 1; $c <= $quantidade_itens ; $c++ ){ // FOR VERIFICA ESNs
			
			$esn = $_POST["serial$x$c"];
			
			if ($esn == "")
			{
				$erro['vazio'] = 1;
			}
				
			$aparelho = $_POST["selectAparelho$x"];
			
			if (!isset($_POST["selectAparelho$x"]))
			{
				$erro['aparelho'] = 1;
			}
			
			$qry = "Select count(esn) from ESNsEntradas WHERE esn='$esn' && status='Em Estoque'";
			
			$cont_qry  = mysql_fetch_array(mysql_query($qry));
			
			if($cont_qry[0]<1)
			{
				$erro["inexistente"] = 1;
			}
			
			
			if(!in_array($esn, $duplicado))
			{
				array_push($duplicado, $esn);
			}else{
				
				$erro["duplicado"] = 1;
			}
			
			
			
			}// fim for veriica ens
			if($erro["duplicado"]!=0 || $erro["inexistente"]!=0 || $erro['vazio']!=0 || $erro['quantidade']!=0 || $erro['aparelho'] !=0) //// IF VERIICA ESNs
			{
				if($erro["aparelho"]!=0)
				{
				echo "<script>alert(\"ERRO: Preencha o campo Aparelho.\");</script>";
				}
				if($erro["quantidade"]!=0)
				{
				echo "<script>alert(\"ERRO: Campo Quantidade Invalido.\");</script>";
				}		
				if($erro["duplicado"]!=0)
				{
				echo "<script>alert(\"ERRO: Saida com numeros de seriais duplicados.\");</script>";
				}
				if($erro["inexistente"]!=0)
				{
				echo "<script>alert(\"ERRO: ESN nao encontrado em estoque.\");</script>";
				}
				if($erro["vazio"]!=0)
				{
				echo "<script>alert(\"ERRO: Complete os campos seriais.\");</script>";
				}

				echo "<form name=\"reload\" action=\"adm?p=index-estoque-clarofixo&es=inserir-dados-saida-clarofixo\" method=\"post\">";
				
				foreach($_POST as $key=>$value)
				{
				echo "<input type=\"hidden\" name=\"$key\" value=\"$value\" />";

					
				}

				echo "</form>
				<script>document.forms[\"reload\"].submit();</script>
				";
				exit("");


			}
		
			else{
				
							
		
            $sql4= "SELECT * FROM aparelhos WHERE id_aparelho = '$aparelho'";
            $query4 = mysql_query($sql4);
            $apArray = mysql_fetch_array($query4);
            
            $varConta = $apArray['estoque'];
            $varConta = $apArray['estoque'];	
			
			$varResult = $varConta - $quantidade_itens;
            
            $sql5="UPDATE aparelhos SET estoque = '".$varResult."' WHERE id_aparelho = '$aparelho'";
            $query5=mysql_query($sql5);
            if ($x == 1)
			
			{
			$sql="INSERT INTO saidas (id_estoquista, id_parceiro, data) VALUES ('$estoquista','".$parceiro."', '".$data."')";
            $query = mysql_query($sql);	
			}
			
            $saida = "SELECT * FROM saidas ORDER BY id_saida DESC LIMIT 1";
            $queryEntrada = mysql_query($saida);
            
            $id_saida = mysql_fetch_array($queryEntrada);
           
            $sql3="INSERT INTO itenssaida (id_saida, id_aparelho, qtde) VALUES ('".$id_saida['id_saida']."', '".$aparelho."', '".$quantidade_itens."')" or die (mysql_error());
            $query3 = mysql_query($sql3);
        	
			
			for ( $i = 1; $i <= $quantidade_itens ; $i++ ){   
                                     			
            $esn = $_POST["serial$x$i"];
            $status = $_POST["selectStatus"];
     
            $saida2 = "SELECT * FROM itenssaida ORDER BY id_itenssaida DESC LIMIT 1";
                        $querySaida2 = mysql_fetch_array(mysql_query($saida2));
                        
            $sql2="INSERT INTO ESNsSaida (id_saida,esn, status ) VALUES ('".$querySaida2['id_itenssaida']."','".$esn."','".$status."')";
            $query2 = mysql_query($sql2);
            
            $sql_up="UPDATE ESNsEntradas SET status = 'Com Parceiro' WHERE esn = '$esn' && status='Em Estoque'";
            mysql_query($sql_up);
            
				}
            
           
  	                     
        
    }
    
        /*Testa se foi cadastrado, da um alert, e redireciona para a home*/
	if ($sql5){
		
	    echo"<script>alert('Saida efetuado com sucesso!');location.href='adm?p=index-estoque-clarofixo&es=inserir-dados-entrada-clarofixo&m=';</script>";
            
        }else{
        echo "<script>alert('Saida nÃ£o efetuada.'); history.back();</script>";
	}
	
		} // IF VERIICA ESNs
	
	
?>
