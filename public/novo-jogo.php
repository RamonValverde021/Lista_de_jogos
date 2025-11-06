<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Novo Jogo</title>
    <link rel="icon" href="images/icone.png">
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css?v=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script language="JavaScript" src="javascript/script.js" defer></script>
</head>

<body id="novo-jogo">
    <div id="corpo">
         <h1 class="titulo_principal">Adicionar Jogo</h1>
        <?php
        require_once "includes/banco.php";
        require_once "includes/functions.php";
        require_once "includes/login.php";
        ?>
    </div>
    <?php include_once "./rodape.php"; ?>
</body>

</html>