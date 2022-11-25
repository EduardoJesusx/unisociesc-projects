<?php
	$id = $_GET['id'];
	session_start();
	if (!isset($_SESSION['userId'])){
		header('Location: /PARTE%20PRATICA/assets/pages/login.php');
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/css/main.css">
  <link rel="stylesheet" href="../src/css/pedido_footer.css">
  <link rel="stylesheet" href="../src/css/pedido_main.css">
  <title>Projeto</title>
</head>
<body>
  <header>
		<div id="logo"><img src="../src/img/Text.svg" alt="logo"></div>
		<?php include_once '../pages/parts/header.php'?>

	<main id="desc-product">
	<?php

		include '../functions/connection.php';
    
		if (isset($_GET['idPedido']) && isset($_GET['idProduto'])) {

      $stmt = $conn->query("SELECT * FROM `pedidos_tem_produtos`  

				INNER JOIN pedidos
				ON pedidos_tem_produtos.pedidos_idPedido = pedidos.idPedido

				INNER JOIN produtos
				ON pedidos_tem_produtos.Produtos_idProduto = produtos.idProduto


				WHERE pedidos.usuarios_idUsuario =".$_SESSION['userId']." AND Produtos_idProduto = ".$_GET['idProduto']." AND pedidos_tem_produtos.pedidos_idPedido = ".$_GET['idPedido'].";");
		
			while ($row = $stmt->fetch()) {
				if ($row['status'] == 0) {

					$stmt = $conn->query("DELETE FROM `pedidos_tem_produtos` WHERE Produtos_idProduto = ".$_GET['idProduto']." AND pedidos_tem_produtos.pedidos_idPedido = ".$_GET['idPedido'].";");
					$stmt->fetch();

					header('Location: /PARTE%20PRATICA/assets/pages/pedidos.php');
				};
			};	
		};

		if (isset($_GET['finalizar-pedido'])) {
			if ($_GET['finalizar-pedido'] == true) {
				$stmt = $conn->query("UPDATE `pedidos` SET `status`= 1 WHERE usuarios_idUsuario = 1 AND `status`= 0;");
				$stmt->fetch();
        header('Location: /PARTE%20PRATICA/');

			}
		}

		 $stmt = $conn->query("SELECT * FROM `pedidos_tem_produtos`  

				INNER JOIN pedidos
				ON pedidos_tem_produtos.pedidos_idPedido = pedidos.idPedido

				INNER JOIN produtos
				ON pedidos_tem_produtos.Produtos_idProduto = produtos.idProduto


				WHERE pedidos.usuarios_idUsuario =".$_SESSION['userId']." AND status < 3 ORDER BY status ASC;");
		
		while ($row = $stmt->fetch()) {
			$precoFinal = $row["preco"] * $row["quantidade"];

			$row["preco"] = str_replace('.', ',', $row["preco"]);
			if($row["status"] == 0) {
				$row["status"] = 'Em Aberto';
			};
			if($row["status"] == 1) {
				$row["status"] = 'Pendente';
			};
			if($row["status"] == 2) {
				$row["status"] = 'Produção';
			};
			if($row["status"] == 3) {
				$row["status"] = 'Concluido';
			};
			if($row["status"] == 4){
				$row["status"] = 'Encerrado';
			};

			echo'
			<div id="conteudo">
				<div class="img"><img class="pizza-img" src="../src/img/produtos/'.$row["imagem"].'.png"></div>
				<p id="left">'.$row["nome_produtos"].'</p>
				<p id="left">X '.$row["quantidade"].'</p>
				<p id="right">R$'.$row["preco"].'</p>
				<p id="right">'.$row["status"].'</p>';
        if ($row[["status"] == ""]){?> 
        <a href="/PARTE%20PRATICA/assets/pages/pedidos.php?idPedido=<?=$row["idPedido"]?>">X</a>
        <?php };
        echo'</div>';
		}
	?>
	</main>


  <!-- <select name="status-pedido" >
    <option value="1">Pendente</option>
    <option value="2">Produção</option>
    <option value="3">Concluido</option>
    <option value="4">Encerrado</option>
  </select> -->


	<footer>
		<a href="/PARTE%20PRATICA/assets/pages/pedidos.php?finalizar-pedido=true" id="footer-pedido">
			<p>R$
				<?php
				if (!isset($precoFinal)) {
					$precoFinal = 0.00;
				};
				$_SESSION['precoFinal'] = number_format((float)$precoFinal, 2, ',', '');
				echo $_SESSION['precoFinal'];
				?>
			 </p>
			<p>Finalizar Pedido</p>
		</a>
	</footer>
</body>
</html>