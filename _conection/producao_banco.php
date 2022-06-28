<?php

if (!isset($_SESSION)){
    session_start();
}

include '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$ponto = $_SESSION['usuarioPonto'];
$usuario = $_SESSION['usuarioUsuario'];
$recadastrador = $_SESSION['usuarioNome'];
/*$data = date("Y-m-d");*/
$data = isset($_POST['data'])?$_POST['data']:0;
$data_convertida = implode('-', array_reverse(explode('/', $data)));
$matricula_primeira = isset($_POST['matini'])?$_POST['matini']:0;
$matricula_ultima = isset($_POST['matfim'])?$_POST['matfim']:0;
$tot_matriculas = $matricula_ultima - $matricula_primeira;
$computados = isset($_POST['computados'])?$_POST['computados']:0;
$nao_computados = isset($_POST['nao_computados'])?$_POST['nao_computados']:0;
$tot_indicadores = $computados + $nao_computados;
$justificativa = isset($_POST['justifica'])?$_POST['justifica']:0;
$atos = isset($_POST['atos'])?$_POST['atos']:0;


if (empty($matricula_primeira)) {
  $computados = 0;
} else {
  echo "";
}

if (empty($matricula_ultima)) {
  $nao_computados = 0;
} else {
  echo "";
}

if (empty($computados)) {
  $matriculas = 0;
} else {
  echo "";
}

if (empty($nao_computados)) {
  $matriculas = 0;
} else {
  echo "";
}

if (empty($atos)) {
  $atos = 0;
} else {
  echo "";
}


// VERIFICA SEQUÊNCIA PARA INCLUSÃO
$ult_mat_seq = "SELECT SEQ_INICIO FROM sequencias WHERE PONTO = '$ponto' ORDER BY SEQ_INICIO DESC LIMIT 1";
$resultult = mysqli_query($conn, $ult_mat_seq);
$resultfim = mysqli_fetch_assoc($resultult);
$ultima_seq = $resultfim['SEQ_INICIO'];


// VERIFICA SE A INCLUSÃO ESTÁ DUPLICADA
$query = "SELECT PONTO, DATA FROM producao WHERE PONTO = '$ponto' AND DATA = '$data_convertida' AND MAT_PRIMEIRA = '$matricula_primeira' AND MAT_ULTIMA = '$matricula_ultima'";
$resultquery = mysqli_query($conn, $query);
$resultconsulta = mysqli_fetch_assoc($resultquery);


/*if (($ponto != 0) && ($matricula_primeira >= $ultima_seq) && (($matricula_ultima <= ($ultima_seq + 99))) && ($tot_indicadores <= 1000)) {*/

if (($ponto != 0) && ($tot_matriculas <= 100)) {

 if (is_null($resultconsulta)) {
  $sql = "INSERT INTO producao (PONTO, USUARIO, RECADASTRADOR, DATA, ATOS, MAT_PRIMEIRA, MAT_ULTIMA, TOT_MATRICULAS, COMPUTADOS, NAO_COMPUTADOS, TOT_INDICADORES, JUSTIFICATIVA) VALUES ('$ponto', '$usuario', '$recadastrador','$data_convertida', '$atos', '$matricula_primeira', '$matricula_ultima', '$tot_matriculas','$computados', '$nao_computados', '$tot_indicadores', '$justificativa')";

  if (mysqli_query($conn, $sql)) {
   print "<script>alert('Produção arquivada com sucesso!');</script>";
    if (($usuario == "BRUNO.SOUSA") || ($usuario == "OSIAS.ROSARIO")) {
          print "<script>location.href='../principalCoordenador.php';</script>";
        } else {
          print "<script>location.href='../principal.php';</script>";
    }

 } else {
   echo "<p><img src='../_image/erro.png' width='200' height='200' style='margin-top: 50px; margin-left: 35px;'/></p>";
   echo "<script>alert('ERRO! Inserção não realizada!');</script>";
   echo "<p style='margin-left: 10px; font-family: Arial Narrow,sans-serif; font-size: 18px;'>Inserção no banco não relizada. <strong> Erro na <br /> conexão com Banco de Dados</strong>. Anote sua <br /> produção e contacte seu coordenador!</p><br />";
   echo "<p style='margin-left: 25px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> TOTAL DE MATRÍCULAS: $tot_matriculas</p>";
   echo "<p style='margin-left: 60px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> COMPUTADOS: $computados</p>";
   echo "<p style='margin-left: 40px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> NÃO COMPUTADOS: $nao_computados</p>";
 }

} else {
  echo "<p><img src='../_image/erro.png' width='200' height='200' style='margin-top: 50px; margin-left: 35px;'/></p>";
  echo "<script>alert('ERRO! Inserção não realizada!');</script>";
  echo "<p style='margin-left: 10px; font-family: Arial Narrow,sans-serif; font-size: 18px;'>Inserção no banco não relizada. <strong>Valores duplicados, <br />já inseridos no banco de dados</strong>. Anote sua produção <br /> e contacte seu coordenador!</p><br />";
  echo "<p style='margin-left: 25px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> TOTAL DE MATRÍCULAS: $tot_matriculas</p>";
  echo "<p style='margin-left: 60px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> COMPUTADOS: $computados</p>";
  echo "<p style='margin-left: 40px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> NÃO COMPUTADOS: $nao_computados</p>";
}

} else {
  echo "<p><img src='../_image/erro.png' width='200' height='200' style='margin-top: 50px; margin-left: 35px;'/></p>";
  echo "<script>alert('ERRO! Inserção não realizada!');</script>";
  echo "<p style='margin-left: 10px; font-family: Arial Narrow,sans-serif; font-size: 18px;'>Inserção no banco não relizada. Possíveis erros: <strong>1) Erro na sequencia <br /> que não corresponde a continuação da anterior;</strong> ou <strong>2) Erro na quantidade <br /> de matrículas enviadas, superior a 100</strong>. Anote sua produção e contacte <br /> seu coordenador!</p><br />";
  echo "<p style='margin-left: 25px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> TOTAL DE MATRÍCULAS: $tot_matriculas</p>";
  echo "<p style='margin-left: 60px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> COMPUTADOS: $computados</p>";
  echo "<p style='margin-left: 40px; font-family: Arial Narrow,sans-serif; font-weight: bold; font-size: 20px;'> NÃO COMPUTADOS: $nao_computados</p>";
}

mysqli_close($conn);

?>
