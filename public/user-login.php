<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Cadastro</title>
    <link rel="icon" href="images/icone.png">
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css?v=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script language="JavaScript" src="javascript/script.js" defer></script>
</head>

<body id="user-login">
    <div id="corpo_login">
        <?php
        require_once "includes/banco.php";
        require_once "includes/functions.php";
        require_once "includes/login.php";

        $user = $_POST['usuario'] ?? null;
        $pass = $_POST['senha'] ?? null;

        if (is_null($user) || is_null($pass)) {
            header("Location: user-login-form.php"); // Redireciona para o formulário
            exit; // Para a execução do script
        } else {
            //echo "Dados foram passados... ";
            $query = "SELECT usuario, nome, senha, tipo 
              FROM usuarios 
              WHERE usuario='$user' LIMIT 1";
            $busca = $banco->query($query);
            if (!$busca) {
                echo "<tr><td>Falha na busca! " . $banco->error . "</td></tr>";
            } else {
                if ($busca->num_rows == 0) {
                    echo "<tr><td>Nenhum registro encontrado!</td></tr>";
                } else {
                    $registro = $busca->fetch_object();
                    //echo print_r($registro);

                    if (testarHash($pass, $registro->senha)) {
                        echo msg_sucesso("Login efetuado com sucesso!");
                        $_SESSION['user'] = $registro->usuario;
                        $_SESSION['nome'] = $registro->nome;
                        $_SESSION['tipo'] = $registro->tipo;
                        header("Location: index.php");
                    } else {
                        echo msg_erro("Usuário ou senha incorretos!");
                    }
                }
            }
        }
        ?>

    </div>
</body>

</html>