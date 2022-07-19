<?php
if (!isset($_SESSION)){
    session_start();
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title class="title">Recadastro</title>
    <link rel="shortcut icon" type="image/x-icon" href="_image/favicon.ico">
    <link rel="stylesheet" type="text/css" href="_css/estilo_principal_coordenador_um.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <meta charset="utf-8">
  </head>

<body id="abre">
  <header>
  <div class="first">
      <div class="logo">
        <a href="../principalCoordenador.php"/><img src="_image/logo_recadastro.png" width="300" height="82"></a>
          <nav class="barra">
            <ul>
              <li><a href="sair.php" class="sair" id="icon_saida" onclick="closeWin()"></a></li>
              <li><a href="#rodape" class="ajuda" id="icon_ajuda" onclick="escondeBrasao()">AJUDA</a></li>
              <li><a href="#seq1" class="sequencia" id="icon_sequencias" onclick="mostraBrasao()">SEQUÊNCIAS</a></li>
              <li><a href="#td" class="minha_producao" id="icon_graficos" onclick="escondeBrasao()">GRÁFICOS</a></li>
              <li><a href="#prod_menu" class="enviar_producao" id="icon_enviar_producao" onclick="mostraBrasao()">PRODUÇÃO</a></li>
              <li><a href="#menu_conta" class="contador" id="icon_contador" onclick="mostraBrasao()">CONTADOR</a></li>
              <li><a href="#novo_cadastrador" class="novo" id="icon_novo" onclick="mostraBrasao()">NOVO</a></li>
              <li><a href="#abre" class="principal" id="icon_principal" onclick="mostraBrasao()">PRINCIPAL</a></li>
            </ul>
          </nav>
      </div>
  </div>
  </header>


  <!-- PRINCIPAL -->
  <div class="boasvindas">
    <p>Bem vindo ao Setor de Recadastro</p>
  </div>

  <div class="apresentacao">
    <p>Somos responsáveis pelo recadastramento de todo o acervo de matrículas físicas, bem como informações dos livros e respectivos livros auxiliares e os dados pessoais das partes (Livro 5 - Indicador Pessoal) e dos imóveis (Livro 2 - Matricula).</p>

    <br />
    <br />
    <br />

    <!-- LOGIN -->
    <table id="tableLogin">
       <tr>
        <th id="loginTh">USUÁRIO: </th>
        <td></td>
        <td></td>
        <td id="loginTd"><?php echo $_SESSION['usuarioUsuario'];?></td>
      </tr>
      <tr>
        <th id="loginTh">NOME: </th>
        <td></td>
        <td></td>
        <td id="loginTd"><?php echo $_SESSION['usuarioNome'];?></td>
      </tr>
    </table>

  </div>

  <div>
      <div class="imagem_principal" id="brasao">
        <img src="_image/brasao.png" width="200" height="200"/>
      </div>
  </div>
 


  <!-- NOVO -->
  <div class="novo_rec">

    <div class="enviar_producao_letreiro"  id="novo_cadastrador">
      <p id="envia">NOVO</p>
    </div>


     <div class="container_novo">
          <div class="primeira_novo">
            <form method="post" action="_conection/novo_banco.php">
              <label><h1> &#160 Nome: &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 Sobrenome: </h1></label> 
              <input class="box_nome" type="text" name="nome" id="fname" disable="true" onkeyup="maiusculaNome()" required >
              <input class="box_sobrenome" type="text" name="sobrenome" id="fsobrenome" onkeyup="maiusculaSobrenome()" required >

              <br />

              <label><h1> &#160 Ponto: &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 Usuário: &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 incluir &#160 &#160 &#160 &#160 excluir</h1></label> 
              <input class="box_ponto" type="number" name="ponto" id="fponto" onkeyup="maiusculaPonto()" required>
              <input class="box_usuario" type="text" name="usuario" id="fusuario" onkeyup="maiusculaUsuario()" required > 
              
              <input class="radiobutton" type="radio" id="acesso1" name="acao" value="1" checked="checked" onclick="habilitar()"> &#160 &#160 &#160 
              <input class="radiobutton" type="radio" id="acesso2" name="acao" value="2" onclick="deshabilitar()">

              <br />
              <br />

              <label><h1> &#160 Senha: &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160  &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 Confirmação de senha: </h1></label> 
              <input class="box_senha" type="password" name="senha" maxlength="6" id="fsenha" onkeyup="maiusculaSenha()" required >
              <input class="box_senha" type="password" name="confere_senha" maxlength="6" id="confsenha" onkeyup="maiusculaConfsenha()" required>

              <div>
                <button class="submit_novo" type="" id="buttonSubmit" value="Enviar">Enviar</button>
              </div>
            </form>


            <!-- FUNÇÃO PARA DEIXAR OS CAMPOS COM LETRAS MAIÚSCULAS E ALTERA A CORDE FUNDO DOS BOX -->

            <script type="text/javascript">
                function habilitar(){
               if(document.getElementById('acesso1').checked = "checked"){
                    
                    document.getElementById('fname').disabled=false;
                    document.getElementById('fname').style.opacity = '1.0';
                    
                    document.getElementById('fsobrenome').disabled=false;
                    document.getElementById('fsobrenome').style.opacity = '1.0';
                   
                    document.getElementById('fsenha').disabled=false;
                    document.getElementById('fsenha').style.opacity = '1.0';
                    
                    document.getElementById('confsenha').disabled=false;
                    document.getElementById('confsenha').style.opacity = '1.0';
                
                }
              }


              function deshabilitar(){
               if(document.getElementById('acesso2').checked = "checked"){
                    
                    document.getElementById('fname').disabled=true;
                    document.getElementById('fname').style.opacity = '0.3';
                    
                    document.getElementById('fsobrenome').disabled=true;
                    document.getElementById('fsobrenome').style.opacity = '0.3';

                    document.getElementById('fsenha').disabled=true;
                    document.getElementById('fsenha').style.opacity = '0.3';
                    
                    document.getElementById('confsenha').disabled=true
                    document.getElementById('confsenha').style.opacity = '0.3';
                }
              }

             function maiusculaNome(){
                var x = document.getElementById("fname");
                x.value = x.value.toUpperCase();
                if (x.value != "") {
                  document.getElementById("fname").style.backgroundColor = "#BCAAA9";
                  document.getElementById("fname").style.color = "#FFFFFF";
                } else {
                  document.getElementById("fname").style.backgroundColor = "#FFFFFF";
                }
              }


              function maiusculaSobrenome(){
                var y = document.getElementById("fsobrenome");
                y.value = y.value.toUpperCase();
                if (y.value != "") {
                  document.getElementById("fsobrenome").style.backgroundColor = "#BCAAA9";
                  document.getElementById("fsobrenome").style.color = "#FFFFFF";
                } else {
                  document.getElementById("fsobrenome").style.backgroundColor = "#FFFFFF";
                  }
                }


              function maiusculaPonto(){
                var p = document.getElementById("fponto");
                p.value = p.value.toUpperCase();
                if (p.value != "") {
                  document.getElementById("fponto").style.backgroundColor = "#BCAAA9";
                  document.getElementById("fponto").style.color = "#FFFFFF";
                } else {
                  document.getElementById("fponto").style.backgroundColor = "#FFFFFF";
                  }
                }


              function maiusculaUsuario(){
                var z = document.getElementById("fusuario");
                z.value = z.value.toUpperCase();
                if (z.value != "") {
                  document.getElementById("fusuario").style.backgroundColor = "#BCAAA9";
                  document.getElementById("fusuario").style.color = "#FFFFFF";
                } else {
                document.getElementById("fusuario").style.backgroundColor = "#FFFFFF";
                  }
                }

                function maiusculaSenha(){
                var u = document.getElementById("fsenha");
                u.value = u.value.toUpperCase();
                if (u.value != "") {
                  document.getElementById("fsenha").style.backgroundColor = "#BCAAA9";
                  document.getElementById("fsenha").style.color = "#FFFFFF";
                } else {
                document.getElementById("fsenha").style.backgroundColor = "#FFFFFF";
                  }
                }

              /* ALEM DAS CORES, ESSA FUNÇÃO VERIFICA SE OS DOIS CAMPOS DE SENHA SÃO IGUAIS */
              function maiusculaConfsenha() {
                var c = document.getElementById("confsenha");
                var senha = document.getElementById("fsenha").value;
                var confsenha = document.getElementById("confsenha").value;
                if (senha == confsenha){
                  c.value = c.value.toUpperCase();
                  if (c.value != "") {
                    document.getElementById("confsenha").style.backgroundColor = "#BCAAA9";
                    document.getElementById("confsenha").style.color = "#FFFFFF";
                  } else {
                    document.getElementById("confsenha").style.backgroundColor = "#FFFFFF";
                    }
                } else {
                    document.getElementById("confsenha").style.backgroundColor = "#FFFFFF";
                    document.getElementById("confsenha").style.color = "#000000";
                }
              } 

            </script>

          </div>
      </div>

  </div>




  <!-- CONTADORES -->
  <div id="menu_conta">
    <div class="contadores" >
      <div class="letreiro_contadores">
        <p id="letra_conta">CONTADOR</p>
      </div>
      <button class="botao_conta_indicadores" type="submit" value="botao_conta_indicadores" onclick="openWin()"><img src="_image/porindicador.png" width="90" height="90"/></button>
      <button class="botao_conta_matriculas" type="submit" value="botao_conta_matriculas" onclick="openMat()"><img src="_image/pormatricula.png" width="90" height="90"/></button>
      <p id="pindicador">por indicador</p>
      <p id="pmatricula">por matricula</p>
    </div>


    <!-- FUNÇÃO (abre janela de contador) -->
    <script type="text/javascript">
      function openWin() {
        abrirWindow = window.open('../contporind.php', "contador", "width=20,height=1000,left=500");
        }
      function closeWin() {
        fecharWindow = abrirWindow.close();
        }
    </script>

    <script type="text/javascript">
      function openMat() {
        abrirWindow = window.open('../contpormat.php', "contador", "width=20,height=1000,left=500");
        }
      function closeMat() {
        fecharWindow = abrirWindow.close();
        }
    </script>

  </div>

<!-- PRODUÇÃO -->
<div class="producao" id="prod_menu">
  <div class="enviar_producao_letreiro">
    <p id="envia">PRODUÇÃO</p>
  </div>
  <div class="primeira">
    <form method="post" action="_conection/producao_banco.php">
      <label><h1>RECADASTRADOR:</h1></label>
      <div class="custom-select" style="width:340px;">
        <select required>
          <option value='<?php echo $_SESSION['usuarioPonto'];?>'><?php echo $_SESSION['usuarioNome'];?></option>;
          <option value=""> - </option>;
        </select>
      </div>
      <br />

      <label><h1>DATA (dd/mm/aaaa): </h1></label>
      <input class="data" type="text" name="data" OnKeyUp="mascaraData(this);" maxlength="10" value='<?php echo (date("d/m/Y"));?>'/>
      <br /> <br />

      <ul style="width: 300px; height: 50px; padding-right: 0px;">
        <li><a href="javascript:history.go()" id="atualiza"></a></li>
      </ul>

      <script type="text/javascript">
        function mascaraData(campoData){
          var data = campoData.value;
          if (data.length == 2){
            data = data + '/';
            document.forms[0].data.value = data;
            return true;              
          }
          if (data.length == 5){
            data = data + '/';
            document.forms[0].data.value = data;
            return true;
          }
        }
      </script>


      <!-- COMPLETA OS INPUTS DAS MATRÍCULAS -->
      <!--
      <div id="matSub"></div>
      <script type="text/javascript">
        function carregaValueMat(){
          $('#matSub').load("_conection/compimpmat_banco.php");
        }
        setInterval("carregaValueMat()", 1000);
      </script>
    -->

  </script>

  <!-- MATRÍCULAS -->

  <?php include "_conection/compimpmat_banco.php"?>

  <div class="container">
    <label><h1>MATRÍCULAS:</h1></label>
    <input class="matricula_inicial" type="number" id="num1" name="matini" onkeyup="calcular_matriculas()" required placeholder=<?php $compNum1 = num1(); echo $compNum1; ?>>
    <input class="matricula_final" type="number" id="num2" name="matfim" onkeyup="calcular_matriculas()" required placeholder=<?php $compNum1 = num1(); echo $compNum1; ?>>
    <div class="middle">
      <div class="text">PRIMEIRA &#160 &#160 &#160 &#160 &#160 &#160 &#160 ÚLTIMA</div>
    </div>
  </div>

  <div class="container2">
    <label></label>
    <div class="soma_matriculas" value="100"><span id="resultado" style="font-size:12px; color:#cc7a66; position: justify;"></span></div>
    <div class="middle2">
      <div class="text2">SOMA</div>
    </div>
  </div>


  <!-- INDICADORES -->
      <!-- 
      <?php include "_conection/compimpind_banco.php"?>

      <div class="container1">
        <label><h1>INDICADORES &#160 / &#160 ATOS: </h1></label>
          <input class="ato_computado" type="number" id="num3" name="computados" onkeyup="calcular_atos()" required placeholder=<?php $compNum3 = num3(); echo $compNum3; ?>>
          <input class="ato_nao_computado" type="number" id="num4" name="nao_computados" onkeyup="calcular_atos()" required placeholder=<?php $compNum4 = num4(); echo $compNum4; ?>>
        <div class="middle1">
          <div class="text1">COMPUTADOS &#160 &#160 &#160 &#160 &#160 &#160 NÃO COMPUTADOS </div>
        </div>
      </div>

      <div class="container2">
        <label></label>
        <div class="soma_atos"><span id="resultado1" style="font-size:12px; color:#cc7a66; position: justify;"></span></div>
          <div class="middle2">
            <div class="text2">SOMA</div>
          </div>
      </div>
    -->
    

    <!-- COMPLETA OS INPUTS DOS INDICADORES -->
      <!--
      <div id="indSub"></div>
      <script type="text/javascript">
        function carregaValueInd(){
          $('#indSub').load("_conection/compimpind_banco.php");
        }
        setInterval("carregaValueInd()", 1000);
      </script>
    -->


      <?php include "metaindicadores.php" ?>

      <div class="justa">
        <div id="just">
          <label><h3 style="color:#FF0000">JUSTIFICATIVA: </h3></label>
          <textarea class="comentario" name="justifica" id="comentRequired"></textarea>
        </div>
      </div>
      <br />
      <div class="falta"><h1>SALDO PARA META: </h1></div>
      <div class="tot_dia"><span><?php print_r($total_meta); ?></span></div>
        <button class="submit" type="" id="buttonSubmit" value="Enviar" onClick="myFunction()">Enviar</button>
  </div>
</form>

            
<!-- FUNÇÕES (Enviar Produção) -->
<script type="text/javascript">
    // Soma Matrículas
    function calcular_matriculas() {
      var num1 = Number(document.getElementById("num1").value);
      var num2 = Number(document.getElementById("num2").value);
      var elemResult = document.getElementById("resultado");
      if (elemResult.textContent === undefined) {
        elemResult.textContent = String(num2 - num1);
        }
      else {
        elemResult.innerText = String(num2 - num1);
        }

        var s1 = document.getElementById("num1").value;
        var s2 = document.getElementById("num2").value;
        var s3 = s2 - s1;
        if (s3 <= 1) {
          document.getElementById('just').style.display='block';
          document.getElementById('comentRequired').required = true;
          }
        else {
          document.getElementById('just').style.display='none';
          document.getElementById('comentRequired').required = false;
        }
      }


    // Soma Indicadores - Atos
    function calcular_atos() {
      var num3 = Number(document.getElementById("num3").value);
      var num4 = Number(document.getElementById("num4").value);
      var elemResult = document.getElementById("resultado1");
      if (elemResult.textContent === undefined) {
        elemResult.textContent = String(num3 + num4);
        }
      else {
        elemResult.innerText = String(num3 + num4);
        }

        var s6 = document.getElementById("resultado1").innerText;
        if (s6 < 179) {
          document.getElementById('just').style.display='block';
          document.getElementById('comentRequired').required = true;
          }
        else {
          document.getElementById('just').style.display='none';
          document.getElementById('comentRequired').required = false;
        }
      }




    // Nome do Recadastrador
    var x, i, j, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 0; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
      });
      b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
      });
     }
  
    function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    for (i = 0; i < y.length; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i)
        } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < x.length; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
        }
      }
    }
    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);
