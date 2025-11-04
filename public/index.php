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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script language="JavaScript" src="./javascript/script.js" defer></script>

</head>

<body id="index">

    <?php
    require_once "./includes/banco.php";     // Importa o arquivo de conexão com o banco de dados, garantindo que seja incluído apenas uma vez.
    require_once "./includes/functions.php"; // Importa o arquivo com funções auxiliares (como a função thumb), garantindo que seja incluído apenas uma vez.
    require_once "./includes/login.php";     // Importa o arquivo de Login 
    $ordem = $_GET['ordenar'] ?? 'nome';     // Pega o parâmetro 'ordenar' da URL. Se não existir, define 'nome' como padrão.
    $chave = $_GET['chave'] ?? '';           // Pega o parâmetro 'chave' (de busca) da URL. Se não existir, define como uma string vazia.
    ?>

    <div id="corpo">
        <?php include_once "./cabecalho.php" ?> <!-- Inclui o arquivo do cabeçalho da página. -->

        <h1 class="titulo_principal">Escolha seu jogo</h1> <!-- Título principal da página. -->
        <form method="get" id="busca" action="index.php"> <!-- Formulario de ordenação e busca -->
            Ordernar:
            <a class="link_ordernar" href="index.php?ordenar=nome&chave=<?php echo $chave; ?>">Nome</a> |
            <a class="link_ordernar" href="index.php?ordenar=produtora&chave=<?php echo $chave; ?>">Produtora</a> |
            <a class="link_ordernar" href="index.php?ordenar=nota_alta&chave=<?php echo $chave; ?>">Nota Alta</a> |
            <a class="link_ordernar" href="index.php?ordenar=nota_baixa&chave=<?php echo $chave; ?>">Nota Baixa</a> |
            <a class="link_ordernar" href="index.php">Mostrar Todos</a> |
            Buscar: <input type="text" name="chave" size="10" maxlength="40" />
            <input type="submit" value="OK" />
        </form>

        <table class="listagem"> <!-- Início da tabela que listará os jogos. -->
            <?php
            $query = "SELECT j.cod, j.nome, g.genero, p.produtora, j.capa 
                      FROM jogos j 
                      JOIN generos g ON j.genero = g.cod
                      JOIN produtoras p ON j.produtora = p.cod "; // Inicia a montagem da query SQL para selecionar dados dos jogos, juntando com as tabelas de gêneros e produtoras.

            /*
                Este bloco verifica se o usuário inseriu algum termo no campo de busca. Se a variável $chave não estiver vazia,
                ele adiciona uma cláusula WHERE à consulta SQL. A cláusula `LIKE '%$chave%'` é usada para encontrar registros
                onde o termo de busca ($chave) apareça em qualquer parte do nome do jogo (j.nome), da produtora (p.produtora) ou
                do gênero (g.genero). O uso do operador OR permite que a busca retorne resultados se o termo for encontrado em qualquer um desses três campos.
            */
            if (!empty($chave)) { // Verifica se uma chave de busca foi fornecida.
                $query .= "WHERE j.nome LIKE '%$chave%' 
                OR p.produtora LIKE '%$chave%' 
                OR g.genero LIKE '%$chave%' "; // Adiciona a cláusula WHERE na query para filtrar os resultados pela chave de busca no nome do jogo, produtora ou gênero.
            }

            switch ($ordem) {                         // Estrutura de controle para definir a ordenação dos resultados.
                case 'nome':                          // Caso a ordenação seja por nome...
                    $query .= "ORDER BY j.nome";      // Adiciona a cláusula ORDER BY para ordenar pelo nome do jogo.
                    break;
                case 'produtora':                     // Caso a ordenação seja por produtora...
                    $query .= "ORDER BY p.produtora"; // Adiciona a cláusula ORDER BY para ordenar pelo nome da produtora.
                    break;
                case 'nota_alta':                     // Caso a ordenação seja por nota mais alta...
                    $query .= "ORDER BY j.nota DESC"; // Adiciona a cláusula ORDER BY para ordenar pela nota em ordem decrescente.
                    break;
                case 'nota_baixa':                    // Caso a ordenação seja por nota mais baixa...
                    $query .= "ORDER BY j.nota ASC";  // Adiciona a cláusula ORDER BY para ordenar pela nota em ordem crescente.
                    break;
                default:                              // Caso nenhum critério de ordenação válido seja fornecido...
                    $query .= "ORDER BY j.nome";      // Usa a ordenação por nome como padrão.
                    break;
            }

            $busca = $banco->query($query);                                     // Executa a query SQL completa no banco de dados.
            if (!$busca) {                                                      // Verifica se a consulta ao banco de dados falhou.
                echo "<tr><td>Falha na busca! " . $banco->error . "</td></tr>"; // Exibe uma mensagem de erro se a consulta falhar.
            } else {                                                            // Se a consulta foi bem-sucedida...
                if ($busca->num_rows == 0) {                                    // Verifica se a consulta não retornou nenhum registro (nenhum jogo encontrado).
                    echo "<tr><td>Nenhum registro encontrado!</td></tr>";       // Exibe uma mensagem informando que nenhum jogo foi encontrado.
                } else {                                                        // Se encontrou um ou mais jogos...
                    while ($registro = $busca->fetch_object()) {                // Inicia um loop que percorre cada jogo retornado, tratando cada registro como um objeto.
                        $capa = thumb($registro->capa);                         // Chama a função 'thumb' para obter o caminho da imagem da capa do jogo.
                        echo "<tr><td><img src='$capa' class='capa_jogo'></td>"; // Exibe a imagem da capa do jogo dentro de uma célula da tabela.
                        echo "<td><a class='link_jogo' href='./detalhes.php?cod=$registro->cod' target='_blank'>$registro->nome</a>"; // Cria um link para a página de detalhes, passando o código do jogo como parâmetro na URL.
                        echo "<br>$registro->genero";                           // Exibe o gênero do jogo.
                        echo " - $registro->produtora</td>";                    // Exibe a produtora do jogo em uma nova linha, dentro da mesma célula.
                        echo "<td>Adm</td></tr>";                               // Exibe a coluna de administração e fecha a linha da tabela.
                    }
                }
            }
            ?>
        </table>
    </div>
    <?php include_once "./rodape.php"; ?> <!-- Inclui o arquivo do rodapé da página. -->
</body>

</html>