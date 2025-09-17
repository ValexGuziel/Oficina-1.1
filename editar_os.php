<?php
include 'conexao.php';

$os = null; // Inicializa a variável para a ordem de serviço

if (isset($_GET['id'])) {
    $id_os = (int) $_GET['id'];
    // **Atualiza a query SQL para selecionar também 'setor' e 'prioridade'**
    $sql_select_os = "SELECT id, numero_os_manual, cliente, setor, equipamento, prioridade, descricao_problema, status, data_abertura, data_conclusao FROM ordens_servico WHERE id = $id_os";
    $result_os = $conn->query($sql_select_os);

    if ($result_os->num_rows > 0) {
        $os = $result_os->fetch_assoc();
    } else {
        echo "Ordem de Serviço não encontrada.";
        exit;
    }
} else {
    header("Location: index.php?status=error&message=ID_nao_fornecido");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- CSS Centralizado -->
    <title>Editar Ordem de Serviço</title>
</head>

<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="index.php" class="view-solicitacoes-button">Abrir Solicitação</a></li>
            <li><a href="lista_os.php" class="view-solicitacoes-button">Ver Solicitações</a></li>
        </ul>
    </nav>
    <div class="container-edit">
        <h1>Editar Ordem de Serviço #<?php echo $os['id']; ?></h1>

        <form action="processar_os.php" method="POST">
            <input type="hidden" name="id_os" value="<?php echo $os['id']; ?>">
            <input type="hidden" name="acao" value="editar">

            <div class="form-row">
                <label for="numero_os_manual">Nº OS (Manual):</label>
                <input type="text" id="numero_os_manual" name="numero_os_manual" value="<?php echo htmlspecialchars($os['numero_os_manual'] ?? ''); ?>">
            </div>

            <div class="form-row">
                <label for="cliente">Solicitante:</label>
                <input type="text" id="cliente" name="cliente" value="<?php echo htmlspecialchars($os['cliente']); ?>"
                    required>

                <label for="setor">Setor:</label>
                <input type="text" id="setor" name="setor" value="<?php echo htmlspecialchars($os['setor'] ?? ''); ?>"
                    required>
            </div>

            <div class="form-row">
                <label for="equipamento">Equipamento / Tag:</label>
                <input type="text" id="equipamento" name="equipamento"
                    value="<?php echo htmlspecialchars($os['equipamento']); ?>" required>

                <label for="prioridade">Prioridade:</label>
                <select id="prioridade" name="prioridade" required>
                    <option value="BAIXA" <?php echo ($os['prioridade'] == 'BAIXA') ? 'selected' : ''; ?>>BAIXA</option>
                    <option value="MÉDIA" <?php echo ($os['prioridade'] == 'MÉDIA') ? 'selected' : ''; ?>>MÉDIA</option>
                    <option value="URGENTE" <?php echo ($os['prioridade'] == 'URGENTE') ? 'selected' : ''; ?>>URGENTE
                    </option>
                </select>
            </div>

            <label for="descricao_problema">Descrição do Problema:</label>
            <textarea id="descricao_problema" name="descricao_problema" rows="4"
                required><?php echo htmlspecialchars($os['descricao_problema']); ?></textarea>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Aberta" <?php echo ($os['status'] == 'Aberta') ? 'selected' : ''; ?>>Aberta</option>
                <option value="Em Andamento" <?php echo ($os['status'] == 'Em Andamento') ? 'selected' : ''; ?>>Em
                    Andamento</option>
                <option value="Aguardando Peças" <?php echo ($os['status'] == 'Aguardando Peças') ? 'selected' : ''; ?>>
                    Aguardando Peças</option>
                <option value="Concluída" <?php echo ($os['status'] == 'Concluída') ? 'selected' : ''; ?>>Concluída
                </option>
                <option value="Cancelada" <?php echo ($os['status'] == 'Cancelada') ? 'selected' : ''; ?>>Cancelada
                </option>
            </select>
            <br><br>

            <button type="submit">Salvar Alterações</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='lista_os.php';">Cancelar</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>