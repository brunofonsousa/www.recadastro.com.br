<?php

if (!isset($_SESSION)){
    session_start();
}

include '../_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$sql = "SELECT DATA, MES, TOT_INDICADORES, TOT_MATRICULAS_CAMPOS, TOT_MATRICULAS_ANOTACOES FROM graficogeral WHERE DATA >= '2019-08-01'";
$result = mysqli_query($conn, $sql);
while($linha = mysqli_fetch_assoc($result)){
	$resultado[] = $linha;
}

$ult_mat = "SELECT MAT_ULTIMA FROM producao ORDER BY MAT_ULTIMA DESC LIMIT 1";
$resultult = mysqli_query($conn, $ult_mat);
$resultfim = mysqli_fetch_assoc($resultult);
$ultima_matricula = $resultfim["MAT_ULTIMA"];

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
        document.getElementById("graficos_imagem3").style.display='none';
        document.getElementById("geral").style.backgroundColor = "#BCAAA9";
        document.getElementById("geral").style.fontFamily = "Arial Narrow',sans-serif";
        document.getElementById("geral").style.fontStyle = "normal";
        document.getElementById("seq1").style.visibility = '';
        document.getElementById("rodape").style.visibility = '';
        document.getElementById("td").style.height = '800px';
        document.getElementById("seq1").style.height = '800px';
        document.getElementById("minha").disabled = false;
        document.getElementById("mensal").disabled = false;
        document.getElementById("minha").style.opacity = 10;
        document.getElementById("mensal").style.opacity = 10;

        /* FUNÇÃO PARA ROLAR ATÉ POSIÇÃO INICIAL DA DIV (td) */
        $('html, body').animate({
            scrollTop: $('#td').offset().top
          }, 1000);
      }
    </script>


<?php //include "atualiza_geral_anotacoes.php";// ?>

<div id="x_content2">
   <canvas id="bar" height="170" width="400"></canvas>
</div>

<script type="text/javascript">

      function totMes(){
    var mesGeral = [
    <?php
    $t=$contMes;
        for ($i = 0; $i < $t; $i++) {
          ?>  
            String('<?php echo "$meses[$i]"; ?>'),
    <?php } ?>];
    return mesGeral;
    }


    function totIndicadores(){
    var matIndGeral = [
    <?php
    $u=$contInd;
        for ($i = 0; $i < $u; $i++) {
          ?>  
            Number('<?php echo $indicadores[$i] ?>'), 
    <?php } ?>];
    return matIndGeral;
    }


    function totMatCampos(){
    var matCampos = [
    <?php
    $v=$contMatCamp;
        for ($i = 0; $i < $v; $i++) {
          ?>  
            Number('<?php echo $matriculas_campos[$i] ?>'), 
    <?php } ?>];
    return matCampos;
    }


    function totMatAnot(){
    var matAnot = [
    <?php
    $x=$contMatAnot;
        for ($i = 0; $i < $x; $i++) {
          ?>  
            Number('<?php echo $matriculas_anotacoes[$i] ?>'), 
    <?php } ?>];
    return matAnot;
    }

        new Chart(document.getElementById("bar"), {
    type: 'bar',
    data: {
      labels: totMes(),
      datasets: [
        {
          label: "Indicadores",
          type: "line",
          backgroundColor: "red",
          borderColor: "white",
          data: totMatAnot(),
          fill: false
        }, {
          label: "Indicadores",
          type: "bar",
          backgroundColor: "#113CCF",
          data: totMatAnot()
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: "PRODUÇÃO GERAL DO SETOR DE RECADASTRO (Total de Anotações: " + "<?php echo $mat_anot; ?>" + "  -  " + "Última Matrícula: " + "<?php echo $ultima_matricula; ?>" + ")",
      }
    }
  });
</script>

</body>
</html>