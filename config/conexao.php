<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão</title>
</head>

<body>
    <?php
    function novaConexao($banco = null)
    {
        $servidor = "127.0.0.1:3306";
        $usuario = "root";
        $senha = "";

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=" . $banco, $usuario, $senha);
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();

            exit;
        }

        return $pdo;
    }
    ?>
</body>

</html>