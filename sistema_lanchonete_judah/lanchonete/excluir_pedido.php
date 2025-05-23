<?php
require_once ('../database/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebLanche - Excluir Pedido</title>
    <link rel="stylesheet" href="../css/geral.css"> <style>
        /* Estilos específicos para a página de exclusão (similar à de status) */
        .message-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
            box-sizing: border-box;
            margin-top: 50px;
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
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <h1>WebLanche - Excluir Pedido</h1>
    <div class="message-container">
        <?php
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $idPedido = (int)$_GET['id']; // Garante que é um número inteiro

            // Prepara a instrução SQL para exclusão
            $sql = "DELETE FROM Pedidos WHERE idPedido = ?";

            // Prepara a declaração para evitar injeção SQL
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                echo "<h2>Ocorreu um Erro!</h2>";
                echo "<p class='error-message'>Erro na preparação da exclusão: " . $conn->error . "</p>";
            } else {
                // Liga o parâmetro
                $stmt->bind_param("i", $idPedido); // 'i' para integer

                // Executa a declaração
                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        echo "<h2>Sucesso!</h2>";
                        echo "<p class='success-message'>Pedido excluído com sucesso!</p>";
                    } else {
                        echo "<h2>Atenção!</h2>";
                        echo "<p class='error-message'>Nenhum pedido encontrado com o ID " . htmlspecialchars($idPedido) . ".</p>";
                    }
                } else {
                    echo "<h2>Ocorreu um Erro!</h2>";
                    echo "<p class='error-message'>Erro ao excluir pedido: " . $stmt->error . "</p>";
                }

                // Fecha a declaração
                $stmt->close();
            }
        } else {
            echo "<h2>Erro!</h2>";
            echo "<p class='error-message'>ID do pedido não especificado para exclusão.</p>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
        <a href='pesquisar_pedidos.php' class='back-link'>Voltar para Pesquisa de Pedidos</a>
    </div>
</body>
</html>