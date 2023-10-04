<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css" type="text/css">
    <title>Listar Dados</title>

    <style>
        p {
            margin-left: 60px
        }
    </style>

</head>

<body>
    <h2>Listar Dados</h2>
    <br>

    <?php
    require_once('../config/conexao.php');

    $conexao = novaConexao();

    $consulta = "SELECT * FROM imc_anapupinho.imc";
    $stmt = $conexao->prepare($consulta);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultados) > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Nome</th><th>Altura</th><th>Peso</th><th>IMC</th></tr>';
        foreach ($resultados as $resultado) {
            echo '<tr>';
            echo '<td>' . $resultado['ID'] . '</td>';
            echo '<td>' . $resultado['nome'] . '</td>';
            echo '<td>' . $resultado['altura'] . '</td>';
            echo '<td>' . $resultado['peso'] . '</td>';
            echo '<td>' . $resultado['imc'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<br><p>Nenhum dado encontrado.</p>';
    }

    $stmt->closeCursor();
    $conexao = null;
    ?>


    <br><br>
    <button class="btn" onclick="location.href='../index.php'">Página Inicial</button>
    <button class="btn" onclick="location.href='inserir.php'">Inserir Dados</button>
    <button class="btn" onclick="location.href='includes/atualizar.php'">Atualizar Dados</button>
    <button class="btn" onclick="location.href='includes/deletar.php'">Deletar Dados</button>

</body>

</html>