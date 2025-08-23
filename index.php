<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Solicitação de Serviços de Manutenção</title>
    <style>
        body {
            font-family: "Roboto", sans-serif;
            font-size: 18px;
            background-image: url('mecanica1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Opcional: fixa a imagem enquanto a página rola */
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            margin: 0;
            /* Espaço para o rodapé fixo */
            box-sizing: border-box;
        }

        .container {
            width: 80%;
            max-width: 900px;
            /* Adicionado para limitar a largura em telas grandes */
            background: #e4e2e2ff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #000;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .header-wrapper {
            display: flex;
            background: #e4e2e2ff;
            align-items: center;
            justify-content: space-around;
            width: 100%;
            max-width: 900px;
            margin-top: 50px;
            margin-bottom: 5px;
            border: 1px solid #000;
            border-radius: 8px;
            padding: 20px;
            box-sizing: border-box;
        }

        .header-image {
            width: 100px;
            height: auto;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: rgba(0, 0, 0, 1);
            text-shadow:
                -1px -1px 0 rgba(255, 166, 1, 1),
                1px -1px 0 rgba(255, 166, 1, 1),
                -1px 1px 0 rgba(255, 166, 1, 1),
                1px 1px 0 rgba(255, 166, 1, 1);
            margin: 0 20px;
        }

        form {
            margin-bottom: 2px;
            margin-top: 2px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            text-transform: uppercase;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: 3px 3px 8px rgba(10, 1, 61, 0.4);
            box-sizing: border-box;
        }

        textarea {
            text-transform: uppercase;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: 3px 3px 8px rgba(10, 1, 61, 0.4);
            box-sizing: border-box;
        }

        button,
        .view-solicitacoes-button {
            background-color: #2e802aff;
            color: white;
            font-size: 14px;
            padding: 10px 15px;
            border: 1px solid #114b0eff;
            border-radius: 30px;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
            margin-right: 10px;
            cursor: pointer;
            text-decoration: none;
        }

        button:hover,
        .view-solicitacoes-button:hover {
            background-color: #176b16ff;
        }

        .view-solicitacoes-button {
            background-color: #007bff;
            border: 1px solid #0056b3;
        }

        .view-solicitacoes-button:hover {
            background-color: #0056b3;
        }

        .form-row {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .form-row label {
            margin-bottom: 0;
            min-width: 80px;
        }

        .form-row input[type="text"],
        .form-row select {
            flex: 1 1 200px;
            width: auto;
            margin-bottom: 0;
        }

        .buttons {
            display: flex;
            align-items: center;
            /* Alinha itens verticalmente */
            flex-wrap: wrap;
            /* Permite quebra de linha em telas pequenas */
            gap: 10px;
            /* Espaço entre os itens */
        }

        .flash-message {
            display: none;
            font-weight: bold;
            margin-left: 10px;
            /* Espaço entre os botões e a mensagem */
        }

        .flash-message.success {
            color: green;
        }

        .flash-message.error {
            color: red;
        }

        /* --- Media Queries --- */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            .header-wrapper {
                flex-direction: column;
                align-items: center;
                padding: 10px;
            }

            .header-image {
                margin-bottom: 10px;
            }

            h1 {
                font-size: 24px;
                margin: 10px 0;
            }

            .form-row {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .form-row input[type="text"],
            .form-row select {
                flex: none;
                width: 100%;
            }

            .buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .buttons button,
            .buttons a {
                width: 100%;
                margin-bottom: 10px;
            }

            .flash-message {
                margin-left: 0;
                /* Remove o espaçamento em telas pequenas */
            }
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            /* Use uma cor de fundo semitransparente (transparência de 50%) */
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 10px;
            text-align: center;
            padding: 5px 0;
            box-sizing: border-box;

            /* Propriedades para o efeito de vidro */
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            /* Para compatibilidade com navegadores WebKit (Safari, etc.) */
        }
    </style>
</head>

<body>
    <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
        <div class="header-wrapper">
            <img src="logo_mastig.png" alt="Logo Mastig" class="header-image">
            <h1>Solicitação de Serviços de Manutenção</h1>
            <img src="chave.jpg" alt="Logo Manutenção" class="header-image">
        </div>
        <div class="container">
            <form action="processar_os.php" method="POST">
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
                    <button type="submit" name="acao" value="adicionar">Abrir Solicitação</button>
                    <a href="lista_os.php" class="view-solicitacoes-button">Ver Solicitações</a>
                    <p class="flash-message success">Ordem de Serviço adicionada com sucesso!</p>
                    <p class="flash-message error">Ocorreu um erro na operação.</p>
                </div>
            </form>
        </div>
    </div>
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
    <footer>
        <p>&copy; 2025 Mastig. Todos os direitos reservados. Powered by Claudio</p>
    </footer>
</body>

</html>