<?php
function thumb($arquivo) {
    $caminho = "./images/capas_jogos/$arquivo";
    if (is_null($arquivo) || !file_exists($caminho)) { // Se o arquivo que foi passado por parametro for nulo ou se o caminho do arquivo não existir
        return "./images/capas_jogos/indisponivel.png";
    } else {
        return $caminho;
    }
}

function msg_sucesso($msg) {
    $resposta = "<div class='msg_sucesso'><span class='material-symbols-outlined'>check_circle</span>" . $msg . "</div> <a href='./index.php'><span class='material-symbols-outlined icone_voltar'>arrow_back</span></a>";
    return $resposta;
}

function msg_aviso($msg) {
    $resposta = "<div class='msg_aviso'><span class='material-symbols-outlined'>info</span>" . $msg . "</div> <a href='./index.php'><span class='material-symbols-outlined icone_voltar'>arrow_back</span></a>";
    return $resposta;
}

function msg_erro($msg) {
    $resposta = "<div class='msg_erro'><span class='material-symbols-outlined'>error</span>" . $msg . "</div> <a href='./index.php'><span class='material-symbols-outlined icone_voltar'>arrow_back</span></a>";
    return $resposta;
}
?>
