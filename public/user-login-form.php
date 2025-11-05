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

<body id="user-login-form">

    <?php
    require_once "includes/banco.php";
    require_once "includes/functions.php";
    require_once "includes/login.php";
    ?>
    <div id="corpo_login">
        <h1 class="titulo_principal">Efetue o Login</h1>
        <form action="user-login.php" method="post" class="formulario_login">
            <table>
                <tr>
                    <td class="table_td">Usuário:</td>
                    <td class="table_td"><input type="text" name="usuario" size="10" maxlength="10" class="input-text_login" /> <!-- Mesma quantidade de caracteres definidos no banco de dados -->
                </tr>
                <tr>
                    <td class="table_td">Senha:</td>
                    <td class="table_td"><input type="password" name="senha" size="10" maxlength="8" class="input-text_login" />
                </tr>
            </table>
            <div class="div_btn">
                <input type="submit" value="Entrar" class="btn_login" />
            </div>
    </div>
</body>

</html>