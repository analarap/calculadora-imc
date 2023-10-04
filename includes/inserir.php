<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css" type="text/css">
    <title>Inserir Dados</title>

    <style>
        p {
            margin-left: 60px
        }
    </style>

</head>

<body>
    <h2>Inserir Dados</h2>
    <br>


    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="altura">Altura (em metros):</label>
        <input type="text" id="altura" name="altura" required>
        <br><br>

        <label for="peso">Peso (em kg):</label>
        <input type="text" id="peso" name="peso" required>
        <br><br>

        <input type="submit" value="Inserir">
    </form>


    <?php
    require_once('../config/conexao.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexao = novaConexao();

        $nome = $_POST['nome'];
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];

        $imc = $peso / ($altura * $altura);

        $inserirDados = "INSERT INTO imc_anapupinho.imc (nome, altura, peso, imc) VALUES (:nome, :altura, :peso, :imc)";

        $stmt = $conexao->prepare($inserirDados);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':altura', $altura, PDO::PARAM_STR);
        $stmt->bindParam(':peso', $peso, PDO::PARAM_STR);
        $stmt->bindParam(':imc', $imc, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $stmt->errorInfo()[2];
        }

        if ($imc < 18.50) {
            echo "<br> Abaixo do peso.";
        } else if ($imc > 18.6 && $imc < 24.9) {
            echo "<br> Peso ideal.";
        } else if ($imc > 25 && $imc < 29.9) {
            echo "<br> Levemente acima do peso.";
        } else if ($imc > 30 && $imc < 34.9) {
            echo "<br> Obesidade grau I";
        } else if ($imc > 35 && $imc < 39.9) {
            echo "<br> Obesidade grau II";
        } else if ($imc > 40) {
            echo "<br> Obesidade grau III";
        }

        $stmt->closeCursor();
        $conexao = null;
    }
    ?>


    <br><br>
    <button class="btn" onclick="location.href='../index.php'">Página Inicial</button>
    <button class="btn" onclick="location.href='listar.php'">Listar Dados</button>
    <button class="btn" onclick="location.href='includes/atualizar.php'">Atualizar Dados</button>
    <button class="btn" onclick="location.href='includes/deletar.php'">Deletar Dados</button>
</body>

</html>