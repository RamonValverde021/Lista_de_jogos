<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Detalhes dos Jogos</title>
    <link rel="icon" href="./images/icone.png">
    <link rel="stylesheet" type="text/css" href="./css/styles.css?v=2.0">
    <script language="JavaScript" src="./javascript/script.js" defer></script>

</head>

<body id="deatlhes">
    <?php
    require_once "./includes/banco.php";
    require_once "./includes/functions.php";
    ?>
    <div id="corpo">
        <?php
        $cod = $_GET['cod'] ?? 0; // Pega o parametro pela URL se ele existir, caso não tenha nada retorna 0
        ?>
        <h1 class="titulo_principal">Detalhes do jogo</h1>
        <table class="listagem">
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
                    echo "<tr><td rowspan='3'><img src='$capa' class='capa_jogo-descricao'></td>";
                    echo "<td><h3>$registro->nome</h3></td></tr>";
                    echo "<tr><td>$registro->descricao</td></tr>";
                    echo "<tr><td>Adm</td></tr>";
                }
            }
            ?>
        </table>
    </div>

</body>

</html>