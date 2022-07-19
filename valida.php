<?php

	/* https://www.youtube.com/watch?v=OB_OgduOFTU */

    if (!isset($_SESSION)){
    session_start();
	}

	include_once '_conection/conection_est.php';


	if((isset($_POST['usrnm'])) && (isset($_POST['psw']))) {
        
        // EVITA MYSQL INJECTION 
		$usuario = mysqli_real_escape_string($conn, $_POST['usrnm']);
		$senha = mysqli_real_escape_string($conn, $_POST['psw']);

		$sql = "SELECT * FROM login WHERE usuario = '$usuario' AND senha = '$senha' LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$resultado = mysqli_fetch_assoc($result);

		if(empty($resultado)){
			$_SESSION['loginErro'] = "Usuário ou senha inválido";
			header("Location: index.php");
		} elseif (isset($resultado)){

			if (($resultado["USUARIO"] == "BRUNO.SOUSA") || ($resultado["USUARIO"] == "OSIAS.ROSARIO") || ($resultado["USUARIO"] == "RAQUEL.TORELLY")) {
				$_SESSION['usuarioPonto'] = $resultado["PONTO"];
				$_SESSION['usuarioNome'] = $resultado["NOME"];
				$_SESSION['usuarioUsuario'] = $resultado["USUARIO"];
				$_SESSION['usuarioSenha'] = $resultado["SENHA"];
				header("Location: principalCoordenador.php");
			} else {
				$_SESSION['usuarioPonto'] = $resultado["PONTO"];
				$_SESSION['usuarioNome'] = $resultado["NOME"];
				$_SESSION['usuarioUsuario'] = $resultado["USUARIO"];
				$_SESSION['usuarioSenha'] = $resultado["SENHA"];
				header("Location: principal.php");
			}
		
		} else {
			$_SESSION['loginErro'] = "Usuário ou senha inválido";
			header("Location: index.php");
		}

	} else {
		$_SESSION['loginErro'] = "Usuário ou senha inválido";
		header("Location: index.php");
	}

?>