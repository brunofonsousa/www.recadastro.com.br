<?php
if (!isset($_SESSION)){
  session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title class="title">Contador por Matrícula</title>
  <link rel="shortcut icon" type="image/x-icon" href="_image/favicon.ico">
  <link rel="stylesheet" type="text/css" href="_css/estilo_cont_mat.css">
  <meta charset="utf-8">
</head>
<body>
  <header>
    <div class="prime" style="height: 650px;">
      <div class="logo" style="padding-top: 10px;">
        <a href="../principal.php"/><img src="_image/logo_recadastro.png" width="150" height="60"></a>
      </div>

      <!-- BOTÃO MATRICULAS -->
      <button class="btn_matriculas" id="btn_conta_comp" onclick="contaComputados()" onmouseover="verde()" onmouseout="preto()"><p id="letreiro_btn_mat">M<br/>

        <p id="valores_computados"><span id="resultado_computados" style="color: rgb(188, 170, 169);">0</span></p>

        <script type="text/javascript">
          var i = 0;
          function contaComputados() {
            i++;
            if (i == 0) {
              document.getElementById("resultado_computados").innerHTML = i;
              document.getElementById("demoMat").value = i;
            } else {
              document.getElementById("resultado_computados").innerHTML = i;
              document.getElementById("demoMat").value = i;
            }
          }

          function verde(){
            document.getElementById("resultado_computados").style.color = "#008000";
            document.getElementById("seta").style.color = "#008000";
          }

          function preto(){
            document.getElementById("resultado_computados").style.color = "rgb(188, 170, 169)";
            document.getElementById("seta").style.color = "rgb(188, 170, 169)";
          }

        </script>
      </div>
    </header>

    <a><img src="_icons/seta.png" id="seta" width="150" height="60" style="padding-left: 40px;"></a>

    <p style="color: #BCAAA9; padding-top: 50px; padding-left: 24px; text-align: center; font-family:'Arial Black',sans-serif; font-size: 10px;">ENVIAR PRODUÇÃO</p>

    <form method="get" action="_conection/contpormat_banco.php">

     <button type="submit" id="botaoContMat"><img src="_icons/archive_black.png" width="20" height="20" /></button>

     <input type="text" name="valorMat" id="demoMat" size="5" style="display: none;">

   </form>

 </body>
 </html>