<?php
session_start();
	if (!isset($_SESSION['userId'])){
		header('Location: /PARTE%20PRATICA/assets/pages/login.php');
		die();
	}
	include '../functions/connection.php';
		 $stmt = $conn->query("SELECT COUNT(*) FROM `pedidos` WHERE usuarios_idUsuario = ".$_SESSION['userId']." AND status = 0;");

			while($row = $stmt->fetch()) {
			 	var_dump($row);
				if($row['COUNT(*)'] == '0'){
				 	$stmt = $conn->query("INSERT INTO `pedidos`(`usuarios_idUsuario`, `dataConfirmacao`, `dataFechamento`, `status`, `quantidade`) VALUES (".$_SESSION['userId'].",null,null,0,".$_GET['qnt'].")");
				};			
			};

		$stmt = $conn->query("SELECT pedidos.idPedido FROM `pedidos` WHERE usuarios_idUsuario = ".$_SESSION['userId']." AND status = 0;");
			
			while($row = $stmt->fetch()) {
				echo($_GET['qnt']);
				$stmt = $conn->query("INSERT INTO `pedidos_tem_produtos`(`Produtos_idProduto`, `pedidos_idPedido`, `quantidade`) VALUES (".$_SESSION['idProduto'].",".$row['idPedido'].",".$_GET['qnt'].");");				
				};			

		header('Location: /PARTE%20PRATICA');

