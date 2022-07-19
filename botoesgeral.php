<!DOCTYPE html>
<html>
  <head>
    <title class="title">Recadastro</title>
    <link rel="shortcut icon" type="image/x-icon" href="_image/favicon.ico">
    <link rel="stylesheet" type="text/css" href="_css/estilo_botoesgeral.css">
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
    function carregarGeral(pagina){
      $("#graficos_imagem3").load(pagina);
    }
</script>

<!-- FUNÇÃO PARA FECHAR A ABA -->
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


<div>
      <button class="botao_geral_indicadores" type="submit" onclick="abreGeralInd()"><img src="_image/geralind.png" width="50" height="50" /></button>
      <p id="indicadores"> INDICADORES (Livro 5) </p>

      <!-- FUNÇÃO QUE CARREGA O GRÁFICO GERAL DE INDICADORES -->
      <script>
        function abreGeralInd() {
          carregarGeral('_graficos/geral_indicadores.php');
        }
      </script>



      <button class="botao_geral_matcampo" type="submit" onclick="abreGeralMatCamp()"><img src="_image/matcampos.png" width="50" height="50" /></button>
      <p id="matriculacampo"> MATRÍCULAS (Campos) </p>

      <!-- FUNÇÃO QUE CARREGA O GRÁFICO GERAL DAS MATRÍCULAS (Campos) -->
      <script>
        function abreGeralMatCamp() {
          carregarGeral('_graficos/geral_matriculas_campos.php');
        }
      </script>



      <button class="botao_geral_matanota" type="submit" onclick="abreGeralMatAnot()"><img src="_image/matanota.png" width="50" height="50" /></button>
      <p id="matriculanota"> MATRÍCULAS (Anotações) </p>

      <!-- FUNÇÃO QUE CARREGA O GRÁFICO GERAL DAS MATRÍCULAS (Anotações) -->
      <script>
        function abreGeralMatAnot() {
          carregarGeral('_graficos/geral_matriculas_anotacoes.php');
        }
      </script>
</div>

</body>
</html>