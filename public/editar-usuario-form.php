<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Editar Usuário</title>
    <link rel="icon" href="images/icone.png">
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="css/novo_usuario.css?v=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script language="JavaScript" src="javascript/script.js" defer></script>
    <style>
        div#corpo_editar_usuario {
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

<body id="editar-usuario-form">
    <?php
    require_once "includes/banco.php";
    require_once "includes/functions.php";
    require_once "includes/login.php";
    ?>
    <div id="corpo_editar_usuario">

        <?php
        $query = "SELECT usuario, nome, tipo FROM usuarios WHERE usuario = '" . $_SESSION['user'] . "'";
        $busca = $banco->query($query);

        if (!$busca) {
            echo msg_erro("Falha ao acessar o banco: " . $banco->error);
        } else {
            if ($busca->num_rows == 0) {
                echo "<tr><td>Nenhum registro encontrado!</td></tr>";
            } else {
                $registro = $busca->fetch_object();
                $nome = $registro->nome;
                $usuario = $registro->usuario;
                $tipo = $registro->tipo;
                if ($tipo == "admin") {
                    $tipo = "Administrador";
                } else if ($tipo == "editor") {
                    $tipo = "Editor";
                } else {
                    $tipo = "Usuário";
                }
            }
        }
        ?>

        <h1 class="titulo_principal">Editar Usuário</h1>
        <form action="editar-usuario.php" method="post" class="formulario_login">
            <table>
                <tr>
                    <td class="table_td">Tipo:</td>
                    <td class="table_td"><?php echo $tipo; ?>
                </tr>
                <tr>
                    <td class="table_td">Usuário:</td>
                    <td class="table_td"><input type="text" name="usuario" id="usuario" size="15" maxlength="30" class="input-text_login" value="<?php echo $usuario; ?>" required />
                </tr>
                <tr>
                    <td class="table_td">Nome:</td>
                    <td class="table_td"><input type="text" name="nome" id="nome" size="15" maxlength="30" class="input-text_login" value="<?php echo $nome; ?>" required /> <!-- Mesma quantidade de caracteres definidos no banco de dados -->
                </tr>
                <tr>
                    <td class="table_td">Senha:</td>
                    <td class="table_td"><input type="password" name="senha1" id="senha1" size="15" maxlength="10" class="input-text_login" required /> <!-- Mesma quantidade de caracteres definidos no banco de dados -->
                </tr>

                <tr>
                    <td class="table_td">Confirme a senha:</td>
                    <td class="table_td"><input type="password" name="senha2" id="senha2" size="15" maxlength="10" class="input-text_login" required />
                </tr>
            </table>
            <div class="div_btn">
                <input type="submit" value="Salvar" class="btn_login" />
            </div>
            <div class="btn_voltar">
                <a href="./index.php"><span class="material-symbols-outlined icone_voltar ">arrow_back</span></a>
            </div>
    </div>
    <?php include_once "./rodape.php"; ?>
</body>

</html>