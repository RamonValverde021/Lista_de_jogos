<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="author" content="Ramon Valverde">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site com uma lista de jogos usando as tecnologias de PHP com MySQL e Bootstrap">
    <title>Lista de Jogos</title>
    <link rel="icon" href="./images/icone.png">
    <link rel="stylesheet" type="text/css" href="./css/styles.css?v=2.0">
    <script language="JavaScript" src="./javascript/script.js" defer></script>

</head>

<body id="index">

    <?php
    require_once "./includes/banco.php";     // Importa o arquivo de conexão com o banco de dados.
    require_once "./includes/functions.php"; // Importa o arquivo com funções auxiliares (como a função thumb).
    $ordem = $_GET['ordenar'] ?? 'nome';
    $chave = $_GET['chave'] ?? '';
    ?>

    <div id="corpo">
        <?php include_once "./cabecalho.php" ?>

        <h1 class="titulo_principal">Escolha seu jogo</h1> <!-- Título principal da página. -->
        <form method="get" id="busca" action="index.php">
            Ordernar:
            <a class="link_ordernar" href="index.php?ordenar=nome">Nome</a> |
            <a class="link_ordernar" href="index.php?ordenar=produtora">Produtora</a> |
            <a class="link_ordernar" href="index.php?ordenar=nota_alta">Nota Alta</a> |
            <a class="link_ordernar" href="index.php?ordenar=nota_baixa">Nota Baixa</a> |
            <a class="link_ordernar" href="index.php">Mostrar Todos</a> |
            Buscar: <input type="text" name="chave" size="10" maxlength="40" />
            <input type="submit" value="OK" />
        </form>

        <table class="listagem"> <!-- Início da tabela que listará os jogos. -->

            <?php
            $query = "SELECT j.cod, j.nome, g.genero, p.produtora, j.capa
                      FROM jogos j 
                      JOIN generos g ON j.genero = g.cod
                      JOIN produtoras p ON j.produtora = p.cod ";

            if (!empty($chave)) {
                $query .= "WHERE j.nome LIKE '%$chave%' OR
                p.produtora LIKE '%$chave%' OR
                g.genero LIKE '%$chave%' ";
            }

            switch ($ordem) {
                case 'nome':
                    $query .= "ORDER BY j.nome";
                    break;
                case 'produtora':
                    $query .= "ORDER BY p.produtora";
                    break;
                case 'nota_alta':
                    $query .= "ORDER BY j.nota DESC";
                    break;
                case 'nota_baixa':
                    $query .= "ORDER BY j.nota ASC";
                    break;
                default:
                    $query .= "ORDER BY j.nome";
                    break;
            }

            $busca = $banco->query($query);                                     // Executa a query para buscar todos os jogos, ordenados por nome.
            if (!$busca) {                                                      // Verifica se a consulta ao banco de dados falhou.
                echo "<tr><td>Falha na busca! " . $banco->error . "</td></tr>"; // Exibe uma mensagem de erro se a consulta falhar.
            } else {                                                            // Se a consulta foi bem-sucedida...
                if ($busca->num_rows == 0) {                                    // Verifica se a consulta não retornou nenhum registro (nenhum jogo encontrado).
                    echo "<tr><td>Nenhum registro encontrado!</td></tr>";       // Exibe uma mensagem informando que nenhum jogo foi encontrado.
                } else {                                                        // Se encontrou um ou mais jogos...
                    while ($registro = $busca->fetch_object()) {                // Inicia um loop para percorrer cada jogo retornado pela consulta.
                        $capa = thumb($registro->capa);                         // Chama a função 'thumb' para obter o caminho da imagem da capa do jogo.
                        echo "<tr><td><img src='$capa' class='capa_jogo'></td>"; // Exibe a imagem da capa do jogo dentro de uma célula da tabela.
                        echo "<td><a class='link_jogo' href='./detalhes.php?cod=$registro->cod' target='_blank'>$registro->nome</a>"; // Cria um link para a página de detalhes, passando o código do jogo como parâmetro na URL.
                        echo " [$registro->genero]";                            // Exibe a coluna de gênero e fecha a linha da tabela."
                        echo "<br>$registro->produtora</td>";
                        echo "<td>Adm</td></tr>";                               // Exibe a coluna de administração e fecha a linha da tabela.
                    }
                }
            }
            ?>
        </table>
    </div>
    <?php include_once "./rodape.php"; ?>
</body>

</html>