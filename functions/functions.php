<?php

function verificaSessaoCookie(){
    session_start();
    if(isset($_COOKIE['oficina']) && !isset($_SESSION['oficina'])){
        $_SESSION['oficina'] = unserialize($_COOKIE['oficina']);
    }
    if(!isset($_COOKIE['oficina']) && !isset($_SESSION['oficina'])){
        header('Location: http://'.BASEURL.'/pages/auth/login.php');
    }
}

//converte o valor digitado pelo usuario para o padrão que o mysql aceita
function moeda($get_valor) {
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
    return $valor; //retorna o valor formatado para gravar no banco
}