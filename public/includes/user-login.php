<?php
require_once "banco.php";
require_once "functions.php";
require_once "login.php";

$user = $_POST['usuario'] ?? null;
$pass = $_POST['senha'] ?? null;

if (is_null($user) || is_null($pass)) {
    header("Location: ../user-login-form.php"); // Redireciona para o formulário
    exit; // Para a execução do script
} else {
    echo "Dados foram passados... ";
}

?>