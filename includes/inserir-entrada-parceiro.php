<?php

  //Recupera valores do formulario
    $quantidadeAparelho=$_POST['qntdAparelho']; 
   
    $sql2 = "";
    
    $data = $_POST['textBoxDataEntrada'];
           
    $arrayData = explode("/", $data);
    $TempArrayData[0] = $arrayData[2];
    $TempArrayData[1] = $arrayData[1];
    $TempArrayData[2] = $arrayData[0];
           
    $data = implode("-", $TempArrayData);
    $data .= " " . date("H:i:s");

    $nf = $_POST['textBoxNotaFiscal'];
           
    $estoquista = $_POST['selectEstoquista'];
    $origem = $_POST['selectOrigem'];

	for ( $x = 1; $x <= $quantidadeAparelho ; $x++ ){  
		$quantidade_itens = $_POST["textBoxQuantidade$x"];  
             
        
        
        $duplicado = array();
		$erro = array("duplicado"=> 0, "nf" =>0, "vazio" => 0, "quantidade" => 0, "aparelho" => 0, "saida" => 0);
	
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
			
			$nf = $_POST['textBoxNotaFiscal'];
			if ($nf == "")
			{
				$erro['nf'] = 1;
			}
			
			$aparelho = $_POST["selectAparelho$x"];	
			
			if (!isset($_POST["selectAparelho$x"]))
			{
				$erro['aparelho'] = 1;
			}
			
			
			$qry = "Select count(esn) from ESNsEntradas WHERE esn='$esn' && status='Em estoque'";
			$cont_qry  = mysql_fetch_array(mysql_query($qry));
			
			$countValues = array_count_values($_POST);
			
			if($cont_qry[0]>0 || $countValues[$esn]>1)
			{
				$erro["duplicado"] = 1;
			}
					
			
			$qry = "Select count(esn.esn),esn.id_esnssaida, itens.* from ESNsSaida esn
				INNER JOIN itenssaida itens ON (itens.id_itenssaida=esn.id_saida)
			 WHERE esn='$esn' && (status='Vendido' OR status='Em Estoque')";
			
			$cont_qry  = mysql_fetch_array(mysql_query($qry));
			
			//echo "<pre>".print_r($cont_qry)."</pre>";
			
			if($cont_qry[0]>0)
			{
				if($aparelho!=$cont_qry["id_aparelho"])
				{
					$erro['aparelho'] = 1;
				}
			}else{
				
				$erro['saida'] = 1;
			}
			
			
			}// fim for veriica ens
			if($erro["nf"]!=0 || $erro["duplicado"]!=0 || $erro['vazio']!=0 || $erro['quantidade']!=0 || $erro['aparelho']!=0 || $erro['saida']!=0)   //// IF VERIICA ESNs
			{
				if($erro["aparelho"]!=0)
				{
				echo "<script>alert(\"ERRO: Aparelho nao preenchido ou nao confere com a ESN informada.\");</script>";
				}
				if($erro["nf"]!=0)
				{
				echo "<script>alert(\"ERRO: Preencha o campo Nota Fiscal.\");</script>";
				}
				if($erro["quantidade"]!=0)
				{
				echo "<script>alert(\"ERRO: Campo Quantidade Invalido.\");</script>";
				}		
				if($erro["duplicado"]!=0)
				{
				echo "<script>alert(\"ERRO: Entrada com numeros de seriais ja cadastrados ou repetidos.\");</script>";
				}	
				if($erro["vazio"]!=0)
				{
				echo "<script>alert(\"ERRO: Complete os campos seriais.\");</script>";
				}
				if($erro["saida"]!=0)
				{
				echo "<script>alert(\"ERRO: Serial nao encontrado com nenhum parceiro.\");</script>";
				}
				
				echo "<form name=\"reload\" action=\"adm?p=index-estoque-clarofixo&es=inserir-dados-entrada-clarofixo\" method=\"post\">";
				
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

				if ($x == 1)
				{
					$sql="INSERT INTO entradas (data, nf, id_estoquista, origem) VALUES ('".$data."','".$nf."','$estoquista','".$origem."')" or die (mysql_error());
					$query = mysql_query($sql);

				}
				
        $sql4= "SELECT * FROM aparelhos WHERE id_aparelho = '$aparelho'";
        $query4 = mysql_query($sql4);
        $apArray = mysql_fetch_array($query4);                  
        $varConta = $apArray['estoque'];
        $varConta = $apArray['estoque'];   
        $varResult = $varConta + $quantidade_itens;

           
        $sql5= "UPDATE aparelhos SET estoque = '".$varResult."' WHERE id_aparelho = '$aparelho'";
        $query5=mysql_query($sql5);

        $entrada = "SELECT * FROM entradas ORDER BY id_entrada DESC LIMIT 1";
        $queryEntrada = mysql_query($entrada);

        $id_entrada = mysql_fetch_array($queryEntrada);                

        $sql3="INSERT INTO itensEntrada (qtde, id_entrada, id_aparelho) VALUES ('".$quantidade_itens."', '".$id_entrada['id_entrada']."', '".$aparelho."')" or die (mysql_error());
        $query3 = mysql_query($sql3);
       
		for ( $i = 1; $i <= $quantidade_itens ; $i++ ){  
			$esn = $_POST["serial$x$i"];
                  
            $status = "Em estoque";
                       
            $entrada2 = "SELECT * FROM itensEntrada ORDER BY id_itensEntrada DESC LIMIT 1";
            $queryEntrada2 = mysql_fetch_array(mysql_query($entrada2));

           $sqlUp = "UPDATE ESNsSaida SET status='Devolvido' WHERE esn='" . $esn . "' && (status='Em Estoque' || status='Vendido')";
           mysql_query($sqlUp);

           $sqlUp2 = "UPDATE ESNsEntradas SET status='Devolvido' WHERE esn='" . $esn . "' && status='Com Parceiro'";
           mysql_query($sqlUp2);

            $sql2="INSERT INTO ESNsEntradas (id_entrada, esn, status ) VALUES ('".$queryEntrada2['id_itensEntrada']."','".$esn."','".$status."')";
            $query2 = mysql_query($sql2);
           //echo "UP: " . $cont_qry["id_esnssaida"];
           

                          
        }
       
    }
}
   
        /*Testa se foi cadastrado, da um alert, e redireciona para a home*/
    if ($sql5){
       
        echo"<script>alert('Devolucao efetuada com sucesso!');location.href='adm?p=index-estoque-clarofixo&es=inserir-dados-entrada-clarofixo&m=';</script>";
    }else{
        echo"<script>alert('Desculpe, nao foi possivel efetuar a devolucao.');history.back()';</script>";
    }

?>
