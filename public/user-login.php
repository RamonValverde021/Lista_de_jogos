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

<body id="user-login">
    <div id="corpo">
        <?php
        require_once "includes/banco.php";                                   // Importa o arquivo de conexão com o banco de dados, garantindo que seja incluído apenas uma vez.
        require_once "includes/functions.php";                               // Importa o arquivo com funções auxiliares (como mensagens de sucesso/erro), garantindo que seja incluído apenas uma vez.
        require_once "includes/login.php";                                   // Importa o arquivo com funções de login (gerar/testar hash) e gerenciamento de sessão.

        $user = $_POST['usuario'] ?? null;                                   // Pega o valor do campo 'usuario' enviado pelo formulário via POST; se não existir, define como nulo.
        $pass = $_POST['senha'] ?? null;                                     // Pega o valor do campo 'senha' enviado pelo formulário via POST; se não existir, define como nulo.

        if (is_null($user) || is_null($pass)) {                              // Verifica se o usuário ou a senha são nulos (acesso direto à página sem formulário).
            header("Location: user-login-form.php");                         // Redireciona o usuário de volta para a página do formulário de login.
            exit;                                                            // Interrompe a execução do script para garantir que o redirecionamento ocorra.
        } else {                                                             // Se o usuário e a senha foram enviados...
            $query = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario='$user' LIMIT 1"; // Monta a consulta SQL para buscar o usuário no banco de dados.
            $busca = $banco->query($query);                                  // Executa a consulta no banco de dados.
            if (!$busca) {                                                   // Verifica se a consulta ao banco de dados falhou.
                echo msg_erro("Falha ao acessar o banco: " . $banco->error); // Exibe uma mensagem de erro se a consulta falhar.
            } else {                                                         // Se a consulta foi bem-sucedida...
                if ($busca->num_rows > 0) {                                  // Verifica se a consulta retornou algum registro (usuário encontrado).
                    $registro = $busca->fetch_object();                      // Converte o resultado da busca em um objeto para facilitar o acesso aos dados.
                    if (testarHash($pass, $registro->senha)) {               // Verifica se a senha fornecida corresponde ao hash armazenado no banco.
                        //echo msg_sucesso("Login efetuado com sucesso!");   // Exibe uma mensagem de sucesso.
                        $_SESSION['user'] = $registro->usuario;              // Armazena o nome de usuário na sessão.
                        $_SESSION['nome'] = $registro->nome;                 // Armazena o nome completo do usuário na sessão.
                        $_SESSION['tipo'] = $registro->tipo;                 // Armazena o tipo de usuário (ex: admin, editor) na sessão.
                        header("Location: index.php");                       // Redireciona o usuário para a página principal.
                    } else {                                                 // Se a senha não corresponder...
                        echo msg_erro("Usuário ou senha inválidos!");        // Exibe uma mensagem de erro genérica por segurança.
                    }
                } else {                                                     // Se a consulta não retornou nenhum registro...
                    echo msg_erro("Nenhum usuário encontrado!");             // Exibe uma mensagem informando que nenhum usuário não foi encontrado.
                }
            }
        }
        ?>

    </div>
</body>

</html>