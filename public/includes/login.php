<?php

session_start();

if(!isset($_SESSION['user'])) {
    $_SESSION['user'] = "";
    $_SESSION['nome'] = "";
    $_SESSION['tipo'] = "";
}

/* 
    A função password_hash() já é a forma mais segura de armazenar senhas.
    Ela usa um algoritmo forte (BCrypt por padrão) e adiciona um "sal" (salt) aleatório e seguro automaticamente.
    Não é necessário (e não é recomendado) criar uma criptografia adicional antes de usá-la. 
*/
function gerarHash($senha) {                          // Define a função 'gerarHash' que recebe uma senha como parâmetro.
    $hash = password_hash($senha, PASSWORD_DEFAULT);  // Cria um hash seguro da senha usando o algoritmo padrão e mais forte disponível.
    return $hash;                                     // Retorna o hash gerado.
}

function testarHash($senha, $hash) {                    // Define a função 'testarHash' que recebe uma senha em texto plano e um hash.
    $ok = password_verify($senha, $hash); // Verifica se a senha em texto plano corresponde ao hash fornecido.
    return $ok;                                         // Retorna 'true' se a senha corresponder ao hash, e 'false' caso contrário.
}

/*
echo gerarHash('teste');                                                                   // Chama a função para gerar um hash da senha 'teste' e o exibe na tela (útil para criar hashes para o banco de dados).
echo "<br>";
if (testarHash('teste', '$2y$10$9ceHAxqGynuyBON7oJ5ni.bUBZ82O5c/WlIyP6hbJfBLFIJwRSyR6')) { // Testa se a senha 'teste' corresponde a um hash específico.
    echo "Senha Confere!";                                                                 // Se a senha e o hash corresponderem, exibe "Senha Confere!".
} else {                                                                                   // Caso contrário...
    echo "Senha Não Confere!";                                                             // Exibe "Senha Não Confere!".
}
*/
?>