<?php


function atualiza_geral() {

if (!isset($_SESSION)){
    session_start();
}

include '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$sql = "SELECT DATA, MES, TOT_INDICADORES, TOT_MATRICULAS_CAMPOS, TOT_MATRICULAS_ANOTACOES FROM graficogeral";
$result = mysqli_query($conn, $sql);
while($linha = mysqli_fetch_assoc($result)){
  $resultado[] = $linha;
}

$ano = array();
$meses = array();
$tot_indicadores = array();
foreach ($resultado as $key => $value) {
  $meses[$key] = $resultado[$key]['MES'];
  $ano[$key] = $resultado[$key]['DATA'];
  $indicadores[$key] = $resultado[$key]['TOT_INDICADORES'];
  $matriculas_campos[$key] = $resultado[$key]['TOT_MATRICULAS_CAMPOS'];
  $matriculas_anotacoes[$key] = $resultado[$key]['TOT_MATRICULAS_ANOTACOES'];
}

/* contadores */
$contMes = count($meses);
$contInd = count($indicadores);
$contMatCamp = count($matriculas_campos);
$contMatAnot = count($matriculas_anotacoes);

/* somatório das colunas */
$tot_prod_ind = array_sum($indicadores);
$mat_camp = array_sum($matriculas_campos);
$mat_anot = array_sum($matriculas_anotacoes);

/* DATAS */
$data_dia = date("d");
$data_mes = date("m");
$data_ano = date("Y");

(string) $ult_ano = array_pop($ano);
(int) $ano = substr($ult_ano, 0, 4);

$ano_sum = $data_ano - $ano;

$ano_passado = $data_ano - 1;
$ano_agora = $data_ano;

if ($data_ano = $ano){
  $ano_fim = $ano_agora;
} else {                     
  $ano_fim = $data_ano - 1;
}

$num = (int) $data_mes - 2;
$meses_string = ["jan/", "fev/", "mar/", "abr/", "mai/", "jun/", "jul/", "ago/", "set/", "out/", "nov/", "dez/"];

(string) $mes_insert = $meses_string[$num] . $ano_fim; /** MES **/

$data_mes_fim = $data_mes - 1;
if ($data_mes_fim < 10){
   $data_mes_fim = "0".$data_mes_fim;
}

(int) $data = $ano_fim . "-" . $data_mes_fim . "-" . "01"; /** DATA **/


/* TOTAL DE INDICADORES E MATRÍCULAS */ 
$sqlTot = "SELECT sum(TOT_MATRICULAS), sum(COMPUTADOS), sum(NAO_COMPUTADOS) FROM producao WHERE DATA BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
$resultTot = mysqli_query($conn, $sqlTot);

$resultadoTot = mysqli_fetch_assoc($resultTot);

if ($resultadoTot == array()){
  $resultadoTot = array();
} 

 foreach ($resultadoTot as $key => $value) {
  $tot_mat_geral = $resultadoTot['sum(TOT_MATRICULAS)']; /*** TOT_MATRICULAS ***/
  $tot_ind_geral = $resultadoTot['sum(COMPUTADOS)']; 
  $tot_indN_geral = $resultadoTot['sum(NAO_COMPUTADOS)']; 
}

$tot_ind_geral_soma = $tot_ind_geral + $tot_indN_geral; /*** TOT_INDICADORES ***/

$mes = array_pop($meses);


if (empty($tot_mat_campos)) {
  $tot_mat_campos = 0; /*** TOT_MATRICULAS_CAMPOS ***/
} else {
  echo "";
}

if (empty($tot_mat_anotacoes)) {
  $tot_mat_anotacoes = 0; /*** TOT_MATRICULAS ***/
} else {
  echo "";
}


/* INSERINDO NO BANCO */
if ($mes != $mes_insert){
  $sqlIns = "INSERT INTO graficogeral (DATA, MES, TOT_INDICADORES, TOT_MATRICULAS_CAMPOS, TOT_MATRICULAS_ANOTACOES) VALUES ('$data', '$mes_insert', '$tot_ind_geral_soma', '$tot_mat_campos', '$tot_mat_anotacoes')";

  if (mysqli_query($conn, $sqlIns)) {
      echo "<script>alert('Total do mês ($mes_insert) inserido com sucesso no Banco de Dados!');</script>";
  } else {
      echo "<script>alert('Falha ao inserir somatória ($mes_insert), contacte o programador!');</script>";
  }
} else {
  echo "<script>alert('Gráfico atualizado ($mes_insert)!');</script>";
}

}

atualiza_geral();

?>