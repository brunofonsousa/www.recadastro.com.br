<?php

if (!isset($_SESSION)){
  session_start();
}


include '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");
$ponto = $_SESSION['usuarioPonto'];
$usuario = $_SESSION['usuarioUsuario'];
$data = date("Y-m-d");


$data_dia = date("d");
$data_mes = date("m");
$data_ano = date("Y");

/*$data_dia_final = $data_dia - 5;
$data_final = date($data_ano . '-' . $data_mes . '-' . $data_dia_final);
$data_convertida = implode('-', array_reverse(explode('/', $data)));*/

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


$usu = array();
$tot_mat = array();
$tot_ind = array();
$dat = array();

/*
$sql = "SELECT RECADASTRADOR, DATA, sum(ATOS), sum(TOT_MATRICULAS), sum(COMPUTADOS), sum(NAO_COMPUTADOS) FROM producao WHERE PONTO = $ponto AND DATA BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE() AND $data GROUP BY DATA ASC ORDER BY DATA";
$result = mysqli_query($conn, $sql);
*/


$sql = "SELECT RECADASTRADOR, DATA, sum(ATOS), sum(TOT_MATRICULAS), sum(COMPUTADOS), sum(NAO_COMPUTADOS) FROM producao WHERE PONTO = '$ponto' GROUP BY DATA ORDER BY DATA DESC LIMIT 7";
$result = mysqli_query($conn, $sql);


while($linha = mysqli_fetch_assoc($result)){
	$resultado[] = $linha;
}

$usua = array();
$date = array();
$data_convertida = array();
$tot_ato = array();
$tot_mat = array();
$tot_ind = array();
$cores = array();
foreach ($resultado as $key => $value) {
	$usua[$key] = $resultado[$key]['RECADASTRADOR'];
	$date[$key] = $resultado[$key]['DATA'];
	$data_convertida[$key] = implode('/', array_reverse(explode('-', $date[$key])));
  $tot_ato[$key] = $resultado[$key]['sum(ATOS)'];
  $tot_mat[$key] = $resultado[$key]['sum(TOT_MATRICULAS)'];
  $tot_ind_comp[$key] = $resultado[$key]['sum(COMPUTADOS)'];
  $tot_ind_Ncomp[$key] = $resultado[$key]['sum(NAO_COMPUTADOS)'];
}

$quant_datas = count($resultado);

?>


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
      document.getElementById("graficos_imagem1").style.display='none';
      document.getElementById("minha").style.backgroundColor = "#BCAAA9";
      document.getElementById("minha").style.fontFamily = "Arial Narrow',sans-serif";
      document.getElementById("minha").style.fontStyle = "normal";
      document.getElementById("seq1").style.visibility = '';
      document.getElementById("rodape").style.visibility = '';
      document.getElementById("td").style.height = '800px';
      document.getElementById("seq1").style.height = '800px';
      document.getElementById("mensal").disabled = false;
      document.getElementById("geral").disabled = false;
      document.getElementById("mensal").style.opacity = 10;
      document.getElementById("geral").style.opacity = 10;

      /* FUNÇÃO PARA ROLAR ATÉ POSIÇÃO INICIAL DA DIV (td) */
      $('html, body').animate({
        scrollTop: $('#td').offset().top
      }, 1000);

    }
  </script>



  <div id="x_content">
    <canvas id="graOne"></canvas>
  </div>

  <script type="text/javascript">
    /* Array da DATA */
    function dataPhp(){
      var data = [
      <?php
      for ($i = 0; $i < $quant_datas; $i++) {
        ?>  
        String('<?php echo $data_convertida[$i] ?>'), 
        <?php } ?>];
        return data;
      }

      /* Array das MATRÍCULAS */
      function totMatPhp(){
        var data = [
        <?php
        for ($i = 0; $i < $quant_datas; $i++) {
          ?>  
          Number('<?php echo $tot_mat[$i] ?>'), 
          <?php } ?>];
          return data;
        }

        /* Array dos INDICADORES COMPUTADOS */
        function totIndCompPhp(){
          var data = [
          <?php
          for ($i = 0; $i < $quant_datas; $i++) {
            ?>  
            Number('<?php echo $tot_ind_comp[$i] ?>'), 
            <?php } ?>];
            return data;
          }

          /* Array dos INDICADORES NÃO COMPUTADOS */
          function totIndNCompPhp(){
            var data = [
            <?php
            for ($i = 0; $i < $quant_datas; $i++) {
              ?>  
              Number('<?php echo $tot_ind_Ncomp[$i] ?>'), 
              <?php } ?>];
              return data;
            }

            /* Array dos ATOS */
            function totAtosPhp(){
              var data = [
              <?php
              for ($i = 0; $i < $quant_datas; $i++) {
                ?>  
                Number('<?php echo $tot_ato[$i] ?>'), 
                <?php } ?>];
                return data;
              }



              /* FUNÇÃO PARA O GRÁFICO SEMANAL */
              function geraGraficoSemanal(){

                var ctx = document.getElementById("graOne").getContext("2d");
                var data = {
                  labels: dataPhp(),
                  datasets: [
                  {
                    label: "Matrículas",
                    type: "line",
                    backgroundColor: "#FFFFFF",
                    borderColor: "#808080",
                    data: totMatPhp(),
                    fill: false,
                    tension: 0
                  },
                  {
                    label: "Matrículas",
                    backgroundColor: "#000000",
                    data: totMatPhp()
                  },
                  ]
                };
                var myBarChart = new Chart(ctx, {
                  type: 'bar',
                  data: data,
                  options: {
                    barValueSpacing: 5,
                    scales: {
                      xAxes: [{
                        barPercentage: 10,
                      }],
                      yAxes: [{
                        ticks: {
                          min: 0,
                        }
                      }]
                    },
                    title:{
                      display: true,
                      text: "Produção semanal (Matrículas): " + "<?php echo $usua[1] ?>",
                      fontSize:20,
                      position: 'top',
                      padding: 80
                    },
                    legend:{
                      display: false,
                      position:'right',
                      fontSize: 10,
                      labels:{
                      }
                    }
                  }
                });
              }

              geraGraficoSemanal();

        </script>
    </body>
</html>

