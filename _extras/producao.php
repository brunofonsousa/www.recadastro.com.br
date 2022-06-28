<!DOCTYPE html>
<html>
<head>

<title class="title">Produção</title>
  <link rel="shortcut icon" type="image/x-icon" href="_image/favicon.ico">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="_css/estilo_prod.css">
</head>

<body>
  <div class="primeira">
        <img src="_image/brasao.png" width="320" height="300" />
    <div>
        <br /> <br />
    </div>
    <form method="POST" action="">
      <label><h1>RECADASTRADOR:</h1></label>
      <div class="custom-select" style="width:340px;">
        <select required>
          <option value="0"> </option>;
          <option value="1">ANDRÉIA LETICIA JOHANN</option>;
          <option value="2">BIANCA STEFINI ALEBRANT</option>
          <option value="3">JOÃO CARLOS MINELLI NETO</option>
          <option value="4">JÚLIA RAASCH QUADROS</option>
          <option value="5">LETÍCIA GOMES D'AGOSTIN</option>
          <option value="6">RAFAELA DA SILVA</option>
          <option value="7">VICTTÓRIA B. S. GONÇALVES</option>
        </select>
      </div>
      <br />

      <label><h1>DATA (dd/mm/aaaa): </h1></label>
        <input class="data" type="date" required>
      <br /> <br />

      <div class="container">
        <label><h1>MATRÍCULAS:</h1></label>
          <input class="matricula_inicial" type="number" id="num1" onkeyup="calcular_matriculas()" required>
          <input class="matricula_final" type="number" id="num2" onkeyup="calcular_matriculas()" required>
        <div class="middle">
          <div class="text">PRIMEIRA &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 ÚLTIMA</div>
        </div>
      </div>

      <div class="container2">
        <label></label>
          <div class="soma_matriculas"><span id="resultado" style="font-size:12px; color:#cc7a66; position: justify;" ></span></div>
        <div class="middle2">
          <div class="text2">SOMA</div>
        </div>
      </div>

      <div class="container1">
        <label><h1>ATOS: </h1></label>
          <input class="ato_computado" type="number" id="num3" onkeyup="calcular_atos()" required>
          <input class="ato_nao_computado" type="number" id="num4" onkeyup="calcular_atos()" required>
        <div class="middle1">
          <div class="text1">COMPUTADOS &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 NÃO COMPUTADOS </div>
        </div>
      </div>

      <div class="container2">
        <label></label>
        <div class="soma_atos"><span id="resultado1" style="font-size:12px; color:#cc7a66; position: justify;"></span></div>
          <div class="middle2">
            <div class="text2">SOMA</div>
          </div>
      </div>

      <div class="justa">
        <div id="just">
          <label><h3 style="color:#FF0000">JUSTIFICATIVA:</h3></label>
          <textarea class="comentario"></textarea>
        </div>
      </div>

      <br />
        <button class="submit" type="submit" value="Enviar">Enviar</button>
  </div>

                                            


  <!-- FUNÇÕES -->
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
      }


    // Soma Atos
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

        var s1 = document.getElementById("num3").value;
        var s2 = document.getElementById("num4").value;
        var s3 = s1 + s2;
        if (s3 <= 99) {
          document.getElementById('just').style.display='block';
          }
        else {
          document.getElementById('just').style.display='none';
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
  </form>
</body>
<br />
<br />
<br />
</html>