<?php
include_once "../includes/header.php";
include_once "../includes/menu_right.php";

/*include "../../Controller/ControllerCliente.php";
$controller = new ControllerCliente();
$resultadoAposInserir = $controller->inserir();
//$query = $controller->query;
*/
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cadastro de Cliente Pessoa Fisica</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="btn btn-default btn-sm" href="index.php"> Exibir Listagem</a>                    
                        </div>
                        <div class="panel-body">
                                                       
                                <form id=form name=form> 
                                    <div class="row">   
                                        <div class="form-group col-lg-12" id="form-nome" >
                                            <label class="control-label" id="label-nome">Nome</label>
                                            <input class="form-control" placeholder="Informe o nome do cliente" name="nome" id="nome">
                                        </div>                                        
                                        
                                    </div>                        
                                    <input type="hidden" name="tipo" id="tipopj" value="Pessoa Jurídica">
                                                                         
                                    <div class="row">
                                        <div id="pessoa-juridica">
                                            <div class="form-group col-lg-6" id="form-cnpj" >
                                                <label class="control-label" id="label-cnpj">CNPJ</label>
                                                <input class="form-control" placeholder="Informe o CNPJ" name="cnpj" id="cnpj">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Inscrição Estadual</label>
                                                <input class="form-control" placeholder="Informe a inscrição estadual" name="ie" id="ie">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3" id="form-telefone" >
                                            <label class="control-label" id="label-telefone">Telefone</label>
                                            <input type="tel" class="form-control" placeholder="Informe o Telefone" name="telefone" id="telefone" >
                                        </div>
                                        <div class="form-group col-lg-3" id="form-celular" >
                                            <label class="control-label" id="label-celular">Celular</label>
                                            <input type="tel" class="form-control" placeholder="Informe o Celular" name="celular" id="celular" >
                                        </div>
                                        <div class="form-group col-lg-6" id="form-email" >
                                            <label class="control-label" id="label-email">E-mail</label>
                                            <input type="text" class="form-control" placeholder="Informe o E-Mail" name="email" id="email" >
                                        </div>
                                    </div>
                                    <div class="row">   
                                        <div class="form-group col-lg-4" >
                                            <label>Endereço</label>
                                            <input class="form-control" placeholder="Informe o endereço" name="endereco" id="endereco" >
                                        </div>
                                        <div class="form-group col-lg-2" >
                                            <label>Número</label>
                                            <input class="form-control" placeholder="Informe o Número" name="nro" id="nro" >
                                        </div>
                                        <div class="form-group col-lg-3" >
                                            <label>Complemento</label>
                                            <input class="form-control" placeholder="Informe o Complemento" name="complemento" id="complemento" >
                                        </div>
                                        <div class="form-group col-lg-3" >
                                            <label>Bairro</label>
                                            <input class="form-control" placeholder="Informe o Bairro" name="bairro" id="bairro" >
                                        </div>
                                    </div>
                                    <div class="row">   
                                        <div class="form-group col-lg-3" >
                                            <label>CEP</label>
                                            <input class="form-control" placeholder="Informe o CEP" name="cep" id="cep">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Cidade</label>
                                            <select class="form-control" name="cidade" id="cidade" onchange="selecionaCidadeAtribuiUf(this)">
                                                <option value="" selected>:: Escolha uma Opção ::</option>
                                                <?php
                                                   include_once MODEL."/Cidade.php";
                                                    $cidade = new Cidade();
                                                    $query = $cidade->buscaTodos();
                                                foreach ($query as $linha){
                                                    echo  "<option value=$linha->idcidade data-valor='$linha->uf'>$linha->cidade </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-2" >
                                            <label>UF</label>
                                            <input class="form-control" id="uf" readonly>
                                        </div>
                                        <div class="form-group col-lg-3" >
                                            <label>Ativo </label>
                                            <select class="form-control" name = "ativo" id="ativo">
                                                <option value='1' selected>Sim</option>
                                                <option value='0'>Não</option>
                                            </select>
                                        </div>
                                        </div>
                                    <div class="row">   
                                        <div class="control-group form-group col-lg-12">
                                                <div class="form-group col-lg-12">
                                                    <button class="btn btn-primary" id="btnGravar" name="gravar">Salvar Dados</button>
                                                    <button class="btn btn-default" id="btnNovo" name="novo" style="display: none">Inserir Novo</button>
                                                </div>
                                        </div>
                                        
                                    </div>
                                    
                                </form>                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <!-- MODAL PARA CONFIRMAR SALVAR -->
             <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">                               
                        <div class="modal-body">
                            <h4 id="msg"></h4>
                        </div>                                                
                    </div>
            </div>
            <!-- FIM DO MODAL PARA CONFIRMAR SALVAR  -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "../includes/footer.php"; ?>


<!-- Jquery Validate Plugin -->
<script src="http://<?php echo VALIDATION ?>"></script>

<!-- Jquery Mask Plugin -->
<script src="http://<?php echo MASK ?>"></script>

<!-- Jquery VALIDATION_ADDITIONAL Plugin -->
<script src="http://<?php echo VALIDATION_ADDITIONAL ?>"></script>
<script src="js/functions_new.js"></script>

<!-- Jquery VALIDAR CNPJ, EU QUE FIZ Plugin -->
<script src="http://<?php echo VALIDAR_CNPJ ?>"></script>

<!-- Jquery VALIDATION_LOCALIZATION Plugin -->
<script src="http://<?php echo VALIDATION_LOCALIZATION ?>"></script>

<!-- meus scripts -->
<script src="js/mask_validations.js"></script>
<script src="js/functions_new.js"></script>


</html>