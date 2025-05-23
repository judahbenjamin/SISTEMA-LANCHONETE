<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebLanche - Pesquisar Pedidos</title>
    <link rel="stylesheet" href="../css/geral.css"> <style>
      /* Estilos específicos para a página de pesquisa */
        /* Ajuste de cores para o fundo WebLanche - azul/roxo (mantendo a original da imagem) */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Adaptei para o gradiente da imagem, que parece ser um roxo/azul */
            background: linear-gradient(to right, #ffbf0e 0%, #fc7425 100%); 
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Alinha do topo para não centralizar demais */
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
            margin-top: 20px; /* Adicionado para afastar do topo */
            font-size: 2.8em; /* Um pouco maior */
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3); /* Sombra mais pronunciada */
        }

        .search-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px; /* Mais arredondado */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Sombra mais forte */
            width: 100%;
            max-width: 500px; /* Um pouco mais largo para acomodar melhor */
            box-sizing: border-box;
            margin-bottom: 30px;
            transition: transform 0.3s ease-in-out; /* Transição para hover */
        }

        .search-container:hover {
            transform: translateY(-5px); /* Efeito de elevação suave */
        }

        .search-form-group {
            display: flex;
            flex-wrap: wrap; /* Permite quebrar linha em telas menores */
            align-items: center;
            gap: 20px; /* Espaçamento ajustado */
            margin-bottom: 0; /* Remove a margem inferior para melhor controle de layout */
        }

        .search-form-group label {
            white-space: nowrap;
            font-weight: bold;
            color: #444; /* Cor mais escura para o label */
            font-size: 1.1em;
        }

        .search-form-group select,
        .search-form-group input[type="text"] {
            padding: 12px 15px; /* Aumenta o padding */
            border-radius: 10px; /* Mais arredondado */
            border: 1px solid #dcdcdc; /* Borda mais suave */
            font-size: 1.05em; /* Fonte um pouco maior */
            box-sizing: border-box;
            flex-grow: 1; /* Permite que cresçam */
            min-width: 120px; /* Garante uma largura mínima para inputs */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .search-form-group select:focus,
        .search-form-group input[type="text"]:focus {
            border-color: #007bff; /* Azul vibrante no focus */
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.25); /* Sombra suave no focus */
            outline: none;
        }

        .search-form-group button {
            /* Estilo do botão de pesquisa */
            padding: 12px 25px; /* Ajusta o padding */
            background-color: #28a745; /* Verde para pesquisar */
            color: white;
            border: none;
            border-radius: 10px; /* Mais arredondado */
            font-size: 1.1em; /* Fonte um pouco maior */
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3); /* Sombra para o botão */
        }

        .search-form-group button:hover {
            background-color: #218838; /* Verde mais escuro no hover */
            transform: translateY(-2px); /* Efeito de elevação */
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4); /* Sombra maior no hover */
        }

        /* Estilos da Tabela de Resultados */
        .results-container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 15px; /* Mais arredondado */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Sombra mais forte */
            width: 100%;
            max-width: 850px; /* Tabela um pouco mais larga */
            box-sizing: border-box;
            overflow-x: auto;
            margin-top: 20px; /* Espaçamento acima da tabela */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 10px; /* Arredonda as bordas da tabela inteira */
            overflow: hidden; /* Garante que o border-radius funcione nas bordas */
        }

        table th,
        table td {
            padding: 14px 18px; /* Aumenta o padding */
            text-align: left;
            border-bottom: 1px solid #eee; /* Borda mais suave */
        }

        table th {
            background-color: #fc7425; /* Azul para cabeçalho */
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.95em; /* Um pouco maior */
        }

        table tr:nth-child(even) {
            background-color: #f8f8f8; /* Listras na tabela (cor mais clara) */
        }

        table tr:hover {
            background-color: #e0f2f7; /* Um azul bem clarinho no hover da linha */
        }

        .no-results {
            text-align: center;
            padding: 25px; /* Mais padding */
            color: #666; /* Cor um pouco mais escura */
            font-size: 1.2em; /* Fonte maior */
            font-style: italic; /* Itálico */
        }

        /* Estilo do botão de Excluir na tabela */
        .delete-icon {
            display: inline-flex; /* Use flexbox para centralizar melhor o X */
            justify-content: center;
            align-items: center;
            width: 32px; /* Tamanho do ícone */
            height: 32px;
            background-color: #dc3545; /* Cor vermelha para exclusão */
            border-radius: 50%;
            color: white;
            font-size: 1.3em; /* Tamanho do 'X' */
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.25);
        }

        .delete-icon:hover {
            background-color: #c82333;
            transform: scale(1.15); /* Aumenta um pouco mais */
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        /* Estilo para o botão de Voltar */
        .botao-voltar {
            margin-top: 30px; /* Mais espaço do container de resultados */
            margin-bottom: 20px; /* Espaço na parte inferior */
            display: inline-block;
            padding: 14px 30px; /* Aumenta o padding */
            background-color: #007bff; /* Azul padrão */
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 17px; /* Fonte um pouco maior */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 10px; /* Mais arredondado */
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3); /* Sombra para o botão */
        }

        .botao-voltar:hover {
            background-color: #0056b3; /* Azul mais escuro no hover */
            transform: translateY(-2px); /* Efeito de elevação */
            box-shadow: 0 6px 14px rgba(0, 123, 255, 0.4);
        }


        /* Responsividade */
        @media (max-width: 768px) {
            .search-container, .results-container {
                padding: 20px;
                margin-left: 15px;
                margin-right: 15px;
            }
            h1 {
                font-size: 2.2em;
                margin-left: 15px;
                margin-right: 15px;
            }
            .search-form-group {
                flex-direction: column;
                align-items: stretch;
                gap: 15px; /* Reduz o gap em telas menores */
            }
            .search-form-group select,
            .search-form-group input[type="text"],
            .search-form-group button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .search-container, .results-container {
                padding: 15px;
            }
            h1 {
                font-size: 1.8em;
            }
            table th, table td {
                padding: 10px;
                font-size: 0.9em;
            }
            .delete-icon {
                width: 25px;
                height: 25px;
                font-size: 1.1em;
                line-height: 25px;
            }
        }
    </style>
