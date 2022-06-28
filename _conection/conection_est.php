<?php


$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "recadastro";


$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

if (!$conn){
	die("Falha na conexao: " . mysqli_connect_error());
} else {
	echo "";
}

?>
