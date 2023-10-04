<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css" type="text/css">
    <title>IMC - Ana Pupo</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>

<body>
    <?php
    require_once('config/conexao.php');
    $conexao = novaConexao();
    $createDB = "CREATE DATABASE IF NOT EXISTS imc_anapupinho";

    $conexao->query($createDB);
    $conexao = novaConexao("imc_anapupinho");
    $createTB = "CREATE TABLE IF NOT EXISTS imc(ID int AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(50), altura VARCHAR(10), peso VARCHAR(10), imc VARCHAR(10))";

    $conexao->query($createTB)

    ?>

    <div class="container">
        <h1>Calculadora de IMC - Ana Pupo</h1>
        <p>Bem-vindo à calculadora de Índice de Massa Corporal (IMC). Selecione uma das opções abaixo:</p>
        <div class="btn-container">
            <button class="btn" onclick="location.href='includes/inserir.php'">Inserir Dados</button>
            <button class="btn" onclick="location.href='includes/listar.php'">Listar Dados</button>
            <button class="btn" onclick="location.href='includes/atualizar.php'">Atualizar Dados</button>
            <button class="btn" onclick="location.href='includes/deletar.php'">Deletar Dados</button>
        </div>
    </div>
</body>

</html>
</body>

</html>