</head>
<body>
    <h1>WebLanche - Pesquisar Pedidos</h1>

    <div class="search-container">
        <form action="pesquisar_pedidos.php" method="GET">
            <div class="search-form-group">
                <label for="tipo_pesquisa">Pesquisar por:</label>
                <select name="tipo_pesquisa" id="tipo_pesquisa">
                    <option value="cliente" <?php if (isset($_GET['tipo_pesquisa']) && $_GET['tipo_pesquisa'] == 'cliente') echo 'selected'; ?>>Cliente</option>
                    <option value="bairro" <?php if (isset($_GET['tipo_pesquisa']) && $_GET['tipo_pesquisa'] == 'bairro') echo 'selected'; ?>>Bairro</option>
                </select>
                <label for="valor_pesquisa">Valor:</label>
                <input type="text" id="valor_pesquisa" name="valor_pesquisa" placeholder="Digite o termo de pesquisa" value="<?php echo isset($_GET['valor_pesquisa']) ? htmlspecialchars($_GET['valor_pesquisa']) : ''; ?>">
                <button type="submit">Pesquisar</button>
            </div>
        </form>
    </div>

    <div class="results-container">
        <h2>Resultados da Pesquisa</h2>
        <?php
        require_once ('../database/conexao.php'); 

        $sql = "SELECT p.idPedido, p.nomeCliente, p.bairroCliente, p.qtde, l.nomeLanche FROM Pedidos p JOIN Lanches l ON p.idLanche = l.idLanche";
        $params = [];
        $types = "";

        if (isset($_GET['tipo_pesquisa']) && !empty($_GET['valor_pesquisa'])) {
            $tipo = $_GET['tipo_pesquisa'];
            $valor = '%' . $conn->real_escape_string($_GET['valor_pesquisa']) . '%'; // Adiciona % para pesquisa LIKE

            if ($tipo == 'cliente') {
                $sql .= " WHERE p.nomeCliente LIKE ?";
                $params[] = $valor;
                $types .= "s";
            } elseif ($tipo == 'bairro') {
                $sql .= " WHERE p.bairroCliente LIKE ?";
                $params[] = $valor;
                $types .= "s";
            }
        }

        // Ordenar os resultados
        $sql .= " ORDER BY p.idPedido ASC"; // Ou qualquer outra ordem que faça sentido

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "<p class='error-message'>Erro na preparação da consulta: " . $conn->error . "</p>";
        } else {
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p>Total de pedidos encontrados: " . $result->num_rows . "</p>";
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>CÓDIGO</th>";
                echo "<th>NOME</th>";
                echo "<th>BAIRRO</th>";
                echo "<th>QTDE</th>";
                echo "<th>LANCHE</th>";
                echo "<th>Excluir</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idPedido"] . "</td>";
                    echo "<td>" . htmlspecialchars($row["nomeCliente"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["bairroCliente"]) . "</td>";
                    echo "<td>" . $row["qtde"] . "</td>";
                    echo "<td>" . htmlspecialchars($row["nomeLanche"]) . "</td>";
                    echo "<td><a href='excluir_pedido.php?id=" . $row["idPedido"] . "' class='delete-icon' onclick='return confirm(\"Tem certeza que deseja excluir este pedido?\");'>X</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p class='no-results'>Nenhum pedido encontrado para a pesquisa.</p>";
            }
            $stmt->close();
        }
        $conn->close();
        ?>
    </div>

    <style>
        .botao-voltar:hover {
            background-color: #0056b3; /* Um tom de azul mais escuro */
        }
    </style>

    <div>
        <a href="form_lanche.php" class="botao-voltar" style="
            margin-top: 25px;
            display: inline-block;
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        ">Voltar para o Cadastro</a>
        
        <a href="../index.html" class="botao-voltar" style="
            margin-top: 25px;
            display: inline-block;
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        ">Voltar para a Página Inicial</a>
    </div>
</body>
</html>