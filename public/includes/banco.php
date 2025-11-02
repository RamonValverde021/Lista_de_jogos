<pre>
    <?php
    $host = "localhost"; // host = onde está hospedado meu banco de dados
    $usuario = "root";   // usuario = usuario do servidor de banco de dados (XAMPP)
    $senha = "";         // senha = senha do servidor (XAMPP)
    $banco = "bd_games"; // banco = nome do banco de dados

    $banco = new mysqli($host, $usuario, $senha, $banco); // banco é um novo objeto que vem da classe mysqli

    if ($banco->connect_errno) {  // -> referencia ao objeto, em JAVA usa (.)
        echo "<p>Encontrei um erro: $banco->errno --> $banco->connect_error</p>";
        die();   // Finaliza todo o programa para ele parar de tentar se conectar ao banco de dados
    } else {
        //echo "<p>Tudo ok na conexão com o banco de dados!</p>";
    }

    $busca = $banco->query("SET NAMES 'utf8'");
    $busca = $banco->query("SET character_set_connection=utf8");
    $busca = $banco->query("SET character_set_client=utf8");
    $busca = $banco->query("SET character_set_results=utf8");

    ?>
</pre>