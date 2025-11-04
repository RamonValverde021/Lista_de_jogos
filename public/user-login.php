<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Login usuario</title>
    <link rel="icon" href="./images/icone.png">
    <link rel="stylesheet" type="text/css" href="./css/styles.css?v=2.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script language="JavaScript" src="./javascript/script.js" defer></script>

</head>

<body id="user-login">

    <?php
    require_once "./includes/banco.php";
    require_once "./includes/functions.php";
    require_once "./includes/login.php";
    ?>

    <div id="corpo">
        <?php

        $user = $_POST['usuario'] ?? null;
        $pass = $_POST['senha'] ?? null;

        if (is_null($user) || is_null($pass)) {
            require "user-login-form.php";
        } else {
            echo "Dados foram passados... ";
        }

        ?>

    </div>
</body>

</html>