
<?php
	session_start();
	if (!isset($_SESSION['userId'])){
		header('Location: /PARTE%20PRATICA/assets/pages/login.php');
	}
  if (isset($_POST['name'])) {
    
include '../functions/connection.php';
		$stmt = $conn->query("INSERT INTO `produtos`(`idProduto`, `tipoProduto_idtTipo_produto`, `nome_produtos`, `descricao`, `preco`, `imagem`) VALUES ('null','".$_POST['tipo']."','".$_POST['name']."','".$_POST['desc']."','".$_POST['preco']."','".$_POST['img']."');");
		$stmt->fetch();

    header('Location: /PARTE%20PRATICA/');
    die(); 
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
	<link rel="stylesheet" href="../src/css/card.css">
	<link rel="stylesheet" href="../src/css/cart_footer.css">
  <link rel="stylesheet" href="../src/css/cadastro-form.css">
</head>

	<body>
    <form action="#" method="post">
      <div>
        <label for="name">Nome</label>
        <input require type="text" name="name" id="name" />
      </div>
      <div>
        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo">
          <option value="1">Salgado</option>
          <option value="2">Doce</option>
          <option value="3">Bebida</option>
        </select>
      </div>
      <div>
        <label for="desc">Descrição</label>
        <input require type="text" name="desc" id="desc" />
      </div>

      <div>
        <label for="preco">Preço</label>
        <input require  step=".01"  type="number" name="preco" id="preco" />
      </div>

      <div>
        <label for="img">Imagem</label>
        <input type="file" id="img" name="img" accept="image/*,.pdf" />
      </div>
      <button require type="submit">Cadastrar</button>
    </form>
</body>
</html>