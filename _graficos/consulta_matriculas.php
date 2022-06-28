<?php

if (!isset($_SESSION)){
    session_start();
}

include_once '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$nome = $_SESSION['usuarioPonto'];
$nome = isset($_POST['ngraf'])?$_POST['ngraf']:0;
$data_inicial = isset($_POST['datainigraf'])?$_POST['datainigraf']:0;
$data_final = isset($_POST['datafimgraf'])?$_POST['datafimgraf']:0;
$acao = isset($_POST['acao'])?$_POST['acao']:0;


/*CONVERSÃO DE DATAS PARA O GRÁFICO*/

$data_inicial_array = explode('-', $data_inicial, 3);
$data_inicial_ini = date($data_inicial_array[0] . '-' . $data_inicial_array[1] . '-' . $data_inicial_array[2]);
$data_inicial_convertida = implode('/', array_reverse(explode('-', $data_inicial_ini)));

$data_final_array = explode('-', $data_final, 3);
$data_final_fim = date($data_final_array[0] . '-' . $data_final_array[1] . '-' . $data_final_array[2]);
$data_final_convertida = implode('/', array_reverse(explode('-', $data_final_fim)));

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

if (empty($atos)) {
  $atos = 0;
} else {
  echo "";
}


if ($acao == 2) {

  $sql = "SELECT USUARIO, sum(ATOS), sum(TOT_MATRICULAS), sum(COMPUTADOS), sum(NAO_COMPUTADOS) FROM producao WHERE DATA BETWEEN '$data_inicial' AND '$data_final' GROUP BY USUARIO";


$result = mysqli_query($conn, $sql);

while($linha = mysqli_fetch_assoc($result)){
  $resultado[] = $linha;
}

$usua_men = array();
$tot_ato = array();
$tot_mat_men = array();
$tot_ind_comp_men = array();
$tot_ind_Ncomp_men = array();
foreach ($resultado as $key => $value) {
  $usua_men[$key] = $resultado[$key]['USUARIO'];
  $tot_ato[$key] = $resultado[$key]['sum(ATOS)'];
  $tot_mat_men[$key] = $resultado[$key]['sum(TOT_MATRICULAS)'];
  $tot_ind_comp_men[$key] = $resultado[$key]['sum(COMPUTADOS)'];
  $tot_ind_Ncomp_men[$key] = $resultado[$key]['sum(NAO_COMPUTADOS)'];
}

$contUsu = count($usua_men);
$cont_mat = count($tot_ato);
$tot_mat = count($tot_mat_men);
$tot_ind = count($tot_ind_comp_men);
$tot_Nind = count($tot_ind_Ncomp_men);

} else {

$sql = "SELECT USUARIO, DATA, sum(ATOS), sum(TOT_MATRICULAS), sum(COMPUTADOS), sum(NAO_COMPUTADOS) FROM producao WHERE RECADASTRADOR = '$nome' AND DATA BETWEEN '$data_inicial' AND '$data_final'";

$result = mysqli_query($conn, $sql);

while($linha = mysqli_fetch_assoc($result)){
  $resultado[] = $linha;
}

$usua_men = array();
$tot_ato = array();
$tot_mat_men = array();
$tot_ind_comp_men = array();
$tot_ind_Ncomp_men = array();
foreach ($resultado as $key => $value) {
  $usua_men[$key] = $resultado[$key]['USUARIO'];
  $tot_ato[$key] = $resultado[$key]['sum(ATOS)'];
  $tot_mat_men[$key] = $resultado[$key]['sum(TOT_MATRICULAS)'];
  $tot_ind_comp_men[$key] = $resultado[$key]['sum(COMPUTADOS)'];
  $tot_ind_Ncomp_men[$key] = $resultado[$key]['sum(NAO_COMPUTADOS)'];
}

$contUsu = count($usua_men);
$cont_mat = count($tot_ato);
$tot_mat = count($tot_mat_men);
$tot_ind = count($tot_ind_comp_men);
$tot_Nind = count($tot_ind_Ncomp_men);
}

