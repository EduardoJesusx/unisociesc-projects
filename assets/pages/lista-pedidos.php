<?php 
	session_start();
	if (!isset($_SESSION['userId'])){
	header('Location: ./assets/pages/login.php');
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
  <link rel="stylesheet" href="../src/css/pedido_footer.css">
  <link rel="stylesheet" href="../src/css/pedido_main.css">
</head>
	<body>

  <header>
		<div id="logo"><img src="../src/img/Text.svg" alt="logo"></div>
    <div id="dados">
    <a class="nav-link logoff" href="/PARTE%20PRATICA/assets/functions/delete_coockie.php">Sair</a>
    </div>
  </header>
  <main id="desc-product">
	<?php

		include '../functions/connection.php';
    


		 $stmt = $conn->query("SELECT * FROM `pedidos_tem_produtos`  

				INNER JOIN pedidos
				ON pedidos_tem_produtos.pedidos_idPedido = pedidos.idPedido

				INNER JOIN produtos
				ON pedidos_tem_produtos.Produtos_idProduto = produtos.idProduto


				WHERE status < 3 ORDER BY status ASC;");
		
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
				<div class="img"><img class="pizza-img" src="../src/img/calabresa.png"></div>
				<p id="left">'.$row["nome_produtos"].'</p>
				<p id="left">X '.$row["quantidade"].'</p>
				<p id="right">'.$row["status"].'</p>';
        if ($row[["status"] == ""]){?> 
        <a href="/PARTE%20PRATICA/assets/pages/pedidos.php?idPedido=<?=$row["idPedido"]?>">X</a>
        <?php };
        echo'</div>';
		}
	?>
	</main>
</body>
</html>