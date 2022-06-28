<?php

if (!isset($_SESSION)){
    session_start();
}

include '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");
$ponto = $_SESSION['usuarioPonto'];
$usuario = $_SESSION['usuarioUsuario'];
$data_inicial = date("Y-m-d");
$data_mes = date("m");
$data_ano = date("Y");

/* CALCULAR DATA
$data_dia = date("d");
$data_mes = date("m");
$data_ano = date("Y");

$data_dia_final = $data_dia + 30;

if ($data_dia_final > 30){
	$data_dia_fim = $data_dia;
	$data_mes_fim = $data_mes - 1;
	if ($data_mes_fim < 10){
		$data_mes_fim = "0".$data_mes_fim;
	}
	$data_final = date($data_ano . '-' . $data_mes_fim . '-' . $data_dia_fim);
} else {
	$data_dia_fim = $data_dia;
	$data_mes_fim = $data_mes;
	$data_final = date($data_ano . '-' . $data_mes_fim . '-' . $data_dia_fim);
}
*/


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


$sql = "SELECT USUARIO, sum(ATOS), sum(TOT_MATRICULAS), sum(COMPUTADOS), sum(NAO_COMPUTADOS) FROM producao WHERE Month(DATA) = $data_mes AND Year(DATA) = $data_ano GROUP BY USUARIO";
$result = mysqli_query($conn, $sql);
while($linha = mysqli_fetch_assoc($result)){
	$resultado[] = $linha;
}

$sql_data = "SELECT DATA, sum(TOT_MATRICULAS) FROM producao WHERE Month(DATA) = $data_mes GROUP BY DATA";
$result_data = mysqli_query($conn, $sql_data);
while($linha_data = mysqli_fetch_assoc($result_data)){
  $resultado_data[] = $linha_data;
}

foreach ($resultado_data as $key => $value) {
  $tot_mat_um[$key] = $resultado_data[$key]['sum(TOT_MATRICULAS)'];
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

$media_dia = (int)(array_sum($tot_mat_um) / count($resultado_data));


// MÊS e ANO
$num = (int) $data_mes - 1;
$meses_string = ["JANEIRO/", "FEVEREIRO/", "MARÇO/", "ABRIL/", "MAIO/", "JUNHO/", "JULHO/", "AGOSTO/", "SETEMBRO/", "OUTUBRO/", "NOVEMBRO/", "DEZEMBRO/"];
(string) $mes_insert = $meses_string[$num] .$data_ano = date("Y"); /** MES **/

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


<body>

    <div> 
        <span class="close" onclick="fechar()"> x </span>
    </div>

    <script type="text/javascript">
      function fechar(){
        document.getElementById("graficos_imagem2").style.display='none';
        document.getElementById("mensal").style.backgroundColor = "#BCAAA9";
        document.getElementById("mensal").style.fontFamily = "Arial Narrow',sans-serif";
        document.getElementById("mensal").style.fontStyle = "normal";
        document.getElementById("seq1").style.visibility = '';
        document.getElementById("rodape").style.visibility = '';
        document.getElementById("td").style.height = '800px';
        document.getElementById("seq1").style.height = '800px';
        document.getElementById("minha").disabled = false;
        document.getElementById("geral").disabled = false;
        document.getElementById("minha").style.opacity = 10;
        document.getElementById("geral").style.opacity = 10;

        /* FUNÇÃO PARA ROLAR ATÉ POSIÇÃO INICIAL DA DIV (td) */
        $('html, body').animate({
            scrollTop: $('#td').offset().top
          }, 1000);

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

    /* Array dos ATOS 
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
    */

    /* FUNÇÃO PARA O GRÁFICO MENSAL */
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
          text:"Produção Mensal" + " (" + "<?php echo $mes_insert; ?>" + ")" + "   -   Média Diária de Matrículas: " + " (" + "<?php echo $media_dia; ?>" + ")",
          fontSize: 20,
          position: 'top',
          padding: 40
        },
        legend:{
          display: false,
          position:'right',
          fontSize: 10,
          labels:{
          }
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 80,
                bottom: 80
            }
      }
    }
    });

</script>

</body>
</html>