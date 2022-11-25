    <div id="links">
        <a class="nav-link" href="/PARTE%20PRATICA/">Menu</a>
        <a class="nav-link" href="">Salgados</a>
        <a class="nav-link" href="">Doces</a>
        <a class="nav-link" href="">Bebidas</a>
    </div>
    <?php
    if (isset($_SESSION['userId'])) {

        echo'<div id="dados">';
        include '../functions/connection.php';
        $stmt = $conn->query("SELECT usuarios.tipo_usuario_idTipo FROM `usuarios` WHERE idUsuario = ".$_SESSION['userId'].";");
    
        while ($row = $stmt->fetch()) {
            if ($row['tipo_usuario_idTipo'] == 1) {
                echo '<a class="nav-link" href="/PARTE%20PRATICA/assets/pages/novo-produto.php">Cadastrar Produto</a>';
                echo '<a class="nav-link" href="/PARTE%20PRATICA/assets/pages/adm-pedidos.php">Pedidos</a>';
            }else if ($row['tipo_usuario_idTipo'] == 2) {
                echo '<a class="nav-link" href="/PARTE%20PRATICA/assets/pages/novo-produto.php">Pedidos</a>';
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