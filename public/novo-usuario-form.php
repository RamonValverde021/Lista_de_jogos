<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Novo Usuário</title>
    <link rel="icon" href="images/icone.png">
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=2.0">
    <link rel="stylesheet" type="text/css" href="css/login.css?v=2.0">
    <link rel="stylesheet" type="text/css" href="css/novo_usuario.css?v=2.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script language="JavaScript" src="javascript/script.js" defer></script>
    <style>
        div#corpo_novo_usuario {
            width: 380px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0px 0px 30px #777;
            border-radius: 15px;
        }

        form.formulario_login {
            width: 100%;
            font-size: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body id="novo-usuario-form">
    <div id="corpo_novo_usuario">
        <h1 class="titulo_principal">Novo Usuário</h1>
        <form action="novo-usuario.php" method="post" class="formulario_login">
            <table>
                <tr>
                    <td class="table_td">Usuário:</td>
                    <td class="table_td"><input type="text" name="usuario" id="usuario" size="15" maxlength="30" class="input-text_login" required/>
                </tr>
                <tr>
                    <td class="table_td">Nome:</td>
                    <td class="table_td"><input type="text" name="nome" id="nome" size="15" maxlength="30" class="input-text_login" required/> <!-- Mesma quantidade de caracteres definidos no banco de dados -->
                </tr>
                <tr>
                    <td class="table_td">Senha:</td>
                    <td class="table_td"><input type="password" name="senha1" id="senha1" size="15" maxlength="10" class="input-text_login" required/> <!-- Mesma quantidade de caracteres definidos no banco de dados -->
                </tr>

                <tr>
                    <td class="table_td">Confirme a senha:</td>
                    <td class="table_td"><input type="password" name="senha2" id="senha2" size="15" maxlength="10" class="input-text_login" required/>
                </tr>
                <tr>
                    <td class="table_td">Tipo:</td>
                    <td class="table_td"><select name="tipo" id="tipo" class="select_login">
                            <option value="admin" class="option_login">Administrador</option>
                            <option value="editor" class="option_login">Editor</option>
                            <!-- <option value="usuario" class="option_login">Usuário</option> -->
                        </select>
                    </td>
                </tr>
            </table>
            <div class="div_btn">
                <input type="submit" value="Salvar" class="btn_login" />
            </div>
    </div>
    <?php
    require_once "includes/banco.php";
    require_once "includes/functions.php";
    require_once "includes/login.php";
    ?>
    <?php include_once "./rodape.php"; ?>
</body>

</html>