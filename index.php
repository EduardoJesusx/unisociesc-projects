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
	<link rel="stylesheet" href="./assets/src/css/main.css">
	<link rel="stylesheet" href="./assets/src/css/card.css">
	<link rel="stylesheet" href="./assets/src/css/cart_footer.css">
</head>

	<body>

	<header>
		<div id="logo"><img src="./assets/src/img/Text.svg" alt="logo"></div>
	
		<div id="links">
        <a class="nav-link" href="/PARTE%20PRATICA/">Menu</a>
        <a class="nav-link" href="/PARTE%20PRATICA/index.php?pesquisa=1">Salgados</a>
        <a class="nav-link" href="/PARTE%20PRATICA/index.php?pesquisa=2">Doces</a>
        <a class="nav-link" href="/PARTE%20PRATICA/index.php?pesquisa=3">Bebidas</a>
    </div>
    <?php
    if (isset($_SESSION['userId'])) {

        echo'<div id="dados">';
        include 'assets/functions/connection.php';
				
        $stmt = $conn->query("SELECT usuarios.tipo_usuario_idTipo FROM `usuarios` WHERE idUsuario = ".$_SESSION['userId'].";");
    
        while ($row = $stmt->fetch()) {
            if ($row['tipo_usuario_idTipo'] == 1) {
                echo '<a class="nav-link" href="/PARTE%20PRATICA/assets/pages/novo-produto.php">Cadastrar Produto</a>';
                echo '<a class="nav-link" href="/PARTE%20PRATICA/assets/pages/pedidos.php">Pedidos</a>';
            }else if ($row['tipo_usuario_idTipo'] == 2) {
								header('Location: ./assets/pages/lista-pedidos.php');
            }
            else{
                echo '<a class="nav-link" href="/PARTE%20PRATICA/assets/pages/pedidos.php">Meus Pedidos</a>';
            }
        }

        echo'
        <a class="nav-link logoff" href="/PARTE%20PRATICA/assets/functions/delete_coockie.php">Sair</a>
        </div>';


        };
?>
    
</header>


	<main id="cardapio">
		<?php
		include 'assets/functions/connection.php';

		if(isset($_GET['pesquisa'])){
			if ($_GET['pesquisa'] == 1) {
				$stmt = $conn->query("SELECT produtos.idProduto, tipoproduto.nome_tipoProduto, produtos.nome_produtos, produtos.descricao, produtos.preco FROM produtos INNER JOIN tipoproduto on produtos.tipoProduto_idtTipo_produto = tipoproduto.idTipo_produto WHERE produtos.tipoProduto_idtTipo_produto = 1;");

				
			};
			if ($_GET['pesquisa'] == 2) {
				$stmt = $conn->query("SELECT produtos.idProduto, tipoproduto.nome_tipoProduto, produtos.nome_produtos, produtos.descricao, produtos.preco FROM produtos INNER JOIN tipoproduto on produtos.tipoProduto_idtTipo_produto = tipoproduto.idTipo_produto WHERE produtos.tipoProduto_idtTipo_produto = 2;");
			};
			if ($_GET['pesquisa'] == 3) {
				$stmt = $conn->query("SELECT produtos.idProduto, tipoproduto.nome_tipoProduto, produtos.nome_produtos, produtos.descricao, produtos.preco FROM produtos INNER JOIN tipoproduto on produtos.tipoProduto_idtTipo_produto = tipoproduto.idTipo_produto WHERE produtos.tipoProduto_idtTipo_produto = 3;");
			};
		}else{
			$stmt = $conn->query("SELECT produtos.idProduto, tipoproduto.nome_tipoProduto, produtos.nome_produtos, produtos.descricao, produtos.preco FROM produtos INNER JOIN tipoproduto on produtos.tipoProduto_idtTipo_produto = tipoproduto.idTipo_produto;");
		}

		
		while ($row = $stmt->fetch()) {
			echo'
			<section class="card">
			<div class="img"><img class="pizza-img" src="./assets/src/img/calabresa.png"></div>
			<div class="content">
				<p>'.$row["nome_produtos"].'</p>
				<a href="./assets/pages/produto.php?id='.$row["idProduto"].'" class="add"><img src="./assets/src/img/plus-circle-solid.svg"></a>
			</div>
			</section>';
		}
	?>
	</main>

	<footer>
		<div id="footer-content">
			<a href="/PARTE%20PRATICA/assets/pages/pedidos.php">Total</p>
			<a href="/PARTE%20PRATICA/assets/pages/pedidos.php" id="price"><?=$_SESSION['precoFinal'];?></a>
		</div>
	</footer>
</body>

</html>