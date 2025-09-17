<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// --- Lógica para buscar ordens de serviço existentes com filtro ---
$filtro_status = '';
if (isset($_GET['status_filtro']) && !empty($_GET['status_filtro'])) {
    $filtro_status = $conn->real_escape_string($_GET['status_filtro']);
}

$sql_select = "SELECT id, numero_os_manual, cliente, setor, equipamento, prioridade, descricao_problema, status, data_abertura, data_conclusao FROM ordens_servico";

if ($filtro_status) {
    $sql_select .= " WHERE status = '$filtro_status'";
}

$sql_select .= " ORDER BY data_abertura DESC, FIELD(prioridade, 'URGENTE', 'MÉDIA', 'BAIXA')";

$result = $conn->query($sql_select);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css"> <!-- CSS Centralizado -->
    <title>Lista de Solicitações de Serviço</title>
</head>

<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="index.php" class="view-solicitacoes-button">Abrir Solicitação</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="container-top">
            <div class="button-h1">
                <a href="index.php" class="back-button">Voltar para o Início</a>
            </div>
            <h1>Lista de Solicitações de Serviço</h1>
            <button onclick="imprimirTabela()" class="print-list-button">Imprimir Lista</button>
        </div>
        <div class="container-lista">
          
            <?php
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'success_add') {
                    echo '<p class="alert-message" style="color: green;">Ordem de Serviço adicionada com sucesso!</p>';
                } elseif ($_GET['status'] == 'success_update') {
                    echo '<p class="alert-message" style="color: green;">Ordem de Serviço atualizada com sucesso!</p>';
                } elseif ($_GET['status'] == 'success_delete') {
                    echo '<p class="alert-message" style="color: red;">Ordem de Serviço excluída com sucesso!</p>';
                } elseif ($_GET['status'] == 'error') {
                    echo '<p class="alert-message" style="color: red;">Ocorreu um erro na operação.</p>';
                }
            }
            ?>

            <form action="" method="get" class="filtro-form">
                <label for="status_filtro">Filtrar por Status:</label>
                <select name="status_filtro" id="status_filtro" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <option value="Aberta" <?php echo ($filtro_status == 'Aberta') ? 'selected' : ''; ?>>Aberta</option>
                    <option value="Em Andamento" <?php echo ($filtro_status == 'Em Andamento') ? 'selected' : ''; ?>>Em
                        Andamento</option>
                    <option value="Aguardando Peças" <?php echo ($filtro_status == 'Aguardando Peças') ? 'selected' : ''; ?>>
                        Aguardando Peças</option>
                    <option value="Concluída" <?php echo ($filtro_status == 'Concluída') ? 'selected' : ''; ?>>Concluída
                    </option>
                    <option value="Cancelada" <?php echo ($filtro_status == 'Cancelada') ? 'selected' : ''; ?>>Cancelada
                    </option>
                </select>
            </form>

            <?php if ($result->num_rows > 0): ?>
                <div class="table-wrapper">
                    <table id="tabela-os">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Solicitante</th>
                                <th>Setor</th>
                                <th>Equipamento</th>
                                <th>Prioridade</th>
                                <th>Problema</th>
                                <th>Nº OS</th>
                                <th>Status</th>
                                <th>Abertura</th>
                                <th>Conclusão</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <?php
                                $prioridade_class = '';
                                switch (strtoupper($row['prioridade'])) {
                                    case 'BAIXA':
                                        $prioridade_class = 'prioridade-baixa';
                                        break;
                                    case 'MÉDIA':
                                        $prioridade_class = 'prioridade-media';
                                        break;
                                    case 'URGENTE':
                                        $prioridade_class = 'prioridade-urgente';
                                        break;
                                    default:
                                        $prioridade_class = '';
                                        break;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['cliente']); ?></td>
                                    <td><?php echo htmlspecialchars($row['setor'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($row['equipamento']); ?></td>
                                    <td class="<?php echo $prioridade_class; ?>">
                                        <?php echo htmlspecialchars($row['prioridade'] ?? 'N/A'); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['descricao_problema']); ?></td>
                                    <td><?php echo htmlspecialchars($row['numero_os_manual'] ?? 'N/A'); ?></td>
                                    <td class="status-<?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
                                        <?php echo $row['status']; ?>
                                    </td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($row['data_abertura'])); ?></td>
                                    <td>
                                        <?php echo $row['data_conclusao'] ? date('d/m/Y H:i', strtotime($row['data_conclusao'])) : 'N/A'; ?>
                                    </td>
                                    <td class="acoes">
                                        <form action="processar_os.php" method="POST"
                                            style="display:inline-block; margin-right: 5px;">
                                            <input type="hidden" name="id_os" value="<?php echo $row['id']; ?>">
                                            <select name="novo_status" onchange="this.form.submit()">
                                                <option value=""></option>
                                                <option value="Aberta" <?php echo ($row['status'] == 'Aberta') ? 'selected' : ''; ?>>
                                                    Aberta</option>
                                                <option value="Em Andamento" <?php echo ($row['status'] == 'Em Andamento') ? 'selected' : ''; ?>>Em
                                                    Andamento</option>
                                                <option value="Aguardando Peças" <?php echo ($row['status'] == 'Aguardando Peças') ? 'selected' : ''; ?>>
                                                    Aguardando Peças</option>
                                                <option value="Concluída" <?php echo ($row['status'] == 'Concluída') ? 'selected' : ''; ?>>Concluída
                                                </option>
                                                <option value="Cancelada" <?php echo ($row['status'] == 'Cancelada') ? 'selected' : ''; ?>>Cancelada
                                                </option>
                                            </select>
                                            <input type="hidden" name="acao" value="atualizar_status">
                                        </form>

                                        <a href="editar_os.php?id=<?php echo $row['id']; ?>" title="Editar"><i
                                                class="fa-solid fa-pen"></i></a>
                                        <a href="processar_os.php?acao=excluir&id=<?php echo $row['id']; ?>" class="delete-btn"
                                            onclick="return confirm('Tem certeza que deseja excluir esta Ordem de Serviço?');"
                                            title="Excluir"><i class="fa-solid fa-trash"></i></a>
                                        
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>Nenhuma solicitação de serviço registrada ainda.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Encontra todas as mensagens de alerta
        var messages = document.querySelectorAll('.alert-message');

        // Itera sobre cada mensagem encontrada
        messages.forEach(function (message) {
            // Define um temporizador (timeout) de 3000 milissegundos (3 segundos)
            setTimeout(function () {
                // Remove o elemento da página
                message.style.display = 'none'; // Alternativa: message.remove();
            }, 3000); // 3000ms = 3 segundos
        });
    </script>

    <script>
function imprimirTabela() {
    // 1. Encontra a tabela pelo seu ID
    const tabela = document.getElementById('tabela-os');

    if (!tabela) {
        alert('Tabela de Ordens de Serviço não encontrada.');
        return;
    }

    // 2. Cria o conteúdo HTML para a nova janela de impressão
    let conteudoParaImprimir = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Relatório de Ordens de Serviço</title>
            <style>
                body { font-family: "Roboto", sans-serif; }
                h1 { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #b9b9b9ff; padding: 8px; text-align: left; font-size: 12px; }
                th { background-color: #acb1d2ff; }
                
            </style>
        </head>
        <body>
            <h1>Relatório de Ordens de Serviço</h1>
            ${tabela.outerHTML}
        </body>
        </html>
    `;

    // 3. Abre uma nova janela e insere o conteúdo
    const janelaImpressao = window.open('', '', 'height=600,width=800');
    janelaImpressao.document.open();
    janelaImpressao.document.write(conteudoParaImprimir);
    janelaImpressao.document.close();

    // 4. Aguarda o carregamento e inicia a impressão
    janelaImpressao.onload = function() {
        janelaImpressao.print();
        janelaImpressao.close();
    };
}
</script>

</body>

</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>