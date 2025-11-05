<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Novo Usuário</title>
    <link rel="icon" href="images/icone.png">
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css?v=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script language="JavaScript" src="javascript/script.js" defer></script>
</head>

<body id="novo-usuario">
    <div id="corpo">
        <?php
        require_once "includes/banco.php";
        require_once "includes/functions.php";
        require_once "includes/login.php";

        if (!isAdmin()) {
            echo msg_erro("Você não tem permissão para acessar esta página!");
            //header("Location: index.php");
            exit;
        } else {
            if (!isset($_POST['usuario'])) {
                header("Location: novo-usuario-form.php");
                exit;
            } else {
                $usuario = $_POST['usuario'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;
                $tipo = $_POST['tipo'] ?? null;

                if (is_null($usuario) || is_null($nome) || is_null($senha1) || is_null($senha2)) {
                    echo msg_erro("Preencha todos os campos!");
                } else {
                    if ($senha1 != $senha2) {
                        echo msg_erro("As senhas não conferem!");
                    } else {
                        $senha = gerarHash($senha1);
                        $query = "INSERT INTO usuarios (usuario, nome, senha, tipo) VALUES ('$usuario', '$nome', '$senha', '$tipo')";
                        $retorno = $banco->query($query);
                        if (!$retorno) {
                            echo msg_erro("Falha ao acessar o banco: " . $banco->error);
                        } else {
                            echo msg_sucesso("Usuário cadastrado com sucesso!");
                            //header("Location: index.php");
                        }
                    }
                }
            }
        }
        ?>
    </div>
    <?php include_once "./rodape.php"; ?>
</body>

</html>