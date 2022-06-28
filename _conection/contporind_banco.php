<?php

if (!isset($_SESSION)){
    session_start();
}

include_once '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$computados = isset($_GET['valorComp'])?$_GET['valorComp']:0;
$nao_computados = isset($_GET['valorNComp'])?$_GET['valorNComp']:0;
$ponto = $_SESSION['usuarioPonto'];
$usuario = $_SESSION['usuarioUsuario'];
$data = date("Y-m-d");


if (empty($computados)) {
	$computados = 0;
} else {
	echo "";
}

if (empty($nao_computados)) {
	$nao_computados = 0;
} else {
	echo "";
}

if (empty($matriculas)) {
	$matriculas = 0;
} else {
	echo "";
}

$consulta = "SELECT * FROM contadores WHERE PONTO = '$ponto' AND USUARIO = '$usuario' AND DATA = '$data'";
$result = mysqli_query($conn, $consulta);
$resultado = mysqli_fetch_assoc($result);

if ($resultado == array()){
	$resultado = array();
} 


if ((in_array($ponto, $resultado)) && (in_array($data, $resultado))){

	$sql = "UPDATE contadores SET COMPUTADOS = '$computados', NAO_COMPUTADOS = '$nao_computados' WHERE PONTO = '$ponto' and DATA = '$data'";

	if (mysqli_query($conn, $sql)) {
		echo "<script> function dimensionar() {window.resizeTo(600, 300)}; dimensionar(); </script>";
		echo "<script> function move() {window.moveTo(400, 200)}; move(); </script>";
		echo "<script>alert('Update realizado com sucesso!');</script>";
  		echo "<script> window.close(); </script>";
	} else {
		echo "<script> function move() {window.moveTo(500, 200)}; move(); </script>";
		echo "<p><img src='../_image/erro.png' width='200' height='200' style='margin-top: 50px; margin-left: 35px;'/></p>";
  		echo "<p style='margin-left: 10px; font-family: Arial Narrow,sans-serif; font-size: 18px;'>Update não relizado e contadores não foram arquivados. Anote sua produção e contacte seu coordenador!</p><br />";
  		echo "<p style='margin-left: 60px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> COMPUTADOS: $computados</p>";
  		echo "<p style='margin-left: 40px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> NÃO COMPUTADOS: $nao_computados</p>";
	}

 	mysqli_close($conn);

} else {
	$sql = "INSERT INTO contadores (PONTO, USUARIO, DATA, COMPUTADOS, NAO_COMPUTADOS, MATRICULAS) VALUES ('$ponto', '$usuario', '$data', '$computados', '$nao_computados', '$matriculas')";

	if (mysqli_query($conn, $sql)) {
    	echo "<script> function dimensionar() {window.resizeTo(600, 300)}; dimensionar(); </script>";
		echo "<script> function move() {window.moveTo(400, 200)}; move(); </script>";
    	echo "<script>alert('Indicadores arquivados com sucesso!');</script>";
  		echo "<script> window.close(); </script>";
	} else {
		echo "<script> function move() {window.moveTo(500, 200)}; move(); </script>";
    	echo "<p><img src='../_image/erro.png' width='200' height='200' style='margin-top: 50px; margin-left: 35px;'/></p>";
  		echo "<p style='margin-left: 10px; font-family: Arial Narrow,sans-serif; font-size: 18px;'>Inserção no banco não relizada. Anote sua produção e contacte seu coordenador!</p><br />";
  		echo "<p style='margin-left: 60px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> COMPUTADOS: $computados</p>";
  		echo "<p style='margin-left: 40px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> NÃO COMPUTADOS: $nao_computados</p>";
	}

	mysqli_close($conn);
}

?>

