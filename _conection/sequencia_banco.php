<?php

if (!isset($_SESSION)){
    session_start();
}

include '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$ponto = $_SESSION['usuarioPonto'];
$recadastrador = $_SESSION['usuarioNome'];
$data = date("Y-m-d");

$consulta = "SELECT * FROM sequencias ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($conn, $consulta);
$resultado = mysqli_fetch_assoc($result);

if ($resultado == array()){
	$resultado = array();
}

$fim = array_pop($resultado);
$id = array_shift($resultado) + 1;

$primeira_seq = $fim + 1;
$ultima_seq = $fim + 100;

$sql = "INSERT INTO sequencias (ID, PONTO, NOME, DATA, SEQ_INICIO, SEQ_FIM) VALUES ('$id','$ponto', '$recadastrador', '$data','$primeira_seq', '$ultima_seq')";
mysqli_query($conn, $sql);

$ini = (string) $primeira_seq;
$fim = (string) $ultima_seq;

$inteiro = $ini . "    -    " . $fim;

mysqli_close($conn);

echo "$inteiro";

?>