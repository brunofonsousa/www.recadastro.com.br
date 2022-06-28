<?php


function num1() {
if (!isset($_SESSION)){
    session_start();
}

include '_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$ponto = $_SESSION['usuarioPonto'];
$recadastrador = $_SESSION['usuarioNome'];
$data = date("Y-m-d");

//$consultaPri = "SELECT MAT_ULTIMA FROM producao WHERE PONTO = '$ponto' AND MAT_ULTIMA = (SELECT max(MAT_ULTIMA) from producao WHERE PONTO = '$ponto' ORDER BY DATA DESC LIMIT 1) ORDER BY DATA DESC LIMIT 1";

//$consultaPri = "SELECT MAT_ULTIMA FROM producao WHERE PONTO = '$ponto' ORDER BY DATA DESC LIMIT 1";

$consultaPri = "SELECT MAX(MAT_ULTIMA) FROM (SELECT MAT_ULTIMA FROM producao WHERE PONTO = '$ponto' ORDER BY DATA DESC LIMIT 2) AS CONTADOR LIMIT 1";

$resultPri = mysqli_query($conn, $consultaPri);
$resultadoPri = mysqli_fetch_assoc($resultPri);

if ($resultadoPri == array()){
	$resultadoPri = array();
}

$primeira = array_pop($resultadoPri);

return $primeira;
}




/*
function num2() {

if (!isset($_SESSION)){
    session_start();
}

include '_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$ponto = $_SESSION['usuarioPonto'];
$recadastrador = $_SESSION['usuarioNome'];
$data = date("Y-m-d");

$consultaPri = "SELECT MAT_ULTIMA FROM producao WHERE PONTO = '$ponto' ORDER BY DATA DESC LIMIT 1";
$consultaUti = "SELECT * FROM contadores WHERE PONTO = '$ponto' AND DATA = '$data'";

$resultPri = mysqli_query($conn, $consultaPri);
$resultUti = mysqli_query($conn, $consultaUti);

$resultadoPri = mysqli_fetch_assoc($resultPri);
$resultadoUti = mysqli_fetch_assoc($resultUti);

if ($resultadoPri == array()){
	$resultadoPri = array();
}

$primeira = array_pop($resultadoPri);

if($resultadoUti == 0){
	$valor_contadores = 0;
} else {
	$valor_contadores = array_pop($resultadoUti);
}

$ultima = $primeira + $valor_contadores;

return $ultima;

}
*/

?>