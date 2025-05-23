<?php
require_once ('../database/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebLanche - Status do Pedido</title>
    <link rel="stylesheet" href="../css/geral.css">
    <style>
        /* Estilos específicos para a página de status */
        .message-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
            box-sizing: border-box;
            margin-top: 50px; /* Espaço entre o h1 e a caixa de mensagem */
        }

        .message-container h2 {
            margin-top: 0;
            font-size: 1.8em;
            color: #333;
        }

        .success-message {
            color: #28a745; /* Verde para sucesso */
            font-weight: bold;
            font-size: 1.2em;
        }

        .error-message {
            color: #dc3545; /* Vermelho para erro */
            font-weight: bold;
            font-size: 1.2em;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background-color: #007bff; /* Azul para o botão de voltar */
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .back-link:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        }
        /* Ajuste para o body no processa_pedido para centralizar apenas um elemento */
        body {
            display: flex;
            flex-direction: column; /* Coloca os elementos em coluna */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #ffbf0e 0%, #fc7425 100%); 
        }
    </style>
</head>
<body>
    <h1>WebLanche - Status do Pedido</h1>
    <div class="message-container">
        <?php
        // Verifica se os dados foram enviados via POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Coleta e sanitiza os dados do formulário
            $nomeCliente = $conn->real_escape_string($_POST['nomeCliente']);
            $bairroCliente = $conn->real_escape_string($_POST['bairroCliente']);
            $qtde = (int)$_POST['qtde']; // Converte para inteiro
            $idLanche = (int)$_POST['idLanche']; // Converte para inteiro

            // Validação básica dos dados
            if (empty($nomeCliente) || empty($bairroCliente) || $qtde <= 0 || empty($idLanche)) {
                echo "<h2>Ocorreu um Erro!</h2>";
                echo "<p class='error-message'>Todos os campos são obrigatórios e a quantidade deve ser maior que zero.</p>";
            } else {
                // Prepara a instrução SQL para inserção
                $sql = "INSERT INTO Pedidos (idLanche, nomeCliente, bairroCliente, qtde) VALUES (?, ?, ?, ?)";

                // Prepara a declaração para evitar injeção SQL
                $stmt = $conn->prepare($sql);

                if ($stmt === false) {
                    echo "<h2>Ocorreu um Erro!</h2>";
                    echo "<p class='error-message'>Erro na preparação da declaração: " . $conn->error . "</p>";
                } else {
                    // Liga os parâmetros (s = string, i = integer)
                    $stmt->bind_param("issi", $idLanche, $nomeCliente, $bairroCliente, $qtde);

                    // Executa a declaração
                    if ($stmt->execute()) {
                        echo "<h2>Sucesso!</h2>";
                        echo "<p class='success-message'>Pedido cadastrado com sucesso!</p>";
                    } else {
                        echo "<h2>Ocorreu um Erro!</h2>";
                        echo "<p class='error-message'>Erro ao cadastrar pedido: " . $stmt->error . "</p>";
                    }

                    // Fecha a declaração
                    $stmt->close();
                }
            }
        } else {
            // Se a página for acessada diretamente sem POST
            echo "<h2>Acesso Inválido!</h2>";
            echo "<p class='error-message'>Por favor, preencha o formulário de pedido.</p>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
        <a href='form_lanche.php' class='back-link'>Voltar para o Formulário</a>
    </div>
</body>
</html>