</script>
</div>
    

                                         
<!-- GRÁFICOS -->
<div class="todos_graficos" id="td">

<!-- SEMANAL -->  
  <div class="graficos">
    <div class="graf1">
      <button class="botao_grafico_minha" id="minha" type="button" value="Minha" onclick="myFunction1()"> Período</button>
    </div>

    <div id="graficos_imagem1"></div>

        <!-- FUNÇÃO QUE CARREGA O GRÁFICO SEMANAL -->
        <script>
          function carregarSemanal(pagina){
            $("#graficos_imagem1").load(pagina);
          }
        </script>


 <script>
  function myFunction1() {
    var x = document.getElementById('graficos_imagem1');
    if (x.style.display === "none") {
        document.getElementById("graficos_imagem1").style.display='block';
        document.getElementById("minha").style.backgroundColor = "#000000";
        document.getElementById("minha").style.fontStyle = "italic";
        document.getElementById("minha").style.fontFamily = "Arial Narrow',sans-serif";
        document.getElementById("seq1").style.visibility = 'hidden';
        document.getElementById("rodape").style.visibility = 'hidden';
        document.getElementById("td").style.height = '0px';
        document.getElementById("seq1").style.height = '0px';
        document.getElementById("mensal").disabled = true;
        document.getElementById("geral").disabled = true;
        document.getElementById("mensal").style.opacity = 0;
        document.getElementById("geral").style.opacity = 0;
        carregarSemanal('botoesconsulta.php');

        /* FUNÇÃO PARA ROLAR ATÉ POSIÇÃO DA DIV (minha) */
        $('html, body').animate({
            scrollTop: $('#minha').offset().top
            }, 1000);
     

    } else {
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
  }
  </script>
</div>
 

<!-- LETREIRO -->
<div class="graficos">
  <div class="letreiro_grafico" id="janelagraf">
    <p id="letreiro_grafico_graf">GRÁFICOS</p>
  </div>
</div>


<!-- MENSAL -->
<div class="graficos">
  <div class="graf2">
      <button class="botao_grafico_mensal" id="mensal" type="button" value="Mensal" onclick="myFunction2()">Mensal</button>
  </div>


    <div id="graficos_imagem2"></div>

        <!-- FUNÇÃO QUE CARREGA O GRÁFICO MENSAL -->
        <script>
          function carregarMensal(pagina){
            $("#graficos_imagem2").load(pagina);
          }
        </script>


  <script>
  function myFunction2() {
    var x = document.getElementById('graficos_imagem2');
    if (x.style.display === "none") {
        document.getElementById("graficos_imagem2").style.display='block';
        document.getElementById("mensal").style.backgroundColor = "#000000";
        document.getElementById("mensal").style.fontStyle = "italic";
        document.getElementById("mensal").style.fontFamily = "Arial Narrow',sans-serif";
        document.getElementById("seq1").style.visibility = 'hidden';
        document.getElementById("rodape").style.visibility = 'hidden';
        document.getElementById("td").style.height = '0px';
        document.getElementById("seq1").style.height = '0px';
        document.getElementById("minha").disabled = true;
        document.getElementById("geral").disabled = true;
        document.getElementById("minha").style.opacity = 0;
        document.getElementById("geral").style.opacity = 0;
        carregarMensal('_graficos/mensal_matriculas.php');
        
        /* FUNÇÃO PARA ROLAR ATÉ POSIÇÃO DA DIV (mensal) */
        $('html, body').animate({
            scrollTop: $('#mensal').offset().top
          }, 1000);

    } else {
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
  }

  </script> 



</div>


<!-- GERAL -->
<div class="graficos">
  <div class="graf3">
      <button class="botao_grafico_geral" id="geral" type="button" value="Geral" onclick="myFunction3()">Geral</button>
  </div>

<div id="graficos_imagem3"></div>

        <!-- FUNÇÃO QUE CARREGA O GRÁFICO MENSAL -->
        <script>
          function carregarGeral(pagina){
            $("#graficos_imagem3").load(pagina);
          }
        </script>



  <script>
  function myFunction3() {
    var x = document.getElementById('graficos_imagem3');
    if (x.style.display === "none") {
        document.getElementById("graficos_imagem3").style.display='block';
        document.getElementById("geral").style.backgroundColor = "#000000";
        document.getElementById("geral").style.fontStyle = "italic";
        document.getElementById("geral").style.fontFamily = "Arial Narrow',sans-serif";
        document.getElementById("seq1").style.visibility = 'hidden';
        document.getElementById("rodape").style.visibility = 'hidden';
        document.getElementById("td").style.height = '0px';
        document.getElementById("seq1").style.height = '0px';
        document.getElementById("minha").disabled = true;
        document.getElementById("mensal").disabled = true;
        document.getElementById("minha").style.opacity = 0;
        document.getElementById("mensal").style.opacity = 0;
        carregarGeral('botoesgeral.php');

        /* FUNÇÃO PARA ROLAR ATÉ POSIÇÃO DA DIV (geral) */
        $('html, body').animate({
            scrollTop: $('#geral').offset().top
          }, 1000);

    } else {
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
  }

  </script>

    </br>
    </br>
    </br>

  </div>
</div>




<!-- SEQUÊNCIAS -->
<div class="seq" id="seq1">

  <div class="letreiro_seq">
    <p id="letreiro_sequencia">SEQUÊNCIA</p>
  </div>

  <div id="gif_sequencia">
    <p>
      <img src="_gifs/sequencia1.gif" id="gif1">
    </p>
  </div>

  <div id="img_sequencia">
    <p>
      <img src="_gifs/sequencia_imagem.gif" id="img_gif">
    </p>
  </div>


    <button class="botao_gerar_sequencia" id="gera_seq" type="button" value="gerar" onclick="alertaGeraSequencia()">Gerar</button>

  <!-- FUNÇÕES (Sequência) -->
  <script type="text/javascript">

    function alertaGeraSequencia() {
      var txt;
      var seq;      
       if (confirm("Confirma emissão de sequência?")) {
        txt = "You pressed OK!";
        setTimeout(geraSequencia, 1000);
        setTimeout(mostraSequencia, 8000);
        carrega();
        document.getElementById('gera_seq').style.display='none';
      } else {
        txt = "You pressed Cancel!";
      }
        document.getElementById("demo").innerHTML = txt;
    }

    function geraSequencia() {
      var x = document.getElementById('gif_sequencia');
      if (x.style.display === "none") {
        document.getElementById('img_sequencia').style.display='none';
      } else {
        document.getElementById('gif_sequencia').style.display='block';
        document.getElementById('img_sequencia').style.display='none';
      }
    }
   
    function mostraSequencia() {
      var x = document.getElementById('mostra_sequencia');
      if (x.style.display === "none") {
        document.getElementById('gif_sequencia').style.display='none';
      } else {
        document.getElementById('mostra_sequencia').style.display='block';
        document.getElementById('gif_sequencia').style.display='none';
      }
    }
  </script>

  <script type="text/javascript">
    function carrega(){
      $('#sequencia_gerada').load("_conection/sequencia_banco.php");
    }
  </script>

    <div id="mostra_sequencia"> 
      <div id="sequencia_gerada">
      </div>
    </div>

</div>


<!-- AJUDA -->
<div class="aba_ajuda" id="rodape">
  <div class="letreiro_ajuda">
    <p><a id="letras_ajuda" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:o_setor" target="_blank">AJUDA</a></p>
  </div>
  <div class="duvidas">
    <table class="tabelas">
      <tr>
        <th><a><img src="_image/duvidas1.png" width="60" height="60"></a></th>
        <th><a><img src="_image/duvidas2.png" width="60" height="60"></a></th> 
        <th><a><img src="_image/duvidas4.png" width="60" height="60"></a></th>
        <th><a><img src="_image/duvidas5.png" width="60" height="60"></a></th>
        <th><a><img src="_image/duvidas6.png" width="60" height="60"></a></th>
      </tr>
      <tr>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:vazio_ou_zerado" target="_blank">CPF vazio ou zerado?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:zerado" target="_blank">CNPJ zerado?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:exceto_para_os_seguintes_recadastradores" target="_blank">Quais são as exceções para o CONF?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:regime_de_bens" target="_blank">O que são os Regimes de Bens?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:urbano" target="_blank">O que é um imóvel Urbano?</a></td>
      </tr>
      <tr>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:sem_radical" target="_blank">CPF sem radical?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:cnpj_sem_radical" target="_blank">CNPJ sem radical</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:estado_civil" target="_blank">O que é Estado Civil?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:sequencia" target="_blank">O que é uma SEQUENCIA?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:unidades_autonomas" target="_blank">Unidades Autônomas?</a></td>
      </tr>
      <tr>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:no_sistema_register_ha_um_cpf_diferente_daquele_da_matricula" target="_blank">No Sistema Register há um CPF diferente da matrícula?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:razao_social_nome_da_empresa_divergindo" target="_blank">Razão Social divergindo?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:nomes_dos_indicadores" target="_blank">Quais qualificações (nomes do indicadores) devem ser cadastrados?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:unificacao" target="_blank">Como unifico um indicador? (UNIFICAÇÃO)</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:rural" target="_blank">O que é um imóvel Rural?</a></td>
      </tr>
      <tr>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:a_esposa_ja_tem_cpf_proprio" target="_blank">A esposa ja tem CPF próprio?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:codigo" target="_blank">O que é um CÓDIGO?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:rec" target="_blank">O que é REC?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:livro_2_-_anotacoes" target="_blank">Livro 2 - Anotações</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:livro_2_-_campos" target="_blank">Livro 2 - Campos</a></td>
      </tr>
      <tr>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:espolio" target="_blank">Como se cadastra ESPÓLIO?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:conf" target="_blank">O que é CONF?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:padroes_de_preenchimento_livro_5" target="_blank">Como os campos do Livro 5 devem ser preenchidos?</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/doku.php?id=setores:trainee:principios" target="_blank">Princípios Registrais</a></td>
        <td><a id="links" href="http://wiki.gleci.com.br/lib/exe/fetch.php?media=setores:trainee:manual_de_estagio.pdf" target="_blank">Manual do Estagiário</a></td>
      </tr>
    </table>
  </div>

  <script type="text/javascript">
  function escondeBrasao() {
    var x = document.getElementById('brasao');
    if (x.style.display === "none") {
        document.getElementById("brasao").style.display='block';
    } else {
        document.getElementById("brasao").style.display='none';
      }
    }

  function mostraBrasao() {
    var y = document.getElementById('brasao');
    if (y.style.display === "none") {
        document.getElementById("brasao").style.display='block';
    } 
  }

  </script>


</body>
</html>