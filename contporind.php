<?php
if (!isset($_SESSION)){
  session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title class="title">Contador por Indicador</title>
  <link rel="shortcut icon" type="image/x-icon" href="_image/favicon.ico">
  <link rel="stylesheet" type="text/css" href="_css/est_contporind.css">
  <meta charset="utf-8">
</head>
<body>
  <header>
    <script type="text/javascript">
        // CONTADOR
        var i = 0;
        function contaComputados() {
          i++;
          if (i == 0) {
            document.getElementById("resultado_computados").innerHTML = i;
            document.getElementById("demoInd").value = i;
          } else {
            document.getElementById("resultado_computados").innerHTML = i;
            document.getElementById("demoInd").value = i;
          }
        }

        // CORES NÚMEROS DO CONTADOR
        function verde(){
          document.getElementById("resultado_computados").style.color = "#0000FF";
        }
        
        function preto(){
          document.getElementById("resultado_computados").style.color = "#BCAAA9";
        }

        function cinza(){
          document.getElementById("demoComp").style.backgroundColor = "#BCAAA9";
          document.getElementById("demoNComp").style.backgroundColor = "#BCAAA9";
          document.getElementById("demoComp").style.color = "#FFFFFF";
          document.getElementById("demoNComp").style.color = "#FFFFFF";
        }

        function branco(){
          document.getElementById("demoComp").style.backgroundColor = "#FFFFFF";
          document.getElementById("demoNComp").style.backgroundColor = "#FFFFFF";
          document.getElementById("demoComp").style.color = "#000000";
          document.getElementById("demoNComp").style.color = "#000000";
        }

        // RESULTADO NÃO COMPUTADOS
        function calcular_indicadores() {
          var resultado_computados = Number(document.getElementById("demoInd").value);
          var computados = Number(document.getElementById("demoComp").value);
          var nao_computados = document.getElementById("resultado");
          if (nao_computados.textContent === undefined) {
            nao_computados.textContent = String(resultado_computados - computados);
            document.getElementById("demoNComp").value = nao_computados.textContent = String(resultado_computados - computados);
          }
          else {
            nao_computados.innerText = String(resultado_computados - computados);
            document.getElementById("demoNComp").value = nao_computados.textContent = String(resultado_computados - computados);
          }
        }
      </script>

      <div class="prime">
        <div class="logo">
          <a href="../principal.php"/><img src="_image/logo_recadastro.png" width="150" height="60"></a>
        </div>

        <!-- BOTÃO INDICADOR -->
        <button class="btn_matriculas" id="btn_conta_comp" onclick="contaComputados()" onmouseover="verde()" onmouseout="preto()"><p id="letreiro_btn_mat">I<br/></button>
          <p id="valores_computados"><span id="resultado_computados">0</span></p>
        </div>
      </header>

      <br />

      <a><img src="_icons/seta.png" width="150" height="60" style="padding-top: 80px; padding-left: 35px;"></a>

      </table>

      <p style="color: #BCAAA9; padding-top: 50px; padding-left: 25px; text-align: center; font-family:'Arial Black',sans-serif; ">CONTADOR</p>

      
        <form method="get" action="_conection/contporind_banco.php">

          <div id="form_enviar">
            <table class="tableLogin">
              <tr>
                <td><input type="text" id="demoInd" size="5" style="text-align: center; display: none;" onkeyup="calcular_indicadores()"></td>
                <td><input type="text" name="valorComp" id="demoComp" size="2" onkeyup="calcular_indicadores()"></td>
                <td></td>
                <td style="font-family:'Arial Narrow',sans-serif;">&</td>
                <td></td>
                <td><input type="text" name="valorNComp" id="demoNComp" size="2" onkeyup="calcular_indicadores()"><span id="resultado" style="display: none;"></span></td>
              </tr>
              <tr>
                <td></td>
                <td class="letreiro_cursor_comp" style="color: #FFFFFF;">COMPUTADOS</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="letreiro_cursor_ncomp" style="color: #FFFFFF;">NÃO COMPUTADOS</td>
              </tr>
            </table>

      <br />

      <button type="submit" id="botaoContMat" style="height: 50px;" onmouseover="cinza()" onmouseout="branco()"><img src="_icons/archive_black.png"  width="20" height="20" /></button>

      </div>

      </form>

    </body>
    </html>