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
    require_once "./includes/banco.php";     // Importa o arquivo de conexão com o banco de dados.
    require_once "./includes/functions.php"; // Importa o arquivo com funções auxiliares (como a função thumb).
    ?>

    <div id="corpo"> 
        <h1 class="titulo_principal">Escolha seu jogo</h1> <!-- Título principal da página. -->
        <table class="listagem"> <!-- Início da tabela que listará os jogos. -->

            <?php
            $busca = $banco->query("SELECT * FROM jogos ORDER BY nome");        // Executa a query para buscar todos os jogos, ordenados por nome.
            if (!$busca) {                                                      // Verifica se a consulta ao banco de dados falhou.
                echo "<tr><td>Falha na busca! " . $banco->error . "</td></tr>"; // Exibe uma mensagem de erro se a consulta falhar.
            } else {                                                            // Se a consulta foi bem-sucedida...
                if ($busca->num_rows == 0) {                                    // Verifica se a consulta não retornou nenhum registro (nenhum jogo encontrado).
                    echo "<tr><td>Nenhum registro encontrado!</td></tr>";       // Exibe uma mensagem informando que nenhum jogo foi encontrado.
                } else {                                                        // Se encontrou um ou mais jogos...
                    while ($registro = $busca->fetch_object()) {                // Inicia um loop para percorrer cada jogo retornado pela consulta.
                        $capa = thumb($registro->capa);                         // Chama a função 'thumb' para obter o caminho da imagem da capa do jogo.
                        echo "<tr><td><img src='$capa' class='capa_jogo'></td>"; // Exibe a imagem da capa do jogo dentro de uma célula da tabela.
                        echo "<td><a class='link_jogo' href='./detalhes.php?cod=$registro->cod' target='_blank'>$registro->nome</a></td>"; // Cria um link para a página de detalhes, passando o código do jogo como parâmetro na URL.
                        echo "<td>Adm</td></tr>";                               // Exibe a coluna de administração e fecha a linha da tabela.
                    } 
                } 
            } 
            ?>
        </table>
    </div> 
    <?php $banco->close(); ?> <!-- Inicia um bloco PHP para fechar a conexão com o banco de dados, liberando recursos. -->
</body>

</html>