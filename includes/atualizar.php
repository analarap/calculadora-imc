<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css" type="text/css">
    <title>Atualizar Dados</title>

    <style>
        p {
            margin-left: 60px
        }
    </style>

</head>

<body>
    <h2>Atualizar Dados</h2>
    <br>

    <form method="POST">
        <label for="id">ID do Registro:</label>
        <input type="text" id="id" name="id" required>
        <br><br>

        <label for="nome">Novo Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="altura">Nova Altura (em metros):</label>
        <input type="text" id="altura" name="altura" required>
        <br><br>

        <label for="peso">Novo Peso (em kg):</label>
        <input type="text" id="peso" name="peso" required>
        <br><br>

        <input type="submit" value="Atualizar">
    </form>

    <?php
    require_once('../config/conexao.php');

    require_once('../config/conexao.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexao = novaConexao();

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];

        $verificarID = "SELECT ID FROM imc_anapupinho.imc WHERE ID = :id";
        $stmtVerificar = $conexao->prepare($verificarID);
        $stmtVerificar->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtVerificar->execute();

        if ($stmtVerificar->rowCount() > 0) {
            $imc = $peso / ($altura * $altura);

            $atualizarDados = "UPDATE imc_anapupinho.imc SET nome = :nome, altura = :altura, peso = :peso, imc = :imc WHERE ID = :id";

            $stmt = $conexao->prepare($atualizarDados);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':altura', $altura, PDO::PARAM_STR);
            $stmt->bindParam(':peso', $peso, PDO::PARAM_STR);
            $stmt->bindParam(':imc', $imc, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "<br><p>Dados atualizados com sucesso!</p>";
            } else {
                echo "<br><p>Erro ao atualizar dados: </p>" . $stmt->errorInfo()[2];
            }

            $stmt->closeCursor();
        } else {
            echo "<br><p>ID não encontrado. Por favor, insira um ID válido.</p>";
        }

        $conexao = null;
    }
    ?>
    <br><br>
    <button class="btn" onclick="location.href='../index.php'">Página Inicial</button>
    <button class="btn" onclick="location.href='inserir.php'">Inserir Dados</button>
    <button class="btn" onclick="location.href='listar.php'">Listar Dados</button>
    <button class="btn" onclick="location.href='includes/deletar.php'">Deletar Dados</button>

</body>

</html>