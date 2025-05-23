<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebLanche - Cadastro de Pedidos</title>
    <link rel="stylesheet" href="../css/geral.css">
</head>
<body>
    <h1>WebLanche - Cadastro de Pedidos</h1>
    <form action="processa_pedido.php" method="post">
        <div class="nome">
            <label for="name">Nome do Cliente:</label>
            <input type="text" id="name" name="nomeCliente" required>
        </div>
        <div class="bairro">
            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairroCliente" required>
        </div>
        <div class="quantidade">
            <label for="quant">Quantidade:</label>
            <input type="number" id="quant" name="qtde" required min="1">
        </div>
        <div class="lanche">
            <label for="listLanche">Lanche:</label>
            <select name="idLanche" id="listLanche" required>
                <option value="">Selecione</option>
                <?php
                require_once ('../database/conexao.php');

                $sql = "SELECT idLanche, nomeLanche FROM Lanches ORDER BY nomeLanche";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["idLanche"] . "'>" . $row["nomeLanche"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum lanche encontrado</option>";
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div class="button-container">
            <button type="submit"><span>Fazer Pedido</span></button>
            <button type="reset"><span>Limpar Campos</span></button>
        </div>
    </form>

    <style>
        .botao-voltar:hover {
            background-color: #0056b3; /* Um tom de azul mais escuro */
        }

        body {
            background: linear-gradient(to right, #ffbf0e 0%, #fc7425 100%);
        }
    </style>

   <div>
        <a href="pesquisar_pedidos.php" class="botao-voltar" style="
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
        ">Voltar para ver os Pedidos</a>
        
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