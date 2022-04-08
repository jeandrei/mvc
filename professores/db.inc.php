<?php
//***********************************************faz a conexão com o banco de dados*******
try//tenta fazer a conexão com o banco de dados
{
	$pdo = new PDO('mysql:host=mysql;dbname=professores', 'root', 'rootadm');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)//caso algo de errado ele pega o erro originao do php e joga para a variavel $e 
{						//atribui a mensagem de erro tratada na variavel $erro
	$error = "Erro ao tentar conectar ao banco de dados, tente novamente mais tarde!";
	include "error.html.php";
	exit();
}
//*****************************************************************************************
?>