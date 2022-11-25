<?php
	session_start();
if (isset($_SESSION['userId'])){
	header('Location: /PARTE%20PRATICA/index.php');
}


  if (isset($_POST['email'])){
		include '../functions/connection.php';
		$stmt = $conn->query("SELECT usuarios.idUsuario, usuarios.senha, usuarios.email FROM usuarios WHERE usuarios.senha = '".$_POST["password"]."' AND usuarios.email= '".$_POST['email']."';");
		while ($row = $stmt->fetch()) {


		echo $_POST['password'], $row['senha'];
				if ($_POST['email'] === $row['email'] and $_POST["password"] === $row['senha']) {;

			$validation = true;
		}else {
			$validation = 2;
		}

			if(isset($validation)) {

				if ($validation === 2) {
					$_SESSION['erros'] = ['Usuário ou senha inválido!'];
				  }
				if($validation === true){

				$_SESSION['erros'] = null;
				$_SESSION['userId'] = $row['idUsuario'];
				header('Location: /PARTE%20PRATICA/index.php');
			}
		}
		}

  }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Projeto</title>
	<link rel="stylesheet" href="../src/css/main.css">
	<link rel="stylesheet" href="../src/css/login.css">
</head>

<body>
	<header>
		<div id="logo"><img src="../src/img/Text.svg" alt="logo"></div>
	</header>
    <main>
			
		<form action="#" method="post">

        <div class="erros">
          <?php if(isset($_SESSION['erros'])){
						foreach ($_SESSION['erros'] as $erro) :
						echo '<p id="error">'.$erro.'</p>';
						endforeach;
					};		
				?>			
        </div>

			<h1>Login</h1>
			<label for="email">Email</label>
				<input require type="email" name="email">
			<label for="password">password</label>
				<input require type="password" name="password">
				<button type="submit">Entrar</button>
			<a href="">Não tem uma conta?</a>
		</form>
	</main>
</body>

</html>