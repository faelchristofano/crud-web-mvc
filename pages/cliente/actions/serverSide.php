<?php
include_once '../../config.php';
include MODEL."/Cliente.php";
$model = new Cliente();

//a cada interação do usuário no Datatables, é passado uma requisição atraves do $_REQUEST
$requestData = $_REQUEST;
$rAtivo = $_POST['rAtivo'];


//crio esse array para passar o nome da coluna na tabela para ser ordenada, senão fizer o 
// $requestData['order'][0], retorna apenas o numero da coluna e não o nome

$columns = array(
    0 => 'cl.nome',
    1 => 'documento',
    2 => 'telefone',
    3 => 'celular'
);


$dadosComFiltro = $model->busca(
                    $requestData['search']['value'],  //pesquisa no campo localizar
                    $columns[intval($requestData['order'][0]['column'])], // coluna que sera ordenada
                    $requestData['order'][0]['dir'], //direção ASC ou DESC
                    $requestData['start'], // inicio da busca
                    $requestData['length'], // quantidade de elementos
                    $rAtivo
                ); 


// Quatidade de linhas retornadas
                
$nro_linha = $model->retornaLinhas($requestData['search']['value'], $rAtivo)->qtdeLinhas;           
$totalFiltered = $nro_linha;


$json_data = array(
    "draw" => intval($requestData['draw']),
    "recordsTotal" => intval($nro_linha),
    "recordsFiltered" => intval($totalFiltered),
//	"recordsFiltered" => intval('0'),
    "data" => $dadosComFiltro
);

echo json_encode($json_data);