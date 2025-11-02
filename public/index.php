<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Lista de Jogos</title>
    <link rel="icon" href="./images/icone.png">
    <link rel="stylesheet" type="text/css" href="./css/styles.css?v=1.0">
    <script language="JavaScript" src="./javascript/script.js" defer></script>

</head>

<body id="index">

    <?php
    require_once "./includes/banco.php";
    require_once "./includes/functions.php";
    ?>

    <div id="corpo">
        <h1 class="titulo_principal">Escolha seu jogo</h1>
        <table class="listagem">
            <?php
            $busca = $banco->query("SELECT * FROM jogos ORDER BY nome");
            if (!$busca) {
                echo "<tr><td>Falha na busca! " . $banco->error . "</td></tr>";
            } else {
                if ($busca->num_rows == 0) {
                    echo "<tr><td>Nenhum registro encontrado!</td></tr>";
                } else {
                    while ($registro = $busca->fetch_object()) {
                        $capa = thumb($registro->capa);
                        echo "<tr><td><img src='$capa' class='capa_jogo'></td>";
                        echo "<td><a class='link_jogo' href='./detalhes.php?cod=$registro->cod' target='_blank'>$registro->nome</a></td>"; // Em href='./pages/detalhes.php?cod=$registro->cod' passa um parametro por link na parte "?cod=$registro->cod'" onde soma ao link './pages/detalhes.php' o cod do registro do jogo (Seu ID)
                        echo "<td>Adm</td></tr>";
                    }
                }
            }
            ?>
        </table>
    </div>
    <?php $banco->close(); ?> <!-- Fecha a conexão com o banco de dados -->
</body>

</html>