<?php
include_once '../../config.php';
include_once MODEL."/Cliente.php";

$model = new Cliente();
$buscaCPFouCNPJ = isset($_POST['cpf']) ? $_POST['cpf'] : $_POST['cnpj'];
if(!$model->buscaCPFouCNPJ($buscaCPFouCNPJ)){
    if(!$model->buscaEmail($_POST['email'])){
        if($model->insert($_POST)){
            echo json_encode(array('sucesso'=>true, 'mensagem'=>'Dados Salvos com Sucesso!'));
        } else {
            echo json_encode(array('sucesso'=>false, 'mensagem'=>'Ops!! Erro ao cadastrar, informe o Setor de TI.'));
        }
    } else {
        echo json_encode(array('sucesso'=>false, 'mensagem'=>'Ops!! Já existe um cliente com esse e-email cadastrado.'));
    }
} else {
    echo json_encode(array('sucesso'=>false, 'mensagem'=>'Ops!! Já existe um cliente com esse Cpf/Cnpj cadastrado.'));
}


