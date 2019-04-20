<?php
include_once "../includes/header.php";
include_once "../includes/menu_right.php";
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Clientes</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-5">
                                    <a class="btn btn-default btn-sm" href="new_pf.php"> Cadastrar Cliente Pessoa Física</a>
                                    <a class="btn btn-default btn-sm" href="new_pj.php"> Cadastrar Cliente Pessoa Jurídica</a>
                                </div>
                                <div class="col-lg-7 text-right">
                                    <form class="form-inline">                                     
                                        <div class="form-group">
                                            <label class="font-weight-bold">Filtrar por: </label>
                                            <label class="radio-inline">
                                                    <input class="form-check-input" type="radio" name="rAtivo" value="">Todos os Clientes
                                            </label>
                                            <label class="radio-inline">
                                                    <input class="form-check-input" type="radio" name="rAtivo" value="1" checked="checked">Ativos
                                                </label>
                                                <label class="radio-inline">
                                                    <input class="form-check-input" type="radio" name="rAtivo" value="0">Inativo
                                                </label>
                                        </div>                                                                        
                                    </form>
                            </div>   
                            </div>
                        </div>
                       <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>CPF/CNPJ</th>
                                        <th>telefone</th>
                                        <th>Celular</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>CPF/CNPJ</th>
                                        <th>telefone</th>
                                        <th>Celular</th>
                                        <th>Ações</th>
                                    </tr>
                                </tfoot>
                                
                            </table>
                        <!-- MODAL PARA REMOVER REGISTROS -->
                        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header text-white bg-dark">
                                        Confirmação
                                    </div>
                                    <div class="modal-body">
                                        <label id='msgDeRemocao'></label>
                                    </div>
                                    <div id='retornoHTML'></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Cancelar</button>
                                        <a class="btn btn-danger text-white btn-remove" id="btn-remove">Remover</a>
                                        <a class="btn btn-primary text-white btn-entendi" style='display: none'>Entendi</a>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <!-- FIM DO MODAL PARA REMOVER REGISTROS -->
                        <!-- MODAL PARA RELATORIOS -->
                        <div class="modal fade" id="modalRel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">                               
                                    <div id='body-rel' class="modal-body">                       
                                    </div>  
                                    
                                                                            
                                </div>
                            </div>
                        </div>
                        <!-- FIM DO MODAL PARA RELATORIOS  -->
                        </div>
                    </div>

                </div>
            </div>
        <!-- /#page-wrapper -->

        </div>
    <!-- /#wrapper -->
<?php include "../includes/footer.php"; ?>

 <!-- Funções DataTable e outras desenvolvidas por mim -->
<script src="js/functions_index.js"></script>   




