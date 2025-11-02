<?php
function thumb($arquivo)
{
    $caminho = "./images/capas_jogos/$arquivo";
    if (is_null($arquivo) || !file_exists($caminho)) { // Se o arquivo que foi passado por parametro for nulo ou se o caminho do arquivo não existir
        return "./images/capas_jogos/indisponivel.png";
    } else {
        return $caminho;
    }
}
