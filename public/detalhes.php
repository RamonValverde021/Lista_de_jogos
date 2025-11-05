<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Detalhes dos Jogos</title>
    <link rel="icon" href="./images/icone.png">
    <link rel="stylesheet" type="text/css" href="./css/styles.css?v=3.0">
    <link rel="stylesheet" type="text/css" href="./css/detalhes.css?v=3.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script language="JavaScript" src="./javascript/script.js" defer></script>
</head>

<body id="deatlhes">
    <?php
    require_once "./includes/banco.php";
    require_once "./includes/functions.php";
    require_once "./includes/login.php";
    ?>
    <div id="corpo">
        <?php include_once "./cabecalho.php";
        $cod = $_GET['cod'] ?? 0; // Pega o parametro pela URL se ele existir, caso não tenha nada retorna 0
        ?>

        <h1 class="titulo_principal">Detalhes do jogo</h1>
        <table class="descricao_jogo">

            <?php
            $busca = $banco->query("SELECT * FROM jogos WHERE cod = $cod");
            if (!$busca) {
                echo "<tr><td>Falha na busca! " . $banco->error . "</td></tr>";
            } else {
                if ($busca->num_rows == 0) {
                    echo "<tr><td>Nenhum registro encontrado!</td></tr>";
                } else {
                    $registro = $busca->fetch_object();
                    $capa = thumb($registro->capa);
                    echo "<tr><td rowspan='4'class='capa_jogo'><img src='$capa' class='capa_jogo-descricao'></td>";
                    echo "<td><h3>$registro->nome</h3></td></tr>";
                    echo "<tr><td>Nota: " . number_format($registro->nota, 1) . "/10.0</td></tr>";
                    echo "<tr><td class='td_descricao_jogo'>$registro->descricao</td></tr>";
                    // Exibe a coluna de administração e fecha a linha da tabela.
                    if (isAdmin()) {
                        echo "<tr><td class='td_admin_jogo'>";
                        echo "<span class='material-symbols-outlined icons_admin'>add_circle</span> ";
                        echo "<span class='material-symbols-outlined icons_admin'>edit</span> ";
                        echo "<span class='material-symbols-outlined icons_admin'>delete</span>";
                        echo "</td></tr>";
                    } elseif (isEditor()) {
                        echo "<td><span class='material-symbols-outlined icons_admin'>edit</span></td></tr>";
                    }
                }
            }
            ?>

        </table>
        <a href="./index.php"><span class="material-symbols-outlined icone_voltar">arrow_back</span></a>
    </div>
    <?php include_once "./rodape.php"; ?>
</body>

</html>