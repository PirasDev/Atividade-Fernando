<?php

$servidor = "127.0.0.1:3x306";
$usuario = "crm_admin";
$senha = "senai";
$banco = "crm";
	

$comando = verificaValorPost("comando");
if($comando === "teste"){
	
	$valor = verificaValorPost('valor');
	$valorr = (floatval($valor))* 2;
	
	echo("$valorr");
}
else if($comando == 'inserir'){
	
	$cpf = verificaValorPost('cpf');
	$nome = verificaValorPost('nome');
	$sobrenome = verificaValorPost('sobrenome');
	$data = [
		[$cpf, $nome, $sobrenome]
	];
	$sql = "INSERT INTO cliente
		(cpf,nome,sobrenome) VALUES (?,?,?)";
	$stmt= $pdo->prepare($sql);
	try {
		$pdo->beginTransaction();
		foreach ($data as $row)
		{
			$stmt->execute($row);
		}
		$pdo->commit();
		echo("insert ok");
	}catch (Exception $e){
		$pdo->rollback();
		echo("insert erro ".$e->getCode());
		switch($e->getCode()){
			case 23000:
				echo(" CPF já existente!");
			break;
			case 22001:
				echo(" Algum campo excedeu o limite de caracteres");
			break;
		}
		
	}
}

function verificaValorPost($var){
	if(!isset($_POST["$var"])){
		echo("Faltou o $var");
	}
	return $_POST["$var"];
}
//  SELECT 
if ($comando == 'buscarCpf' || $isDebug) {
	if($isDebug){}
	$resultado = mysqli_query($conexao, 
		"SELECT * FROM clientes WHERE cpf=\"$cpf\" ;");
	if($resultado){
		$linha = mysqli_fetch_array($resultado);
		$registros = array();
		
		$linha2 = array(			
			'cpf'=>$linha['cpf'],
			'nome'=>$linha['nome'], 
			'sobrenome' =>$linha['sobrenome']);
		array_push($registros, $linha2);
		array_push($jsonArray, array('registros'=>$registros));
	}
}
elseif ($comando == 'buscarNome' || $isDebug) {
	if($isDebug){}
	$resultado = mysqli_query($conexao, 
		"SELECT * FROM clientes WHERE nome LIKE \"%$nome%\" ;");
	if($resultado){
		$registros = array();
		while($linha = mysqli_fetch_array($resultado)){
			$linha2 = array(
				'cpf'=>$linha['cpf'],
				'nome'=>$linha['nome'], 
				'sobrenome' =>$linha['sobrenome']);
			array_push($registros, $linha2);
		}
		array_push($jsonArray, array('registros'=>$registros));
	}
}
if($resultado){
							 				
	array_push($jsonArray, array('resultado'=>'OK'));
}else{
	array_push($jsonArray, array('resultado'=>'NOK'));
}
					
echo json_encode(array($comando=>$jsonArray));

echo("$nome, $cpf, $sobrenome");


 //INSERT 

if($operacao == "Inserir"){
	
}elseif($operacao == "Alterar"){
	$resultado = mysqli_query($conexao, 
		"UPDATE clientes 
		SET nome=\"$nome\", sobrenome=\"$sobrenome\"
		WHERE cpf=\"$cpf\"; ");
	if($resultado){
		echo("<br>Dados atualizados com sucesso!");
	}else{
		echo("<br>Os dados não puderam ser atualizados. Erro:");
		mysqli_error($conexao);
	}	
}

?>