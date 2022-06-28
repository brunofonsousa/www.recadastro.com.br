<?php
if (!isset($_SESSION)){
    session_start();
}

include_once '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$nome = isset($_POST['nome'])?$_POST['nome']:0;
$sobrenome = isset($_POST['sobrenome'])?$_POST['sobrenome']:0;
$nome_completo = $nome . " " . $sobrenome;
$ponto = isset($_POST['ponto'])?$_POST['ponto']:0;
$usuario = isset($_POST['usuario'])?$_POST['usuario']:0;
$acao = isset($_POST['acao'])?$_POST['acao']:0;
$senha = isset($_POST['senha'])?$_POST['senha']:0;


$consulta = "SELECT * FROM login WHERE PONTO = '$ponto'";
$result = mysqli_query($conn, $consulta);
$resultado = mysqli_fetch_assoc($result);


if ($resultado == array()){
	$resultado = array();
} 

if (empty($resultado)) {
  $usuario_cadastrado = "";
} else {
  $usuario_cadastrado = $resultado['USUARIO'];
}

if (empty($resultado)) {
  $senha_cadastrada = "";
} else {
  $senha_cadastrada = $resultado['SENHA'];
}


if ($acao == 1){
  if (in_array($ponto, $resultado)) {
	   print "<script>alert('Cadastro já existente (Usuário: $usuario_cadastrado / Senha: $senha_cadastrada)');</script>";
     print "<script>location.href='../principalCoordenador.php';</script>";
  } else {

	$sql = "INSERT INTO login (PONTO, NOME, USUARIO, SENHA) VALUES ('$ponto', '$nome_completo', '$usuario', '$senha')";

	if (mysqli_query($conn, $sql)) {
    	print "<script>alert('Novo cadastro registrado com sucesso (Usuário: $usuario / Senha: $senha)');</script>";
  		print "<script>location.href='../principalCoordenador.php';</script>";
	} else {
		echo "<p><img src='../_image/erro.png' width='200' height='200' style='margin-top: 50px; margin-left: 100px;'/></p>";
		echo "<p style='margin-left: 10px; font-family: Arial Narrow,sans-serif; font-size: 18px;'>Inserção no banco não relizada, contacte seu coordenador!</p><br />";
  		echo "<p style='margin-left: 100px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'>USUÁRIO: $usuario</p>";
  		print "<script>alert('ERRO! Cadastro não inserido no banco, contacte seu coordenador!');</script>";
  		print "<script>location.href='../principalCoordenador.php';</script>";
	 }
	 mysqli_close($conn);
  }

} else {
    
    $sql = "DELETE FROM login WHERE PONTO = '$ponto' AND USUARIO = '$usuario'";
  
  if (mysqli_query($conn, $sql)) {
      print "<script>alert('Usuário excluído com sucesso (Usuário: $usuario) !!!');</script>";
      print "<script>location.href='../principalCoordenador.php';</script>";
  } else {
    echo "<p><img src='../_image/erro.png' width='200' height='200' style='margin-top: 50px; margin-left: 100px;'/></p>";
    echo "<p style='margin-left: 10px; font-family: Arial Narrow,sans-serif; font-size: 18px;'>Exclusão no banco não relizada, contacte seu coordenador!</p><br />";
      echo "<p style='margin-left: 100px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'>USUÁRIO: $usuario</p>";
      print "<script>alert('ERRO! Cadastro não deletado do banco, contacte seu coordenador!');</script>";
      print "<script>location.href='../principalCoordenador.php';</script>";
   } 
   mysqli_close($conn);
  }   

?>

