<?php
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
    if (isset($_POST['status-pedido'])) {
      $stmt = $conn->query("UPDATE `pedidos` SET `status`='".$_POST['status-pedido']."' WHERE idPedido =".$_GET['idPedido']);
      $stmt->fetch();
      header('Location: /PARTE%20PRATICA/assets/pages/adm-pedidos.php');
    }
		 $stmt = $conn->query("SELECT * FROM `pedidos_tem_produtos`  

				INNER JOIN pedidos
				ON pedidos_tem_produtos.pedidos_idPedido = pedidos.idPedido

				INNER JOIN produtos
				ON pedidos_tem_produtos.Produtos_idProduto = produtos.idProduto


				WHERE idPedido = ".$_GET['idPedido'].";");
		while ($row = $stmt->fetch()) {
      $_SESSION['precoFinal'] = $row["preco"] * $row["quantidade"];

			$row["preco"] = str_replace('.', ',', $row["preco"]);
    };

    $stmt = $conn->query("SELECT * FROM `pedidos` WHERE pedidos.idPedido = ".$_GET['idPedido'].";"); 

		while ($row = $stmt->fetch()) {
      

			if($row["status"] == 0) {
				$row["status"] = '';
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

			echo'<form method="POST" action="#" id="conteudo">
				<p id="left"> Id   - '.$row["idPedido"].'</p>
				<p id="right">R$'.number_format((float)$_SESSION['precoFinal'], 2, ',', '').'</p>
        <select name="status-pedido">';
          if($row['status'] == '') {
            echo '<option selected value="0">Em aberto</option>';
            echo '<option value="1">Pendente</option>';
            echo '<option value="2">Produção</option>';
            echo '<option value="3">Concluido</option>';
            echo '<option value="4">Encerrado</option>';

          };  
          if ($row['status'] == 'Pendente') {
            echo '<option value="0">Em aberto</option>';
            echo '<option selected value="1">Pendente</option>';
            echo '<option value="2">Produção</option>';
            echo '<option value="3">Concluido</option>';
            echo '<option value="4">Encerrado</option>';
          };
          if ($row['status'] == 'Produção') {
            echo '<option  value="0">Em aberto</option>';
            echo '<option value="1">Pendente</option>';
            echo '<option selected value="2">Produção</option>';
            echo '<option value="3">Concluido</option>';
            echo '<option value="4">Encerrado</option>';
          };
          if ($row['status'] == 'Concluido') {
            echo '<option  value="0">Em aberto</option>';
            echo '<option value="1">Pendente</option>';
            echo '<option value="2">Produção</option>';
            echo '<option selected value="3">Concluido</option>';
            echo '<option value="4">Encerrado</option>';
          };
          if ($row['status'] == 'Encerrado') {
            echo '<option  value="0">Em aberto</option>';
            echo '<option value="1">Pendente</option>';
            echo '<option value="2">Produção</option>';
            echo '<option value="3">Concluido</option>';
            echo '<option selected value="4">Encerrado</option>';
          };?>
        </select>
        <?php 
        };
    ;?>
        <button type="submit">Salvar</button>
  </form>
	</main>

	<footer>
	</footer>
</body>
</html>