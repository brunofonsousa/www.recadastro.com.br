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
    <link rel="stylesheet" type="text/css" href="_css/estilo_index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/blip-chat-widget" type="text/javascript">
</script>
<script src="https://unpkg.com/blip-chat-widget" type="text/javascript">
</script>

  
  <body>
    <div class="first">
      <div class="logo">
        <img src="_image/logo_recadastro.png" width="350" height="150"/>
      </div>
      <form method="POST" action="valida.php">
        <div class="input-container">
          <i class="fa fa-user icon"></i>
          <input class="input-field" type="text" placeholder="Nome" name="usrnm" id="lognome" onkeyup="logNome()" required autofocus>
        </div>
        <div class="input-container">
          <i class="fa fa-key icon"></i>
          <input class="input-field" type="password" placeholder="Senha" name="psw" id="logsenha" onkeyup="logSenha()" required>
        </div>
        
        <!-- FUNÇÕES PARA DEIXAR AS LETRAS MAIÚSCULAS E TROCAR A COR DE FUNDO NOS CAMPOS DE LOGIN E SENHA -->
        <script type="text/javascript">
            function logNome(){
                var x = document.getElementById("lognome");
                x.value = x.value.toUpperCase();
                if (x.value != "") {
                  document.getElementById("lognome").style.backgroundColor = "#FFFFAA";
                  document.getElementById("lognome").style.color = "#000000";
                } else {
                  document.getElementById("lognome").style.backgroundColor = "#FFFFFF";
                }
             }

            function logSenha(){
                var y = document.getElementById("logsenha");
                y.value = y.value.toUpperCase();
                if (y.value != "") {
                  document.getElementById("logsenha").style.backgroundColor = "#FFFFAA";
                  document.getElementById("logsenha").style.color = "#000000";
                } else {
                  document.getElementById("logsenha").style.backgroundColor = "#FFFFFF";
                }
             }
             
        </script>




        <button type="submit" class="btn">Entrar</button>
      </form>
      <p class="erro_sessao">
        <?php 
          if (isset($_SESSION['loginErro'])){
            echo $_SESSION['loginErro'];
            unset ($_SESSION['loginErro']);
          }
        ?>
      </p>
    </div> 
    

    
  </body>
  
</html>