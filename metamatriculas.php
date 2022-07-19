<?php

if (!isset($_SESSION)){
	session_start();
}

include '_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");
$ponto = $_SESSION['usuarioPonto'];
$usuario = $_SESSION['usuarioUsuario'];
$data_inicial = date("Y-m-d");
$data_mes = date("m");
$meta_matriculas = 200;


$sql_mat = "SELECT sum(TOT_MATRICULAS) FROM producao WHERE DATA = '$data_inicial' AND USUARIO = '$usuario'";
$result = mysqli_query($conn, $sql_mat);
while($linha = mysqli_fetch_assoc($result)){
	$resultado[] = $linha;
}

$total_dia_matriculas = $resultado[0]['sum(TOT_MATRICULAS)'];

if ($total_dia_matriculas <= $meta_matriculas){
	$total_meta_matriculas = - $resultado[0]['sum(TOT_MATRICULAS)'] + $meta_matriculas;
} else {
	$total_meta_matriculas = "OK";
}


?>