?>

<!-- http://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/ -->

<!DOCTYPE html>
<html>
  <head>
    <title class="title">Recadastro</title>
    <link rel="shortcut icon" type="image/x-icon" href="_image/favicon.ico">
    <link rel="stylesheet" type="text/css" href="_css/estilo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <meta charset="utf-8">
  </head>

<style type="text/css">
  .close {
    width: 100px;
    color: white;
    float: right;
    font-family:'Arial Narrow',sans-serif;
    font-size: 23px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
  color: red;
  text-decoration: none;
  cursor: pointer;
}

</style>


<body style="width: 60%; margin: auto; background-color: #000; padding-top: 10%;">

    <div style="padding-left: 50px;"> 
        <span class="close" onclick="fechar()"> x </span>
    </div>

    <script type="text/javascript">
      function fechar(){
          location.href='../principalCoordenador.php#td';
    }
    </script>



<div id="x_content1">
   <canvas id="bar-chart"></canvas>
</div>


<script type="text/javascript">

   /* Array das DATAS */
    function totUsuMensal(){
    var usuarios = [
    <?php
    $j=$contUsu;
        for ($i = 0; $i < $j; $i++) {
          ?>  
            String('<?php echo $usua_men[$i] ?>'), 
    <?php } ?>];
    return usuarios;
    }

    /* Array das MATRÍCULAS */
    function totMatMensalPhp(){
    var matMensal = [
    <?php
    $k=$tot_mat;
        for ($i = 0; $i < $k; $i++) {
          ?>  
            Number('<?php echo $tot_mat_men[$i] ?>'), 
    <?php } ?>];
    return matMensal;
    }

    /* Array dos INDICADORES COMPUTADOS */
    function totIndCompMensalPhp(){
    var ind_mensal = [
    <?php
    $l=$tot_ind;
        for ($i = 0; $i < $l; $i++) {
          ?>  
            Number('<?php echo $tot_ind_comp_men[$i] ?>'), 
    <?php } ?>];
    return ind_mensal;
    }

    /* Array dos INDICADORES NÃO COMPUTADOS */
    function totIndNCompMensalPhp(){
    var indNcompMensal = [
    <?php
    $m=$tot_Nind;
        for ($i = 0; $i < $m; $i++) {
          ?>  
            Number('<?php echo $tot_ind_Ncomp_men[$i] ?>'), 
    <?php } ?>];
    return indNcompMensal;
    }

    /* Array dos ATOS */
    function totAtoPhp(){
    var atoMensal = [
    <?php
    $y=$cont_mat;
        for ($i = 0; $i < $y; $i++) {
          ?>  
            Number('<?php echo $tot_ato[$i] ?>'), 
    <?php } ?>];
    return atoMensal;
    }


    /* FUNÇÃO PARA O GRÁFICO POR CONSULTA DE PERÍODO */
    var ctx = document.getElementById("bar-chart").getContext("2d");
    var data = {
      labels: totUsuMensal(),
      datasets: [
        {
          label: "Matrículas",
          backgroundColor: "#c0c0c0",
          barThickness: 0.5,
          data: totMatMensalPhp()
        }
     ]
    };
    var myBarChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: data,
    options: {
        barValueSpacing: 10,
       scales: {
        xAxes: [{
            barPercentage: 0.5,
            barThickness: 6,
            maxBarThickness: 8,
            minBarLength: 2,
            gridLines: {
                offsetGridLines: true
            }
        }]
    },
        title:{
          display:true,
          text:"PRODUÇÃO DE MATRÍCULAS POR PERÍODO" + " (" + "<?php echo $data_inicial_convertida; ?>" + " a " + "<?php echo $data_final_convertida; ?>" + ")",
          fontSize:20,
          position: 'top',
          padding: 50
        },
        legend:{
          display:true,
          position:'right',
          fontSize: 10,
          labels:{
          }
        }
      }
    });

</script>

</body>
</html>