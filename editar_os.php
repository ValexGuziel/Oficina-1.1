<?php
include 'conexao.php';

$os = null; // Inicializa a variável para a ordem de serviço

if (isset($_GET['id'])) {
    $id_os = (int) $_GET['id'];
    // **Atualiza a query SQL para selecionar também 'setor' e 'prioridade'**
    $sql_select_os = "SELECT id, cliente, setor, equipamento, prioridade, descricao_problema, status, data_abertura, data_conclusao FROM ordens_servico WHERE id = $id_os";
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
    <title>Editar Ordem de Serviço</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .cancel-btn {
            background-color: #6c757d;
        }

        .cancel-btn:hover {
            background-color: #5a6268;
        }

        /* **Adicionado estilo para alinhar labels e inputs na mesma linha** */
        .form-row {
            display: flex;
            align-items: center;
            /* Alinha verticalmente no centro */
            gap: 20px;
            /* Espaço entre os elementos na linha */
            margin-bottom: 10px;
            /* Espaço abaixo da linha */
        }

        .form-row label {
            margin-bottom: 0;
            /* Remove a margem inferior padrão do label */
            min-width: 80px;
            /* Garante que o label tenha um tamanho mínimo */
        }

        .form-row input[type="text"],
        .form-row select {
            flex-grow: 1;
            /* Permite que o input preencha o espaço restante */
            width: auto;
            /* Anula o width fixo para permitir flex-grow */
            margin-bottom: 0;
            /* Remove a margem inferior padrão do input */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar Ordem de Serviço #<?php echo $os['id']; ?></h1>

        <form action="processar_os.php" method="POST">
            <input type="hidden" name="id_os" value="<?php echo $os['id']; ?>">
            <input type="hidden" name="acao" value="editar">

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
            <button type="button" class="cancel-btn" onclick="window.location.href='index.php';">Cancelar</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>