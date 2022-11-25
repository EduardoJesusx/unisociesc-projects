
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
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/css/main.css">
  <link rel="stylesheet" href="../src/css/product.css">
  <link rel="stylesheet" href="../src/css/cart_footer.css">
  <script src="../src/js/add_button.js"></script>
  <title>Projeto</title>
</head>
<body>
  <header>
		<div id="logo"><img src="../src/img/Text.svg" alt="logo"></div>
		<?php include_once '../pages/parts/header.php'?>
		
	<?php
		include '../functions/connection.php';
		$stmt = $conn->query("SELECT produtos.idProduto, tipoproduto.nome_tipoProduto, produtos.nome_produtos, produtos.descricao, produtos.preco FROM produtos INNER JOIN tipoproduto on produtos.tipoProduto_idtTipo_produto = tipoproduto.idTipo_produto WHERE produtos.idProduto=".$id.";");
		
		while ($row = $stmt->fetch()) {
			$row["preco"] = str_replace('.', ',', $row["preco"]);
			echo'
			<main id="desc-product">
			<div id="img-product">
				<img src="../src/produtos/src/img/1.png" alt="">
			</div>
			<h1>'.$row["nome_produtos"].'</h1>
			<div id="content">
				<p>
				'.$row["descricao"].'
				</p>
			</div>
			<form id="action" method="GET" action="./novo-pedido.php">
				<div id="count-product">
					<button type="button" onclick="alterAmounth(1)" class="add-button count-button left">+</button>
					<input value="1" id="input-product" name="qnt" min="0" readonly="readonly" type="number">
					<button type="button" onclick="alterAmounth(-1)" class="add-button count-button right">-</button>
				</div>
				<button type="submit" id="adicionar"  class="add-button">Adicionar R$'.$row["preco"].'</button>
			</fom>
		</main>';
		$_SESSION['idProduto'] = $row['idProduto'];
		}
	?>


	<?php include '../functions/connection.php'; ?>
	<footer>
		<a href="#" id="footer-content">
			<p id="price">Total 49,99</p>
		</a>
	</footer>
</body>
</html>