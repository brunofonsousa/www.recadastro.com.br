<?php

if (!isset($_SESSION)){
    session_start();
}

include '../recadastro/_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");
$ponto = $_SESSION['usuarioPonto'];
$usuario = $_SESSION['usuarioUsuario'];
$data_inicial = date("Y-m-d");
$data_mes = date("m");
$meta = 200;


$sql = "SELECT sum(TOT_INDICADORES) FROM producao WHERE DATA = '$data_inicial' AND USUARIO = '$usuario'";


$result = mysqli_query($conn, $sql);

while($linha = mysqli_fetch_assoc($result)){
	$resultado[] = $linha;
}

$total_dia = $resultado[0]['sum(TOT_INDICADORES)'];

if ($total_dia <= 179){
	$total_meta = - $resultado[0]['sum(TOT_INDICADORES)'] + $meta;
} else {
	$total_meta = "OK";
}


?>