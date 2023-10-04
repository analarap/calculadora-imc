<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css" type="text/css">
    <title>Deletar Dados</title>

    <style>
        p {
            margin-left: 60px
        }
    </style>

</head>

<body>
    <h2>Deletar Dados</h2>
    <br>

    <form method="POST">
        <label for="id">ID do Registro a Deletar:</label>
        <input type="text" id="id" name="id" required>
        <br><br>

        <input type="submit" value="Deletar">
    </form>

    <?php
    require_once('../config/conexao.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexao = novaConexao();

        $id = $_POST['id'];

        $verificarID = "SELECT ID FROM imc_anapupinho.imc WHERE ID = :id";
        $stmtVerificar = $conexao->prepare($verificarID);
        $stmtVerificar->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtVerificar->execute();

        if ($stmtVerificar->rowCount() > 0) {
            $deletarDados = "DELETE FROM imc_anapupinho.imc WHERE ID = :id";

            $stmt = $conexao->prepare($deletarDados);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "<br><p>Registro com ID $id foi deletado com sucesso!</p>";
            } else {
                echo "<br><p>Erro ao deletar registro com ID $id: </p>" . $stmt->errorInfo()[2];
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
    <button class="btn" onclick="location.href='includes/atualizar.php'">Atualizar Dados</button>

</body>

</html>