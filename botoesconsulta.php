<?php

if (!isset($_SESSION)){
  session_start();
}

include '_conection/conection_est.php';

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

$sql = "SELECT PONTO, RECADASTRADOR, USUARIO FROM producao WHERE PONTO != 30 AND PONTO != 31";
$result = mysqli_query($conn, $sql);
while($linha = mysqli_fetch_assoc($result)){
  $resultado[] = $linha;
}

$ponto = array();
$nome = array();
$usuario = array();
foreach ($resultado as $key => $value) {
  $ponto[$key] = $resultado[$key]['PONTO'];
  $nome[$key] = $resultado[$key]['RECADASTRADOR'];
  $usuario[$key] = $resultado[$key]['USUARIO'];
}

$nomeUnico = array_unique($nome);

?>


<!DOCTYPE html>
<html>
<head>
  <title class="title">Recadastro</title>
  <link rel="shortcut icon" type="image/x-icon" href="_image/favicon.ico">
  <link rel="stylesheet" type="text/css" href="_css/estilo_botoesconsulta.css">
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

  <!-- BOTÃO PARA FECHAR A ABA -->
  <div> 
    <span class="close" onclick="fechar()"> x </span>
  </div>


  <!-- FUNÇÃO QUE CARREGA O GRÁFICO GERAL DE INDICADORES -->
  <script>
    function carregarPeriodo(pagina){
     $("#graficos_imagem1").load(pagina);
   }
 </script>


 <!-- FUNÇÃO PARA FECHAR A ABA -->
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



<!-- FORMULÁRIO PARA GERAR O GRÁFICO -->
<form class="principia" action="_graficos/consulta_matriculas.php" method="post">
  <div id="botoes_grafico_todos" style="margin-left: 15%;">
    <input class="radiobutton" type="radio" id="acesso1" name="acao" value="1" checked="checked" onclick="habilitar()" style="width: 50px; height: 30px;"><span style="vertical-align: 10px; color: white; font-family:'Arial Narrow',sans-serif; font-weight: bold;">Por Recadastrador</span> &#160 &#160 &#160 &#160 &#160 &#160 
    <input class="radiobutton" type="radio" id="acesso2" name="acao" value="2" onclick="deshabilitar()" style="width: 50px; height: 30px;"><span style="vertical-align: 10px; color: white; font-family:'Arial Narrow',sans-serif; font-weight: bold;">Todos</span>
  </div>

  <script type="text/javascript">
    function habilitar(){
     if(document.getElementById('acesso1').checked = "checked"){
      document.getElementById('selecao').disabled=false;
      document.getElementById('selecao').style.opacity = '1.0';
    }
  }

  function deshabilitar(){
   if(document.getElementById('acesso2').checked = "checked"){
    document.getElementById('selecao').disabled=true;
    document.getElementById('selecao').style.opacity = '0.3';
    document.getElementById("selecao").options[2].selected = "true";
    document.getElementById("selecao").options[0].selected = "false";
  }
}
</script>

<br/>

<div>
  <label>Nome: </label>
  <div>
    <select id="selecao" name="ngraf" style="height: 38px;">
      <option> <?php echo "-" ?> </option>;
      <?php 
      foreach ($nomeUnico as $key => $value) { ?>
        <option> <?php echo $value ?> </option>;
      <?php }
      ?>
    </select>
  </div>
</div>

<br />

<label>Período: &#160 &#160 </label><br />
<input class="datagraf" type="date" name="datainigraf">
<label> &#160 &#160 &#160 até &#160 &#160 &#160 </label>
<input class="datagraf" type="date" name="datafimgraf">
<button class="botao" id="buttonSubmit" value="Enviar" onclick="abreGrafConsulta()"> > </button>

<!-- FUNÇÃO QUE CARREGA O GRÁFICO POR CONSULTA -->
<script>
  function abreGrafConsulta() {
    carregarPeriodo('_graficos/botoesconsulta.php');
  }
</script>
</form>
</body>
</html>