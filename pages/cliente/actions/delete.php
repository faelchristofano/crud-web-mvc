<?php
include_once '../../config.php';
verificaSessaoCookie();

include MODEL."/Cliente.php";
$model = new Cliente();

if(!$model->buscaId($_POST['id'])){ ?>
    <script>
        alert(':: Registro não identificado! ::'); 
        window.location.replace('index.php');
    </script>
    
   <?php
} else {
    if ($model->delete($_POST['id'])){
        echo json_encode(array('sucesso'=>true, 'mensagem'=>'Registro Removido'));
    } else {
        echo json_encode(array('sucesso'=>false, 'mensagem'=>'Ops!! Já existe histórico de serviços deste cliente, para remover o cliente, primeiro é preciso remover todo seu histórico.'));
    }
   
}


?>