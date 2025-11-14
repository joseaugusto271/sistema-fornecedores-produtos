<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM produtos WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Produto excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir produto: " . $conn->error;
    }
}

$produtos = $conn->query("SELECT p.id, p.nome, p.descricao, p.preco, p.tipo, p.validade, p.imagem, f.nome AS fornecedor_nome FROM produtos p JOIN fornecedores f ON p.fornecedor_id = f.id");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>
    <div class="container">
        <h2>Listagem de Produtos</h2>
        <?php if (isset($mensagem)) echo "<p class='message " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>
        <div class="scroll">
            <table>
                <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Tipo</th>
                        <th>Validade</th>
                        <th>Fornecedor</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $produtos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['descricao']; ?></td>
                        <td><?php echo 'R$ ' . number_format($row['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $row['tipo']; ?></td>
                        <td>
                            <?php
                            $raw = $row['validade']; // valor vindo do banco, ex: "2025-11-30" ou "0000-00-00" ou NULL
                            if (!empty($raw) && $raw !== '0000-00-00') {
                                $dt = DateTime::createFromFormat('Y-m-d', $raw);
                                // checa se a criação deu certo e se a data é válida
                                if ($dt && $dt->format('Y-m-d') === $raw) {
                                    echo $dt->format('d/m/Y');
                                } else {
                                    echo "—";
                                }
                            } else {
                                echo "—";
                            }
                            ?>
                        </td>
                        <td><?php echo $row['fornecedor_nome']; ?></td>
                        <td>
                            <?php if ($row['imagem']): ?>
                                <img src="<?php echo $row['imagem']; ?>" alt="Imagem do produto" class="thumbnail">
                            <?php else: ?>
                                Sem imagem
                            <?php endif; ?>
                        </td>
                    <td>
                        <a href="cadastro_produto.php?edit_id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <a href="index.php" class="back-button">Voltar</a>
    </div>
</body>
</html>