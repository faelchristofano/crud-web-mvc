<?php
include_once '../../config.php';
include_once MODEL."/Cliente.php";

$model = new Cliente();
//verifica se existe cliente cadastrado com esse cpf e email que seja diferente que o próprio 
//cliente que está tendo os dados atualizados.
$buscaCPFouCNPJ = isset($_POST['cpf']) ? $_POST['cpf'] : $_POST['cnpj'];
$cpfouCnpjExiste = $model->buscaCPFouCNPJ($buscaCPFouCNPJ);
if($cpfouCnpjExiste && $cpfouCnpjExiste->id != $_POST['id']){
    echo json_encode(array('sucesso'=>false, 'mensagem'=>'Ops!! Já existe um cliente com esse cpf cadastrado.'));
    die();
};
$emailExiste = $model->buscaEmail($_POST['email']);
if($emailExiste && $emailExiste->id != $_POST['id']){
    echo json_encode(array('sucesso'=>false, 'mensagem'=>'Ops!! Já existe um cliente com esse e-email cadastrado.'));
    die();
};
if($model->update($_POST)){
    echo json_encode(array('sucesso'=>true, 'mensagem'=>'Dados Salvos com Sucesso!'));
} else {
    echo json_encode(array('sucesso'=>false, 'mensagem'=>'Ops!! Erro ao atualizar, informe o Setor de TI.'));
}
      
