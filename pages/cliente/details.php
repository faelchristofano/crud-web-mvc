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
                    <h1 class="page-header">Dados do Cliente</h1>
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
                            
                        <div class="row">   
                            <div class="form-group col-lg-9" id="form-nome" >
                                <label class="control-label" id="label-nome">Nome</label>
                                <input class="form-control" value="<?php echo $query->nome ?>" readonly>
                            </div>                                        
                            <?php if($query->tipo == 'Pessoa Física'){ ?>                             
                                        <div class="form-group col-lg-3" >
                                            <label class="control-label" id="label-datanasc">Data de Nascimento:</label>
                                            <input class="form-control" name="datanasc" id="datanasc" value="<?php echo date('d/m/Y', strtotime($query->datanasc)) ?>">
                                        </div>
                            <?php } ?>
                        </div>
                        <div class="row">   
                            <?php if($query->tipo == 'Pessoa Física'){ ?>
                            <div id="pessoa-fisica">
                                <?php } else { ?>
                                    <div id="pessoa-fisica" style="display: none">
                                <?php } ?>
                                <div class="form-group col-xs-6" id="form-cpf">
                                    <label class="control-label" id="label-cpf">CPF</label>
                                    <input class="form-control" value="<?php echo $query->cpf ?>" id="cpf" readonly>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label>RG</label>
                                    <input class="form-control" value="<?php echo $query->rg ?> "readonly>

                            </div>
                            </div>
                            <?php if($query->tipo == 'Pessoa Jurídica'){ ?>
                            <div id="pessoa-juridica">
                                <?php } else { ?>
                                    <div id="pessoa-juridica" style="display: none">
                                <?php } ?>
                                    <div class="form-group col-xs-6" id="form-cnpj" >
                                        <label class="control-label" id="label-cnpj">CNPJ</label>
                                        <input class="form-control" value="<?php echo $query->cnpj ?>" id="cnpj"readonly>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label>IE</label>
                                        <input class="form-control" value="<?php echo $query->ie ?>" id="ie"readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">  
                                <div class="form-group col-xs-6" id="form-telefone" >
                                    <label class="control-label" id="label-telefone">Telefone</label>
                                    <input type="tel" class="form-control" value="<?php echo $query->telefone ?>" id="telefone" readonly >
                                </div>
                                <div class="form-group col-xs-6" id="form-celular" >
                                    <label class="control-label" id="label-celular">Celular</label>
                                    <input type="tel" class="form-control" value="<?php echo $query->celular ?>" id="celular" readonly >
                                </div>
                                <div class="form-group col-xs-6" >
                                    <label>Endereço</label>
                                    <input class="form-control" value="<?php echo $query->endereco ?>" readonly>
                                </div>
                                <div class="form-group col-xs-2" >
                                    <label>Número</label>
                                    <input class="form-control" value="<?php echo $query->nro ?>"readonly >
                                </div>
                                <div class="form-group col-xs-4" >
                                    <label>Complemento</label>
                                    <input class="form-control" value="<?php echo $query->complemento ?>" readonly>
                                </div>
                                <div class="form-group col-xs-3" >
                                    <label>Bairro</label>
                                    <input class="form-control" value="<?php echo $query->bairro ?>" readonly>
                                </div>
                                <div class="form-group col-xs-3" >
                                    <label>CEP</label>
                                    <input class="form-control" value="<?php echo $query->cep ?>"readonly>
                                </div>
                                <div class="form-group col-xs-4">
                                    <label>Cidade</label>

                                        <?php
                                        include_once MODEL."/Cidade.php";
                                        $cidade = new Cidade();
                                        $queryc = $cidade->buscaId($query->cidade_id);
                                        $uf = $queryc->uf;
                                        ?>
                                        <input class="form-control" value="<?php echo $queryc->cidade ?>" readonly>
                                    </select>
                                </div>
                                <div class="form-group col-xs-2" >
                                    <label>UF</label>
                                    <input class="form-control" value="<?php echo $uf ?> " readonly>
                                </div>

                            </div>                                                  
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "../includes/footer.php"; ?>

</body>

</html>
