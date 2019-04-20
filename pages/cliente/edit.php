<?php
include_once "../includes/header.php";
include_once "../includes/menu_right.php";

include MODEL."/Cliente.php";
$model = new Cliente();

if(!$model->buscaId($_GET['id'])){ ?>
    <script>
        alert(':: Registro não identificado! ::'); 
        window.location.replace('index.php');
    </script>
    
   <?php
} else {
    $query = $model->buscaId($_GET['id']);
}
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Editando Dados do Cliente</h1>
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
                            <form name="form" id="form">
                                <input type='hidden' name='id' id='id' value="<?php echo $query->id ?>">
                                <div class="row">   
                                    <div class="form-group col-lg-9" id="form-nome" >
                                        <label class="control-label" id="label-nome">Nome</label>
                                        <input class="form-control" placeholder="Informe o nome do cliente" name="nome" id="nome" value="<?php echo $query->nome ?>">
                                    </div>           
                                    <?php if($query->tipo == 'Pessoa Física'){ ?>                             
                                        <div class="form-group col-lg-3" >
                                            <label class="control-label" id="label-datanasc">Data de Nascimento:</label>
                                            <input class="form-control" placeholder="Informe a data de nascimento" name="datanasc" id="datanasc" value="<?php echo date('d/m/Y', strtotime($query->datanasc)) ?>">
                                        </div>
                                    <?php } ?>
                                </div>                                
                                <div class="row">
                                <?php if($query->tipo == 'Pessoa Física'){ ?>
                                            <input type="hidden" name="tipo" id="tipopf" value="Pessoa Física">
                                            <div class="form-group col-lg-6" id="form-cpf">
                                                    <label class="control-label" id="label-cpf">CPF</label>
                                                    <input class="form-control" placeholder="Informe o CPF" name="cpf" value="<?php echo $query->cpf ?>" id="cpf">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>RG</label>
                                                    <input class="form-control" placeholder="Informe o RG" name="rg" value="<?php echo $query->rg ?>" id="rg">
                                            </div>
                                <?php  } else { ?>
                                            <input type="hidden" name="tipo" id="tipopj" value="Pessoa Juridica">
                                            <div class="form-group col-lg-6" id="form-cnpj">
                                                    <label class="control-label" id="label-cnpj">CNPJ</label>
                                                    <input class="form-control" placeholder="Informe o CNPJ" name="cnpj" value="<?php echo $query->cnpj ?>" id="cnpj">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Inscrição Estadual</label>
                                                    <input class="form-control" placeholder="Informe a Inscrição Estadual" name="ie" value="<?php echo $query->ie ?>" id="ie">
                                            </div>
                                 <?php  }  ?>                                                                        
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3" id="form-telefone" >
                                        <label class="control-label" id="label-telefone">Telefone</label>
                                        <input type="tel" class="form-control" placeholder="Informe o Telefone" name="telefone" id="telefone" value="<?php echo $query->telefone ?>">
                                    </div>
                                    <div class="form-group col-lg-3" id="form-celular" >
                                        <label class="control-label" id="label-celular">Celular</label>
                                        <input type="tel" class="form-control" placeholder="Informe o Celular" name="celular" id="celular" value="<?php echo $query->celular ?>">
                                    </div>
                                    <div class="form-group col-lg-6" id="form-email" >
                                        <label class="control-label" id="label-email">E-mail</label>
                                        <input type="text" class="form-control" placeholder="Informe o E-Mail" name="email" id="email" value="<?php echo $query->email ?>">
                                    </div>
                                </div>
                                <div class="row">   
                                    <div class="form-group col-lg-4" >
                                        <label>Endereço</label>
                                        <input class="form-control" placeholder="Informe o endereço" name="endereco" id="endereco" value="<?php echo $query->endereco ?>">
                                    </div>
                                    <div class="form-group col-lg-2" >
                                        <label>Número</label>
                                        <input class="form-control" placeholder="Informe o Número" name="nro" id="nro" value="<?php echo $query->nro ?>">
                                    </div>
                                    <div class="form-group col-lg-3" >
                                        <label>Complemento</label>
                                        <input class="form-control" placeholder="Informe o Complemento" name="complemento" id="complemento" value="<?php echo $query->complemento ?>">
                                    </div>
                                    <div class="form-group col-lg-3" >
                                        <label>Bairro</label>
                                        <input class="form-control" placeholder="Informe o Bairro" name="bairro" id="bairro" value="<?php echo $query->bairro ?>">
                                    </div>
                                </div>
                                <div class="row">   
                                    <div class="form-group col-lg-3" >
                                        <label>CEP</label>
                                        <input class="form-control" placeholder="Informe o CEP" name="cep" id="cep" value="<?php echo $query->cep ?>">
                                    </div>
                                <div class="form-group col-lg-4">
                                    <label>Cidade</label>
                                    <select class="form-control" name="cidade" id="cidade" onchange="selecionaCidadeAtribuiUf(this)">
                                        <option value="" selected>:: Escolha uma Opção ::</option>
                                        <?php
                                        include_once MODEL."/Cidade.php";
                                        $cidade = new Cidade();
                                        $queryc = $cidade->buscaTodos();
                                        foreach ($queryc as $linha){
                                            if($query->cidade_id == $linha->idcidade){
                                                echo  "<option value=$linha->idcidade data-valor='$linha->uf' selected>$linha->cidade </option>";
                                                $uf = $linha->uf;
                                            } else {
                                                echo  "<option value=$linha->idcidade data-valor='$linha->uf'>$linha->cidade </option>";
                                            }

                                        }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="form-group col-lg-2" >
                                        <label>UF</label>
                                        <input class="form-control" id="uf" value="<?php echo $uf ?> " readonly>
                                    </div>
                                    <div class="form-group col-lg-3" >
                                        <label>Ativo </label>
                                        <select class="form-control" name = "ativo" id="ativo">
                                            <?php
                                                if($query->ativo == 1){
                                                    echo "<option value='1' selected>Sim</option>";
                                                    echo "<option value='0'>Não</option>";
                                                } else {
                                                    echo "<option value='1'>Sim</option>";
                                                    echo "<option value='0' selected>Não</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">   
                                    <div class="control-group form-group col-lg-12">
                                            <div class="form-group col-lg-12">
                                                <button class="btn btn-success" id="btnAtualizar" name="gravar">Atualizar Dados</button>                                                
                                            </div>
                                    </div>
                                    <!-- <div class='col-lg-12' id="msg"></div> -->
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
             <!-- MODAL PARA CONFIRMAR ATUALIZAÇÕES -->
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
<script src="js/functions_edit.js"></script>

</body>

</html>
