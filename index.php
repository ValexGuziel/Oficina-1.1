<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Adicionado Font Awesome para o ícone -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- CSS Centralizado -->
    <title>Solicitação de Serviços de Manutenção</title>
</head>

<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li></li>
            <li><a href="lista_os.php" class="view-solicitacoes-button">Ver Solicitações</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div style="display: flex; flex-direction: column; align-items: center; width: 100%;"> 
            <div class="container">
                <form action="processar_os.php" method="POST" id="os-form">
                    <div class="form-row">
                        <label for="cliente">Solicitante:</label>
                        <input type="text" id="cliente" name="cliente" required>
                        <label for="setor">Setor:</label>
                        <input type="text" id="setor" name="setor" required>
                    </div>
                    <div class="form-row">
                        <label for="equipamento">Equipamento / Tag:</label>
                        <input type="text" id="equipamento" name="equipamento" required>
                        <label for="prioridade">Prioridade:</label>
                        <select id="prioridade" name="prioridade" required>
                            <option value="BAIXA">BAIXA</option>
                            <option value="MÉDIA">MÉDIA</option>
                            <option value="URGENTE">URGENTE</option>
                        </select>
                    </div>
                    <label for="descricao_problema">Descrição do Problema:</label>
                    <textarea id="descricao_problema" name="descricao_problema" rows="4" required></textarea>
                    <div class="buttons">
                        <button type="submit" name="acao" value="adicionar" class="view-solicitacoes-button">Abrir Solicitação</button>
                        <p class="flash-message success">Ordem de Serviço adicionada com sucesso!</p>
                        <p class="flash-message error">Ocorreu um erro na operação.</p>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        // Obtém os parâmetros da URL
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        const successMessage = document.querySelector('.flash-message.success');
        const errorMessage = document.querySelector('.flash-message.error');

        // Verifica o status e exibe a mensagem correta
        if (status === 'success') {
            successMessage.style.display = 'inline'; // Ou 'inline' para manter na mesma linha

            // Esconde a mensagem após 5 segundos
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 2000);

        } else if (status === 'error') {
            errorMessage.style.display = 'block'; // Ou 'inline'

            // Esconde a mensagem após 5 segundos
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 2000);
        }
    </script>
</body>

</html>