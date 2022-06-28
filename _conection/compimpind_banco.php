<?php


function num3() {

if (!isset($_SESSION)){
    session_start();
}

include '_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");
$data = date("Y-m-d");

$ponto = $_SESSION['usuarioPonto'];
$recadastrador = $_SESSION['usuarioNome'];

$consulta = "SELECT COMPUTADOS, NAO_COMPUTADOS FROM contadores WHERE PONTO = '$ponto' AND DATA = '$data'";
$result = mysqli_query($conn, $consulta);
$resultado = mysqli_fetch_assoc($result);

if ($resultado == array()){
	$resultado = array();
}

$primeiroInd = array_shift($resultado);

return $primeiroInd;

}




function num4() {

if (!isset($_SESSION)){
    session_start();
}

include '_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");
$data = date("Y-m-d");

$ponto = $_SESSION['usuarioPonto'];
$recadastrador = $_SESSION['usuarioNome'];

$consulta = "SELECT COMPUTADOS, NAO_COMPUTADOS FROM contadores WHERE PONTO = '$ponto' AND DATA = '$data'";
$result = mysqli_query($conn, $consulta);
$resultado = mysqli_fetch_assoc($result);

if ($resultado == array()){
	$resultado = array();
}

$ultimoInd = array_pop($resultado);

return $ultimoInd;

}


?>