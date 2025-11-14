<?php include('valida_sessao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Principal</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>
    <div class="header">
        <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?></h1>
        <a href="logout.php" class="logout">Sair</a>
    </div>
    <div class="container-menu">
        <ul class="menu">
            <li><a href="cadastro_fornecedor.php" class="cadastro">Cadastro de Fornecedores</a></li>
            <li><a href="cadastro_produto.php" class="cadastro">Cadastro de Produtos</a></li>
            <li><a href="listagem_produtos.php" class="cadastro">Listagem de Produtos</a></li>
        </ul>
    </div>
</body>
</html>